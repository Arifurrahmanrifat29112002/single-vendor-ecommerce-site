@extends('frontendWeb.layouts.webtemp')
@section('webpag')

<h1 class="text-center">Final Step</h1>
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-4">
          <div class="card">
            <div class="card-header">
                <span>Product Will Send At</span>
            </div>
            <div class="card-body">
                @php
                    $id =Auth()->id();
                    $phone_number=  App\Models\shppinginfo::where('user_id',$id)->value('phone_number');
                    $city_name=  App\Models\shppinginfo::where('user_id',$id)->value('city_name');
                    $post_code=  App\Models\shppinginfo::where('user_id',$id)->value('post_code');
                @endphp

                <ul >
                    <li>User Name:{{ $user->name }}  </li>
                    <li>Email:{{ $user->email }} </li>
                    <li>phone Number: {{ $phone_number }} </li>
                    <li>City/village Name: {{ $city_name  }} -( {{ $post_code  }} )  </li>

                </ul>
            </div>
          </div>
        </div>
        <div class="col-8">

        <div class="card p-3">
            <h5 class="card-header">Add To Card</h5>
            <div class="table-responsive text-nowrap">
              <table class="table ">
                <thead>
                  <tr>
                    <th>No.</th>

                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Action</th>
                  </tr>
                </thead>
                @php
                    $total_price = 0;
                @endphp
                <tbody class="table-border-bottom-0">
                  @forelse ($addTocard_info as $item)

                  <tr>
                    @php
                        $product_name=  App\Models\product::where('id',$item->product_id)->value('product_name');
                        $product_image=  App\Models\product::where('id',$item->product_id)->value('product_image');

                    @endphp
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $loop->iteration }}</strong></td>

                    <td>{{ $product_name }}</td>
                    <td>
                        <img src="{{ asset('upload/product_image') }}/{{  $product_image }}"  alt="Avatar"  width="50">

                    </td>
                    <td>{{ $item->product_quantity }} </td>
                    <td>{{ $item->price }}Tk</td>

                    <td ><a href="{{ route('addproducttocardremove',['id'=>$item->id]) }}" class="bg bg-warning p-1 text-white">Remove</a></td>
                    @php
                        $total_price =$total_price + $item->price;
                    @endphp
                  </tr>
                  @empty

                  @endforelse
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total Price</td>
                    <td>{{ $total_price }} Tk</td>
                    <td></td>

                  </tr>
                </tbody>

              </table>
            </div>

          </div>
          <div class="btn-group mt-3">
            <form action="{{ route('placeorder') }}" method="post">
                @csrf
                <input type="submit" value="Place Order" class="btn btn-primary">
            </form>
            <form action="" method="post">
                @csrf
                <input type="submit" value="Cancel Order" class="btn btn-danger ml-2">
            </form>
          </div>
      </div>
        </div>

    </div>

@endsection


