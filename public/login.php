<?php

require_once '../app.php';

if (! empty($localStorage->get('jwt'))) {
    header('Location: ' . PUBLIC_URL);
}

if ($_GET['setup'] ?? null) {
    header('Location: ' . PUBLIC_URL . 'localStorage.php?action=set&name=jwt&value=' . session_id());
}
?>

<a href="?setup=1">Login</a>
