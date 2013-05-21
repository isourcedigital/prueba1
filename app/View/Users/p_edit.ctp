<div id="register" class="user-edit">

	<?php echo $session->flash() ?>

	<h1 class="boxTitle"><?php printf(__('Account information | ID: %s', true), $user['User']['id'])?></h1>
	<div class="box clearfix">
		<?php echo $form->create('User'); ?>
		<fieldset class="clearfix basic-info">
			<?php echo $this->element('form_register_step1'); ?>
		</fieldset>
		<fieldset class="clearfix basic-info">
			<?php
			if ($authUser['user_type_id'] == MOBILE) {
				echo $this->element('form_register_mobile');
			} else {
				echo $this->element('form_register_sar');
			}
			?>
		</fieldset>
		<div class="suscribe">
		<?php
		echo $form->input('receive_newsletter', array(
			'label' => __('Click to subscribe to SanDisk News, Promos, and Special Communications', true),
		)) ?>
		</div>
		<?php echo $form->end(__('Submit', true)); ?>
	</div>

</div>

