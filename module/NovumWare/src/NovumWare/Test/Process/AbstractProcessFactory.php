<?php
namespace NovumWare\Test\Process;

use Zend\ServiceManager\ServiceLocatorInterface;

class AbstractProcessFactory implements \Zend\ServiceManager\AbstractFactoryInterface
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
		return is_subclass_of($requestedName, 'NovumWare\Process\AbstractProcess');
	}

	/**
	 * Create service with name
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @param $name
	 * @param $requestedName
	 * @return \NovumWare\Process\AbstractProcess
	 */
	public function createServiceWithName(ServiceLocatorInterface $locator, $name, $requestedName) {
		$mockResource = new \Mockery\Mock;
		$mockResource->shouldReceive('inTransaction')->andReturn(true);
		$mockConnection = \Mockery::mock('\Zend\Db\Adapter\Driver\Pdo\Connection');
		$mockConnection->shouldReceive('isConnected')->andReturn(true);
		$mockConnection->shouldReceive('getResource')->andReturn($mockResource);
		$mockConnection->shouldReceive('commit');
		$mockConnection->shouldReceive('rollback');
		$mockDriver = \Mockery::mock('\Zend\Db\Adapter\Driver\Pdo\Pdo');
		$mockDriver->shouldReceive('getConnection')->andReturn($mockConnection);
		$mockAdapter = \Mockery::mock('\Zend\Db\Adapter\Adapter');
		$mockAdapter->shouldReceive('getDriver')->andReturn($mockDriver);
		return new $requestedName($mockAdapter, $locator);
	}
}
