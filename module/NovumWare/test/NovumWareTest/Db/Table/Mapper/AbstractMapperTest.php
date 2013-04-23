<?php
namespace NovumWareTest\Db\Table\Mapper;

use NovumWareTest\Model\MockModel;

class AbstractMapperTest extends \NovumWare\Test\Controller\AbstractControllerTest
{
	/** @var \NovumWareTest\Db\Table\Mapper\MockMapper */
	protected $mockMapper;


	public function setup() {
		parent::setUp();
		$this->mockMapper = $this->getApplicationServiceLocator()->get('\NovumWareTest\Db\Table\Mapper\MockMapper');
	}


	// ========================================================================= INSERT METHODS =========================================================================
	public function testInsertModel() {
		$mockModel = $this->createPopulatedMockModel();
		$this->mockTableGateway->shouldReceive('insert')->with($this->createPrefixedMockData($this->mockMapper->getColumPrefix()))->once();
		$this->mockMapper->insertModel($mockModel);
	}


	// ========================================================================= FETCH METHODS =========================================================================
	public function testFetchManyWithSelect() {
		$select = $this->getSelect('mocks');
		$resultSet = $this->createPopulatedResultSet();
		$expectedModelsArray = $this->createPopulatedMockModelsArray();
		$this->mockTableGateway->shouldReceive('selectWith')->with($select)->once()->andReturn($resultSet);
		$returnedModelsArray = $this->mockMapper->fetchManyWithSelect($select);
		$this->assertEquals($returnedModelsArray, $expectedModelsArray);
	}

	public function testFetchOneWithSelect() {
		$select = $this->getSelect($this->mockMapper->tableName);
		$resultSet = $this->createResultSetFromData($this->createMockData());
		$expectedModel = $this->createPopulatedMockModel();
		$this->mockTableGateway->shouldReceive('selectWith')->with($select)->once()->andReturn($resultSet);
		$returnedModel = $this->mockMapper->fetchOneWithSelect($select);
		$this->assertEquals($returnedModel, $expectedModel);
	}
	public function testFetchOnceWithSelectThrowsError() {
		$select = $this->getSelect($this->mockMapper->tableName);
		$resultSetMulti = $this->createPopulatedResultSet();
		$this->mockTableGateway->shouldReceive('selectWith')->with($select)->once()->andReturn($resultSetMulti);
		$this->setExpectedException('\Exception');
		$this->mockMapper->fetchOneWithSelect($select);
	}


	// ========================================================================= CONVENIENT FETCH METHODS =========================================================================
	public function testFetchAll() {
		$select = $this->getSelect($this->mockMapper->tableName);
		$resultSet = $this->createPopulatedResultSet();
		$expectedModelsArray = $this->createPopulatedMockModelsArray();
		$this->mockTableGateway->shouldReceive('selectWith')->with($this->getSqlStringCompareClosure($select))->once()->andReturn($resultSet);
		$returnedModelsArray = $this->mockMapper->fetchAll();
		$this->assertEquals($returnedModelsArray, $expectedModelsArray);
	}

	public function testFetchManyWhere() {
		$select = $this->getSelect($this->mockMapper->tableName);
		$where = array('name = ?' => 'Mark');
		$select->where($where);
		$resultSet = $this->createPopulatedResultSet();
		$expectedModelsArray = $this->createPopulatedMockModelsArray();
		$this->mockTableGateway->shouldReceive('selectWith')->with($this->getSqlStringCompareClosure($select))->once()->andReturn($resultSet);
		$returnedModelsArray = $this->mockMapper->fetchManyWhere($where);
		$this->assertEquals($returnedModelsArray, $expectedModelsArray);
	}

	public function testFetchOneWhere() {
		$select = $this->getSelect($this->mockMapper->tableName);
		$where = array('name = ?' => 'Mark');
		$select->where($where);
		$resultSet = $this->createResultSetFromData($this->createPrefixedMockData());
		$expectedModel = $this->createPopulatedMockModel();
		$this->mockTableGateway->shouldReceive('selectWith')->with($this->getSqlStringCompareClosure($select))->once()->andReturn($resultSet);
		$returnedModel = $this->mockMapper->fetchOneWhere($where);
		$this->assertEquals($returnedModel, $expectedModel);
	}
	public function testFetchOneWhereThrowsException() {
		$where = array('name = ?' => 'Mark');
		$resultSetMulti = $this->createPopulatedResultSet();
		$this->mockTableGateway->shouldReceive('selectWith')->withAnyArgs()->andReturn($resultSetMulti)->once();
		$this->setExpectedException('\Exception');
		$this->mockMapper->fetchOneWhere($where);
	}

