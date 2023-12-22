<?php
session_start();

define('PUBLIC_URL', 'http://localhost/PHP-LocalStorage-API/public/');
define('LOG_FOLDER', '/Users/kirilcvetkov/www/PHP-LocalStorage-API/');

require_once '../LocalStorage.php';

echo '<pre>' . session_id() . "\n";

$localStorage = new LocalStorage();

if ($_GET['get'] ?? null) {
    echo $localStorage->get('test123');
}

if ($_GET['set'] ?? null) {
    echo $localStorage->set('test123', $_GET['set']);
}
