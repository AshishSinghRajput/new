<?php defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = ENVIRONMENT;
$query_builder = TRUE;

$db['development'] = array(
	'dsn'	=> '',
	'hostname' => getenv('DB_DEV_HOST'),
	'username' => getenv('DB_DEV_USER'),
	'password' => getenv('DB_DEV_PASS'),
	'database' => getenv('DB_DEV_DB'),
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['production'] = array(
	'dsn'	=> '',
	'hostname' => getenv('DB_PROD_HOST'),
	'username' => getenv('DB_PROD_USER'),
	'password' => getenv('DB_PROD_PASS'),
	'database' => getenv('DB_PROD_DB'),
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
