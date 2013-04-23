<?php
namespace NovumWare\Db\Table\Mapper;

use NovumWare\NovumWareHelpers;
use NovumWare\Model\AbstractModel;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Update;

/**
 * @property string $tableName
 * @property string $columnPrefix
 * @property string $idColumn
 * @property string $modelClass
 */
abstract class AbstractMapper
{
//	static protected $mapperTableName = 'table_name';
//	protected $columnPrefix = 'prefix_';
//	protected $idColumn = 'prefix_id';
//	protected $modelClass = 'Path\To\Model';

	public $tableName;

	/** @var bool */
	public $printQuery = false;

	/** @var \NovumWare\Zend\Db\TableGateway\TableGateway */
	public $tableGateway;


	public function __construct(\Zend\Db\TableGateway\AbstractTableGateway $tableGateway) {
		if (!property_exists($this, 'columnPrefix')) throw new \Exception('static protected $columnPrefix must be set in '.get_called_class());
		if (!isset($this->idColumn)) throw new \Exception('static protected $idColumn must be set in '.get_called_class());
		if (!isset($this->modelClass)) throw new \Exception('static protected $modelClass must be set in '.get_called_class());
		$this->tableName = static::getTableName();
		$this->tableGateway = $tableGateway;
	}


	// ========================================================================= INSERT METHODS =========================================================================
	/**
	 * @param \NovumWare\Model\AbstractModel $model
	 * @return void
	 */
	public function insertModel(AbstractModel $model) {
		$this->checkModelClass($model);
		if (property_exists($model, 'time_created')) $model->time_created = NovumWareHelpers::datePHPToMysql();
		$this->tableGateway->insert($this->prefixDataArray($model->toArray()));
	}


	// ========================================================================= FETCH METHODS =========================================================================
	/**
	 * Fetch many rows from the DB with a Select
	 *
	 * @param \Zend\Db\Sql\Select $select
	 * @return array of \NovumWare\Model\AbstractModel
	 */
	public function fetchManyWithSelect(Select $select) {
		if ($this->printQuery) var_dump($select->getSqlString());
		$resultSet = $this->tableGateway->selectWith($select);
		return $this->convertResultSetToModelsArray($resultSet);
	}

	/**
	 * Fetch one row from the DB with a Select
	 *
	 * @param \Zend\Db\Sql\Select $select
	 * @return \NovumWare\Model\AbstractModel
	 * @throws \Exception if more than one row is returned
	 */
	public function fetchOneWithSelect(Select $select) {
		$modelsArray = $this->fetchManyWithSelect($select);
		if (count($modelsArray) > 1) throw new \Exception('More than one row returned with: '.$select->getSqlString());
		return (isset($modelsArray[0])) ? $modelsArray[0] : null;
	}


	// ========================================================================= CONVENIENT FETCH METHODS =========================================================================
	/**
	 * Fetch all rows from the DB
	 *
	 * @return array of \NovumWare\Model\AbstractModel
	 */
	public function fetchAll() {
		$select = $this->getSelect();
		return $this->fetchManyWithSelect($select);
	}

	/**
	 * Fetch many rows with a WHERE clause
	 *
	 * @param array $where
	 * @return array of \NovumWare\Model\AbstractModel
	 */
	public function fetchManyWhere(array $where) {
		$select = $this->getSelect();
		$select->where($where);
		return $this->fetchManyWithSelect($select);
	}

	/**
	 * Fetch one row from the DB with a WHERE clause
	 *
	 * @param array $where
	 * @return \NovumWare\Model\AbstractModel
	 */
	public function fetchOneWhere(array $where) {
		$select = $this->getSelect();
		$select->where($where);
		return $this->fetchOneWithSelect($select);
	}

	/**
	 * Fetch on row for an id
	 *
	 * @param int $id
	 * @return \NovumWare\Model\AbstractModel
	 */
	public function fetchOneForId($id) {
		return $this->fetchOneWhere(array($this->idColumn.' = ?' => $id));
	}


