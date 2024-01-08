<?php

require_once '../app.php';

if ($_GET['logout'] ?? null) {
    session_destroy();
    LocalStorageSession::getInstance()->destroy();
} elseif (! empty(LocalStorageSession::getInstance()->get(TOKEN_NAME))) {
    header('Location: ' . PUBLIC_URL);
} elseif ($_GET['login'] ?? null) {
    exit('
<script>
  window.localStorage.setItem("' . TOKEN_NAME . '", "' . TOKEN_VALUE . '");
  window.location.href = \'' . PUBLIC_URL . '\';
</script>
    ');
}
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title>Signin Template · Bootstrap v5.3</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/color-modes.js"></script>

    <!-- Custom styles for this template -->
    <link href="css/sign-in.css" rel="stylesheet">
  </head>
  <body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signin w-100 m-auto">
      <h1 class="text-nowrap">LocalStorage - PHP Session Sync</h1>
      <ol>
        <li>
          Does LocalStorage have JWT?
          <span class="badge" id="localstorage-has-jwt"></span>
          <span class="badge" id="localstorage-jwt"></span>
          <a href="#" id="localstorage-has-jwt-set" style="display: none;">Set random JWT</a>
        </li>
        <li>
          Are LocalStorate and _SESSION in-sync?
          <span class="badge" id="localstorage-php-jwt"></span>
          <span class="badge" id="localstorage-php-syncd"></span>
          <a href="#" onClick="sync(); return false;">Sync</a>
        </li>
      </ol>
    </main>

    <footer class="footer mt-auto bg-body-tertiary">
      <div class="container">
        <span class="text-muted">
          &copy; SlickSky.com 2023.
          <a href="https://github.com/kirilcvetkov/LocalStorage-PHP-Session-Sync" role="button" target="_blank">GitHub Source</a>
        </span>
      </div>
    </footer>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
      function getJwtFromLocalStorage()
      {
        return window.localStorage.getItem('<?= TOKEN_NAME ?>') || null;
      }

      function checkLocalStorageJwt()
      {
        let jwt = window.localStorage.getItem('<?= TOKEN_NAME ?>');
        document.getElementById('localstorage-has-jwt').innerHTML = jwt ? 'Yes' : 'No';
        document.getElementById('localstorage-jwt').innerHTML = jwt;
        document.getElementById('localstorage-has-jwt').className = jwt ? 'badge text-bg-success' : 'badge text-bg-danger';
        document.getElementById('localstorage-jwt').className = jwt ? 'badge text-bg-success' : 'badge text-bg-danger';

        if (! jwt) {
          document.getElementById('localstorage-has-jwt-set').style = '';
        } else {
          document.getElementById('localstorage-has-jwt-set').style = 'display: none';
          // document.getElementById('localstorage-has-jwt-check').style = 'display: none';
        }
      }
      checkLocalStorageJwt();
      // document.getElementById('localstorage-has-jwt-check').addEventListener('click', checkLocalStorageJwt, false);

      function setLocalStorageJwt()
      {
        let jwt = '<?= TOKEN_VALUE ?>';
        window.localStorage.setItem('<?= TOKEN_NAME ?>', jwt);
        checkLocalStorageJwt();
      }
      document.getElementById('localstorage-has-jwt-set').addEventListener('click', setLocalStorageJwt, false);

      function checkSync()
      {
        let localStorageJwt = getJwtFromLocalStorage();
        let sessionJwt = '<?= LocalStorageSession::getInstance()->get(TOKEN_NAME) ?>';
        let syncd = localStorageJwt === sessionJwt;

        document.getElementById('localstorage-php-jwt').innerHTML = syncd ? 'Yes' : 'No';
        document.getElementById('localstorage-php-syncd').innerHTML = '"' + localStorageJwt + ' === ' + sessionJwt + '"';
        document.getElementById('localstorage-php-jwt').className = syncd ? 'badge text-bg-success' : 'badge text-bg-danger';
        document.getElementById('localstorage-php-syncd').className = syncd ? 'badge text-bg-success' : 'badge text-bg-danger';
      }
      checkSync();

      function sync()
      {
        let jwt = window.localStorage.getItem('<?= TOKEN_NAME ?>') || null;

        if (! jwt) {
          alert('no token');

          return false;
        }

        let data = {
          name: '<?= TOKEN_NAME ?>',
          value: jwt,
          auth: '<?= SetSessionAuth::getInstance()->get() ?>',
        };
        postData('<?= PUBLIC_URL ?>setSession.php', data)
            .then((response) => console.log);
      }

      // Example POST method implementation:
      async function postData(url = '', data = {}) {
        // Default options are marked with *
        const response = await fetch(url, {
          method: 'POST', // *GET, POST, PUT, DELETE, etc.
          mode: 'cors', // no-cors, *cors, same-origin
          cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
          credentials: 'same-origin', // include, *same-origin, omit
          headers: {
            "Content-Type": "application/json",
            // 'Content-Type': 'application/x-www-form-urlencoded',
          },
          redirect: "follow", // manual, *follow, error
          referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
          body: JSON.stringify(data), // body data type must match "Content-Type" header
        });
        return response.json(); // parses JSON response into native JavaScript objects
      }
    </script>
  </body>
</html>
