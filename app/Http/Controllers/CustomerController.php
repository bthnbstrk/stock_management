<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Providers\JsonServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
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
        $validator = Validator::make($request->only(['surname', 'name', 'delivery_address', 'email_address', 'phone_number']), [
            'name' => 'required|string|max:150',
            'surname' => 'required|string|max:150',
            'delivery_address' => 'required|string|max:3000',
            'email_address' => 'required|string|email|max:250|unique:tbl_customers',
            'phone_number' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return $this->json_service_provider->fail(["message" => $validator->errors()->toJson()], 400);
        }

        $customer = Customer::create([
            "name" => $request->get('name'),
            "surname" => $request->get('surname'),
            "delivery_address" => $request->get('delivery_address'),
            "email_address" => $request->get('email_address'),
            "phone_number" => $request->get('phone_number'),
            "created_user_id" => $active_user->id,
        ]);

        return $this->json_service_provider->success(["message" => "Customer created success!", "data" => $customer], 201);

    }

    public function update(Request $request,$customer_id)
    {

        $customer = Customer::where('id', $customer_id)->first();
        if (empty($customer))
            return $this->json_service_provider->fail(["message" => "Customer not found!"], 404);

        $validator = Validator::make($request->only(['surname', 'name', 'delivery_address', 'email_address', 'phone_number']), [
            'name' => 'required|string|max:150',
            'surname' => 'required|string|max:150',
            'delivery_address' => 'required|string|max:3000',
            'email_address' => [
                'required',
                'string',
                'max:250',
                Rule::unique('tbl_customers', 'email_address')->ignore($customer->id, 'id'),
            ],
            'phone_number' => [
                'required',
                'string',
                'max:50',
                Rule::unique('tbl_customers', 'phone_number')->ignore($customer->id, 'id'),
            ],
        ]);

        if ($validator->fails()) {
            return $this->json_service_provider->fail(["message" => $validator->errors()->toJson()], 400);
        }

        $customer->name = $request->name;
        $customer->surname = $request->surname;
        $customer->delivery_address = $request->delivery_address;
        $customer->email_address = $request->email_address;
        $customer->phone_number = $request->phone_number;

        $customer->update();

        return $this->json_service_provider->success(["message" => "Customer updated success!","data"=>$customer], 200);
    }

    public function destroy($customer_id)
    {

        $customer = Customer::where('id', $customer_id)->first();
        if (empty($customer))
            return $this->json_service_provider->fail(["message" => "Customer not found!"], 404);

        $customer->delete();
        return $this->json_service_provider->success(["message" => "Customer deleted success!"], 200);
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

        $customers = Customer::orderBy('id','desc');
        $customers = $customers->paginate($request->limit, ['*'], 'page', $request->offset)->toArray();

        return $this->json_service_provider->success($customers);

    }

    public function select(Request $request,$customer_id)
    {
        $customer = Customer::where('id', $customer_id)->first();
        if (empty($customer))
            return $this->json_service_provider->fail(["message" => "Customer not found!"], 404);

        return $this->json_service_provider->success(["data"=>$customer], 200);
    }

    public function count()
    {
        $customer_count = Customer::all()->count();
        return $this->json_service_provider->success(["data"=>$customer_count], 200);
    }

    public function orders(Request $request,$customer_id)
    {
        $customer = Customer::where('id', $customer_id)->with('orders')->first();
        if (empty($customer))
            return $this->json_service_provider->fail(["message" => "Customer not found!"], 404);

        return $this->json_service_provider->success(["data"=>$customer->toArray()], 200);
    }

    public function all(Request $request)
    {
        $customers = Customer::select('id','name','surname')->get();
        if (empty($customers))
            return $this->json_service_provider->fail(["message" => "Customers not found!"], 404);

        return $this->json_service_provider->success(["data"=>$customers], 200);
    }

    public function getCustomers(Request $request){
        if ($request->ajax()) {
            $data = Customer::latest()->get();
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
