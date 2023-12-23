<?php

require_once '../app.php';

if (($_GET['action'] ?? null) == 'set') {
    exit('
<script>
    window.localStorage.setItem("' . TOKEN_NAME . '", "' . TOKEN_VALUE . '");
    window.location.href = \'' . PUBLIC_URL . 'index.php\';
</script>
    ');
}

if (empty(LocalStorageSession::getInstance()->get(TOKEN_NAME))) {
    exit('
<script>
    let value = window.localStorage.getItem("' . TOKEN_NAME . '") || "";
    fetch(\'' . PUBLIC_URL . 'setSession.php?name=' . TOKEN_NAME . '&value=\' + value + \'&auth=' . SetSessionAuth::getInstance()->get() . '\')
        .then((response) => console.log);
    window.location.href = \'' . PUBLIC_URL . 'login.php\';
</script>
    ');
}

echo 'Logged in: ' . LocalStorageSession::getInstance()->get(TOKEN_NAME);
