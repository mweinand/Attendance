<?php
namespace Application\Model;

class User implements IEntity
{
	public $id;
	public $firstName;
	public $lastName;
	public $serial;
	public $currentEntry;
	
	public function exchangeArray($data)
	{
		$this->id = (isset($data['id'])) ? $data['id'] : null;
		$this->firstName = (isset($data['firstName'])) ? $data['firstName'] : null;
		$this->lastName = (isset($data['lastName'])) ? $data['lastName'] : null;
		$this->serial = (isset($data['serial'])) ? $data['serial'] : null;
		$this->currentEntry = (isset($data['currentEntry'])) ? $data['currentEntry'] : null;
	}

	public function getId()
	{
		return $this->id;
	}
	
	public function setId($id)
	{
		$this->id = $id;
	}

	public function toArray()
	{
		return array(
			'id' => $this->id,
			'firstName' => $this->firstName,
			'lastName' => $this->lastName,
			'serial' => $this->serial,
			'currentEntry' => $this->currentEntry
		);
	}
}
