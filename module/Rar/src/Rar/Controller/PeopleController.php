<?php

namespace Rar\Controller;

use Application\Constants\MessageConstants;
use Rar\Form\PersonForm;
use Rar\Model\PersonModel;

class PeopleController extends \NovumWare\Zend\Mvc\Controller\AbstractActionController
{
    public function newAction() {
		if (!$this->getRequest()->isPost()) return;
		$personForm = new PersonForm($this->getRequest()->getPost('newPersonForm'));

		if (!$personForm->isValid()) { $this->nwFlashMessenger()->addErrorMessage(MessageConstants::ERROR_INVALID_FORM);  return; }

		$peopleMapper = $this->getPeopleMapper();
		$peopleMapper->insertModel(new PersonModel($personForm->getData()));

		$this->nwFlashMessenger()->addSuccessMessage('You successfully submitted the form.');
		return $this->redirect()->toRoute('home');
	}

	public function checkNameTakenAction() {
		$name = $this->params('name');
		if (!$name) { $this->nwFlashMessenger()->addErrorMessage(MessageConstants::ERROR_MISSING_INFO);  return; }
		$peopleMapper = $this->getPeopleMapper();
		return array('nameTaken' => (bool) $peopleMapper->fetchOneWhere(array('person_name = ?' => $name)));
	}

	public function checkEmailTakenAction() {
		$email = $this->params('email');
		if (!$email) { $this->nwFlashMessenger()->addErrorMessage(MessageConstants::ERROR_MISSING_INFO);  return; }
		$peopleMapper = $this->getPeopleMapper();
		return array('emailTaken' => (bool) $peopleMapper->fetchOneWhere(array('person_email = ?' => $email)));
	}

		public function checkPhoneTakenAction() {
		$phone = $this->params('phone');
		if (!$phone) { $this->nwFlashMessenger()->addErrorMessage(MessageConstants::ERROR_MISSING_INFO);  return; }
		$peopleMapper = $this->getPeopleMapper();
		return array('phoneTaken' => (bool) $peopleMapper->fetchOneWhere(array('person_phone = ?' => $phone)));
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