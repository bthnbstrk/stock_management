<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;
use App\Providers\JsonServiceProvider;
use Illuminate\Http\Request;

class OrderObserver
{

    protected $request;
    protected $json_service_provider;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->json_service_provider = new JsonServiceProvider();
    }
    /**
     * Handle the Order "created" event.
     */
    public function creating(Order $order): void
    {

    }

    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        /*
        try{
            $products = $this->request->products;
            foreach ($products as $product_item){
                $product = Product::where('id', $product_item['id'])->first();
                OrderLine::create([
                    "order_id"=>$order->id,
                    "product_name"=>$product->name,
                    "barcode"=>$product->barcode,
                    "amount"=>intval($product_item['amount']),
                    "vat"=>$product->vat,
                    "unit_price"=>$product->unit_price,
                    "total_price"=>$product->total_price,
                ]);
            }
            $order->total_vat=123;
            $order->total_price_without_vat=123;
            $order->bill_price=123;
            $order->update();
        }catch (\Exception $e){
            $order->delete();
        }*/
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
