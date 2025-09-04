<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CustomerResource::collection(Customer::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $customer = Customer::create($request->validated());
        return new CustomerResource($customer);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $validatedData = $request->validated();
    
        $updateData = array_filter($validatedData, function ($value) {
            return $value !== null && $value !== '';
        });
    
        $customer->update($updateData);

        return new CustomerResource($customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        if ($customer->transactions()->exists()){
            return response()->json([
                'message' => 'Customer tidak bisa dihapus karena sudah ada di transaksi'
            ]);
        }
        
        $customer->delete();
        return response()->json([
            'message' => 'Customer berhasil dihapus'
        ]);
    }
}
