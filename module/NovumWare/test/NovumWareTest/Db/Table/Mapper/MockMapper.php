<?php
namespace NovumWareTest\Db\Table\Mapper;

class MockMapper extends \NovumWare\Db\Table\Mapper\AbstractMapper
{
	static protected $mapperTableName = 'mocks';
	protected $columnPrefix = 'mock_';
	protected $idColumn = 'mock_id';
	protected $modelClass = '\NovumWareTest\Model\MockModel';
}