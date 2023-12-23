<?php

require_once '../app.php';

if (empty($_GET['security']) || ! $security->check($_GET['security'])) {
    exit('Unauthorized');
}

$localStorage->set(
    $_GET['name'] ?? null,
    $_GET['value'] ?? null
);
