<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function login(){
        return view('frontend.login');
    }

    public function home(){
        return view('frontend.home');
    }

    public function productList(){
        return view('frontend.product.product-list');
    }

    public function customerList(){

        return view('frontend.customer.customer-list');
    }

    public function orderList(){
        return view('frontend.order.order-list');
    }

    public function stockList(){
        return view('frontend.stock.stock-list');
    }

    public function customerForm(){
        return view('frontend.customer.customer-form');
    }

    public function productForm(){
        return view('frontend.product.product-form');
    }

    public function orderForm(){
        return view('frontend.order.order-form');
    }

    public function stockForm(){
        return view('frontend.stock.stock-form');
    }

    public function logout(){
        return "logout success";
    }
}
