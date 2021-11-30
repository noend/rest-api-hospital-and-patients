<?php
/**
 * Bootstrap Eloquent
 *
 */

use app\Lib\Config;
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$config = new Config();
$config->load('database');

$capsule->addConnection([
    'driver' => $config->get('mysql')['driver'],
    'host' => $config->get('mysql')['host'],
    'database' => $config->get('mysql')['database'],
    'username' => $config->get('mysql')['username'],
    'password' => $config->get('mysql')['password'],
    'charset' => $config->get('mysql')['charset'],
    'collation' => $config->get('mysql')['collation'],
    'prefix' => $config->get('mysql')['prefix'],
]);

$capsule->bootEloquent();
