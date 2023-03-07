@extends('frontendWeb.layouts.webtemp')
@section('webpag')

    <div class="container ">
        @foreach ($produtcs as $produt)




          <div class="container p-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="box_main">
                        <img class="card-img card-img-left" src="{{ asset('upload/product_image') }}/{{  $produt->product_image }}" alt="Card image">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="box_main">
                        <ul>
                            <li><h5>{{ $produt->product_name }}</h5></li>
                            <li><span class="text-danger">Price </span>{{ $produt->product_price }}tk</li>
                            <li class="mt-2">{{ $produt->short_description  }}</li>
                            <li class="mt-2">{{ $produt->long_description }}</li>
                            <li class="mt-2"><span>Available Quantity-</span>{{ $produt->product_quantity }}</li>
                            <li class="mt-4">
                                {{-- add to card --}}
                                <form action="{{ route('addproducttocard') }}" method="post">
                                    @csrf
                                    <input type="text" value="{{ $produt->id }}" hidden name="product_id">
                                    <input type="text" value="{{ $produt->product_price }}" hidden name="product_price">
                                    <label for="Quantity">How Many Pics? </label>
                                    <input class="form-control " width="20%" type="number" min="1" value="1" id="Quantity" name="product_quantity"><br>
                                    <input class="btn  bg-warning text-light mt-3" type="submit" value="Add To Card">
                                </form>

                             </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endforeach


    </div>


    <div class="container">
        <h1 class="fashion_taital">Related Products</h1>
        <div class="fashion_section_2">
           <div class="row">
        @foreach ($related_products as $related_product)
        <div class="col-lg-4 col-sm-4">
            <div class="box_main">
               <h4 class="shirt_text">{{  $related_product->product_name }}</h4>
               <p class="price_text">Price  <span style="color: #262626;">{{ $related_product->product_price }} Tk</span></p>
               <div class="tshirt_img"><img src="{{ asset('upload/product_image') }}/{{  $related_product->product_image  }}"></div>
               <div class="btn_main">
                <form action="{{ route('addproducttocard') }}" method="post">
                    @csrf
                    <input type="text" value="{{ $related_product->id }}" hidden name="product_id">
                    <input type="text" value="{{ $related_product->product_price }}" hidden name="product_price">
                    <input class="form-control " value="1" hidden name="product_quantity">
                    <input class="btn  bg-warning text-light mt-3" type="submit" value="Buy Now">
                </form>
                  <div class="seemore_bt"><a href="{{ route('singleProduct',['id'=>$related_product->id,'slug'=>$related_product->product_slug ]) }}">See More</a></div>
               </div>
            </div>
         </div>
        @endforeach


           </div>
        </div>

  </div>
@endsection
