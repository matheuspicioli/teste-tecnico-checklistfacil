<?php

namespace App\Strategies;

interface EntityStrategy
{
    public function apply(array $contents);
}