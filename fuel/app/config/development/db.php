<?php
/**
 * The development database settings. These get merged with the global settings.
 */

return array(
	'default' => array(
		'type' => 'mysqli',
		'connection' => array(
			'hostname'	   => 'localhost',
			'port'		   => '3306',
			'database'	   => 'olivecode',
			'username'	   => 'root',
			'password'	   => '',
			'persistent'	=> false,
			'compress'	   => false,
		),
	),
	'game_bootcamp' => array(
		'type' => 'mysqli',
		'connection' => array(
			'hostname'	   => 'localhost',
			'port'		   => '3306',
			'database'	   => 'game_bootcamp',
			'username'	   => 'root',
			'password'	   => '',
			'persistent'	 => false,
			'compress'	   => false,
		),
	),
);
