<?php
namespace NovumWare\Test\Controller;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Update;
use Zend\Json\Json;

abstract class AbstractControllerTest extends \Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase
{
	/**
     * Trace error when exception is throwed in application
     * @var boolean
     */
    protected $traceError = true;

	/** @var \Mockery\Mock */
	protected $mockTableGateway;

	/** @var \Mockery\Mock */
	protected $mockFlashMessenger;

	/** @var \Mockery\Mock */
	protected $mockEmailsProcess;


	public function setUp() {
		$configFile = realpath('config/application.config.php');
		if (!is_readable($configFile)) throw new \Exception('Cannot load the Application config file');
		$this->setApplicationConfig(include $configFile);
		$this->mockTableGateway = $this->getApplicationServiceLocator()->get('MockTableGateway');
		$this->mockFlashMessenger = $this->getApplicationServiceLocator()->get('ControllerPluginManager')->get('nwFlashMessenger');
		$this->mockFlashMessenger->shouldReceive('setController')->shouldReceive('getAllMessages');
		$this->mockEmailsProcess = $this->getApplicationServiceLocator()->get('NovumWare\Process\EmailsProcess');
	}


	// ========================================================================= HELPER METHODS =========================================================================
	/**
	 * @return array
	 */
	protected function getResultVariables() {
		return $this->getApplication()->getMvcEvent()->getResult()->getVariables();
	}

	/**
	 * @param string $tableName
	 * @return \Zend\Db\Sql\Select
	 */
	protected function getSelect($tableName) {
		return new Select($tableName);
	}

	/**
	 * @param string $tableName
	 * @return \Zend\Db\Sql\Update
	 */
	protected function getUpdate($tableName) {
		return new Update($tableName);
	}

	/**
	 * @param string $tableName
	 * @return \Zend\Db\Sql\Delete
	 */
	protected function getDelete($tableName) {
		return new Delete($tableName);
	}

	/**
	 * @param array $dataArrays an array or array of arrays (to simulate multiple DB rows returned)
	 * @return \Zend\Db\ResultSet\ResultSet
	 */
	protected function createResultSetFromData(array $dataArrays) {
		if (count($dataArrays) > 0 && !is_array(current($dataArrays))) $dataArrays = array($dataArrays);
		$resultSet = new ResultSet;
		$resultSet->initialize($dataArrays);
		return $resultSet;
	}

	/**
	 * @param array $dataArrays an array of array of arrays (to simulate multiple DB rows returned)
	 * @param string $modelClass
	 * @return array of \NovumWareTest\Model\MockModel
	 */
	protected function createMockModelsArrayFromData(array $dataArrays, $modelClass) {
		if (count($dataArrays) > 0 && !is_array(current($dataArrays))) $dataArrays = array($dataArrays);
		$mockModelsArray = array();
		foreach ($dataArrays as $data) $mockModelsArray[] = new $modelClass($data);
		return $mockModelsArray;
	}

	/**
	 * Prefix array keys with $columnPrefix (for inserting into DB)
	 *
	 * @param array $unprefixedArray
	 * @param string $prefix
	 * @return array Prefixed array
	 */
	protected function prefixDataArray(array $unprefixedArray, $prefix) {
		$prefixedArray = array();
		foreach ($unprefixedArray as $key => $value) $prefixedArray[$prefix.$key] = $value;
		return $prefixedArray;
	}

	/**
	 * @param \Zend\Db\Sql\AbstractSql $compareSql
	 * @return \Closure
	 */
	protected function getSqlStringCompareClosure(\Zend\Db\Sql\AbstractSql $compareSql) {
		return \Mockery::on(function($withSql) use($compareSql) {
			if ($withSql->getSqlString() != $compareSql->getSqlString()) {
//				echo PHP_EOL; var_dump($withSql->getSqlString()); var_dump($compareSql->getSqlString());
				return false;
			}
			return true;
		});
	}

	/**
	 * @param array $compareArray
	 * @return \Closure
	 */
	protected function getArrayCompareClosure(array $compareArray) {
		return \Mockery::on(function($withArray) use($compareArray) {
			$keysArray = array_keys($withArray);
			$keysToUnset = preg_grep('/.*_time_created|updated$/', $keysArray);
			foreach ($keysToUnset as $unsetKey) unset($withArray[$unsetKey]);
			if ($withArray != $compareArray) {
//				echo PHP_EOL; var_dump(array_diff_assoc($withArray, $compareArray)); exit();
//				echo PHP_EOL; var_dump($withArray, $compareArray); exit();
//				foreach (array_diff($withArray, $compareArray) as $key => $val) { echo PHP_EOL; var_dump($withArray[$key], $compareArray[$key]); } exit();
				return false;
			}
			return true;
		});
	}

	/**
	 * @param string $template
	 * return \Closure
	 */
	protected function getTemplateCompareClosure($template) {
		$viewRenderer = $this->getApplicationServiceLocator()->get('SmartyViewRenderer');
		return \Mockery::on(function($withTemplate) use($template, $viewRenderer){
			if ($viewRenderer->render($withTemplate) != $viewRenderer->render($template)) {
//				echo PHP_EOL; var_dump('Templates: ', $viewRenderer->render($withTemplate), $viewRenderer->render($template));
				return false;
			}
			return true;
		});
	}

	/**
	 * @param array $keys
	 * @return \Closure
	 */
	protected function getArrayKeysAreSetClosure(array $keys) {
		return \Mockery::on(function($withArray) use($keys){
			foreach ($keys as $key) if (!isset($withArray[$key]) || !$withArray[$key]) {
//				echo PHP_EOL; var_dump($key, 'does not exist');
				return false;
			}
			return true;
		});
	}

	 /**
      * Makes the dispatch a Ajax request
      */
      protected function setAjaxRequest() {
		  $this->getRequest()->getHeaders()->addHeaders(array('X-Requested-With' => 'XMLHttpRequest'));
      }

	  /**
       * Gets the Json reponse as a php array
       *
       * @return array
       */
       protected function getJsonResponse() {
		   return Json::decode($this->getResponse()->getBody(), Json::TYPE_OBJECT);
       }


}