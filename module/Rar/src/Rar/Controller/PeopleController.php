<?php

namespace Rar\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class PeopleController extends \NovumWare\Zend\Mvc\Controller\AbstractActionController
{
    public function newAction() {
		if (!$this->getRequest()->isPost()) return;
		
	}
}