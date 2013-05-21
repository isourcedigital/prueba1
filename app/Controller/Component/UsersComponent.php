<?php
class UsersComponent extends Component {
	function initialize(&$controller) {		
		$emailUSR=$controller->Cookie->read('emailUSR');
		$passUSR=$controller->Cookie->read('passUSR');
		$facebookUSR=$controller->Cookie->read('facebookUSR');
		$isFacebook=0;
		if(!empty($facebookUSR)){
			$isFacebook=1;
		}
		
		$isValidLogin=null;
		$isLoginNow = (
			isset($controller->data['User']['email']) and
			isset($controller->data['User']['password']) and
			isset($controller->data['User']['login'])
		);

		
		if ($isLoginNow) {
			@$controller->data['User']['password'] = Security::hash($controller->data['User']['password']);
			$controller->Session->write($controller->data);
			$sessionUser = $controller->Session->read('User');			
			$isValidLogin = (					
					!empty($sessionUser['email']) and
					$user  = $controller->User->findByEmail($sessionUser['email']) and
					$user['User']['facebook']==$isFacebook and
					$user['User']['email'] == $sessionUser['email'] and
					$user['User']['password'] == $sessionUser['password']
			);
			
		}else{
			if(!empty($emailUSR) && !empty($passUSR)){
				$isValidLogin = (						
						$user  = $controller->User->findByEmail($controller->Cookie->read('emailUSR')) and
						$user['User']['facebook']==$isFacebook and
						$user['User']['email'] == $controller->Cookie->read('emailUSR') and
						$user['User']['password'] == $controller->Cookie->read('passUSR')
				);
			}else{
				
			}
		}
		if ($isValidLogin) {
			$controller->authUser = array_shift($user);
		}

		$controller->set('authUser', $controller->authUser);

		if ($isLoginNow) {
			if ($controller->authUser) {				
				
					//add cookie
					$controller->Cookie->write('emailUSR', $controller->data['User']['email'], false, '+10 weeks');
					$controller->Cookie->write('passUSR', $controller->data['User']['password'], false, '+10 weeks');
				//echo $controller->redirect(array('controller' => 'blogs', 'action' => 'index'));
					$pager=$controller->webroot;
					$goAdmin="<script>self.parent.location.href='$pager';self.parent.Shadowbox.close();</script>";
					echo $goAdmin;
			}else{
				$controller->Session->setFlash(__('Please, try again.'));
				
				//$controller->redirect(array('controller' => 'users', 'action' => 'login'));
				
			}
		}

	}

}