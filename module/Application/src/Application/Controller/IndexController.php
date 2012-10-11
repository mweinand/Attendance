<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Application\Model\User;
use Application\Form\UserEnrollForm;
use Application\Form\UserEnrollFormValidation;

class IndexController extends AbstractActionController
{
	protected $userTable;

	public function __construct() {
	}

	public function getUserTable() {
		
		$test = $this->getServiceLocator();
		$this->userTable = $test->get('Application\Model\UserTable');
		return $this->userTable;
	}

	public function indexAction()
	{
		return new ViewModel(array(
			'users' => $this->getUserTable()->fetchAll()
		));
	}

	public function triggerAction() {
		return new JsonModel(array(
			'result' => 1,
			'direction' => 1
		));
	}

	public function enrollAction() {
		$form = new UserEnrollForm();
		
		$request = $this->getRequest();
		if($request->isPost()) {
			$user = new User();
			$userEnrollValidator = new UserEnrollFormValidation();
			$form->setInputFilter($userEnrollValidator->getInputFilter());
			$form->setData($request->getPost());

			if($form->isValid()) {
				$user->exchangeArray($form->getData());
				var_dump($user);
				$this->getUserTable()->save($user);

				$form->setData(array());
			}
		}

		return array('form' => $form);
	}
}
