<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request){
        $query = $request->input('search');
        
        $products = Product::latest();
    
        if ($query) {
            $products->where('name', 'like', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%');
        }
    
        $products = $products->paginate(5);
    
        return view('products.index', compact('products', 'query'));
    }
    
    public function create(){
        return view('products.create');
    }
    public function store(Request $request){
        //validate data
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required'
        ]);
        //upload image
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('products'),$imageName);

        $product = new Product();
        $product->image = $imageName;
        $product->name = $request->name;
        $product->description = $request->description;

        $product->save();

        return back()->withSuccess('Product Created !!!!');
    }
    public function edit($id){
        $product = Product::where('id', $id)->first();
        return view('products.edit', ['product' => $product]);
    }
    public function update(Request $request, $id){
        //validate data
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable'
        ]);

        $product = Product::where('id',$id)->first();

        if (isset($request->image)) {
            // Get the old image name
            $oldImageName = $product->image;
        
            // Check if an old image exists
            if ($oldImageName) {
                // Delete the old image
                $oldImagePath = public_path('products') . '/' . $oldImageName;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        
            // Upload the new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('products'), $imageName);
            $product->image = $imageName;
        }
        
        $product->name = $request->name;
        $product->description = $request->description;

        $product->save();

        return back()->withSuccess('Product Updated !!!!');
    }
    public function destory($id){
        $product = Product::where('id',$id)->first();
        $product->delete();
        return back()->withSuccess('Product is in Trash !!!!');
    }

    public function forceDelete($id)
{
    $product = Product::withTrashed()->find($id);

    $product->forceDelete();

    return redirect()->route('products.index')->with('success', 'Product Deleted successfully.');
}

    public function show($id){
        $product = Product::where('id',$id)->first();
        return view('products.show',['product'=>$product]);
    }
    public function trash()
    {

        $product = Product::onlyTrashed()->get();
    
        if (!$product) {
            abort(404);
        }
    
        return view('products.trash', ['products' => $product]);
    }

    public function restore($id){
        $product = Product::withTrashed()->find($id);

        if ($product) {
            // Restore the trashed product
            $product->restore();
    
            return redirect()->route('products.index')->with('success', 'Product restored successfully.');
        } else {
            return redirect()->route('products.index')->with('error', 'Product not found or already restored.');
        }
    }
}
