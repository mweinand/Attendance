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
		$this->firstName = (isset($data['first_name'])) ? $data['first_name'] : null;
		$this->lastName = (isset($data['last_name'])) ? $data['last_name'] : null;
		$this->serial = (isset($data['serial'])) ? $data['serial'] : null;
	}
}
