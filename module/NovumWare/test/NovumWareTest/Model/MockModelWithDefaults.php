<?php
namespace NovumWareTest\Model;

class MockModelWithDefaults extends \NovumWare\Model\AbstractModel
{
	public $id;
	public $name;
	public $role = 'member';
}