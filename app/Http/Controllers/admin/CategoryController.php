<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\product;
use App\Models\subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
class CategoryController extends Controller
{
    public function index(){

    }
    //show category page
    public function create(){
        return view('admin.category.addCategory');
    }

    //store category page
    public function store(Request $request){
        $request->validate([
            "category_name" => 'required|unique:categories,category_name,'.$request->id,
            "category_image" => 'required|mimes:png,jpg'
        ]);
        //create slug
        $slug = Str::slug($request->category_name, '-');
        //category image upload code
         $file_name = auth()->id() . '-' . time() . '.' . $request->file('category_image')->getClientOriginalExtension();
         $img = Image::make($request->file('category_image'));
         $img->save(base_path('public/upload/category_image/' . $file_name), 80);
        //category data insert a table
            Category::insert([
                "category_name" => $request->category_name,
                "category_slug" => $slug,
                "category_image" => $file_name,
                'created_at' => now(),
            ]);
            return back()->withSuccess('category Create successful');
    }


    //store category page
    public function allCategory(){
        return view('admin.category.allCategory',[
            "categories" => Category::all(),
            'trashCategories' =>Category::onlyTrashed()->get(),
        ]);
    }
    public function edit($id){

        $Category = Category::FindOrFail($id);
        return view('admin.category.EditCategory',compact('Category'));
    }
    public function update(Request $request,$id){

        $request->validate([
            "category_name" => 'unique:categories,category_name,'.$request->id,
            "category_image" => 'mimes:png,jpg'
        ]);
        //create slug
        $slug = Str::slug($request->category_name, '-');

        //category_image
        if($request->hasFile('category_image')){
            //category_image upload
           $category_info = Category::find($request->id);
           $category_img =  $category_info->category_image;
            unlink(base_path('public/upload/category_image/' . $category_img ));
            $file_name = auth()->id() . '-' . time() . '.' . $request->file('category_image')->getClientOriginalExtension();
            $img = Image::make($request->file('category_image'));
            $img->save(base_path('public/upload/category_image/' . $file_name), 80);
            Category::FindOrFail($id)->update([
                "category_image" => $file_name,
            ]);

        }

        //category data insert a table
        Category::FindOrFail($id)->update([
                "category_name" => $request->category_name,
                "category_slug" => $slug,
            ]);
            return back()->withSuccess('category Update successful');
    }
    public function destroy($id){
         $subcategories = subcategory::where('Category_id',$id)->get();

         foreach ($subcategories as $subcategory) {
              $subcategory->delete();
         }
        Category::FindOrFail($id)->delete();
        return back()->with('tempDelete','category TemDelete successful');
    }
    public function restore($id){
       Category::onlyTrashed()->find($id)->restore();
       return back();
    }
    public function delete($id){
       $category = Category::onlyTrashed()->find($id);
       $image_name =$category->category_image;
       $category_id = $category->id;
       $subcategories = subcategory::onlyTrashed()->where('Category_id', $category_id)->get();
       foreach ($subcategories as $subcategory) {
        unlink(base_path("public/upload/SubCategory_image/" . $subcategory->SubCategory_image));
        $subcategory->forceDelete();
       }
       unlink(base_path("public/upload/category_image/" . $image_name));
        Category::onlyTrashed()->find($id)->forceDelete();
       return back()->withSuccess('category Deleted !');
     }

     public function dashbord()
     {

      return view('admin.dashbord',[
       'category_count' => Category::all()->count(),
       'Category' => Category::all(),
       'subcategory_count' => subcategory::all()->count(),
       'subcategory' => subcategory::all(),
       'product_count' => product::all()->count(),
       'product' => product::all(),
      ]);
     }
}




