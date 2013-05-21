<div id="register">
	<div class="box clearfix">
		<h1><?php __('Password recovery') ?></h1>
		<?php
		$url = array('controller' => 'users', 'action' => 'recovery', $user['User']['id'], $user['User']['hash']);
		echo $form->create('User', array('url' => $url, 'autocomplete' => 'off'));
		?>
		<div class="col">
		<?php echo $form->input('password') ?>
		<?php echo $form->input('repeat_password', array(
			'type' => 'password',
			'label' => __('Repeat password', true),
			'error' => __('Both passwords should be the same', true),
		));
		echo $form->end(__('Change password', true));
		?>
		</div>
	</div>
</div>
