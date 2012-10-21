<?php

namespace Application\Model;

class Timesheet implements IEntity
{
	public $id;
	public $userId;
	public $timeIn;
	public $timeOut;
	
	public function exchangeArray($data)
	{
		$this->id = (isset($data['id'])) ? $data['id'] : null;
		$this->userId = (isset($data['userId'])) ? $data['userId'] : null;
		$this->timeIn = (isset($data['timeIn'])) ? $data['timeIn'] : null;
		$this->timeOut = (isset($data['timeOut'])) ? $data['timeOut'] : null;
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
			'userId' => $this->userId,
			'timeIn' => $this->timeIn,
			'timeOut' => $this->timeOut
		);
	}
}
?>