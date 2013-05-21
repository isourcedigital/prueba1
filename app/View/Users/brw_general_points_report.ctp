<div class="report">
	<div class="index clearfix">
		<h2>General Points Report</h2>
		<?php if (!empty($this->params['named'])): ?>
		<div class="actions">
			<ul>
				<li class="export"><a href="<?php echo Router::url(
					array('action' => 'brw_general_points_report_export')	+ $this->params['named']
				); ?>">Export</a></li>
			</ul>
		</div>
		<?php endif ?>
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
		<legend>Dates:</legend>
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
				<th class="string">Invitation Points</th>
				<th class="string">Training Points</th>
				<th class="string">Invitation Team Points</th>
				<th class="string">Training Team Points</th>
			</tr>
			<?php foreach ($users as $user): ?>
			<tr>
				<td class="field"><?php echo $user['User']['id']?></td>
				<td class="field"><?php echo $user['User']['name']?></td>
				<td class="field"><?php echo $user['User']['last_name'] ?></td>
				<td class="field"><?php echo $user['UserType']['name'] ?></td>
				<td class="field"><?php echo !empty($user['Dealer']['name']) ? $user['Dealer']['name'] : $user['User']['company_name']?></td>
				<td class="field"><?php echo $user['Country']['name'] ?></td>
				<td class="field"><?php echo $user['User']['invitation_points'] ?></td>
				<td class="field"><?php echo $user['User']['training_points'] ?></td>
				<td class="field"><?php echo $user['User']['team_invitation_points'] ?></td>
				<td class="field"><?php echo $user['User']['team_training_points'] ?></td>
			</tr>
			<?php endforeach ?>
		</table>
		<?php else: ?>
		<p class="norecords">There are no users matching your search query</p>
		<?php endif ?>
	<?php endif ?>
</div>