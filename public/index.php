<?php

require_once '../app.php';

if (empty($localStorage->get('jwt'))) {
    header('Location: ' . PUBLIC_URL . 'localStorage.php?action=get&name=jwt');
}

echo 'Already logged in: ' . $localStorage->get('jwt');
