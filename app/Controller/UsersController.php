<?php

App::uses('FB', 'Facebook.Lib');

class UsersController extends AppController{

	var $name = 'Users';
	public $components = array('Email');
	public $helpers = array('paginator');
	
	var $uses = array('User');

	
	function index() {}


	function view() {
		if (empty($this->authUser)) {
			$this->redirect('/');
		}
		$this->pageTitle = __('Mis Datos', true);
		$crumb = array(
			__('Usuarios', true) => array('controller' => 'users', 'action' => 'login'),
			__('Mis datos', true) => array('controller' => 'users', 'action' => 'view'),
		);
		$this->set('crumb', $crumb);
	}


	function step1($type) {
		if (!in_array($type, array('mobile', 'sar'))) {
			$this->cakeError('error404');
		}

		$this->pageTitle = __('Registration', true);
		if (!empty($this->data)) {
			$invitation = $this->User->Invitation->findByEmail($this->data['User']['email']);
			if ($invitation) {
				$this->Session->setFlash(__('Some fields are pre-populated because you were previosly invited', true), 'flash_notice');
				$this->Session->write('step1Data', $this->data);
				$this->redirect(array('controller' => 'users', 'action' => 'register_from_invitation',
				$invitation['Invitation']['id'], myhash($invitation['Invitation']['id'])));
			}
			$this->User->checkAndDeleteIncomplete($this->data['User']['email']);
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->redirect(array('action' => 'step2', $this->User->id, myhash($this->User->id)));
			} else {
				$this->Session->setFlash(__('Please check the errors below', true), 'flash_error');
			}
		}
		$this->set('type', $type);
	}


	function step2($id, $hash) {
		$user = $this->User->findById($id);
		if (empty($user) or $hash != myhash($id)) {
			$this->cakeError('error404');
		}
		if (!empty($this->data)) {
			if ($this->User->saveStep2($id, $this->data)) {
				$this->_sendActivationNotice($user['User']['id']);
				$this->redirect(array('controller' => 'texts', 'action' => 'view', 3));
			} else {
				$this->Session->setFlash(__('Please check the errors below', true), 'flash_error');
			}
		}
		$this->pageTitle = __('Partner registration', true);
		$this->set(array(
			'user' => $user,
			'id' => $id,
			'hash' => $hash,
			'tos' => ClassRegistry::init('Text')->findById($user['User']['mobile']?10:2),
			'states' => $this->User->Country->findListWithStates(),
			'businessModels' => $this->User->BusinessModel->find('list'),
			'userProductCategories' => $this->User->UserProductCategory->find('list'),
			'companyTypes' => $this->User->CompanyType->find('list'),
			'retailerTypes' => $this->User->RetailerType->find('list'),
			'numberRetailerLocations' => $this->User->NumberRetailerLocation->find('list'),
			'numberSaleAssociates' => $this->User->NumberSaleAssociate->find('list'),
			'countries', $this->User->Country->find('list'),
			'userMobileTypes' => $this->User->UserMobileType->find('list'),
			'userTypes' => $this->User->UserType->getListNoMobile(),
			'dealers' => $this->User->Dealer->findWithOther(),
			'carriers' => $this->User->Carrier->find('list'),
			'refererTypes' =>  $this->User->RefererType->find('list'),
		));
	}


	/*function _sendConfirmationEmail($id) {
		$user = $this->User->read(null, $id);
		if (Configure::read('isLocal')) {
			$this->Email->delivery = 'debug';
		}
		$this->Email->from = Configure::read('no-reply');
		$this->Email->to = $user['User']['email'];
		$this->Email->sendAs = 'html';
		$content = ClassRegistry::init('Text')->getConfirmationEmail($user);
		$this->Email->subject = $content['subject'];
		$this->Email->send($content['body']);
	}*/


	function login() {
		//$fc=$this->User->getFacebook();
		
	}
	function loginface(){
		
	}

	function logout() {
		$this->Session->delete('User');
		$this->Cookie->delete('emailUSR');
		$this->Cookie->delete('passUSR');
		$this->Cookie->delete('facebookUSR');
		
		
	}


	function lostpass() {
		if (!empty($this->data)) {
			$user = $this->User->findByEmail($this->data['User']['email']);
			if (empty($user)) {
				$this->Session->setFlash(__('The email address is not registered', true), 'flash_error');
				$this->redirect('/');
			} elseif (!in_array($user['User']['user_status_id'], array(USER_ADMIN, USER_GUEST))) {
				$this->Session->setFlash(__('Account not approved yet', true), 'flash_notice');
				$this->redirect('/');
			} else {
				$this->_sendPasswordRecovery($user);
				$this->redirect(array('controller' => 'texts', 'action' => 'view', 7));
			}
		}
	}


	function register () {
		try {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {				
				throw new Exception('The user has been saved');
			} else {
				
				throw new Exception('The user could not be saved. Please, try again.');
			}
		}
		} catch (Exception $e) {		
			$this->Session->setFlash($e->getMessage());
		}
		
	}


	


	
}