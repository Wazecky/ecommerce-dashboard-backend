<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    // Add a new product
    function addProduct(Request $req)
    {
        $product = new Product;
        $product->name = $req->input('name');
        $product->price = $req->input('price');
        $product->description = $req->input('description');
        $product->file_path = $req->file('file')->store('products');
        $product->save();
        return $product;
    }
    // Retrieve a list of all products
    function list()
    {
        return Product::all();
    }
    // Delete a product by ID
    function delete($id)
    {
        $result = Product::where('id', $id)->delete();
        if ($result) {
            return ["result" => "product has been deleted"];
        } else {
            return ["result" => "product not found, operation failed"];
        }
    }
    // Get product details by ID
    function getProduct($id)
    {
        return Product::find($id);
    }
    // Search for products by name
    function search($key)
    {
        return Product::where('name', 'Like', "%$key%")->get();
    }
    // Update product details
    public function updateProduct(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);

            // Validate updated data
            $validatedData = $request->validate([
                'name' => 'string',
                'price' => 'string',
                'description' => 'string',
                'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Update product attributes with validated data
            if (array_key_exists('name', $validatedData)) {
                $product->name = $validatedData['name'];
            }
            if (array_key_exists('price', $validatedData)) {
                $product->price = $validatedData['price'];
            }
            if (array_key_exists('description', $validatedData)) {
                $product->description = $validatedData['description'];
            }

            // Check if a new file is uploaded and update the file path
            if ($request->hasFile('file')) {
                $product->file_path = $request->file('file')->store('products');
            }

            // Save the updated product
            $product->update();

            return response()->json(['message' => 'The product is updated successfully'], 200);
        } catch (\Exception $e) {
            // Handle any exceptions that occur
            return response()->json(['message' => 'Error updating product: ' . $e->getMessage()], 500);
        }
    }
}
