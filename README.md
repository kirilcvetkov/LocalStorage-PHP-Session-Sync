# LocalStorage-PHP-Session-Sync

## Introduction

LocalStorage-PHP-Session-Sync is a simple utility that facilitates the seamless retrieval of browser's LocalStorage data into PHP sessions.
This package is designed to address synchronization challenges in a multi-platform setup, where login information
needs to be shared between a front-end platform handling the login process and a back-end PHP platform.

## How It Works

The primary use case for LocalStorage-PHP-Session-Sync involves retrieving a JWT (JSON Web Token) stored in the browser's Local Storage and
transferring it to the PHP Session. This process ensures authentication synchronization across different platforms.

1. Land on `index.php` and start the session
2. If logged in, display JWT from LocalStorage
3. If not, make a JS `fetch()` call to `setSession.php` which transfers the JWT to the PHP Session
    - I've implemented a basic authentication for this script
4. Redirect to `login.php`
    - if logged in, redirect to `index.php`
    - if not, present login form
5. Clicking on the login button, mocks-up authentication and redirects to `index.php`

## File Description

app.php - bootstrap for the app

LocalStorageSession.php - a simple class managing the LocalStorage data saved in the Session

SetSessionAuth.php - simple security for the public/setSession.php script

Singleton.php - basic singleton pattern class

public/index.php - mock-up index page

public/login.php - mock-up login page

public/setSession.php - syncstores LocalStorage va
