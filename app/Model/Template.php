<?php

class Template extends AppModel {

	var $order = array('Template.name' => 'asc');
	//var $belongsTo = array('PremioCategory','UserType');
	//var $hasMany = array('DetalleCanje' => array('dependent' => true));
	//var $hasAndBelongsToMany = array('Carrier', 'UserType');

	
	var $brwConfig = array(
			
			'fields' => array(
					'filter' => array('name'),
			),
			'paginate' => array(
					'fields' => array('id', 'name',),
					
					
			),
	);
	
	
	function get($id) {
		return $template = $this->find('first', array(
				'conditions' => array('Template.id' => $id),
				'contain' => array('BrwImage'),
		));
	}
	

}