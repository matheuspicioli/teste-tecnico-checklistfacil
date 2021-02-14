<?php

namespace App\Strategies;

use App\Datas\Customer as CustomerData;

class Customer implements EntityStrategy
{
    public function apply(array $contents): void
    {
        CustomerData::$quantity += 1;
    }
}