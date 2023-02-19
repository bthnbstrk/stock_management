<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    public function run()
    {

        $stocks = [
            [
                "product_id" => 1,
                "amount" => 1000,
            ],
            [
                "product_id" => 2,
                "amount" => 1000,
            ],
            [
                "product_id" => 3,
                "amount" => 1000,
            ],
            [
                "product_id" => 4,
                "amount" => 1000,
            ],
            [
                "product_id" => 5,
                "amount" => 1000,
            ],
            [
                "product_id" => 6,
                "amount" => 1000,
            ]
        ];

        foreach ($stocks as $stock) {
            Stock::create($stock);
        }

    }
}
