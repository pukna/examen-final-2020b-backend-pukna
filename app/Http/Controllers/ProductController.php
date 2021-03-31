<?php

namespace App\Http\Controllers;


use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\ProductCollection;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private static $messages = [
        'required' => 'El campo :attribute es obligatorio.',

    ];
    public function index()
    {
        return new ProductCollection(Product::all()->sortByDesc('created_at'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:products|max:255',
            'code' => 'required|string|unique:products|max:10',
            'price' => 'required|int'
        ], self::$messages);

        $product = Product::create($request->all());
        return response()->json($product, 201);
    }
    public function run ($id)
    {

        $article=DB::table('products')->select()->where('user_id','=',$id)->get();
        return response()->json($article);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json($product, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $request->validate([
            'name' => 'required|string|unique:name|max:255',
            'code' => 'required|string|unique:code|max:10',
            'price' => 'required|integer'
        ], self::$messages);

        $product->update($request->all());
        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Product $product)
    {
        $product->status = 'deleted';
        $product->update($product->all());
        return response()->json($product, 200);
    }
}
