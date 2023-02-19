<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {

        $products = [
            [
                "name" => "Kolalı Jelibon",
                "barcode" => "ABC12345",
                "brand" => "ÇİLOĞLU GIDA",
                "category_id" => 1,
                "vat" => 0.18,
                "price" => 123.23,
                "unit_price" => 123.23 + (123.23*0.18),
                "created_user_id" => 1,
            ],
            [
                "name" => "Çilekli Jelibon",
                "barcode" => "ABC1234",
                "brand" => "ÇİLOĞLU GIDA",
                "category_id" => 1,
                "vat" => 0.18,
                "price" => 123.23,
                "unit_price" => 123.23 + (123.23*0.18),
                "created_user_id" => 1,
            ],
            [
                "name" => "Muzlu Jelibon",
                "barcode" => "ABC123",
                "brand" => "ÇİLOĞLU GIDA",
                "category_id" => 1,
                "vat" => 0.18,
                "price" => 123.23,
                "unit_price" => 123.23 + (123.23*0.18),
                "created_user_id" => 1,
            ],
            [
                "name" => "Kivili Jelibon",
                "barcode" => "ABC12",
                "brand" => "ÇİLOĞLU GIDA",
                "category_id" => 1,
                "vat" => 0.18,
                "price" => 123.23,
                "unit_price" => 123.23 + (123.23*0.18),
                "created_user_id" => 1,
            ],
            [
                "name" => "Vişneli Jelibon",
                "barcode" => "ABC14",
                "brand" => "ÇİLOĞLU GIDA",
                "category_id" => 1,
                "vat" => 0.18,
                "price" => 123.23,
                "unit_price" => 123.23 + (123.23*0.18),
                "created_user_id" => 1,
            ],
            [
                "name" => "Ekşi Jelibon",
                "barcode" => "AC1234",
                "brand" => "ÇİLOĞLU GIDA",
                "category_id" => 1,
                "vat" => 0.18,
                "price" => 123.23,
                "unit_price" => 123.23 + (123.23*0.18),
                "created_user_id" => 1,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

    }
}
