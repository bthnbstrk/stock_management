<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Stock;
use App\Providers\JsonServiceProvider;
use Illuminate\Http\Request;

class StatisticController extends Controller
{

    protected $json_service_provider;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->json_service_provider = new JsonServiceProvider();
    }

    public function statistic(Request $request){
        $active_user = $request->get('active_user');
        $data = [
            "productCount"=>Product::all()->count(),
            "stockCount"=>Stock::all()->count(),
            "orderCount"=>Order::all()->count(),
            "userName"=>$active_user->name,
        ];

        return $this->json_service_provider->success(["data"=>$data],200);
    }

}
