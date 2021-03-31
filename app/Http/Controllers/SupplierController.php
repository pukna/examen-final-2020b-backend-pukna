<?php

namespace App\Http\Controllers;


use App\Product;
use App\Supplier;
use App\Http\Resources\Supplier as SupplierResource;
use App\Http\Resources\ProductCollection;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
 protected $fillable = ['id','name'];
    private static $messages = [
        'required' => 'El campo :attribute es obligatorio.',

    ];
    public function index()
    {
//          return new SupplierResource(Supplier::all());
//        return new SupplierCollection(Supplier::paginate(10));
       return response()->json(Supplier::all(), 200);

    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:suppliers',

        ], self::$messages);

        $customer = Supplier::create($request->all());

        $product = Supplier::create($request->all());
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return response()->json(new SupplierResource($supplier),200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $customer)
    {
        $request->validate([
            'name' => 'required|string|unique:customers',
            'lastname' => 'required|string|unique:customers',
            'document' => 'required|string|unique:customers|max:10'
        ], self::$messages);
        $customer->update($request->all());
        return response()->json($customer, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Supplier $customer
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function delete(Supplier $customer)
    {
        $customer->delete();
        return response()->json(null, 204);
    }

}
