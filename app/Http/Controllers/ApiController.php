<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ApiController extends Controller
{
    public function index(){
        $product = new Product();
        $products = $product->all();

        return response()->json($products);

    }

    public function store(Request $request)
    {
        $dataForm = $request->all();
        $product = new Product();
        $product->fill($dataForm);
        $product->save();

        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if(!$product)
            return response()->json(['message'=>'Record not found',], 404);

        $product->fill($request->all());
        $product->save();

        return response()->json($product);
    }

    public function destroy($id)
    {
        $product= Product::find($id);

        if(!$product)
            return response()->json(['message'=>'Record not found',], 404);

        $product->delete();

    }

}
