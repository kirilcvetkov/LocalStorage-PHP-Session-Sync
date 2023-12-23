<script>
<?php
require_once '../app.php';

$name = $_GET['name'] ?? null;

switch ($_GET['action'] ?? null) {
    case 'get':
        echo '
            let value = window.localStorage.getItem("' . $name . '");
            fetch(\'' . PUBLIC_URL . 'setSession.php?name=' . $name . '&value=\' + value + \'&security=' . $security->get() . '\')
                .then((response) => console.log);
            window.location.href = \'' . PUBLIC_URL . 'login.php\';
        ';
        break;

    case 'set':
        echo '
            window.localStorage.setItem("' . $name . '", "' . ($_GET['value'] ?? null) . '");
            window.location.href = \'' . PUBLIC_URL . 'index.php\';
        ';
        break;
}
?>
</script>
