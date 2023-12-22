<?php
require_once 'index.php';

$name = $_GET['name'] ?? null;
$value = $_GET['value'] ?? null;

$_SESSION['localStorage'][$name] = $value;
