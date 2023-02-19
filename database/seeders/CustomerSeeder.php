<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run()
    {

        $customers = [
            [
                "name" => "Batuhan",
                "surname" => "Müşteri",
                "delivery_address" => "Adres12",
                "email_address" => "ema31il@mail.com",
                "phone_number" => "21134",
                "created_user_id" => 1,
            ],
            [
                "name" => "Batuhan",
                "surname" => "Müşteri5",
                "delivery_address" => "Adre5s1",
                "email_address" => "ema5il@mail.com",
                "phone_number" => "25134",
                "created_user_id" => 1,
            ],
            [
                "name" => "Batuhan",
                "surname" => "Müşteri4",
                "delivery_address" => "Adre4s1",
                "email_address" => "ema4il@mail.com",
                "phone_number" => "21344",
                "created_user_id" => 1,
            ],
            [
                "name" => "Batuhan",
                "surname" => "Müşteri3",
                "delivery_address" => "Adres13",
                "email_address" => "em3ail@mail.com",
                "phone_number" => "21343",
                "created_user_id" => 1,
            ],
            [
                "name" => "Batuhan",
                "surname" => "Müşteri2",
                "delivery_address" => "Adres12",
                "email_address" => "ema1il@mail.com",
                "phone_number" => "21345",
                "created_user_id" => 1,
            ],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }

    }
}
