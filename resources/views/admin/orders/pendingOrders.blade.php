@extends('admin.layouts.template')
@section('Content')

    <div class="card mt-5">
        <h3 class="m-3">Pending Orders</h3>
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead class="table-dark ">
              <tr >
                <th>No.</th>
                <th>User Name</th>
                <th>product</th>
                <th>Quntaty</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @forelse ($pending as $item)
                <tr>
                    @php
                         $name=  App\Models\User::where('id',$item->user_id)->value('name');
                         $product_name=  App\Models\product::where('id',$item->product_id)->value('product_name');
                         $product_image=  App\Models\product::where('id',$item->product_id)->value('product_image');
                    @endphp
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$loop->iteration }}</strong></td>
                                <td>
                                    <ul>
                                        <li>Name: {{ $name }}</li>
                                        <li>Phone: {{ $item->phone_number }}</li>
                                        <li>City & Zip: {{ $item->city }}-{{ $item->postcode }}</li>

                                    </ul>
                                </td>

                                <td>
                                    <img src="{{ asset('upload/product_image') }}/{{  $product_image }}" alt="Avatar" width="50"  data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"  title="" data-bs-original-title="{{ $product_name }}">

                                </td>
                                <td>{{  $item->product_quentaty }}  </td>
                                <td>{{  $item->total_price }}  </td>
                                <td>

                                    <form action="{{ route('confirm',['id'=>$item->id]) }}" method="post">
                                        @csrf
                                        <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="status">
                                            <option value="pending" selected>pending</option>
                                            <option value="confirm">Confirm</option>
                                          </select>

                                </td>
                                <td>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </td>
                            </form>
                            </tr>
              @empty
              <tr>
                <td class="text-center text-danger ">No Data</td>
            </tr>
              @endforelse


            </tbody>
          </table>
        </div>
      </div>
@endsection
