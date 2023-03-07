@extends('frontendWeb.layouts.webtemp')
@section('webpag')
 <div class="container">
    <h3 class="text-center mt-3"> Search Result.....</h3>
    <div class="row mb-5 mt-5">

        @forelse ($serch_reults as $produt)
        <div class="col-lg-4 col-sm-4 mt-5">
            <div class="box_main">
               <h4 class="shirt_text">{{ $produt->product_name }}</h4>
               <p class="price_text">Price  <span style="color: #262626;">{{ $produt->product_price }} Tk</span></p>
               <div class="tshirt_img"><img src="{{ asset('upload/product_image') }}/{{  $produt->product_image  }}"></div>
               <div class="btn_main">
                  <form action="{{ route('addproducttocard') }}" method="post">
                    @csrf
                    <input type="text" value="{{ $produt->id }}" hidden name="product_id">
                    <input type="text" value="{{ $produt->product_price }}" hidden name="product_price">
                    <input class="form-control " value="1" hidden name="product_quantity">
                    <input class="btn  bg-warning text-light mt-3" type="submit" value="Buy Now">
                </form>

                  <div class="seemore_bt"><a href="{{ route('singleProduct',['id'=>$produt->id,'slug'=>$produt->product_slug ]) }}">See More</a></div>
               </div>
            </div>
         </div>
        @empty
            <h1 class="text-center  text-danger">No Result</h1>
        @endforelse

      </div>

 </div>
@endsection


