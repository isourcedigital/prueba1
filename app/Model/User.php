<?php

class User extends AppModel {

	var $order = array('User.name' => 'asc');
	//var $belongsTo = array('PremioCategory','UserType');
	var $hasMany = array('Blog' => array('dependent' => true));
	//var $hasAndBelongsToMany = array('Carrier', 'UserType');

	/*
	var $validate = array(
			'name' => array('rule' => 'notEmpty'),
			'password' => array('rule' => 'notEmpty'),
			'repeat_password' => array('rule' => array('checkPasswordMatch')),
			'email' => array(					
					'email' => array('rule' => 'email'),
					'notEmpty' => array('rule' => 'notEmpty'),
					
			),
			'repeat_email' => array('rule' => array('checkEmailMatch')),
			
	);
	*/
	var $brwConfig = array(
			
			'fields' => array(
					'filter' => array('name','email'),
			),
			'paginate' => array(
					'fields' => array('id', 'name','email'),
					
					
			),
	);
	
	function checkPasswordMatch($data) {
		return ($this->data[$this->alias]['password'] == $this->data[$this->alias]['repeat_password']);
	}
	function checkEmailMatch($data) {
		return ($this->data[$this->alias]['email'] == $this->data[$this->alias]['repeat_email']);
	}
}