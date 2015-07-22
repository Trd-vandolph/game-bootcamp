<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.6
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2013 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * NOTICE:
 *
 * If you need to make modifications to the default configuration, copy
 * this file to your app/config folder, and make them in there.
 *
 * This will allow you to upgrade fuel without losing your custom config.
 */

return array(

	/**
	 * link_multiple_providers
	 *
	 * Can multiple providers be attached to one user account
	 */
	'link_multiple_providers' => true,

	/**
	 * default_group
	 *
	 * Group id to be assigned to newly created users
	 */
	'default_group' => 1,

	/**
	 * debug
	 *
	 * Uncomment if you would like to view debug messages
	 */
	'debug' => false,

	/**
	 * A random string used for signing of auth response.
	 *
	 * You HAVE to set this value in your application config file!
	 */
	'security_salt' => 'sdadsa++GAa=dsad234-yuk',

	/**
	 * Higher value, better security, slower hashing;
	 * Lower value, lower security, faster hashing.
	 */
	'security_iteration' => 300,

	/**
	 * Time limit for valid $auth response, starting from $auth response generation to validation.
	 */
	'security_timeout' => '2 minutes',

	/**
	 * Strategy
	 * Refer to individual strategy's documentation on configuration requirements.
	 */
	'Strategy' => array(
		'Facebook' => array(
			'app_id' => '397193120438023',
			'app_secret' => '89dacaccfd4ca0327f13c57dd15280b4'
		),
		'Twitter' => array(
			'key' => 'XiTWwd0Iwpjd3G4A2Kdahrpee',
			'secret' => 'RR0FzGJT8Cs43LQaMCDTBYkNyu0FewDDqaepeYJjRIn16K7MmW'
		),
		'Google' => array(
			'client_id' => '485987042354-5i8bs86psjtrdne3l72j21lvbu53oh4o.apps.googleusercontent.com',
			'client_secret' => 'H2OtYbOw14OHq8R0-G9pC1cW',
		),
	/**
	 *   'Facebook' => array(
	 *      'app_id' => 'APP ID',
	 *      'app_secret' => 'APP_SECRET'
	 *    ),
	 */

	 ),
);