	// ========================================================================= UPDATE METHODS =========================================================================
	/**
	 * Update the DB using a Model
	 *
	 * @param \NovumWare\Model\AbstractModel $model
	 * @param array $where
	 * @return void
	 * @throws \Exception if $where is empty
	 */
	public function updateModel(AbstractModel $model) {
		$this->checkModelClass($model);
		$dataArray = $this->prefixDataArray($model->toArray());
		$id = $dataArray[$this->idColumn];
		if (!$id) throw new \Exception(get_class($model).':'.$this->idColumn.' must be set to update');
		$update = $this->getUpdate();
		$update->set($dataArray);
		$update->where(array($this->idColumn.' = ?'=>$id));
		$this->tableGateway->updateWith($update);
	}


	// ========================================================================= DELETE METHODS =========================================================================
	/**
	 * Delete row(s) using a WHERE clause
	 *
	 * @param array $where
	 * @return int
	 */
	public function deleteWhere(array $where) {
		if (empty($where)) throw new \Exception('WHERE clause provided is empty: '.print_r($where, true));
		$delete = $this->getDelete();
		$delete->where($where);
		if ($this->printQuery) var_dump($delete->getSqlString());
		return $this->tableGateway->deleteWith($delete);
	}


	// ========================================================================= CONVENIENT DELETE METHODS =========================================================================
	/**
	 * Delete a Model from the DB
	 *
	 * @param \NovumWare\Model\AbstractModel $model
	 * @return int
	 * @throws \Exception if the Model does not have a primary key set
	 */
	public function deleteModel(AbstractModel $model) {
		$this->checkModelClass($model);
		$data = $this->prefixDataArray($model->toArray());
		$id = $data[$this->idColumn];
		if (!$id) throw new \Exception('Could not delete '.get_class($model).': '.$this->idColumn.' was not set');
		return $this->deleteWhere(array($this->idColumn.' = ?' => $id));
	}


	// ========================================================================= HELPER METHODS =========================================================================
	/**
	 * Prefix array keys with $columnPrefix (for inserting into DB)
	 *
	 * @param array $unprefixedArray
	 * @return array Prefixed array
	 */
	protected function prefixDataArray(array $unprefixedArray) {
		$prefixedArray = array();
		foreach ($unprefixedArray as $key => $value) $prefixedArray[$this->columnPrefix.$key] = $value;
		return $prefixedArray;
	}

	/**
	 * Remove the $columnPrefix from array keys (for fetching from DB)
	 *
	 * @param array|ArrayObject $prefixedArray
	 * @return array
	 */
	protected function unprefixDataArray($prefixedArray) {
		$unprefixedArray = array();
		foreach ($prefixedArray as $key => $value) {
			if (substr($key, 0, strlen($this->columnPrefix)) == $this->columnPrefix) $key = substr($key, strlen($this->columnPrefix));
			$unprefixedArray[$key] = $value;
		}
		return $unprefixedArray;
	}

	/**
	 * Convert a set of DB results to an array of \NovumWare\ModelAbstract
	 *
	 * @param \Zend\Db\ResultSet\ResultSet $resultSet
	 * @return array of \NovumWare\Model\AbstractModel
	 */
	protected function convertResultSetToModelsArray(ResultSet $resultSet) {
		$modelsArray = array();
		foreach ($resultSet as $result) $modelsArray[] = new $this->modelClass($this->unprefixDataArray($result));
		return $modelsArray;
	}

	/**
	 * @param \NovumWare\Model\AbstractModel $model
	 * @throws \Exception if the $model is not an instance of the mapper's class
	 */
	protected function checkModelClass(AbstractModel $model) {
		if (!($model instanceof $this->modelClass)) throw new \Exception(get_class($model).' is not an instance of '.$this->modelClass);
	}


	// ========================================================================= CREATION METHODS =========================================================================
	public function createModelFromData($data) {
		if (is_object($data)) $data = get_object_vars($data);
		return new $this->modelClass($this->unprefixDataArray($data));
	}

	/**
	 * @return \Zend\Db\Sql\Select
	 */
	protected function getSelect() {
		return new Select($this->tableName);
	}

	/**
	 * @return \Zend\Db\Sql\Update
	 */
	protected function getUpdate() {
		return new Update($this->tableName);
	}

	/**
	 * @return \Zend\Db\Sql\Delete
	 */
	protected function getDelete() {
		return new Delete($this->tableName);
	}


	// ========================================================================= ACCESS METHODS =========================================================================
	static public function getTableName() {
		return static::$mapperTableName;
	}

	public function getColumPrefix() {
		return $this->columnPrefix;
	}

}