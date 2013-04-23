<?php
namespace NovumWare\Db\Table\Mapper\NoDb;

use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;

/**
 * @property string $modelClass
 */
abstract class AbstractMapper
{
	/** @var \Zend\Db\Sql\Sql */
	public $sql;


	public function __construct(Sql $sql) {
		$this->sql = $sql;
	}

	// ========================================================================= SELECT METHODS =========================================================================
	/**
	 * @param \Zend\Db\Sql\Select $select
	 * @return array or arrays
	 */
	protected function executeSelect($select) {
		$tableGateway = $this->getTableGateway($select->getRawState(Select::TABLE));
		$resultSet = $tableGateway->selectWith($select);
		return $resultSet->toArray();
	}


	// ========================================================================= HELPER METHODS =========================================================================
	/**
	 * Convert a set of DB results to an array of \NovumWare\ModelAbstract
	 *
	 * @param \Zend\Db\ResultSet\ResultSet $resultSet
	 * @return array of \NovumWare\Model\AbstractModel
	 */
//	protected function convertResultSetToModelsArray(ResultSet $resultSet) {
//		$modelsArray = array();
//		foreach ($resultSet as $result) $modelsArray[] = new $this->modelClass($this->unprefixDataArray($result));
//		return $modelsArray;
//	}


	// ========================================================================= CREATION METHODS =========================================================================
	/**
	 * @param string $table
	 * @return \Zend\Db\Sql\Select
	 */
	protected function getSelect($table) {
		return new Select($table);
	}

	/**
	 * @param string $table
	 * @return \Zend\Db\TableGateway\TableGateway
	 */
	protected function getTableGateway($table) {
		$dbAdapter = $this->sql->getAdapter();
		return new TableGateway($table, $dbAdapter);
	}

}