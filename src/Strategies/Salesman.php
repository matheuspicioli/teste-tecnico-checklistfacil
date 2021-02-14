<?php

namespace App\Strategies;

use App\Datas\Salesman as SalesmanData;

class Salesman implements EntityStrategy
{
    public function apply(array $contents): void
    {
        $salary                     = (float)explode(',', $contents[2])[1];
        SalesmanData::$quantity     += 1;
        SalesmanData::$total_salary += $salary;
        SalesmanData::$media_salary = SalesmanData::$total_salary / SalesmanData::$quantity;
    }
}