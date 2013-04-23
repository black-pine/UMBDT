<?php
namespace NovumWare\Process;

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
		$dbAdapter = $locator->get('Zend\Db\Adapter\Adapter');
		return new $requestedName($dbAdapter, $locator);
	}
}
