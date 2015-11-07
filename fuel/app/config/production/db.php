<?php
/**
* The production database settings. These get merged with the global settings.
*/
return array(
	'default' => array(
		'type' => 'mysqli',
		'connection' => array(
			'hostname'	   => 'localhost',
			'port'		   => '3306',
			'database'	   => 'gb_db',
			'username'	   => 'root',
			'password'	   => '',
			'persistent'	=> false,
			'compress'	   => false,
		),
		'identifier'	 => '`',
		'table_prefix'   => '',
		'charset'		=> 'utf8',
		'enable_cache'   => true,
		'profiling'	  => false,
		'readonly'	   => false,
	),
	'shared' => array(
		'type' => 'mysqli',
		'connection' => array(
			'hostname'	   => 'shared-database.c1pl9kfl7exm.ap-southeast-1.rds.amazonaws.com',
			'port'		   => '3306',
			'database'	   => 'shared_database',
			'username'	   => 'shared_database',
			'password'	   => 'shared_database',
			'persistent'	 => false,
			'compress'	   => false,
		),
		'identifier'	 => '`',
		'table_prefix'   => '',
		'charset'		=> 'utf8',
		'enable_cache'   => true,
		'profiling'	  => false,
		'readonly'	   => false,
	),
);
