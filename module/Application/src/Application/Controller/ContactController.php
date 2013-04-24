<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class ContactController extends \NovumWare\Zend\Mvc\Controller\AbstractActionController
{
	public function preDispatch() {
		parent::preDispatch();
		$this->_ajaxContext->addActionContext('contact-us', 'json')
						   ->initContext();
	}

    public function contactUsAction() {
		// send email from POSTed form
		if($this->getRequest()->isPost()) {
			$formContact = new Application_Form_Contact_ContactUs($this->_request->getPost('formContactUs'));
			if (!$formContact->drIsValid()) {
				$this->processFailure(Application_Constants_Errors::FORM_INVALID, NULL, $formContact->getMessages());
				return;
			}
			NovumWare_Process_Emails::send(Application_Constants_Emails::$EMAIL_ADDRESS_CONTACT_US, 'UMBDT Contact Us Submission', implode(', ', $formContact->getValues()), NULL);
			$this->view->success = true;
		}
	}

    public function donateAction() {}
    public function hireUsAction() {}
}