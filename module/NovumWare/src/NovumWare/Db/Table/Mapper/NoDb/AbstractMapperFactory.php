<?php
namespace NovumWare\Db\Table\Mapper\NoDb;

use Zend\Db\Sql\Sql;
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
		return (is_subclass_of($requestedName, 'NovumWare\Db\Table\Mapper\NoDb\AbstractMapper'));
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
		$sql = new Sql($dbAdapter);
		return new $requestedName($sql);
	}
}
