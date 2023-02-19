<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderLine extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "tbl_order_lines";

    protected $fillable = [
        'order_id',
        'product_name',
        'amount',
        'barcode',
        'vat',
        'unit_price',
        'total_price',
    ];

    public function order()
    {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }

}
