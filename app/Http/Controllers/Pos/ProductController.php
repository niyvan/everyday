<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;

class ProductController extends Controller
{
    public function index(){

        $product = Product::latest()->get();
        return view('admin.items.index',compact('product'));

    } // End Method


    public function create(){
        $category = Category::all();
        return view('admin.items.create',compact('category'));
    } // End Method


    public function store(Request $request){

        Product::insert([

            'name' => $request->name,
            'category_id' => $request->category_id,
            'wholesale_price' => $request->wholesale_price,
            'retail_price' => $request->retail_price,
            'description' => $request->description,
            'quantity' => '0',
            'minimum_qty' => $request->minimum_qty,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('product.all')->with($notification);

    } // End Method



    public function edit($id){
        $category = Category::all();
        $product = Product::findOrFail($id);
        return view('admin.items.edit',compact('product','category'));
    } // End Method



    public function update(Request $request)
    {


        $product_id = $request->id;

        Product::findOrFail($product_id)->update([

            'name' => $request->name,
            'category_id' => $request->category_id,
            'wholesale_price' => $request->wholesale_price,
            'retail_price' => $request->retail_price,
            'description' => $request->description,
            'minimum_qty' => $request->minimum_qty,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('product.all')->with($notification);


    }
    // End Method


    public function destroy($id){

       Product::findOrFail($id)->delete();
            $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method

    // public function outofstock(){
    //     $category = Category::all();
    //     $product = Product::where('quantity','<','2')->get();
    //     return view('admin.index',compact('product','category'));
    // }

}
