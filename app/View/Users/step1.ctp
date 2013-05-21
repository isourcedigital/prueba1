<?php echo $this->element('backhome') ?>

<div id="register">

	<h2 class="subtitle"><?php __('SanDisk Channel Services Network Registration') ?></h2>
	<p>
		<?php __('Welcome to the SanDisk ® Channel Services Network Registration Wizard.'); ?>
		<?php __('Just answer a few simple questions to apply for membership to the SanDisk ® Authorized Reseller Program.'); ?>
		<?php __('By signing up today, you can begin enjoying the advantages offered to exclusive SanDisk ® Authorized Resellers.'); ?>
	</p>

	<?php echo $session->flash() ?>

	<div class="box clearfix">
		<h1><?php __('Registration') ?></h1>
		<?php
		echo $form->create('User', array('url' => array('action' => 'step1', $type)));
		echo $this->element('form_register_step1');
		echo $form->submit(__('Next', true));
		echo $form->end();
		?>
	</div>

</div>