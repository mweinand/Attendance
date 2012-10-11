<?php
namespace Application\Model;

interface IEntity {
	public function getId();
	public function toArray();
}

?>
