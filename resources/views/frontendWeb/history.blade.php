@extends('frontendWeb.layouts.user_profile_templet')
@section('user')

    <div class="card mt-5">
        <h3 class="m-3">Confirm Orders</h3>
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead class="table-dark ">
              <tr >
                <th>No.</th>

                <th>product</th>
                <th>Quntaty</th>
                <th>Total Price</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @forelse ($confirm as $item)
                <tr>
                    @php

                         $product_name=  App\Models\product::where('id',$item->product_id)->value('product_name');
                         $product_image=  App\Models\product::where('id',$item->product_id)->value('product_image');
                    @endphp
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$loop->iteration }}</strong></td>


                                <td>
                                    <img src="{{ asset('upload/product_image') }}/{{  $product_image }}" alt="Avatar" width="50"  data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"  title="" data-bs-original-title="{{ $product_name }}">

                                </td>
                                <td>{{  $item->product_quentaty }}  </td>
                                <td>{{  $item->total_price }} Tk </td>



                            </tr>
              @empty
                            <tr>
                                <td class="text-center text-danger">No Data</td>
                            </tr>
              @endforelse


            </tbody>
          </table>
        </div>
      </div>
@endsection
