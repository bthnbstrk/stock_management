<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "tbl_orders";

    protected $fillable = [
        'created_user_id',
        'customer_id',
        'status',
        'delivery_date',
        'total_vat',
        'total_price_without_vat',
        'bill_price',
    ];

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'created_user_id');
    }

    public function orderLines()
    {
        return $this->hasMany(OrderLine::class, 'order_id', 'id');
    }
}
