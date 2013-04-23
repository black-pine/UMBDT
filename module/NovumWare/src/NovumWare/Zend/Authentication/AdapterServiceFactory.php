<?php
namespace NovumWare\Zend\Authentication;

use Zend\ServiceManager\ServiceLocatorInterface;

class AdapterServiceFactory implements \Zend\ServiceManager\FactoryInterface
{
	/**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
		return new Adapter($serviceLocator->get('Zend\Db\Adapter\Adapter'));
	}
}