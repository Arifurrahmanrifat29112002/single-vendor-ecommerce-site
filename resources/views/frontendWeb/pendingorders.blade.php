@extends('frontendWeb.layouts.user_profile_templet')
@section('user')
      <h1>pending</h1>
      @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
      @endif

      <div class="card p-3">
        <h5 class="card-header">Pending Orders</h5>
        <div class="table-responsive text-nowrap">
          <table class="table ">
            <thead>
              <tr>
                <th>No.</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>

              </tr>
            </thead>
            @php
                $total_price = 0;
            @endphp
            <tbody class="table-border-bottom-0">
              @forelse ($pending_orders as $item)
              @php
                $product_name=  App\Models\product::where('id',$item->product_id)->value('product_name');
             @endphp
              <tr>

                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $loop->iteration }}</strong></td>

                <td>{{ $product_name }}</td>

                <td>{{ $item->product_quentaty }} </td>
                <td>{{ $item->total_price }}Tk</td>

                @php
                    $total_price =$total_price + $item->total_price;
                @endphp
              </tr>
              @empty

              @endforelse
              <tr>

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
@endsection
