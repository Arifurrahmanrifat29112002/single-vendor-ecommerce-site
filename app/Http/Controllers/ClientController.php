<?php

namespace App\Http\Controllers;

use App\Models\addtocard;
use App\Models\category;
use App\Models\order;
use App\Models\product;
use App\Models\shppinginfo;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
     public function category($id) {
            $categorice = category::find($id);
            $produtcs = product::where('Category_id',$id)->get();

        return view('frontendWeb.category',compact('categorice','produtcs'));
    }
    public function singleProduct($id) {

            $produtcs = product::where('id',$id)->get();
            $sub_id = product::where('id',$id)->value('SubCategory_id');
            $related_products = product::where('SubCategory_id',$sub_id)->latest()->get();

        return view('frontendWeb.singleProduct',compact('produtcs','related_products'));
    }
    public function addToCard() {
        $user_id = Auth()->id();
        $addTocard_info =  addtocard::where('user_id',$user_id)->latest()->get();
        return view('frontendWeb.addToCard',compact('addTocard_info'));
    }
    public function addproducttocard(Request $request) {
        $price = $request->product_price * $request->product_quantity;

            addtocard::insert([
                "user_id" => Auth()->id(),
                "product_id" => $request->product_id,
                "product_quantity" => $request->product_quantity,
                "price" => $price,
                "created_at" => now(),
            ]);
            return redirect()->route('addToCard')->with('message','Your item added to cart Successfully');

    }
    public function addproducttocardremove($id)
    {
        addtocard::where('id',$id)->delete();
        return back()->with('message','Your item Delete Successfully');
    }
    public function Getshipping()
    {
        $u_id =Auth()->id();
        $user = shppinginfo::where('user_id',$u_id)->count();

        return view('frontendWeb.shipping',compact('user'));
    }

    public function checkout()
    {
        $user_id = Auth()->id();
        $addTocard_info =  addtocard::where('user_id',$user_id)->latest()->get();

        // $shpping_address = shppinginfo::where('user_id',$user_id)->get();

        $user = User::find($user_id);
        return view('frontendWeb.checkout',compact('addTocard_info','user'));
    }
    public function Addshipping(Request $request)
    {
         $request->validate([
            '*' => 'required',
            'phone_number' =>'required |min_digits:11'
         ]);
         shppinginfo::insert([
            "user_id"=>Auth()->id(),
            "phone_number"=>$request->phone_number,
            "city_name"=>$request->city_name,
            "post_code"=>$request->post_code,
            "created_at"=>now(),
         ]);
        return redirect()->route('checkout')->with('massage','successfull');

    }

    public function placeorder()
    {
        $user_id = Auth()->id();
        $addTocards_info =  addtocard::where('user_id',$user_id)->latest()->get();
        $phone_number=  shppinginfo::where('user_id',$user_id)->value('phone_number');
        $city_name= shppinginfo::where('user_id',$user_id)->value('city_name');
        $post_code= shppinginfo::where('user_id',$user_id)->value('post_code');

        foreach ($addTocards_info as $item) {
           order::insert([
            "user_id"=>$user_id ,
            "phone_number"=> $phone_number,
            "city"=> $city_name,
            "postcode"=> $post_code,
            "product_id"=>$item->product_id,
            "product_quentaty"=>$item->product_quantity,
            "total_price"=>$item->price,
            "created_at"=>now(),

           ]);
           $id= $item->id;
           addtocard::where('id',$id)->delete();

        }
        shppinginfo::where('user_id',$user_id)->delete();
        return redirect()->route('pendingorders')->with('message','your order has been placed successfulliy');
    }


    public function userProfile() {

        return view('frontendWeb.userProfile');
    }
    public function pendingorders() {
        $pending_orders = order::where('status','pending')->latest()->get();
        return view('frontendWeb.pendingorders',compact('pending_orders'));
    }
    public function history() {

        return view('frontendWeb.history',[
            'confirm' => order::where('status','confirm')->latest()->get()
        ]);
    }

     public function NewRelease(){


        return view('frontendWeb.newrelease');
    }
    public function todaysDeal(){
        return view('frontendWeb.todaysdeal');
    }
    public function customerService(){
        return view('frontendWeb.customerservice');
    }

    //serching result
    public function search(Request $request)
    {
        $serch_query = $request->search;
        $serch_reults =product::where("product_name","LIKE","%$serch_query%")->get();
        return view('frontendWeb.search',compact('serch_reults'));
    }

}
