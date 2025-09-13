<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; 
use App\Models\Product;

trait UploadTrait
{
    /**
     * رفع صورة المنتج بدون أي تعديل.
     *
     * @param Request $request
     * @param string $inputname
     * @param string $foldername
     * @param string $disk
     * @param int $product_id
     * @return string|null
     */
    public function uploadProductImage(Request $request, $inputname, $foldername, $disk, $product_id)
    {
        if ($request->hasFile($inputname) && $request->file($inputname)->isValid()) {

            $photo = $request->file($inputname);

            // توليد اسم فريد للصورة
            $filename = time() . '_' . Str::random(10) . '.' . $photo->getClientOriginalExtension();

            // حفظ الصورة كما هي في التخزين
            Storage::disk($disk)->putFileAs($foldername, $photo, $filename);

            // تحديث اسم الصورة في قاعدة البيانات
            $product = Product::findOrFail($product_id);
            $product->ImagePath = $filename;
            $product->save();

            return $filename;
        }

        return null;
    }

    /**
     * حذف صورة المنتج
     *
     * @param string $disk
     * @param string $foldername
     * @param string $filename
     * @param int $product_id
     * @return void
     */
    public function deleteProductImage($disk, $foldername, $filename, $product_id)
    {
        // حذف الصورة من التخزين
        Storage::disk($disk)->delete($foldername . '/' . $filename);

        // إزالة الصورة من قاعدة البيانات
        $product = Product::findOrFail($product_id);
        $product->ImagePath = null;
        $product->save();
    }
}
