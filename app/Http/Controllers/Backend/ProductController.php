<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Supplier;
use App\Model\Unit;
use App\Model\Category;
use Auth;

class ProductController extends Controller
{
    public function view(){

      $allData = Product::all();
      return view('backend.product.view-product',compact('allData'));

    }
    
     public function add(){

     	$data['suppliers'] = Supplier::all();
     	$data['units']= Unit::all();
     	$data['categorys']= Category::all();
      return view('backend.product.add-product',$data);

    }
    public function store(Request $request){

    $product = new Product();
    $product->supplier_id = $request->supplier_id;
    $product->unit_id = $request->unit_id;
    $product->category_id = $request->category_id;
    $product->name = $request->name;
    if ($request->file('image')){
        $file = $request->file('image');
        $filename= date('YmdHi').$file->getClientOriginalName();
        $file->move(public_path('upload/product_images'), $filename);
        $product['image']=$filename;
        }
    $product->quantity = '0';
    $product->created_by = Auth::user()->id;
    $product->save();
      return redirect()->route('products.view')->with('success','Data Saved Successfully');

    }

     public function edit($id){

      $data['editData'] = Product::find($id);
      $data['suppliers'] = Supplier::all();
      $data['units']= Unit::all();
      $data['categorys']= Category::all();

      return view('backend.product.edit-product',$data);

    }

    public function update(Request $request, $id){
    $product = Product::find($id);
    $product->supplier_id = $request->supplier_id;
    $product->unit_id = $request->unit_id;
    $product->category_id = $request->category_id;
    $product->name = $request->name;
    if ($request->file('image')){
        $file = $request->file('image');
        @unlink(public_path('upload/product_images/'.$data->image));
        $filename= date('YmdHi').$file->getClientOriginalName();
        $file->move(public_path('upload/product_images'), $filename);
        $product['image']=$filename;
        }
    $product->updated_by = Auth::user()->id;
    $product->save();
     return redirect()->route('products.view')->with('success','Data Updated Successfully');

    }



    public function delete($id){

       $product =Product::find($id);
       if(file_exists('public/upload/product_images/'.$product->image) AND!
        empty($product->image)){
        unlink('public/upload/product_images/'.$product->image);
    }
       $product->delete();

      return redirect()->route('products.view')->with('success','Data Deleted Successfully');

    }
}
