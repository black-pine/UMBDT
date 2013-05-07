<?php
namespace Rar\Model;

class PersonModel extends \NovumWare\Model\AbstractModel
{
	public $id;
	public $name;
	public $email;
	public $phone;
	public $departureTime;
	public $driver = 0;
	public $capacity;
	public $preference1;
	public $preference2;
	public $antipreference1;
	public $antipreference2;
	public $driver_person_id;
}