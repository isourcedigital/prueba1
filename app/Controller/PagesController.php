<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Pages';

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		
		$blog = ClassRegistry::init('Blog');
		$blog->recursive = 1;
		$language=Configure::read("Config.language");
		$conditions=array ();
		$conditions=array_merge($conditions,array ('Blog.site' => 1, 'Blog.lang' => $language, 'Blog.status' => 1));
		$blogs_kl = $blog->find('all',array('conditions'=>$conditions));
		$this->set(array('blogs_kl'=>$blogs_kl));
		
		if(!empty($this->authUser)){			
			$conditions=array ();
			$conditions=array_merge($conditions,array ('Blog.site' => 0, 'Blog.user_id' => $this->authUser["id"], 'Blog.status' => 1));
			$blogs_usr = $blog->find('all',array('conditions'=>$conditions));
			$this->set(array('blogs_usr'=>$blogs_usr));		
		}
		
		$blogs_big_news = $blog->find('first',array('conditions'=>array('Blog.site' => 1, 'Blog.lang' => $language, 'Blog.status' => 1, 'Blog.big_news' => 1)));
		$this->set(array('blogs_big_news'=>$blogs_big_news));
		
		$blogs_fixed = $blog->find('first',array('conditions'=>array('Blog.site' => 1, 'Blog.lang' => $language, 'Blog.status' => 1, 'Blog.fixed' => 1)));
		$this->set(array('blogs_fixed'=>$blogs_fixed));
		
		$this->set(compact('page', 'subpage', 'title_for_layout'));
		$this->render(implode('/', $path));
	}
}
