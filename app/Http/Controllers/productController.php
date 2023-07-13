<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class productController extends Controller
{

   public function create()
    {
        $path = resource_path('views/farmer/create_product.blade.php');
        $content = File::get($path);

        return response()->json(['content' => $content]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'nutritional_value' => 'required|string',
        ]);

        $product = new Product();
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->quantity = $validatedData['quantity'];
        $product->nutritional_value = $validatedData['nutritional_value'];
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }


}
