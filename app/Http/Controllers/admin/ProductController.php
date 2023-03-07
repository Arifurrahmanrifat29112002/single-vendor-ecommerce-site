<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\product;
use App\Models\subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    //
    public function index(){

    }
    public function addProduct(){
        return view('admin.products.addProduct',[
            "categorices" =>category::all(),
            "subcategorices" => subcategory::all(),
        ]);
    }
    public function allProduct(){
        return view('admin.products.allProduct',[
           "products"=> product::all(),
           "Trashedproducts" => product::onlyTrashed()->get(),
        ]);
    }
    //ajax  categoryb ->subcategorylist
    public function getSubCategoryList(Request $request){

        $category_id = $request->category_id;
        $sub_category_list = subcategory::where('Category_id',$category_id)->get();
        $subCategoryOption = '';
        foreach ($sub_category_list as  $value) {
            $subCategoryOption .=" <option value='$value->id'>$value->SubCategory_name</option>";
        }
        return $subCategoryOption;
    }


    public function store(Request $request){
         $request->validate([
            "*" =>"required",
            "product_image" =>"mimes:png,jpg",
            "Category_id" =>"required",
            "SubCategory_id" =>"required",
         ]);
         //create slug
         $slug = Str::slug($request->product_name, '-');
         //product image upload code
         $file_name = auth()->id() . '-' . time() . '.' . $request->file('product_image')->getClientOriginalExtension();
         $img = Image::make($request->file('product_image'));
        $img->save(base_path('public/upload/product_image/' . $file_name), 80);

      $category_name = category::where('id',$request->Category_id)->value('Category_name');
      $SubCategory_name =subcategory::where('id',$request->SubCategory_id)->value('SubCategory_name');

         product::insert([
            "product_name" => $request->product_name,
            "product_slug" => $slug,
            "product_price" => $request->product_price,
            "product_quantity" => $request->product_quantity,
            "product_image" => $file_name,
            "Category_name" => $category_name,
            "SubCategory_name" => $SubCategory_name,
            "Category_id" => $request->Category_id,
            "SubCategory_id" => $request->SubCategory_id,
            "short_description" => $request->short_description,
            "long_description" => $request->long_description,
            "product_status" => $request->product_status,
            'created_at' => now(),
         ]);
         category::where('id',$request->Category_id)->increment('product_count',1);
         subcategory::where("id",$request->SubCategory)->increment('product_count',1);
         return back()->withSuccess('Product Create successful');
    }


    public function edit($id){
        return view('admin.products.productEdit',[
            'product' => product::FindOrFail($id),
            'categorices' => category::all(),
            'subcategorices' => subcategory::all(),
           ]);
    }

    public function update(Request $request,$id){
        $request->validate([
            "product_image" => 'mimes:png,jpg'
         ]);
         //create slug
         $slug = Str::slug($request->product_name, '-');
         //product image upload code
        if($request->hasFile('product_image')){
            //category_image upload
           $product_info = product::find($request->id);
           $product_img =  $product_info->product_image;
            unlink(base_path('public/upload/product_image/' . $product_img ));

            $file_name = auth()->id() . '-' . time() . '.' . $request->file('product_image')->getClientOriginalExtension();
            $img = Image::make($request->file('product_image'));
            $img->save(base_path('public/upload/product_image/' . $file_name), 80);
            product::FindOrFail($id)->update([
                "product_image" => $file_name,
            ]);

        }
        $category_name = category::where('id',$request->Category_id)->value('Category_name');
        $SubCategory_name =subcategory::where('id',$request->SubCategory_id)->value('SubCategory_name');

        product::FindOrFail($id)->update([
            "product_name" => $request->product_name,
            "product_slug" => $slug,
            "product_price" => $request->product_price,
            "product_quantity" => $request->product_quantity,
            "Category_name" => $category_name,
            "SubCategory_name" => $SubCategory_name,
            "Category_id" => $request->Category_id,
            "SubCategory_id" => $request->SubCategory_id,
            "short_description" => $request->short_description,
            "long_description" => $request->long_description,
            "product_status" => $request->product_status,
        ]);
        return back()->withSuccess('Product Update successful');

    }
    public function destroy($id){
      $product =  product::FindOrFail($id)->delete();
      return back()->withSuccess('Product Tmp Deleted');
    }
    public function restore($id){
        product::onlyTrashed()->find($id)->restore();
        return back();
    }
    public function delete($id){
        $product = product::onlyTrashed()->find($id);
        $product_image =$product->product_image;
        $Category_id =$product->Category_id;
        $SubCategory_id =$product->SubCategory_id;
        unlink(base_path('public/upload/product_image/' . $product_image));
        product::onlyTrashed()->find($id)->forceDelete();

        category::where('id',$Category_id)->decrement('product_count',1);
        subcategory::where("id",$SubCategory_id)->decrement('product_count',1);
         return back();

    }
}
