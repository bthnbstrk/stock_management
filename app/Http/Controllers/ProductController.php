<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Providers\JsonServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
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

        $validator = Validator::make($request->only(['barcode', 'name','brand','category_id','vat','price']),[
            'name'=>'required|string|max:200',
            'barcode'=>'required|string|max:20|unique:tbl_products',
            'brand'=>'required|string|max:200',
            'category_id'=>'required|integer|min:1',
            'vat'=>'required|regex:/^\d+(\.\d{1,2})?$/',
            'price'=>'required|regex:/^\d+(\.\d{1,2})?$/',
        ]);

        if($validator->fails()){
            return $this->json_service_provider->fail(["message"=>$validator->errors()->toJson()],400);
        }

        $product = Product::create([
            "name"=>$request->get('name'),
            "barcode"=>$request->get('barcode'),
            "brand"=>$request->get('brand'),
            "category_id"=>$request->get('category_id'),
            "vat"=>floatval($request->get('vat')),
            "price"=>floatval($request->get('price')),
            "unit_price"=>floatval($request->get('price')) + (floatval($request->get('price')) * floatval($request->get('vat'))),
            "created_user_id"=>$active_user->id,
        ]);

        return $this->json_service_provider->success(["message"=>"Product created success!","data"=>$product],201);

    }

    public function update(Request $request,$product_id)
    {
        $product = Product::where('id', $product_id)->first();
        if (empty($product))
            return $this->json_service_provider->fail(["message" => "Product not found!"], 404);

        $validator = Validator::make($request->only(['barcode', 'name','brand','category_id','vat','price']),[
            'name'=>'required|string|max:200',
            'barcode' => [
                'required',
                'string',
                'max:20',
                Rule::unique('tbl_products', 'barcode')->ignore($product->id, 'id'),
            ],
            'brand'=>'required|string|max:200',
            'category_id'=>'required|integer|min:1',
            'vat'=>'required',
            'price'=>'required',
        ]);

        if ($validator->fails()) {
            return $this->json_service_provider->fail(["message" => $validator->errors()->toJson()], 400);
        }

        $product->name = $request->name;
        $product->barcode = $request->barcode;
        $product->brand = $request->brand;
        $product->category_id = $request->category_id;
        $product->vat = floatval($request->vat);
        $product->price = floatval($request->price);
        $product->unit_price =$request->price + ($request->price * $request->vat);

        $product->update();

        return $this->json_service_provider->success(["message" => "Product updated success!","data"=>$product], 200);
    }

    public function destroy($product_id)
    {
        $product = Product::where('id', $product_id)->first();
        if (empty($product))
            return $this->json_service_provider->fail(["message" => "Product not found!"], 404);

        $product->delete();
        return $this->json_service_provider->success(["message" => "Product deleted success!"], 200);
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

        $products = Product::orderBy('id','desc');
        $products = $products->paginate($request->limit, ['*'], 'page', $request->offset)->toArray();

        return $this->json_service_provider->success($products);
    }

    public function select(Request $request,$product_id)
    {
        $product = Product::where('id', $product_id)->first();
        if (empty($product))
            return $this->json_service_provider->fail(["message" => "Product not found!"], 404);

        return $this->json_service_provider->success(["data"=>$product], 200);
    }

    public function count()
    {
        $product_count = Product::all()->count();
        return $this->json_service_provider->success(["data"=>$product_count], 200);
    }

    public function categories(){
        $categories = ProductCategory::all();
        return $this->json_service_provider->success(["data"=>$categories], 200);
    }

    public function all(Request $request)
    {
        $products = Product::select('id','name')->has('stock')->get();
        if (empty($products))
            return $this->json_service_provider->fail(["message" => "Products not found!"], 404);

        return $this->json_service_provider->success(["data"=>$products], 200);
    }

    public function getProducts(Request $request){
        if ($request->ajax()) {
            $data = Product::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
