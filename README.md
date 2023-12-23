# PHP-LocalStorage-API
Retrieve LocalStorage data from PHP

/login.php

1. check if logged in already
    $jwt = (new LocalStorage())->get('jwt');

    a) start session - land on index.php
    b) execute JS fetch call to transfer the JWT to setSession - redirect to checkLocalStorage.php (which makes a call to setSession.php)
    c) check if logged in - redirect back to login.php

2. if not, ask for login

