<?php

namespace Application\Form;

use Zend\Form\Form;

class UserEnrollForm extends Form
{
	public function __construct($name = null)
	{
		parent::__construct('userEnroll');
		$this->setAttribute('method', 'post');
		$this->add(array(
			'name' => 'id',
			'attributes' => array(
				'type' => 'hidden',
			)
		));

		$this->add(array(
			'name' => 'serial',
			'attributes' => array(
				'type' => 'text'
			),
			'options' => array(
				'label' => 'School ID'
			)
		));

		$this->add(array(
			'name' => 'firstName',
			'attributes' => array(
				'type' => 'text'
			),
			'options' => array(
				'label' => 'First Name'
			)
		));

		$this->add(array(
			'name' => 'lastName',
			'attributes' => array(
				'type' => 'text'
			),
			'options' => array(
				'label' => 'Last Name'
			)
		));

		$this->add(array(
			'name' => 'submit',
			'attributes' => array(
				'type' => 'submit',
				'value' => 'Submit',
				'id' => 'submitbutton'
			)
		));

	}
}
?>
