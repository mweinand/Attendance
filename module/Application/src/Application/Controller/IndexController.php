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
use Application\Model\Timesheet;
use Application\Form\UserEnrollForm;
use Application\Form\UserEnrollFormValidation;

class IndexController extends AbstractActionController
{
	protected $userTable;
	protected $timesheetTable;

	public function __construct() {
	}
	
	public function setDependancies() {
		
		$sm = $this->getServiceLocator();
		$this->timesheetTable = $sm->get('Application\Model\TimesheetTable');
		$this->userTable = $sm->get('Application\Model\UserTable');
	}

	public function indexAction()
	{
		$this->setDependancies();
		
		$users = $this->userTable->getSignedInUsers();
		return new ViewModel(array(
			'users' => $users
		));
	}

	public function triggerAction() {

		$this->setDependancies();

		$request = $this->getRequest();
		$userSerial = $request->getPost('input');
		
		// Get user
		$user = $this->userTable->findBySerial($userSerial);
		
		// If invalid user, return such	
		if($user == null) {
			return new JsonModel(array(
				'result' => 0
			));
		}				
		
		// Is this user already logged in?
		if($user->currentEntry > 0) {
			$timesheet = $this->timesheetTable->findById($user->currentEntry);
			if($timesheet != null) {
				$timesheet->timeOut = date('c');
				$this->timesheetTable->save($timesheet);
				$user->currentEntry = null;
				$this->userTable->save($user);
				
				
				return new JsonModel(array(
					'result' => 1,
					'direction' => 2
				));
			}
		};	
		
		// Log in otherwise
		$timesheet = new Timesheet();
		$timesheet->userId = $user->id;
		$timesheet->timeIn = date('c');
		$this->timesheetTable->save($timesheet);
		
		$user->currentEntry = $timesheet->id;
		$this->userTable->save($user);
		
		return new JsonModel(array(
			'result' => 1,
			'direction' => 1
		));
	}

	public function enrollAction() {
		$this->setDependancies();
		$form = new UserEnrollForm();
		
		$request = $this->getRequest();
		if($request->isPost()) {
			$user = new User();
			$userEnrollValidator = new UserEnrollFormValidation();
			$form->setInputFilter($userEnrollValidator->getInputFilter());
			$form->setData($request->getPost());

			if($form->isValid()) {
				$user->exchangeArray($form->getData());
				$this->userTable->save($user);

				$form = new UserEnrollForm();
			}
		}

		return array('form' => $form);
	}
}
