<script>
<?php
require_once 'index.php';

$name = $_GET['name'] ?? null;
$value = $_GET['value'] ?? null;

switch ($_GET['action'] ?? null) {
    case 'get':
        echo 'let item = window.localStorage.getItem("' . $name . '")';
        break;

    case 'set':
        echo 'window.localStorage.setItem("' . $name . '", "' . $value . '");';
        break;
}
?>

fetch('<?= PUBLIC_URL ?>setSession.php?name=<?= $name ?>&value=<?= $value ?? null ?>')
.then((response) => console.log);

// window.localStorage.removeItem();
// window.localStorage.clear();
// window.localStorage.key();
</script>
