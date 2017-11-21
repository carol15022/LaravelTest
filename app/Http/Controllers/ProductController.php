<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFormResquest;
use Illuminate\Http\Request;
use App\Models\Product;
use Intervention\Image\ImageManagerStatic as Image;

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
        $image = $request->file('image');
        $this->resize($image);

        $imageName = $request->image->getClientOriginalName();

        $dataForm = $request->except('image');


        /*Save the image url on the form*/
        $urlImage = '/images/'.$imageName;

        $dataForm['image'] = $urlImage;

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
        $productImage = $product['image'];

        /*Verifies that the image file has changed*/
        if(($_FILES['image']['name']) == "")
            $urlDataFormImage = $productImage;
        else{
            $dataFormImage = $request->image->getClientOriginalName();
            $urlDataFormImage = '/images/' . $dataFormImage;
            $image = $request->file('image');
            $this->resize($image);
        }

        /*Save the image url on the form*/
        if($urlDataFormImage == $productImage)
            $dataForm['image'] = $productImage;
        else
            $dataForm['image'] = $urlDataFormImage;

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

    private function resize($image)
    {
        try
        {
            $extension 		= 	$image->getClientOriginalExtension();
            $imageRealPath 	= 	$image->getRealPath();
            $thumbName 		= 	$image->getClientOriginalName();
            $size = "60";

            //$imageManager = new ImageManager(); // use this if you don't want facade style code
            //$img = $imageManager->make($imageRealPath);

            $img = Image::make($imageRealPath); // use this if you want facade style code
            $img->resize(intval($size), null, function($constraint) {
                $constraint->aspectRatio();
            });
            return $img->save(public_path('images'). '/'. $thumbName);
        }
        catch(Exception $e)
        {
            return false;
        }

    }


}
