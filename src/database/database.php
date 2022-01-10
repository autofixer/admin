<?php

use Lightroom\Database\ConnectionSettings as Connection;

/**
 * Database connection settings
 *
 * @return array
 * @author Moorexa <www.moorexa.com> 
 * @author Amadi Ifeanyi <amadiify.com>
 * 
 * This Returns a set of database configurations and a default connection settings.
 **/
Connection::load([

	//enable access from PHP to MYSQL database.
	'new-db' => [
		'dsn' 		=> '{driver}:host={host};dbname={dbname};charset={charset}',
		'driver'    => Lightroom\Database\Drivers\Mysql\Driver::class,
		'host' 	    => 'localhost',
		'user'      => 'root',
		'pass'  	=> 'root',
		'dbname'    => 'autofixer',
		'charset'   => 'utf8mb4',
		'port'      => '',
		'attributes'=> true,
		'prefix'	=> '',
		//'unix_socket' => '', // uncomment this to instruct the system not to find the driver socket path
		'production'=> [
			'driver'  	=>   Lightroom\Database\Drivers\Mysql\Driver::class,
			'host'    	=>   'localhost',
			'user'    	=>   'root',
			'pass'  	=>   'Autofixer@2022',
			'dbname'    =>   'autofixer',
		],
	],


// choose from any of your configuration for a default connection
])
->default(['development' => 'new-db', 'live' => ''])
->domain('admin.autofixer.com.ng', 'new-db@production');

