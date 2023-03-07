@extends('admin.layouts.template')
@section('Content')


    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>All SubCategory</h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
          <!-- Basic Layout -->
          <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Produts Info</h5>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#largeModal">
                    Trash Bin
                    </button>
            </div>
              <!-- Large Modal -->
              <div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content  bg-dark">
                    <div class="modal-header ">
                      <h5 class="modal-title" id="exampleModalLabel3">Trash Bin</h5>
                      <button type="button"class="btn-close"data-bs-dismiss="modal"aria-label="Close"></button>
                    </div>
                    <div class="modal-body m-1">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-dark">

                              <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Product Name</th>
                                    <th>price</th>
                                    <th>Category</th>
                                    <th>SubCategory</th>
                                    <th>Actions</th>
                                </tr>
                              </thead>
                              <tbody class="table-border-bottom-0 ">
                               @forelse ($Trashedproducts as $Trashedproduct)
                               <tr>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $loop->iteration }}</strong></td>
                                <td>{{ $Trashedproduct->product_name }}</td>
                                <td>{{ $Trashedproduct->product_price }}</td>
                                <td>{{ $Trashedproduct->Category_name }}</td>
                                <td>{{ $Trashedproduct->SubCategory_name }}</td>
                                <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu" style="">
                                    <a class="dropdown-item" href="{{ route('Productrestore',["id"=>$Trashedproduct->id]) }}"><i class="bx bx-edit-alt me-1"></i> Restore</a>
                                    <a class="dropdown-item" href="{{ route('Productdelete',["id"=>$Trashedproduct->id]) }}"><i class="bx bx-trash me-1"></i> Delete</a>
                                    </div>
                                </div>
                                </td>
                            </tr>
                               @empty
                               <tr>
                                  <td class="d-block">No SubCategory</td>
                              </tr>
                               @endforelse


                              </tbody>
                            </table>
                          </div>

                    </div>

                  </div>
                </div>
              </div>
            <div class="table-responsive text-nowrap">
              <table class="table table-dark">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Product Name</th>
                    <th>price</th>
                    <th>Category</th>
                    <th>SubCategory</th>
                    <th>Product Quantity</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($products as $product)
                    <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $loop->iteration }}</strong></td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->product_price }}</td>
                        <td>{{ $product->Category_name }}</td>
                        <td>{{ $product->SubCategory_name }}</td>
                        <td>{{ $product->product_quantity }}</td>


                        <td><span class="badge bg-label-primary me-1">{{ $product->product_status }}</span></td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                              <a class="dropdown-item" href="{{ route('Productedit',['id'=>$product->id]) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                              <a class="dropdown-item" href="{{ route('Productdestroy',['id'=>$product->id]) }}"><i class="bx bx-trash me-1"></i> Delete</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                    @empty

                    @endforelse


                </tbody>
              </table>
            </div>
          </div>
        </div>
        </div>
@endsection
