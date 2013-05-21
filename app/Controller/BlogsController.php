<?php
class BlogsController extends AppController{	
	public function index() {		
		$this->Blog->recursive = 1;
		$language=Configure::read("Config.language");
		$conditions=array ();
		$conditions=array_merge($conditions,array ('Blog.site' => 1, 'Blog.lang' => $language, 'Blog.status' => 1));
		$blogs_kl = $this->Blog->find('all',array('conditions'=>$conditions));			
		$this->set(array('blogs_kl'=>$blogs_kl));
		
		if(!empty($this->authUser)){
			$conditions=array ();
			$conditions=array_merge($conditions,array ('Blog.site' => 0, 'Blog.user_id' => $this->authUser["id"], 'Blog.status' => 1));
			$blogs_usr = $this->Blog->find('all',array('conditions'=>$conditions));
			$this->set(array('blogs_usr'=>$blogs_usr));
		}
		
	}
	
	public function view($id = null) {
		//$this->layout='ajax';
		$this->Blog->id = $id;
		try {		
		if (!$this->Blog->exists()) {
			throw new Exception('Invalid Blog');
		}
		$this->set('blog', $this->Blog->read(null, $id));
		}catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	public function comments($id = null) {
			$idItem=explode("-", $id);
			
			$this->set(array('id'=>$idItem[0],'item'=>$idItem[1]));
	}
	public function detalle($id = null) {
			$idItem=explode("-", $id);
			
			$this->set(array('id'=>$idItem[0],'item'=>$idItem[1]));
		
	}
	
	public function p_add() {
		if ($this->request->is('post')) {
			$this->Blog->create();
			$name=@$this->request->data["Blog"]["name"];
			$url=@$this->request->data["Blog"]["url"];
			$site=0;// el cero significa que no pertenece a KL
			$status=1;// el 1 significa que el blog esta habilitado
			$lang=null;// los blog de los usuarios no tienen lenguajes
			$user_id=$this->authUser["id"];// es el id del usuario que esta logueado al sistema
			$template_id=2;// template por default
			$dataBlog=array(
						'Blog' => array(
							'name' => $name,
							'url' => $url,
							'lang' => $lang,
							'site' => $site,
							'status' => $status,
							'user_id' => $user_id,
							'template_id' => $template_id,
						));
			
			
			if ($this->Blog->save($dataBlog)) {
				$this->Session->setFlash(__('The blog has been saved'),'default',array('class' => 'success'));
			} else {
				$this->Session->setFlash(__('The blog could not be saved. Please, try again.'));
			}
		}
	}
	
	public function busers($users = null) {
		$conditions=array ();
		$conditions=array_merge($conditions,array ('Blog.site' => 0, 'Blog.user_id' => $users));
		$blogs_users = $this->Blog->find('all',array('conditions'=>$conditions));
		$this->set(array('blogs_users'=>$blogs_users));
	}
	public function ubusers($blog = null,$estado=null) {
		$this->autoRender = false;
		if(!empty($this->authUser)){
			$this->Blog->id = $blog;
			$dataBlog=array(
					'Blog' => array(							
							'status' => $estado
					)
			);
			$this->Blog->save($dataBlog);
		}
	}
	public function listbusers($users = null) {
		$this->autoRender = false;
		$conditions=array ();
		$conditions=array_merge($conditions,array ('Blog.site' => 0,'Blog.status' => 1, 'Blog.user_id' => $users));
		$blogs_users = $this->Blog->find('all',array('conditions'=>$conditions));
		$item_blog=0;	
	
		foreach ($blogs_users as $blog_usr):	
			$id=$blog_usr['Blog']['id'];
			$name=$blog_usr['Blog']['name'];
			$item_blog++;
			echo '<div class="bloqueNuevo blog" id="blog3">
				<a href="#blog3-page" data-transition="slide" id="pinchTest">
				<div class="bloque">
					<img src="images/app_10.jpg">
					<div class="tituloBlog">
					<p>'.$name.'</p>
				</div>
				</div>
				</a>
				</div>';
			if($item_blog==3){
				echo '<div class="clear"></div>';
			}
		endforeach;
	}
	
}