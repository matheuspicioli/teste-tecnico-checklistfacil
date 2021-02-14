<?php

namespace App;

use App\Strategies\EntityStrategy;

class EntityContext
{
    private EntityStrategy $strategy;

    public function __construct(EntityStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function executeStrategy(array $contents)
    {
        $this->strategy->apply($contents);
    }
}