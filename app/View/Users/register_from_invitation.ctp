<div id="register" class="user-edit">

	<?php echo $session->flash() ?>

	<div class="box clearfix" id="register-from-invitation">
		<h1><?php __('Registration'); ?></h1>
		<?php echo $form->create('User', array('url' => array('action' => 'register_from_invitation', $invitation['Invitation']['id'], $hash))); ?>
		<fieldset class="clearfix basic-info">
			<?php echo $this->element('form_register_step1'); ?>
		</fieldset>
		<div class="theinputs">
			<?php
			if ($invitation['Invitation']['user_type_id'] == MOBILE) {
				echo $this->element('form_register_mobile');
			} else {
				echo  $this->element('form_register_sar');
			}
			?>
			<div id="tos"><div id="tos2">
				<?php
				echo $form->input('receive_newsletter', array(
					'label' => __('Click to subscribe to SanDisk News, Promos, and Special Communications', true),
					'checked' => true,
				)) ?>
				<div class="tos html_text"><div id="insideTos"><?php echo $tos['Text']['text'] ?></div></div>
				<?php echo $form->input('accept', array(
					'label' => __('Accept Terms of Use', true), 'type' => 'checkbox',
					'error' => __('You must read and accept terms and conditions in order to submit', true),
				)) ?>
			</div></div>
			<?php echo $form->submit(__('Submit', true)) ?>
		</div>
		<?php echo $form->end(); ?>
	</div>

</div>

