<?php
namespace NovumWare\Process;

/**
 * All public methods are NOT run in DB transactions.
 * To run a process in a DB transaction, it must be protected with an '_' preceding the method name.
 * Then call the method name without the preceding '_', and __call() wll handle the DB transaction.
 */
abstract class AbstractProcess
{
	/** @var \Zend\ServiceManager\ServiceManager */
	protected $serviceManager;

	/** @var \Zend\Db\Adapter\Adapter */
	protected $dbAdapter;

	/** @var \Zend\Db\Adapter\Driver\Pdo\Connection */
	protected $dbConnection;


	public function __construct(\Zend\Db\Adapter\Adapter $dbAdapter, \Zend\ServiceManager\ServiceManager $sm) {
		$this->serviceManager = $sm;
		$this->dbAdapter = $dbAdapter;
		$this->dbConnection = $this->dbAdapter->getDriver()->getConnection();
	}

	/**
	 * Magic method to call methods in a DB transaction
	 *
	 * @param string $name
	 * @param string $arguments
	 * @return mixed
	 * @throws \Exception if the method does not exist on this object
	 */
	public function __call($name, $arguments) {
		$prefixedName = '_'.$name;
		if (!method_exists($this, $prefixedName)) throw new \Exception(get_class($this)." has no method: $name())");
		if (!$this->dbConnection->isConnected()) $this->dbConnection->connect();
		if (!$this->dbConnection->getResource()->inTransaction()) $this->dbConnection->beginTransaction ();
		try {
			$result = call_user_func_array(array($this, $prefixedName), $arguments);
			$this->dbConnection->commit();
			return $result;
		} catch(\NovumWare\Process\ProcessException $novumWareException) {
			$this->dbConnection->rollback();
			return $this->catchNovumWareException($novumWareException);
		} catch(\Exception $exception) {
			$this->dbConnection->rollback();
			throw $exception;
		}
	}

	/**
	 * @param \NovumWare\Process\ProcessException $novumWareException
	 * @return \NovumWare\Process\ProcessResult
	 */
	protected function catchNovumWareException(ProcessException $novumWareException) {
		$errorMessage = $novumWareException->getErrorMessage();
		return new ProcessResult(false, null, $errorMessage);
	}

	/**
	 * @return void
	 */
//	static protected function activateProfiler() {
//	    static::$dbProfiler = Zend_Db_Table::getDefaultAdapter()->getProfiler();
//	    static::$dbProfiler->setEnabled(true);
//	}

	/**
	 * @param Exception $exception
	 * @return void
	 */
//	static protected function printDebugInfo(Exception $exception) {
//	    if (get_class($exception) == 'Zend_Db_Statement_Exception') Zend_Debug::dump(static::$dbProfiler->getLastQueryProfile());
////	    else Zend_Debug::dump($exception->getMessage());
//	    print "<pre>$exception</pre>";
//	}

	// ========================================================================= HELPER METHODS =========================================================================
	/**
	 * Uses the View Helper Url
	 *
	 * @param string $routeName
	 * @param array $params
	 * @param array $options
	 * @return string
	 */
	protected function url($routeName, array $params=null, array $options=null) {
		if (!$params) $params = array();
		return $this->serviceManager->get('ViewHelperManager')->get('url')->__invoke($routeName, $params, $options);
	}

}
