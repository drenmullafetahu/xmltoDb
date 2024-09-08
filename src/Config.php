<?php

namespace App;

class Config
{
    private $settings = [
        'db_type' => 'mysql',
        'db_host' => '127.0.0.1',
        'db_name' => 'xmltodb',
        'db_user' => 'root',
        'db_pass' => '',
        'sqlite_path' => __DIR__ . '/../database.sqlite',
        'log_file' => 'error.log',
    ];

    public function get($key)
    {
        return $this->settings[$key] ?? null;
    }
}