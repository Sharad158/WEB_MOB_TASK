<?php

namespace App\Http\Controllers;

use App\Models\MyProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        
    }

   
    public function create()
    {
        return view('product_create');
    }

   
    public function store(Request $request)
    {
       $res = new MyProduct;

       $res->Name = $request->name;
       $res->SKU = uniqid();
       $res->Price = $request->price;
       $res->Category = $request->Category;
       $res->Quantity = $request->quantity;
       $res->Image = $request->image;

       $res->save();

       $request->session()->flash('msg','1 Record Inserted');

       return redirect('product');
    }

   
    public function show(MyProduct $productarr)
    {
       return view('product_show')->with('productarr',MyProduct::all());
    }

   
    public function edit(MyProduct $MyProduct,$id)
    {
        return view('product_edit')->with('MyProduct',MyProduct::find($id));
    }

  
    public function update(Request $request, MyProduct $MyProduct)
    {

     $res = MyProduct::find($request->id);
    
     $res->Name = $request->name;
     $res->SKU = uniqid();
     $res->Price = $request->price;
     $res->Category = $request->Category;
     $res->Quantity = $request->quantity;
     $res->Image = $request->image;

     $res->save();

     $request->session()->flash('msg','Data Updated');

     return redirect('product');

    }

   
    public function destroy(MyProduct $MyProduct,$id)
    {
       //echo $id;
       MyProduct::destroy(array('id',$id));

       return redirect('product');
    }
}
