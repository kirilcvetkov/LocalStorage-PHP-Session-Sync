# LocalStorage-to-PHP-Session-Sync

## Introduction

LocalStorage-to-PHP-Session-Sync is a simple utility that showcases the retrieval of browser's LocalStorage data into PHP sessions.
This package is designed to address synchronization challenges in a multi-platform setup, where authentication data
needs to be shared between a JavaScript front-end platform (handling the login process) and a back-end PHP platform.

## How It Works

The primary use case for LocalStorage-to-PHP-Session-Sync involves retrieving a JWT (JSON Web Token) stored in the browser's Local Storage and
transferring it to the PHP Session. This process ensures authentication synchronization across different platforms.

1. Land on `index.php` and show current state of `jwt` value in LocalStorage and PHP session.
2. You'll be given the option to set the LocalStorage value.
3. Once there's a LocalStorage `jwt` value, you'll be given the option to "sync" this value to the PHP session.
4. Clicking on Sync button, JavaScript will make a POST call to the `sessionApi.php` script with the `jwt` value to be stored.
5. You'll have the option to reset (delete) the `jwt` value from LocalStorage and the PHP session.

## File Description

app.php - bootstrap for the app

LocalStorageSession.php - a simple class managing the LocalStorage data saved in the Session

SetSessionAuth.php - simple security for the public/setSession.php script

Singleton.php - basic singleton pattern class

public/index.php - mock-up an index page

public/sessionApi.php - stores LocalStorage's `jwt` value in the PHP session
