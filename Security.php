<?php

class Security
{
    public function get()
    {
        return hash('sha256', session_id());
    }

    public function check(string $value)
    {
        return $value === hash('sha256', session_id());
    }
}
