<?php

namespace Rar\Controller;

use Application\Constants\MessageConstants;

class RidesController extends \NovumWare\Zend\Mvc\Controller\AbstractActionController
{
    public function indexAction() {
		$peopleMapper = $this->getPeopleMapper();
		$driverModelsArray = $peopleMapper->fetchDrivers();
		$riderModelsArray = $peopleMapper->fetchRiders();
		$ridersWithDriverModelsArray = $peopleMapper->fetchRidersWithDriver();
		return array(
			'driversArray' => $driverModelsArray,
			'ridersArray' => $riderModelsArray,
			'ridersWithDriverArray' => $ridersWithDriverModelsArray
		);
	}

	public function saveAction() {
		$drivers = $this->getRequest()->getPost('drivers');
		$ridersNotSeated = $this->getRequest()->getPost('ridersNotSeated');
		if (!$drivers) { $this->nwFlashMessenger()->addErrorMessage(MessageConstants::ERROR_MISSING_INFO); return; }
		foreach ($drivers as $driverId => $riders) {
			foreach ($riders as $riderId) {
				$riderModel = $this->getPeopleMapper()->fetchOneForId($riderId);
				$riderModel->driver_person_id = $driverId;
				$this->getPeopleMapper()->updateModel($riderModel);
			}
		}
		foreach ($ridersNotSeated as $unseatedId) {
			$riderModel = $this->getPeopleMapper()->fetchOneForId($unseatedId);
			$riderModel->driver_person_id = null;
			$this->getPeopleMapper()->updateModel($riderModel);
		}
		$this->nwFlashMessenger()->addSuccessMessage('Rides list successfully saved');
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