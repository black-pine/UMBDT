<?php
namespace NovumWare\Db\Table\Mapper;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @codeCoverageIgnore
 */
class AbstractMapperFactory implements \Zend\ServiceManager\AbstractFactoryInterface
{
	/**
	 * Determine if we can create a service with name
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @param $name
	 * @param $requestedName
	 * @return bool
	 */
	public function canCreateServiceWithName(ServiceLocatorInterface $locator, $name, $requestedName) {
		return (is_subclass_of($requestedName, 'NovumWare\Db\Table\Mapper\AbstractMapper'));
	}

	/**
	 * Create service with name
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @param $name
	 * @param $requestedName
	 * @return \NovumWare\Db\Table\Mapper\AbstractMapper
	 */
	public function createServiceWithName(ServiceLocatorInterface $locator, $name, $requestedName) {
		$dbAdapter = $locator->get('Zend\Db\Adapter\Adapter');
		$resultSetPrototype = new ResultSet;
		$tableName = $requestedName::getTableName();
		$tableGateway = new TableGateway($tableName, $dbAdapter, null, $resultSetPrototype);
		return new $requestedName($tableGateway);
	}
}
