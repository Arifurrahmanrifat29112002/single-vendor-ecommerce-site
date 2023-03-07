<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SubCategoryController extends Controller
{


    public function index(){

    }

    public function addsubCategory(){
        return view('admin.subcategory.addsubCategory',[
            "categorices" => category::latest()->get(),
        ]);
    }

    public function store(Request $request){
         $request->validate([
            "*" =>"required",
            "SubCategory_image" => "mimes:png,jpg"
         ]);
        //create slug
         $slug = Str::slug($request->SubCategory_name, '-');
        //SubCategory image upload code
        $file_name = auth()->id() . '-' . time() . '.' . $request->file('SubCategory_image')->getClientOriginalExtension();
        $img = Image::make($request->file('SubCategory_image'));
        $img->save(base_path('public/upload/SubCategory_image/' . $file_name), 80);

        $Category_name = category::where('id',$request->Category_id)->value('category_name');

        subcategory::insert([
            "SubCategory_name"=>$request->SubCategory_name,
            "SubCategory_slug" =>$slug,
            "SubCategory_image"=>$file_name,
            "Category_id" =>$request->Category_id,
            "Category_name" =>$Category_name,
            'created_at' => now(),
        ]);

        category::where("id",$request->Category_id)->increment('SubCategory_count',1);

        return back()->withSuccess('SubCategory Create successful');
    }
    public function allSubcategory(){
        return view('admin.subcategory.allSubcategory',[
           "subcategorices"=>subcategory::all(),
           "trashSubCategories" => subcategory::onlyTrashed()->get(),
        ]);
    }
    public function edit($id){
       $subcatergory = subcategory::FindOrFail($id);
       $categorices = category::all();
       return view('admin.subcategory.EditeSubCategory',compact('subcatergory','categorices'));
    }
    public function update(Request $request,$id){
        $request->validate([
            "SubCategory_image" => "mimes:png,jpg"
         ]);
        //create slug
         $slug = Str::slug($request->SubCategory_name, '-');
          //category_image
        if($request->hasFile('SubCategory_image')){
            //SubCategory_image upload
           $subcategory_info = subcategory::find($request->id);
           $subcategory_img =  $subcategory_info->SubCategory_image;
            unlink(base_path('public/upload/SubCategory_image/' . $subcategory_img ));
            $file_name = auth()->id() . '-' . time() . '.' . $request->file('SubCategory_image')->getClientOriginalExtension();
            $img = Image::make($request->file('SubCategory_image'));
            $img->save(base_path('public/upload/SubCategory_image/' . $file_name), 80);
            subcategory::FindOrFail($id)->update([
                "SubCategory_image"=>$file_name,
            ]);

        }
         $Category_name = category::where('id',$request->Category_id)->value('category_name');
         subcategory::FindOrFail($id)->update([
                "SubCategory_name"=>$request->SubCategory_name,
                "SubCategory_slug" =>$slug,
                "Category_id" =>$request->Category_id,
                "Category_name" =>$Category_name,
         ]);
         return back()->withSuccess('SubCategory Update successful');

     }
     public function destroy($id){
        subcategory::find($id)->delete();
        return back()->withSuccess('SubCategory Tmp Deleted');
     }
     public function restore($id){
       $category_id = subcategory::onlyTrashed()->find($id)->Category_id;
       $category_id_deleted_at_check = category::withTrashed()->find($category_id)->deleted_at;

        if ($category_id_deleted_at_check == null) {
            subcategory::onlyTrashed()->find($id)->restore();
            return back();
        } else {
            return back();
        }


        // subcategory::onlyTrashed()->find($id)->restore();
        // return back();
     }
     public function delete($id){
        $subcatergory = subcategory::onlyTrashed()->find($id);
        $Category_id=$subcatergory->Category_id;
        $image_name = $subcatergory->SubCategory_image;
        unlink(base_path('public/upload/SubCategory_image/' . $image_name));
        subcategory::onlyTrashed()->find($id)->forceDelete();
        category::where('id',$Category_id)->decrement('SubCategory_count',1);
        return back();
     }
}
