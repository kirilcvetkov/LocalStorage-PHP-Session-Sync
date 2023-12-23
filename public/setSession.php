<?php

require_once '../app.php';

$localStorage->set(
    $_GET['name'] ?? null,
    $_GET['value'] ?? null
);
