<?php

session_start();

define('PUBLIC_URL', 'http://localhost/LocalStorage-PHP-Session-Sync/public/');
define('TOKEN_NAME', 'jwt');
define('TOKEN_VALUE', session_id());

require_once 'Singleton.php';
require_once 'SetSessionAuth.php';
require_once 'LocalStorageSession.php';
