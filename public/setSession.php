<?php

require_once '../app.php';

if (empty($_GET['auth']) || ! SetSessionAuth::getInstance()->validate($_GET['auth'])) {
    exit('Unauthorized');
}

LocalStorageSession::getInstance()->set(
    $_GET['name'] ?? null,
    $_GET['value'] ?? null
);
