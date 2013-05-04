<?php

namespace Rar\Controller;

class RidesController extends \NovumWare\Zend\Mvc\Controller\AbstractActionController
{
    public function indexAction() {
		$peopleMapper = $this->getPeopleMapper();
		$driverModelsArray = $peopleMapper->fetchDrivers();
		$riderModelsArray = $peopleMapper->fetchRiders();
		return array(
			'driversArray' => $driverModelsArray,
			'ridersArray' => $riderModelsArray
		);
	}


	// ========================================================================= FACTORY METHODS =========================================================================
	/**
	 * @return \Rar\Mapper\PeopleMapper
	 */
	protected function getPeopleMapper() {
		if (!isset($this->peopleMapper)) $this->peopleMapper = $this->getServiceLocator()->get('\Rar\Mapper\PeopleMapper');
		return $this->peopleMapper;
	}
}