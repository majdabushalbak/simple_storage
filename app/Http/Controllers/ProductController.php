<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $query = $request->input('search');

        if ($query) {
            // Search for products by name
            $products = Product::where('name', 'like', '%' . $query . '%')->get();
        } else {
            // Retrieve all products
            $products = Product::all();
        }

        return view('products.index', compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return a view that contains a form for creating a new product
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for image
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->quantity = $request->quantity;

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // Store image in public storage
            $product->image = $imagePath;
        }

        $product->save();
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the product by its ID and return it to a view
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find the product by its ID and return it to a view for editing
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        // Validate the request data, including the image
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);

        // Find the product by its ID
        $product = Product::findOrFail($id);

        // Update the product details
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->quantity = $validatedData['quantity'];

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            // Store the new image
            $imagePath = $request->file('image')->store('images', 'public');

            // Delete the old image if necessary
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            // Update the product with the new image path
            $product->image = $imagePath;
        }

        // Save the product changes
        $product->save();

        // Redirect to the product show page with a success message
        return redirect()->route('products.show', $product->id)->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the product by its ID and delete it
        $product = Product::findOrFail($id);
        $product->delete();

        // Redirect to the product index page with a success message
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function search(Request $request)
{
    $query = $request->input('query');

    // Search products by name and return only the first 10 results
    $products = Product::where('name', 'like', '%' . $query . '%')
                        ->take(10) // Limit the query results to 10 first
                        ->pluck('name'); // Then pluck only the 'name' field

    return response()->json($products);
}

    public function list()
    {
        $products = Product::all();
        $data=[];

        foreach($products as $item){

            $data[]=$item['name'];
        }
return $data;
    }


    public function updateQuantity(Request $request, Product $product)
{
    // Validate the quantity input
    $request->validate([
        'quantity' => 'required|integer'
    ]);

    // Update the product's quantity
    $product->quantity = $request->input('quantity');
    $product->save();

    return response()->json(['message' => 'Quantity updated successfully', 'quantity' => $product->quantity]);
}

public function getTable($index)
{
    $products = Product::all();
    $chunks = $products->chunk(20);

    if (isset($chunks[$index])) {
        return view('products.table', ['products' => $chunks[$index]]);
    } else {
        return response('Table not found', 404);
    }
}


}
