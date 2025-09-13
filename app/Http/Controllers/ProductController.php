<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  use UploadTrait;
 public function index() 
  {
    $products = Product::all();
    return view("Dashboard.Products.index",compact('products')); 
  }
public function store(ProductRequest $request)  {
  
  $product = new Product();
  $product->name=$request->name;
  $product->price=$request->price;

  $product->description=$request->description;

  $product->save();

      if ($request->hasFile('ImagePath')) {
        $filename = $this->uploadProductImage(
            $request,            
            'ImagePath',         // اسم input
            'products',          // اسم المجلد في storage
            'public',            // disk (عادة public أو s3)
            $product->id         
        );
        $product->ImagePath = $filename; // حفظ اسم الملف في قاعدة البيانات
        $product->save();
    }

    return redirect()->route('Product.all');
  
}

  public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->name        = $request->name;
        $product->price       = $request->price;
        $product->description = $request->description;

    
        if ($request->hasFile('ImagePath')) {
            if ($product->ImagePath) {
                $this->deleteProductImage('public', 'products', $product->ImagePath, $product->id);
            }

            $filename = $this->uploadProductImage(
                $request,
                'ImagePath',
                'products',
                'public',
                $product->id
            );

            $product->ImagePath = $filename;
        }

        $product->save();

        return redirect()->route('Product.all');
    }

   
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // حذف الصورة إذا موجودة
        if ($product->ImagePath) {
            $this->deleteProductImage('public', 'products', $product->ImagePath, $product->id);
        }

        $product->delete();

        return redirect()->route('Product.all');
    }
  
}
