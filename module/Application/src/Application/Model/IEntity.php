<?php
namespace Application\Model;

interface IEntity {
	public function getId();
	public function setId($id);
	public function toArray();
}

?>
