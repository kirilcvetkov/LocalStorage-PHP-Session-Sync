# PHP-LocalStorage-API
Retrieve browser's LocalStorage data into PHP's session

This a mock page that needs to retrieve a JWT from the browser in order to check if the app is authenticated.
The issue I faced is sync-ing login information in a multi-platform setup.
When having a front-end platform which handles the login process but there's a need to sync it with a back-end PHP platform, this is a way to do it.

1. index.php - start the session
2. redirect to localStorage.php (which makes a call to setSession.php) - executes JS fetch call to transfer the JWT to the PHP Session
3. redirect back to login.php - check if logged in
