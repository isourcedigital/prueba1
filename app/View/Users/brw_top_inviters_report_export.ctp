<?php
echo 'User Id,Name,Last Name,Email,Telephone,User Type,Company Name,Carrier,Country,State,Invitations';
foreach ($users as $user) {
	echo "\n" . $user['User']['id']
	 . ',' . $user['User']['name']
	 . ',' . $user['User']['last_name']
	 . ',' . $user['User']['email']
	 . ',' . $user['User']['telephone']
	 . ',' . $user['UserType']['name']
	 . ',' . (!empty($user['Dealer']['name']) ? $user['Dealer']['name'] : $user['User']['company_name'])
	 . ',' . $user['Carrier']['name']
	 . ',' . $user['Country']['name']
	 . ',' . $user['State']['name']
	 . ',' . $user['User']['count_invitations'];
}