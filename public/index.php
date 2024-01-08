<?php

require_once '../app.php';

$sessionApiScript = 'sessionApi.php';
$sessionApiUrl = PUBLIC_URL . $sessionApiScript;

?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title></title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/color-modes.js"></script>

    <!-- Custom styles for this template -->
    <link href="css/sign-in.css" rel="stylesheet">
  </head>
  <body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signin w-100 m-auto">
      <h1 class="text-nowrap pb-5">LocalStorage to PHP Session Sync</h1>
      <ol class="list-group list-group-flush">
        <li class="list-group-item py-3 px-4">
          1. What's the variable name to be sync'd?
          <div class="small text-muted">Name <span class="badge text-bg-primary"><?= TOKEN_NAME ?></span></div>
          <div class="small text-muted">Value <span class="badge text-bg-success"><?= TOKEN_VALUE ?></span></div>
          <div class="small text-muted">
            You can set the variable name and value in the <b>app.php</b> script
            using the <span class="badge text-bg-secondary">TOKEN_NAME</span>
            and <span class="badge text-bg-secondary">TOKEN_VALUE</span> constants, respectively.
          </div>
        </li>
        <li class="list-group-item py-3 px-4">
          2. Does LocalStorage have the <span class="badge text-bg-primary"><?= TOKEN_NAME ?></span> value?
          <span class="badge" id="localstorage-has-jwt"></span>
          <a href="#" id="localstorage-has-jwt-set" class="btn btn-success btn-sm ms-4" style="display: none;">Set random value</a>
          <div class="small text-muted">Value <span class="badge" id="localstorage-jwt"></span></div>
        </li>
        <li class="list-group-item py-3 px-4">
          3. Are LocalStorage and PHP $_SESSION in-sync?
          <span class="badge" id="localstorage-php-jwt"></span>
          <a id="localstorage-php-jwt-sync" class="btn btn-primary btn-sm ms-4" role="button" href="#" onClick="sync(); return false;">Sync</a>
          <div class="small text-muted">
            Sync does a POST call to <span class="badge text-bg-secondary"><?= $sessionApiScript ?></span> with the <span class="badge text-bg-primary"><?= TOKEN_NAME ?></span> value, which saves it into the $_SESSION for PHP to use.
          </div>
        </li>
        <li class="list-group-item py-3 px-4">
          4. Reset LocalStorage and PHP $_SESSION
          <a id="localstorage-php-jwt-reset" class="btn btn-danger btn-sm ms-4" role="button" href="#" onClick="reset(); return false;">Reset</a>
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
        let jwt = getJwtFromLocalStorage();

        document.getElementById('localstorage-has-jwt').innerHTML = jwt ? 'Yes' : 'No';
        document.getElementById('localstorage-jwt').innerHTML = jwt;
        document.getElementById('localstorage-has-jwt').className = jwt ? 'badge text-bg-success' : 'badge text-bg-danger';
        document.getElementById('localstorage-jwt').className = jwt ? 'badge text-bg-success' : 'badge text-bg-danger';
        document.getElementById('localstorage-has-jwt-set').style = jwt ? 'display: none' : '';
      }

      checkLocalStorageJwt();

      function setLocalStorageJwt()
      {
        let jwt = '<?= TOKEN_VALUE ?>';
        window.localStorage.setItem('<?= TOKEN_NAME ?>', jwt);
        checkLocalStorageJwt();
      }

      document.getElementById('localstorage-has-jwt-set').addEventListener('click', setLocalStorageJwt, false);

      function checkSync()
      {
        let syncd = getJwtFromLocalStorage() === '<?= LocalStorageSession::getInstance()->get(TOKEN_NAME) ?>';

        document.getElementById('localstorage-php-jwt').innerHTML = syncd ? 'Yes' : 'No';
        document.getElementById('localstorage-php-jwt').className = syncd ? 'badge text-bg-success' : 'badge text-bg-danger';
        document.getElementById('localstorage-php-jwt-reset').style = syncd ? '' : 'display: none';
      }

      checkSync();

      function sync()
      {
        let jwt = getJwtFromLocalStorage();

        if (! jwt) {
          alert('no token');

          return false;
        }

        postData(
          '<?= $sessionApiUrl ?>',
          {
            auth: '<?= SetSessionAuth::getInstance()->get() ?>',
            action: 'set',
            name: '<?= TOKEN_NAME ?>',
            value: jwt,
          }
        )
        .then((response) => {
          console.log({response});
          window.location.href = '<?= PUBLIC_URL ?>index.php';
        });
      }

      function reset()
      {
        window.localStorage.removeItem('<?= TOKEN_NAME ?>');

        postData(
          '<?= $sessionApiUrl ?>',
          {
            auth: '<?= SetSessionAuth::getInstance()->get() ?>',
            action: 'delete',
            name: '<?= TOKEN_NAME ?>',
          }
        )
        .then((response) => {
          console.log({response});
          window.location.href = '<?= PUBLIC_URL ?>index.php';
        });
      }

      document.getElementById('localstorage-php-jwt-reset').addEventListener('click', reset, false);

      async function postData(url = '', data = {})
      {
        const response = await fetch(url, {
          method: 'POST', // *GET, POST, PUT, DELETE, etc.
          mode: 'cors', // no-cors, *cors, same-origin
          cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
          credentials: 'same-origin', // include, *same-origin, omit
          headers: {"Content-Type": "application/json"},
          redirect: "follow", // manual, *follow, error
          referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
          body: JSON.stringify(data), // body data type must match "Content-Type" header
        });

        return response.json(); // parses JSON response into native JavaScript objects
      }
    </script>
  </body>
</html>
