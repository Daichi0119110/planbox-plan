<?php

//データベース関連
define('DSN', 'mysql:host=localhost;dbname=planbox;charset=utf8');
define('DB_USER', 'dbuser');
define('DB_PASSWORD', 'planbox');

//その他
define('SITE_URL', 'http://localhost/planbox/');
define('PASSWORD_KEY', 'planbox2015');

error_reporting(E_ALL & ~E_NOTICE);
ini_set( 'display_errors', 1 );

session_set_cookie_params(0, '/planbox/');
