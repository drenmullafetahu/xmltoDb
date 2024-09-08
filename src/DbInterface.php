<?php

namespace App;

interface DbInterface
{
    public function connect();
    public function insert(array $data);
}