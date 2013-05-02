<?php
namespace Rar\Mapper;

class PeopleMapper extends \NovumWare\Db\Table\Mapper\AbstractMapper
{
	static protected $mapperTableName = 'people';
	protected $columnPrefix = 'person_';
	protected $idColumn = 'person_id';
	protected $modelClass = '\Rar\Model\PersonModel';


	// ========================================================================= CONVENIENCE METHODS =========================================================================


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
}