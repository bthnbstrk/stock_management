<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;
use App\Models\Stock;
use App\Providers\JsonServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
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

    public function create(Request $request)
    {
        $active_user = $request->get('active_user');

        $validator = Validator::make($request->only(['customer_id', 'delivery_date', 'products']), [
            'customer_id' => 'required|integer|min:1',
            'delivery_date' => 'required|date',
            'products' => 'required|array',
            'products.*.id' => 'required|integer|min:1',
            'products.*.amount' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->json_service_provider->fail(["message" => $validator->errors()->toJson()], 400);
        }

        $customer = Customer::where('id', $request->customer_id)->first();
        if (empty($customer))
            return $this->json_service_provider->fail(["message" => "Customer not found!"], 404);

        $products = $request->products;
        foreach ($products as $product_item) {
            $product = Product::where('id', $product_item['id'])->with('stock')->first();
            if (empty($product))
                return $this->json_service_provider->fail(["message" => "Product not found!"], 404);

            $product_data = $product->toArray();
            $is_saleable = $product_data['stock']['amount'] - $product_item['amount'];

            if($is_saleable<0)
                return $this->json_service_provider->fail(["message" => "The product does not saleble! The product is out of stock"], 404);
        }

        DB::beginTransaction();
        try {
            $order = Order::create([
                "created_user_id" => $active_user->id,
                "customer_id" => $request->customer_id,
                "delivery_date" => new Carbon($request->delivery_date),
            ]);

            $total_vat =0;
            $total_price_without_vat =0;
            $total_price =0;

            foreach ($products as $product_item){

                $product = Product::where('id', $product_item['id'])->first();
                OrderLine::create([
                    "order_id"=>$order->id,
                    "product_name"=>$product->name,
                    "barcode"=>$product->barcode,
                    "amount"=>intval($product_item['amount']),
                    "vat"=>$product->vat,
                    "unit_price"=>$product->unit_price,
                    "total_price"=>($product->unit_price + ($product->vat*$product->unit_price))*intval($product_item['amount']),
                ]);

                $stock = Stock::where('product_id',$product->id)->first();
                $stock->amount = intval($stock->amount) - intval($product_item['amount']);
                $stock->update();

                $total_vat=$total_vat + (($product->unit_price*$product->vat)*intval($product_item['amount']));
                $total_price_without_vat=$total_price_without_vat + ($product->unit_price*intval($product_item['amount'])) ;
                $total_price=$total_price + (($product->unit_price + ($product->unit_price*$product->vat))*intval($product_item['amount']));
            }

            $order->total_vat=round($total_vat,2);
            $order->total_price_without_vat=round($total_price_without_vat,2);
            $order->bill_price=round($total_price,2);
            $order->update();

            DB::commit();
            return $this->json_service_provider->success(["message" => "Order created success!", "data" => $order], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->json_service_provider->fail(["message" => "Order created failed!"], 400);
        }
    }
    public function changeStatus($order_id,$status)
    {
        $order = Order::where('id', $order_id)->first();
        if (empty($order))
            return $this->json_service_provider->fail(["message" => "Order not found!"], 404);

        $order->status = intval($status);
        return $this->json_service_provider->success(["message" => "Order status changed success!", "data" => $order], 200);
    }

    public function destroy(Request $request,$order_id)
    {
        $order = Order::where('id', $order_id)->first();
        if (empty($order))
            return $this->json_service_provider->fail(["message" => "Order not found!"], 404);

        $order->delete();
        $order->orderLines()->delete();
        return $this->json_service_provider->success(["message" => "Order deleted success!"], 200);
    }

    public function list(Request $request)
    {
        $validator = Validator::make($request->only(['limit', 'offset']), [
            'limit' => 'required|string|max:150',
            'offset' => 'required|string|max:150',
        ]);

        if ($validator->fails()) {
            return $this->json_service_provider->fail(["message" => $validator->errors()->toJson()], 400);
        }

        $orders = Order::orderBy('id','desc');
        $orders = $orders->paginate($request->limit, ['*'], 'page', $request->offset)->toArray();

        return $this->json_service_provider->success($orders);
    }

    public function select(Request $request,$order_id)
    {
        $order = Order::where('id', $order_id)->first();
        if (empty($order))
            return $this->json_service_provider->fail(["message" => "Order not found!"], 404);

        return $this->json_service_provider->success(["data"=>$order], 200);
    }

    public function count()
    {
        $order_count = Order::all()->count();
        return $this->json_service_provider->success(["data"=>$order_count], 200);
    }

    public function getOrders(Request $request){

        if ($request->ajax()) {
            $orders = OrderLine::orderBy('id','desc')->with('order')->with('order.customer');
            return DataTables::of($orders)
                ->addColumn('bill_price', function ($orderLine) {
                    if (!$orderLine->order)
                        return '';
                    return $orderLine->order->bill_price;
                })
                ->addColumn('customer_name', function ($orderLine) {
                    if (!$orderLine->order)
                        return '';

                    return $orderLine->order->customer->name . "". $orderLine->order->customer->surname;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


    }
}
