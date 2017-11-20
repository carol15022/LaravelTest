<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFormResquest;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    private $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $products = $this->product->all();
        $title = 'Products Listing';
        return view('products.index', compact('products', 'title'));
    }

    public function create()
    {
        $title = 'Product Registration';
        return view('products.create', compact('title'));
    }

    public function store(ProductFormResquest $request)
    {

        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move('images', $imageName);

        $dataForm = $request->all();

        $insert =  $this->product->create($dataForm);

        if($insert)
            return redirect()->route('products.index');
        else
            return redirect()->route('products.create');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $product = $this->product->find($id);

        $title = 'Product Edition';
        return view('products.create', compact('title', 'product'));
    }


    public function update(ProductFormResquest $request, $id)
    {
        $dataForm = $request->all();

        $product = $this->product->find($id);

        $update = $product->update($dataForm);

        if($update)
            return redirect()->route('products.index');
        else
            return redirect()->route('products.update', $id);
    }


    public function destroy($id)
    {
        $product = $this->product->find($id);

        $delete = $product->delete($product);

        if($delete)
            return redirect()->route('products.index');
        else
            return redirect()->route('products.index')->with(['errors' => 'Failed to Delete']);
    }

    public function upload()
    {
        return view ('products.index');
    }


}
