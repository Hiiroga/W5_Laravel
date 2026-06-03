<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data' => Product::query()
                ->latest('id')
                ->get(['id', 'name', 'price', 'description']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'min:4', 'max:255'],
            'price'       => ['required', 'integer', 'min:1000000'],
            'description' => ['nullable', 'string'],
        ]);

        $product = new Product();
        $product->name  = $validated['name'];
        $product->price = $validated['price'];
        if (isset($validated['description'])) {
            $product->description = $validated['description'];
        }
        $product->save();

        // Jika request berasal dari route API (segment pertama URL adalah 'api')
        if ($request->segment(1) === 'api') {
            return response()->json([
                'error'   => false,
                'message' => 'Produk berhasil ditambah',
            ], 200);
        }

        // Jika dari web, redirect seperti biasa
        return redirect('/produk')->with('success', 'Produk berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json([
            'data' => $product->only(['id', 'name', 'price', 'description']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
        ]);

        $product->update($validated);

        return response()->json([
            'data' => $product->only(['id', 'name', 'price', 'description']),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully',
        ]);
    }
}
