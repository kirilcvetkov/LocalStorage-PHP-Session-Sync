<?php

session_start();

define('PUBLIC_URL', 'http://localhost/PHP-LocalStorage-API/public/');
define('LOG_FOLDER', '/Users/kirilcvetkov/www/PHP-LocalStorage-API/');

require_once '../LocalStorage.php';

$localStorage = new LocalStorage();
