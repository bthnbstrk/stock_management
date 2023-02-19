<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run()
    {

        $categories = [
            [
                "name" => "Şekerleme",
                "parent_category_id" => 0,
            ],
            [
                "name" => "Baharat",
                "parent_category_id" => 0,
            ],
            [
                "name" => "Kuruyemiş",
                "parent_category_id" => 0,
            ],
            [
                "name" => "Kuru Meyve",
                "parent_category_id" => 0,
            ],
            [
                "name" => "Bisküvi ve Kekler",
                "parent_category_id" => 0,
            ],
            [
                "name" => "Pişirme Ürünleri",
                "parent_category_id" => 0,
            ],
        ];

        foreach ($categories as $category) {
            ProductCategory::create($category);
        }

    }
}
