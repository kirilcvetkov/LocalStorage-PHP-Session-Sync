<?php

require_once '../app.php';

if (! empty(LocalStorageSession::getInstance()->get(TOKEN_NAME))) {
    header('Location: ' . PUBLIC_URL);
}

if ($_GET['setup'] ?? null) {
    header('Location: ' . PUBLIC_URL . 'index.php?action=set');
}
?>

<a href="?setup=1">Login</a>
