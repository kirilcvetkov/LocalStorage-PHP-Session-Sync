<?php

class LocalStorage
{
    private function call($action, $name, $value = null)
    {
        return file_get_contents(PUBLIC_URL . 'localStorage.php?' . http_build_query([
            'action' => $action,
            'name' => $name,
            'value' => $value,
        ]));
    }

    public function get(string $name)
    {
        $this->call(__FUNCTION__, $name);

        return $_SESSION['localStorage'][$name] ?? null;
    }

    public function set(string $name, $value)
    {
        if (is_array($value) || is_object($value)) {
            $value = json_encode($value);
        }

        $this->call(__FUNCTION__, $name, $value);

        return true;
    }

    public function delete(string $name, $value)
    {
        if (is_array($value) || is_object($value)) {
            $value = json_encode($value);
        }

        $this->call(__FUNCTION__, $name);

        return true;
    }
}
