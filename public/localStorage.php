<script>
<?php
require_once '../app.php';

$name = $_GET['name'] ?? null;
$value = $_GET['value'] ?? null;

switch ($_GET['action'] ?? null) {
    case 'get':
        echo '
            let value = window.localStorage.getItem("' . $name . '");
            fetch(\'' . PUBLIC_URL . 'setSession.php?name=' . $name . '&value=\' + value)
                .then((response) => console.log);
        ';
        break;

    case 'set':
        echo 'window.localStorage.setItem("' . $name . '", "' . $value . '");';
        break;
}
?>

window.location.href = '<?= PUBLIC_URL ?>login.php'
</script>