	public function testFetchOneForId() {
		$id = '1';
		$select = $this->getSelect($this->mockMapper->tableName);
		$where = array('mock_id = ?' => $id);
		$select->where($where);
		$resultSet = $this->createResultSetFromData($this->createPrefixedMockData());
		$expectedModel = $this->createPopulatedMockModel();
		$this->mockTableGateway->shouldReceive('selectWith')->with($this->getSqlStringCompareClosure($select))->andReturn($resultSet)->once();
		$returnedModel = $this->mockMapper->fetchOneForId($id);
		$this->assertEquals($returnedModel, $expectedModel);
	}
	public function testFetchOneForIdThrowsException() {
		$id = '1';
		$resultSetMulti = $this->createPopulatedResultSet();
		$this->mockTableGateway->shouldReceive('selectWith')->withAnyArgs()->andReturn($resultSetMulti)->once();
		$this->setExpectedException('\Exception');
		$this->mockMapper->fetchOneForId($id);
	}


	// ========================================================================= UPDATE METHODS =========================================================================
	public function testUpdateModel() {
		$mockModel = $this->createPopulatedMockModel();
		$update = $this->getUpdate($this->mockMapper->tableName);
		$update->set($this->prefixDataArray($mockModel->toArray(), $this->mockMapper->getColumPrefix()));
		$update->where(array('mock_id = ?' => '1'));
		$this->mockTableGateway->shouldReceive('updateWith')->with($this->getSqlStringCompareClosure($update))->once();
		$this->mockMapper->updateModel($mockModel);
	}


	// ========================================================================= DELETE METHODS =========================================================================
	public function testDeleteWhere() {
		$where = array('name = ?' => 'Mark');
		$delete = $this->getDelete($this->mockMapper->tableName);
		$delete->where($where);
		$this->mockTableGateway->shouldReceive('deleteWith')->andReturn('1')->with($this->getSqlStringCompareClosure($delete))->once();
		$this->mockMapper->deleteWhere($where);
	}
	public function testDeleteWhereThrowsException() {
		$where = array();
		$this->mockTableGateway->shouldReceive('deleteWith');
		$this->setExpectedException('\Exception');
		$this->mockMapper->deleteWhere($where);
	}


	// ========================================================================= CONVENIENT DELETE METHODS =========================================================================
	public function testDeleteModel() {
		$mockModel = $this->createPopulatedMockModel();
		$delete = $this->getDelete($this->mockMapper->tableName);
		$delete->where(array('mock_id = ?' => '1'));
		$this->mockTableGateway->shouldReceive('deleteWith')->with($this->getSqlStringCompareClosure($delete))->andReturn('1')->once();
		$this->mockMapper->deleteModel($mockModel);
	}
	public function testDeleteModelThrowsException() {
		$mockModel = new MockModel(array('name'=>'Mark'));
		$this->mockTableGateway->shouldReceive('deleteWith');
		$this->setExpectedException('\Exception');
		$this->mockMapper->deleteModel($mockModel);
	}


	// ========================================================================= CREATION METHODS =========================================================================
	public function testCreateModelFromData() {
		$dataArray = array(
			'id'		  => '2',
			'name'		  => 'Vince',
			'nonexistent' => 'garbage'
		);
		$returnedModel = $this->mockMapper->createModelFromData($dataArray);
		$this->assertInstanceOf('\NovumWareTest\Model\MockModel', $returnedModel);
		$this->assertSame($returnedModel->id, $dataArray['id']);
		$this->assertSame($returnedModel->name, $dataArray['name']);
		$this->assertSame(isset($returnedModel->nonexistent), false);

		$mockModel = $this->createPopulatedMockModel();
		$secondReturnedModel = $this->mockMapper->createModelFromData($mockModel);
		$this->assertSame($mockModel->id, $secondReturnedModel->id);
		$this->assertSame($mockModel->name, $secondReturnedModel->name);
		$this->assertSame(isset($secondReturnedModel->nonexistent), false);
	}


	// ========================================================================= TEST HELPER METHODS =========================================================================
	/**
	 * @return array
	 */
	protected function createMockData() {
		return array(
			'id'	=> '1',
			'name'	=> 'Mark'
		);
	}

	/**
	 * @param string $prefix
	 * @return array
	 */
	protected function createPrefixedMockData() {
		return $this->prefixDataArray($this->createMockData(), $this->mockMapper->getColumPrefix());
	}

	/**
	 * @return array of arrays
	 */
	protected function createMultipleMockData() {
		return array(
			array(
				'id'	=> '1',
				'name'	=> 'Mark'
			),
			array(
				'id'	=> '2',
				'name'	=> 'Vincent'
			)
		);
	}

	/**
	 * @return array of arrays
	 */
	protected function createMultiplePrefixedMockData() {
		return $this->prefixDataArray($this->createMultipleMockData(), $this->mockMapper->getColumPrefix());
	}

	/**
	 * @return \NovumWareTest\Model\MockModel
	 */
	protected function createPopulatedMockModel() {
		return new MockModel($this->createMockData());
	}

	/**
	 * @return \Zend\Db\ResultSet\ResultSet
	 */
	protected function createPopulatedResultSet() {
		return $this->createResultSetFromData($this->createMultiplePrefixedMockData());
	}

	/**
	 * @return array of \NovumWareTest\Model\MockModel
	 */
	protected function createPopulatedMockModelsArray() {
		return $this->createMockModelsArrayFromData($this->createMultipleMockData(), '\NovumwareTest\Model\MockModel');
	}

}