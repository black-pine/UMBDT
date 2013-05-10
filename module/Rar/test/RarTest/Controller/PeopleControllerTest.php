<?php
namespace RarTest\Controller;

use Rar\Model\PersonModel;

class PeopleControllerTest extends \NovumWare\Test\Controller\AbstractControllerTest
{

	public function NewActionCanBeAccessed() {
		$this->dispatch('/rar/people/new');
		$this->assertModuleName('Rar');
		$this->assertControllerClass('PeopleController');
		$this->assertActionName('new');
		$this->assertMatchedRouteName('rar');
		$this->assertResponseStatusCode(200);
	}

	public function NewActionInvalidForm() {
		$data = array(
			'name' => 'Name',
			'email' => 'invaildEmail'
		);
		$this->mockFlashMessenger->shouldReceive('addErrorMessage')->once();
		$this->dispatch('/rar/people/new', 'POST', array('newPersonForm' => $data));
		$this->assertNotRedirect();
		$this->assertResponseStatusCode(200);
	}

	public function testNewActionValidForm() {
		$data = array(
			'name' => 'Name',
			'email' => 'name@youremail.com',
			'phone' =>	'9788525248',
			'departureTime' => 'Friday May 17, 2013 14:46',
			'capacity' => '0'
		);
		$personModel = new PersonModel($data);
		$personModel->departureTime = date('Y-m-d H:i:s', strtotime($personModel->departureTime));
		$this->mockFlashMessenger->shouldReceive('addSuccessMessage')->once();
		$this->mockTableGateway->shouldReceive('insert')->with($this->getArrayCompareClosure($this->prefixDataArray($personModel->toArray(), 'person_')));
		$this->dispatch('/rar/people/new', 'POST', array('newPersonForm' => $data));
		$this->assertRedirect('/');
	}

}