<?php

namespace App\Datas;

abstract class Sales
{
    public static int $quantity = 0;
    public static float $more_expensive = 0.00;
    public static float $cheap_expensive = 1000000000.00;
    public static ?int $more_expensive_id = null;
    public static ?int $cheap_expensive_id = null;
    public static ?string $salesman_sell_more_expensive = null;
    public static ?string $salesman_sell_cheap_expensive = null;
}