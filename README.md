# LocalStorage-PHP-Sync

## Introduction

LocalStorage-PHP-Sync is a simple utility that facilitates the seamless retrieval of browser's LocalStorage data into PHP sessions.
This package is designed to address synchronization challenges in a multi-platform setup, where login information
needs to be shared between a front-end platform handling the login process and a back-end PHP platform.

## How It Works

The primary use case for PHP LocalStorage API involves retrieving a JWT (JSON Web Token) stored in the browser's Local Storage and
transferring it to the PHP Session. This process ensures authentication synchronization across different platforms.

1. index.php - start the session
2. redirect to localStorage.php (which makes a call to setSession.php) - executes JS fetch call to transfer the JWT to the PHP Session
3. redirect back to login.php - check if logged in

## File Description

app.php - bootstrap for the app
LocalStorageSession.php - a simple class managing the LocalStorage data saved in the Session
SetSessionAuth.php - simple security for the public/setSession.php script
public/index.php - mock-up index page
public/localStorage.php - 
public/login.php
public/setSession.php
