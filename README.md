# LocalStorage-PHP-Session-Sync

## Introduction

LocalStorage-PHP-Session-Sync is a simple utility that facilitates the seamless retrieval of browser's LocalStorage data into PHP sessions.
This package is designed to address synchronization challenges in a multi-platform setup, where login information
needs to be shared between a front-end platform handling the login process and a back-end PHP platform.

## How It Works

The primary use case for LocalStorage-PHP-Session-Sync involves retrieving a JWT (JSON Web Token) stored in the browser's Local Storage and
transferring it to the PHP Session. This process ensures authentication synchronization across different platforms.

1. index.php - start the session
2. make a JavaScript fetch call to setSession.php - transfers the JWT to the PHP Session
3. redirect back to login.php - check if logged in

## File Description

app.php - bootstrap for the app
LocalStorageSession.php - a simple class managing the LocalStorage data saved in the Session
SetSessionAuth.php - simple security for the public/setSession.php script
public/index.php - mock-up index page
public/localStorage.php - 
public/login.php
public/setSession.php
