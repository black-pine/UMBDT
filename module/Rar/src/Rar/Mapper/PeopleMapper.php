<?php
namespace Rar\Mapper;

class PeopleMapper extends \NovumWare\Db\Table\Mapper\AbstractMapper
{
	static protected $mapperTableName = 'people';
	protected $columnPrefix = 'person_';
	protected $idColumn = 'person_id';
	protected $modelClass = '\Rar\Model\PersonModel';


	// ========================================================================= CONVENIENCE METHODS =========================================================================
	/**
	 * @return array of \Rar\Model\PersonModel
	 */
	public function fetchDrivers() {
		return $this->fetchManyWhere(array('person_driver = ?' => true));
	}

	/**
	 * @return array of \Rar\Model\PersonModel
	 */
	public function fetchRiders() {
		return $this->fetchManyWhere(array('person_driver = ?' => false, 'person_driver_person_id is ?' => null));
	}

	/**
	 * @return array of \Rar\Model\PersonModel
	 */
	public function fetchRidersWithDriver() {
		$driversArray = $this->fetchDrivers();
		$driversRidersArray = [];
		foreach ($driversArray as $driverKey => $driverModel) {
			$driversRidersArray[$driverKey] = $this->fetchManyWhere(array('person_driver_person_id = ?' => $driverModel->id));
		}
		return $driversRidersArray;
	}


	// ========================================================================= OVERRIDES =========================================================================
	/**
	 * @param \NovumWare\Model\AbstractModel $model
	 * @return void
	 */
	public function insertModel(\NovumWare\Model\AbstractModel $model) {
		$intTime = $model->departureTime;
		$model->departureTime = date('Y-m-d H:i:s', $intTime);
		parent::insertModel($model);
		$model->departureTime = $intTime;
	}

	/**
	 * Fetch many rows from the DB with a Select
	 *
	 * @param \Zend\Db\Sql\Select $select
	 * @return array of \NovumWare\Model\AbstractModel
	 */
	public function fetchManyWithSelect(\Zend\Db\Sql\Select $select) {
		$modelsArray = parent::fetchManyWithSelect($select);
		foreach ($modelsArray as $personModel) $personModel->departureTime = strtotime($personModel->departureTime);
		return $modelsArray;
	}

	/**
	 * Update the DB using a Model
	 *
	 * @param \NovumWare\Model\AbstractModel $model
	 * @param array $where
	 * @return void
	 * @throws \Exception if $where is empty
	 */
	public function updateModel(\NovumWare\Model\AbstractModel $model) {
		$intTime = $model->departureTime;
		$model->departureTime = date('Y-m-d H:i:s', $intTime);
		parent::updateModel($model);
		$model->departureTime = $intTime;
	}
}