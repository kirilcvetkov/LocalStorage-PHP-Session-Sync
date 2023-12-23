<?php

class SetSessionAuth extends Singleton
{
    public function get()
    {
        static $auth;

        if (! isset($auth)) {
            $auth = hash('sha256', session_id());
        }

        return $auth;
    }

    public function validate(string $value)
    {
        return $value === $this->get();
    }
}
