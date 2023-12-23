# PHP LocalStorage API

## Introduction

PHP LocalStorage API is a simple utility that facilitates the seamless retrieval of browser LocalStorage data into PHP sessions. This package is designed to address synchronization challenges in a multi-platform setup, where login information needs to be shared between a front-end platform handling the login process and a back-end PHP platform.

## How It Works

The primary use case for PHP LocalStorage API involves retrieving a JWT (JSON Web Token) stored in the browser's Local Storage and transferring it to the PHP Session. This process ensures authentication synchronization across different platforms.

1. index.php - start the session
2. redirect to localStorage.php (which makes a call to setSession.php) - executes JS fetch call to transfer the JWT to the PHP Session
3. redirect back to login.php - check if logged in
