<?php
namespace NovumWare\Test\Db\Table\Mapper;

use Zend\ServiceManager\ServiceLocatorInterface;

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
		return is_subclass_of($requestedName, 'NovumWare\Db\Table\Mapper\AbstractMapper');
	}

	/**
	 * Create service with name
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @param $name
	 * @param $requestedName
	 * @return \Mockery\Mock
	 */
	public function createServiceWithName(ServiceLocatorInterface $locator, $name, $requestedName) {
		$mockTableGateway = $locator->get('MockTableGateway');
		return new $requestedName($mockTableGateway);
	}
}
