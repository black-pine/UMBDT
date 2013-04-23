<?php
namespace NovumWareTest\Model;

use NovumWareTest\Model\MockModel;
use NovumWareTest\Model\MockModelWithDefaults;

class AbstractModelTest extends \NovumWare\Test\Controller\AbstractControllerTest
{
	public function testConstructorInitializesEmptyModel() {
		$mockModel = new MockModel;
		$this->assertNull($mockModel->id);
		$this->assertNull($mockModel->name);
	}

	public function testConstructorInitialValues() {
		$dataArray = array(
			'id'   => '1',
			'name' => 'Mark'
		);
		$mockModel = new MockModel($dataArray);
		$this->assertSame($mockModel->id, $dataArray['id']);
		$this->assertSame($mockModel->name, $dataArray['name']);
	}

	public function testConstructorCanHandleNonProperties() {
		$dataArray = array(
			'id'		   => '7',
			'name'		   => 'Mark',
			'occupation'   => 'Web Developer',
			'currentCats'  => null,
			'previousCats' => array(
				'Max',
				'Patch',
				'Ane'
			)
		);
		$mockModel = new MockModel($dataArray);
		$this->assertSame($mockModel->id, $dataArray['id']);
		$this->assertSame($mockModel->name, $dataArray['name']);
		$this->assertSame(isset($mockModel->occupation), false);
		$this->assertSame(isset($mockModel->currentCats), false);
		$this->assertSame(isset($mockModel->PreviousCats), false);
	}

	public function testConstructorInitializesEmptyModelWithDefaults() {
		$mockModelDefaults = new MockModelWithDefaults;
		$this->assertNull($mockModelDefaults->id);
		$this->assertNull($mockModelDefaults->name);
		$this->assertSame($mockModelDefaults->role, 'member');
	}

	public function testConstructorInitialValuesWithDefaults() {
		$dataArray = array(
			'name' => 'Mark'
		);
		$mockModelDefaults = new MockModelWithDefaults($dataArray);
		$this->assertNull($mockModelDefaults->id);
		$this->assertSame($mockModelDefaults->name, $dataArray['name']);
		$this->assertSame($mockModelDefaults->role, 'member');
	}

	public function testToArray() {
		$dataArray = array(
			'id'   => '2',
			'name' => 'Mark',
		);
		$mockModel = new MockModel($dataArray);
		$this->assertSame($mockModel->toArray(), $dataArray);
	}

	public function testSetProperties() {
		$dataArray = array(
			'id'   => '5',
			'name' => 'Vincent'
		);
		$mockModel = new MockModel;
		$mockModel->setProperties($dataArray);
		$this->assertSame($mockModel->id, $dataArray['id']);
		$this->assertSame($mockModel->name, $dataArray['name']);
	}

	public function testSetPropertiesCanHandleNonProperties() {
		$dataArray = array(
			'id'		   => '7',
			'name'		   => 'Mark',
			'occupation'   => 'Web Developer',
			'currentCats'  => null,
			'previousCats' => array(
				'Max',
				'Patch',
				'Ane'
			)
		);
		$mockModel = new MockModel;
		$mockModel->setProperties($dataArray);
		$this->assertSame($mockModel->id, $dataArray['id']);
		$this->assertSame($mockModel->name, $dataArray['name']);
		$this->assertSame(isset($mockModel->occupation), false);
		$this->assertSame(isset($mockModel->currentCats), false);
		$this->assertSame(isset($mockModel->PreviousCats), false);
	}
}