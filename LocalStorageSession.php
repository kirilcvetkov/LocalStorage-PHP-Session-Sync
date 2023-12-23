<?php

class LocalStorageSession extends Singleton
{
    public string $sessionArray = 'localStorage';

    public function get(string $name)
    {
        return $_SESSION[$this->sessionArray][$name] ?? null;
    }

    public function set(string $name, $value)
    {
        if ($value === 'null') {
            return;
        }

        return $_SESSION[$this->sessionArray][$name] = $value;
    }

    public function delete(string $name)
    {
        unset($_SESSION[$this->sessionArray][$name]);
    }
}
