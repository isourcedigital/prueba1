<?php

class Blog extends AppModel {

	var $order = array('Blog.id' => 'asc');
	var $belongsTo = array('Template','User');
	var $brwConfig = array(
			'actions' => array('add' => true,'delete' => false),
			'fields' => array(
					
					'hide' => array('site'),
					'filter' => array('name',),
					'names' => array(
							'status' => 'Active',
							'lang' => 'Language',
					),
			),
			
			'paginate' => array(
					'fields' => array('id', 'name','url','lang','status','big_news','fixed'),
					'images' => array('main'),
					
					
			),
			'images' => array(
					'main' => array(
							'name_category' => 'Thumbnail',
							'sizes' => array('92_150', '1024_1024'),
							'index' => true,
							'description' => false,
					),
			),
	);
	
	var $validate = array(
			'name' => array('rule' => 'notEmpty'),
			'url' => array('rule' => 'notEmpty'),
			
	
	);
}