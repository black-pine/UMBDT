<?php
namespace NovumWareTest\Zend\Form;

use NovumWareTest\Zend\Form\MockForm;

use Zend\Form\FormInterface;

class FormTest extends \NovumWare\Test\Controller\AbstractControllerTest
{

	public function testConstructorInitialValues() {
		$dataArray = array(
			'email'	   => 'email@domain.com',
			'password' => 'password'
		);
		$mockForm = new MockForm($dataArray);
		$mockForm->isValid(); // zend won't let you get the data before until you validate
		$rawFormData = $mockForm->getData(FormInterface::VALUES_RAW);
		$this->assertSame($rawFormData['email'], $dataArray['email']);
		$this->assertSame($rawFormData['password'], $dataArray['password']);
	}

	public function testConstructorInitialValuesCanHandleNonProperties() {
		$dataArray = array(
			'email'		   => 'email@domain.com',
			'password'	   => 'password',
			'currentCats'  => null,
			'previousCats' => array(
				'Max',
				'Patch',
				'Ane'
			)
		);
		$mockForm = new MockForm($dataArray);
		$mockForm->isValid(); // zend won't let you get the data before until you validate
		$rawFormData = $mockForm->getData(FormInterface::VALUES_RAW);
		$this->assertSame($rawFormData['email'], $dataArray['email']);
		$this->assertSame($rawFormData['password'], $dataArray['password']);
		$this->assertSame(isset($rawFormData['currentCats']), false);
		$this->assertSame(isset($rawFormData['previousCats']), false);
	}

}