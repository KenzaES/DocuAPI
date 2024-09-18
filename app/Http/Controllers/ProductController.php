<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\log;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function addProduct(Request $request)
   {
    $dataForm = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|integer',
        'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:8192'
    ]);

    // Handle the image upload
    if ($request->hasFile('product_image')) {
        $image = $request->file('product_image');
        $imagePath = $image->store('images/products', 'public'); // Store image in storage/app/public/images/products
        $dataForm['product_image'] = $imagePath;
    }

    $dataForm['user_id'] = Auth::id(); 

    $product = Product::create($dataForm);

    return response()->json([
        'message' => 'Product added successfully',
        'product' => $product
    ], 201);
}

public function editProduct(Request $request, $id)
{
    Log::info('Request data: ', $request->all());

    $product = Product::find($id);
    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    if ($product->user_id !== Auth::id()) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    try {
        $dataForm = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric', // Numeric validation for price
            'product_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:8192',
        ]);

        // Handle the image upload if provided
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imagePath = $image->store('images/products', 'public');
            $dataForm['product_image'] = $imagePath;

            // Optionally delete the old image
            if ($product->product_image && Storage::disk('public')->exists($product->product_image)) {
                Storage::disk('public')->delete($product->product_image);
            }
        }

        // Convert price to integer if it is set
        if (isset($dataForm['price'])) {
            $dataForm['price'] = (int) $dataForm['price'];
        }

        Log::info('Update data: ', $dataForm);
        
        $product->update($dataForm);

        return response()->json([
            'message' => 'Product updated successfully',
            'product' => $product
        ], 200);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 400);
    }
}



    public function getProduct(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        if ($product->user_id !== Auth::id()) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        return response()->json([
            'message' => 'Product found',
            'product' => $product
        ], 200);
    }

    public function showProducts(Request $request)
    {
        $products = Product::where('user_id', Auth::id())->get();

        return response()->json([
            'message' => 'Your products',
            'products' => $products
        ], 200);
    }

    public function deleteProduct(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        if ($product->user_id !== Auth::id()) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ], 200);
    }
}
