<div id="container" class="report">
	<div id="content">
		<div class="model-index">

		<div class="index clearfix">
			<h2><?php __('Top Inviters Report'); ?></h2>
			<?php if (!empty($this->params['named'])): ?>
			<div class="actions">
				<ul>
					<li class="export"><a href="<?php echo Router::url(
						array('action' => 'top_inviters_report_export')	+ $this->params['named']
					); ?>">Export</a></li>
				</ul>
			</div>
			<?php endif ?>
			<div class="actions-view">
				<ul class="actions neighbors">
				<li class="back"><a href="<?php
				echo Router::url(array('controller' => 'brownie', 'action' => 'index', 'plugin' => 'brownie', 'brw' => false))
				?>"><?php __('Back'); ?></a></li></ul>
			</div>
		</div>
		<?php echo $form->create('User', array('class' => 'filter clearfix')) ?>
			<fieldset>
				<legend>User:</legend>
				<?php
				echo $form->input('User.user_type_id', array('empty' => '- All'));
				echo $form->input('User.country_id', array('empty' => '- All'));
				echo $form->input('User.company_type_id', array('empty' => '- All'));
				echo $form->input('User.carrier_id', array('empty' => '- All'));
				echo $form->input('User.dealer_id', array('empty' => '- All', 'label' => 'Agent name'));
				?>
			</fieldset>
			<fieldset>
				<legend>Invites:</legend>
				<?php
				$params = array('type' => 'date', 'minYear' => 2008, 'maxYear' => date('Y'), 'empty' => '-');
				echo $form->input('date_from', $params);
				echo $form->input('date_to', $params);
				?>
			</fieldset>
		<?php echo $form->end('Search') ?>
		<?php if ($this->params['named']):?>
		<?php if (!empty($users)):?>
			<table id="index">
				<tr>
					<th class="string">User Id</th>
					<th class="string">Name</th>
					<th class="string">Last Name</th>
					<th class="string">User Type</th>
					<th class="string">Company Name / Agent</th>
					<th class="string">Country</th>
					<th class="string">Invitations</th>
				</tr>
				<?php foreach ($users as $user): ?>
				<tr>
					<td class="field"><?php echo $user['User']['id']?></td>
					<td class="field"><?php echo $user['User']['name']?></td>
					<td class="field"><?php echo $user['User']['last_name'] ?></td>
					<td class="field"><?php echo $user['UserType']['name'] ?></td>
					<td class="field"><?php echo !empty($user['Dealer']['name']) ? $user['Dealer']['name'] : $user['User']['company_name']?></td>
					<td class="field"><?php echo $user['Country']['name'] ?></td>
					<td class="field"><?php echo $user['User']['count_invitations'] ?></td>
				</tr>
				<?php endforeach ?>
			</table>
		<?php else: ?>
			<p class="norecords">There are no users matching your search query</p>
		<?php endif ?>
		<?php endif ?>
		</div>
	</div>
</div>