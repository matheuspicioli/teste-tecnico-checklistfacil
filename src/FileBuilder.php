<?php

namespace App;

use App\Strategies\Customer;
use App\Strategies\Sales;
use App\Strategies\Salesman;
use App\Datas\Customer as CustomerData;
use App\Datas\Sales as SalesData;
use App\Datas\Salesman as SalesmanData;

class FileBuilder
{
    private        $file;
    private string $file_name;
    private string $path_in            = '/var/lib/app/in/';
    private string $path_out           = '/var/lib/app/out/';
    private string $file_out_name;
    private array  $entities_by_length = [
        11 => Salesman::class,
        14 => Customer::class,
    ];

    public function load($file_name): FileBuilder
    {
        $this->file      = fopen($this->path_in . $file_name, 'r');
        $this->file_name = $file_name;

        return $this;
    }

    public function process(): FileBuilder
    {
        while ($line = fgets($this->file)) {
            /**
             * Limit 3 in function explodes
             * to php doesn't break sales array yet
             */
            $contents    = explode(',', $line, 3);
            $classEntity = $this->determineEntity((string)$contents[1]);
            $context     = new EntityContext(new $classEntity);
            $context->executeStrategy($contents);
        }

        $this->file_out_name = explode('.', $this->file_name)[0].'.out';

        return $this;
    }

    public function out(): void
    {
        $content = "Quantidade de clientes: ".CustomerData::$quantity."\n";
        $content .= "Quantidade de vendedores: ".SalesmanData::$quantity."\n";
        $content .= "Média salarial dos vendedores: $".SalesmanData::$media_salary."\n\n";
        $content .= "ID da venda mais cara: ".SalesData::$more_expensive_id."\n";
        $content .= "Valor da venda mais cara: $".SalesData::$more_expensive."\n";
        $content .= "Vendedor da venda mais cara: ".SalesData::$salesman_sell_more_expensive."\n";
        $content .= "ID da venda mais barata: ".SalesData::$cheap_expensive_id."\n";
        $content .= "Valor da venda mais barata: $".SalesData::$cheap_expensive."\n";
        $content .= "Vendedor com a venda mais barata: ".SalesData::$salesman_sell_cheap_expensive."\n";
        file_put_contents($this->path_out . $this->file_out_name, $content);
    }

    /**
     * @param string $id - must be string, because if a cpf/cnpj starts with 0, the count results 10/13
     *
     * @return string
     */
    private function determineEntity(string $id): string
    {
        if (strlen($id) < 11) {
            return Sales::class;
        }

        return $this->entities_by_length[strlen($id)];
    }
}