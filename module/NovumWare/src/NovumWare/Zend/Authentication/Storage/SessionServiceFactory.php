<?php
namespace NovumWare\Zend\Authentication\Storage;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Application\Constants\ApplicationConstants;

class SessionServiceFactory implements FactoryInterface
{
	/**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
		return new Session(ApplicationConstants::SESSION_NAME);
	}
}