<?php
session_start();
ob_start();

define('URL', 'http://localhost/phpoop/');

define("URLADM", 'http://localhost/phppooadm/adm/');

define('CONTROLLER', 'Home');

define('METODO', 'index');

// Credenciais de acesso ao BD

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB_NAME', 'lfadmin');
