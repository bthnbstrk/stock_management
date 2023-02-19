<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "tbl_products";

    protected $fillable = [
        'created_user_id',
        'name',
        'barcode',
        'brand',
        'price',
        'unit_price',
        'category_id',
        'vat',
    ];

    public function category()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function stock(){
        return $this->hasOne(Stock::class, 'product_id', 'id');
    }

    public function owner(){
        return $this->hasOne(User::class, 'id', 'created_user_id');
    }

}
