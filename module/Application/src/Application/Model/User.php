<?php
namespace Application\Model;

class User 
{
	public $id;
	public $firstName;
	public $lastName;
	public $serial;
	
	public function exchangeArray($data)
	{
		$this->id = (isset($data['id'])) ? $data['id'] : null;
		$this->firstName = (isset($data['firstName'])) ? $data['firstName'] : null;
		$this->lastName = (isset($data['lastName'])) ? $data['lastName'] : null;
		$this->serial = (isset($data['serial'])) ? $data['serial'] : null;
	}
}
