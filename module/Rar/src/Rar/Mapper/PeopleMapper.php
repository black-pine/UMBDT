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
}