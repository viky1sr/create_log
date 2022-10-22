<?php

namespace App\Repository;

interface LogInterface
{
    public function get(string $url,array $params);
    public function store(string $url,array $data);
}
