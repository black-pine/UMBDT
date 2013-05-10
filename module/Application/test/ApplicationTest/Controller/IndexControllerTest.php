<?php
namespace ApplicationTest\Controller;

class IndexControllerTest extends \NovumWare\Test\Controller\AbstractControllerTest
{

	public function testIndexActionCanBeAccessed() {
		$this->dispatch('/');
		$this->assertModuleName('Application');
		$this->assertControllerClass('IndexController');
		$this->assertActionName('index');
		$this->assertMatchedRouteName('application');
		$this->assertResponseStatusCode(200);
	}

}