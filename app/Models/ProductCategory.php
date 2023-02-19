<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = "tbl_product_categories";

    protected $fillable = [
        'name',
        'parent_category_id',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

}
