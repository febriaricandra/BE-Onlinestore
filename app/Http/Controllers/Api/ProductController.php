<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'success' => true,
            'status' => '200',
            'message' => 'List Data Product',
            'data' => $products
        ], 200);
    }

    public function show(Product $product)
    {
        if($product){
            return response()->json([
                'success' => true,
                'status' => '200',
                'message' => 'Detail Data Product',
                'data' => $product
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Product Not Found',
                'data' => ''
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $image_path = $request->file('image')->store('images', 'public');
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image_path,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);
        if($product){
            return response()->json([
                'success' => true,
                'status' => '201',
                'message' => 'Product Created',
                'data' => $product
            ], 201);
        }else{
            return response()->json([
                'success' => false,
                'status' => '409',
                'message' => 'Product Failed to Save',
                'data' => $product
            ], 409);
        }
    }

    public function update(Request $request, Product $product)
    {
        $image_path = $request->file('image')->store('images', 'public');
        $product = Product::findOrFail($product->id);

        if($product){
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $image_path,
                'price' => $request->price,
                'stock' => $request->stock,
            ]);

            return response()->json([
                'success' => true,
                'status' => '200',
                'message' => 'Product Updated',
                'data' => $product
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Product Not Found',
                'data' => ''
            ], 404);
        }
    }

    public function destroy(Product $product){
        $product->delete();
        return response()->json([
            'success' => true,
            'status' => '200',
            'message' => 'Product Deleted',
            'data' => $product
        ], 200);
    }

    public function search($name){
        $product = Product::where("name","like","%".$name."%")->get();
        if(count($product) > 0){
            return response()->json([
                'success' => true,
                'status' => '200',
                'message' => 'Product Found',
                'data' => $product
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'status' => '404',
                'message' => 'Product Not Found',
                'data' => ''
            ], 404);
        }
    }

    public function showImage(Request $request, $namafile)
    {
        $thePath = public_path('storage/images/' . $namafile) ;
        return response()->file($thePath);
    }
}
