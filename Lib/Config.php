<?php

namespace app\Lib;

final class Config {
    private $data = array();

    public function get($key) {
        return ($this->data[$key] ?? null);
    }

    public function set($key, $value = null) {
        $this->data[$key] = $value;
    }

    public function load($filename) {
        $file = __DIR__ . '/../Config/' . $filename . '.php';

        if (file_exists($file)) {

            $loaded_file = require($file);

            is_array($loaded_file) ? $this->data = array_merge($this->data, $loaded_file) : false;

        } else {
            trigger_error('Error: Could not load config ' . $filename . '!');
            exit();
        }

    }

}
