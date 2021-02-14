<?php

namespace App\Strategies;

use App\Datas\Sales as SalesData;

class Sales implements EntityStrategy
{
    public function apply(array $contents): void
    {
        SalesData::$quantity += 1;
        /**
         * $contents[2] still have array sales and salesman
         */
        $newContent = explode('[', $contents[2]);
        $newContent = explode(']', $newContent[1]);
        $sales      = explode(',', $newContent[0]);
        $salesman   = explode(',', $newContent[1])[1];

        foreach ($sales as $sale) {
            $sale       = explode('-', $sale);
            $sale_id    = $sale[0];
            $quantity   = (int)$sale[1];
            $price      = (float)$sale[2];
            $total_sale = $quantity * $price;

            if (SalesData::$more_expensive < $total_sale) {
                SalesData::$more_expensive               = $total_sale;
                SalesData::$more_expensive_id            = $sale_id;
                SalesData::$salesman_sell_more_expensive = $salesman;
            }

            if ($total_sale < SalesData::$cheap_expensive) {
                SalesData::$cheap_expensive               = $total_sale;
                SalesData::$cheap_expensive_id            = $sale_id;
                SalesData::$salesman_sell_cheap_expensive = $salesman;
            }
        }
    }
}