<?php

class LocalStorage
{
    public function __construct(public string $sessionVar = 'localStorage')
    {
    }

    public function get(string $name)
    {
        return $_SESSION[$this->sessionVar][$name] ?? null;
    }

    public function set(string $name, $value)
    {
        return $_SESSION[$this->sessionVar][$name] = $value;
    }

    public function delete(string $name)
    {
        unset($_SESSION[$this->sessionVar][$name]);
    }
}
