<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */

class AppController extends Controller {
	public $uses = array('User');	
	public $helpers = array('Facebook.Facebook','Session');
	public $components = array('Session', 'Brownie.BrwPanel','Users','Cookie','Facebook.Connect');
	
	
	//var $helpers = array('Facebook.Facebook');
	
	public $brwMenu = array(
			'Blogs' => array(
					'Blog - English' => array(
						'controller' => 'contents', 'action' => 'index', 'Blog',
						'Blog.lang' => 'en', 
					),
					'Blog - Russian' => array(
							'controller' => 'contents', 'action' => 'index', 'Blog',
							'Blog.lang' => 'ru',
					),
					'Blog - Spanish' => array(
							'controller' => 'contents', 'action' => 'index', 'Blog',
							'Blog.lang' => 'es',
					),
					'Blog - German' => array(
							'controller' => 'contents', 'action' => 'index', 'Blog',
							'Blog.lang' => 'de',
					),
					'Blog - French' => array(
							'controller' => 'contents', 'action' => 'index', 'Blog',
							'Blog.lang' => 'fr',
					),
					'Blog - Italian' => array(
							'controller' => 'contents', 'action' => 'index', 'Blog',
							'Blog.lang' => 'it',
					),
					'Blog - Portuguese' => array(
							'controller' => 'contents', 'action' => 'index', 'Blog',
							'Blog.lang' => 'pt',
					),
					'Blog - Japanese' => array(
							'controller' => 'contents', 'action' => 'index', 'Blog',
							'Blog.lang' => 'jp',
					),
					'User Blog' => array(
							'controller' => 'contents', 'action' => 'index', 'Blog',
							'Blog.site' => 0,
					),
					
			
			),
			'Configure' => array(
					'Users' => 'User',
					'Templates' => 'Template',
					
			),
	);
	
	
	function beforeFilter() {
		if (!empty($this->params['prefix']) and $this->params['prefix'] == 'p' and empty($this->authUser)) {						
			$this->Session->setFlash(__('You need to be logged in to access this area'));
			$this->redirect('/users/login');
		}
		
		$var_code=@$this->request->query ["code"];
		
		$fc=new FB();
		/*
		$fc=new Facebook(array(
				'appId'  => '175023662586909',
				'apiKey' => '175023662586909',
				'secret' => '182077447371a5097b504327a08c875a',
				'cookie' => true,
				'locale' => 'en_US',
		));
		*/
		$userFacebook=null;
		$user=$fc->getUser();
		
		if(!empty($user)){
			$userFacebook=$fc->api("/".$user);			
			$name_f=$userFacebook["first_name"];
			$email_f=$userFacebook["email"];
			$last_name_f=$userFacebook["last_name"];

			$dataUser=array(
					'User' => array(
							'name' => $name_f,
							'last_name' => $last_name_f,
							'email' => $email_f,
							'password' => 'loginfacebook',
							'facebook' => 1,
							'usrfacebook' => $user,
					));
		}
		
		
		
		if(!empty($var_code)){
			$getUser=$this->User->find('all',array ('conditions' =>array('User.email'=>$email_f)));
			if(!empty($getUser)){// si viene por aqui es por que existe un usuario con ese email				
				if(sizeof($getUser)==1){// si viene por aqui es por que hay un solo usuario con ese email					
					if($getUser[0]["User"]["facebook"]==0){// si viene por aqui es por que ese usuario que existe se registro por el form con ese email, entonces registra otro usuario con ese email pero de facebook
						$this->User->create();						
						$this->User->save($dataUser);
						
					}else{// si viene por aqui es por que el usuario que esta registrado es un usuario facebook
						
					}
				}
			}else{// si viene por aqui es por que el usuario no existe con ese mail
				$this->User->create();
				$this->User->save($dataUser);
			}
			$this->Cookie->write('emailUSR', $email_f, false, '+10 weeks');
			$this->Cookie->write('passUSR', 'loginfacebook', false, '+10 weeks');
			$this->Cookie->write('facebookUSR', $user, false, '+10 weeks');
			echo $this->redirect("/");
		}
		
		$this->set("fc",$fc);
		
	}
	
}
