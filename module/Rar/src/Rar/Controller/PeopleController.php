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
		if (!$personForm->isValid()) {  $this->nwFlashMessenger()->addErrorMessage(MessageConstants::ERROR_INVALID_FORM);  return; }

		var_dump($personForm->getData());
		$peopleMapper = $this->getPeopleMapper();
		$peopleMapper->insertModel(new PersonModel($personForm->getData()));

		$this->nwFlashMessenger()->addSuccessMessage('You successfully submitted the form.');
		$this->redirect()->toRoute('home');
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