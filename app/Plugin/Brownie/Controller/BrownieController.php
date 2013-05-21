<?php

class BrownieController extends BrownieAppController {


	function index() {
		$customHome = Configure::read('brwSettings.customHome');
		if ($customHome) {
			if (!empty($customHome['plugin']) and $customHome['plugin'] == 'brownie') {
				$this->redirect($customHome);
			} else {
				$this->render('custom_home');
			}
		} elseif (!empty($this->brwMenu)) {
			$url = array_shift(array_shift($this->brwMenu));
			if (!is_array($url)) {
				 $url = array(
				 	'controller' => 'contents', 'action' => 'index', 'plugin' => 'brownie',
				 	'brw' => false, $url
				);
			}
			$this->redirect($url);
		}
	}


	function login() {
		if (AuthComponent::user()) {
			$this->redirect(array('controller' => 'brownie', 'action' => 'index'));
		}
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__d('brownie', 'Username or password is incorrect'), 'default', array(), 'auth');
			}
		}
	}


	function logout() {
		$this->redirect($this->Auth->logout());
	}


	function translations() {
		$models = array_diff(App::objects('model'), array('AppModel'));
		$translations = array();
		$out = "<?php\n__('January');__('February');__('March');__('April');__('May');__('June');
		__('July');__('August');__('September');__('October');__('November');__('December');
		__('This field cannot be left blank');";
		foreach ($models as $model) {
			$Model = ClassRegistry::init($model);
			$translations[Inflector::humanize(Inflector::underscore($Model->name))] = true;
			$translations[$Model->brwConfig['names']['singular']] = true;
			$translations[$Model->brwConfig['names']['plural']] = true;
			$schema = (array)$Model->schema();
			foreach ($schema as $key => $value) {
				$translations[Inflector::humanize(str_replace('_id', '', $key))] = true;
			}
			foreach ($Model->brwConfig['custom_actions'] as $action => $config) {
				$translations[$config['title']] = true;
				if ($config['confirmMessage']) {
					$translations[$config['confirmMessage']] = true;
				}
			}
		}

		$translations = array_keys($translations);
		foreach ($translations as $translation) {
			$out .= "__('" . $translation . "');\n";
		}

		$forTranslate = ROOT . DS . APP_DIR . DS . 'View' . DS . 'Elements' . DS . '4translate.php';
		fwrite(fopen($forTranslate, 'w'), $out);
	}


}