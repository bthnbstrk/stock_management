<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = "tbl_customers";

    protected $fillable = [
        'created_user_id',
        'name',
        'surname',
        'delivery_address',
        'email_address',
        'phone_number'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id')->orderBy("created_at");
    }

    public function owner(){
        return $this->hasOne(User::class, 'id', 'created_user_id');
    }

}
