@extends('frontendWeb.layouts.webtemp')
@section('webpag')
      <h1 class="text-center">add to card</h1>

      @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
      @endif

      <div class="container">
        <div class="card p-3">
            <h5 class="card-header">Add To Card</h5>
            <div class="table-responsive text-nowrap">
              <table class="table ">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>User Id</th>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Product Quantity</th>
                    <th>Price</th>
                    <th>Created At</th>
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
                    <td>{{ $item->user_id }}</td>
                    <td>{{ $product_name }}</td>
                    <td>
                        <img src="{{ asset('upload/product_image') }}/{{  $product_image }}"  alt="Avatar" class="rounded-circle" width="50">

                    </td>
                    <td>{{ $item->product_quantity }}</td>
                    <td>{{ $item->price }}Tk</td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('F d ,Y')}}</td>
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
                    <td></td>
                    <td>Total Price</td>
                    <td>{{ $total_price }} Tk</td>
                    <td></td>
                   @if ($total_price != 0)
                    <td><a href="{{ route('shipping') }}" class="bg bg-primary p-1 text-white" >Check Out</a></td>
                   @endif
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
      </div>
@endsection


