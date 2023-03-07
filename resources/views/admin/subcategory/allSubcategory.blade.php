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
                    <h5 class="card-header">All SubCategory Info</h5>
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
                                    <th>SubCategory Name</th>
                                    <th>Category Name</th>
                                    <th>Sub Product Count</th>
                                    <th>Actions</th>
                                </tr>
                              </thead>
                              <tbody class="table-border-bottom-0 ">
                               @forelse ($trashSubCategories as $trashSubCategory)
                               <tr>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $loop->iteration }}</strong></td>
                                <td>{{ $trashSubCategory->SubCategory_name }}</td>
                                <td>{{ $trashSubCategory->Category_name }}</td>
                                <td>{{ $trashSubCategory->product_count }}</td>
                                <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu" style="">
                                    <a class="dropdown-item" href="{{ route('Subcategoryrestore',['id'=>$trashSubCategory->id]) }}"><i class="bx bx-edit-alt me-1"></i> Restore</a>
                                    <a class="dropdown-item" href="{{ route('Subcategorydelete',['id'=>$trashSubCategory->id]) }}"><i class="bx bx-trash me-1"></i> Delete</a>
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
                    <th>SubCategory Name</th>
                    <th>Category Name</th>
                    <th>Sub Product Count</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0 ">
                 @forelse ($subcategorices as $subcategory)
                          <tr>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $loop->iteration  }}</strong></td>
                                <td>{{ $subcategory->SubCategory_name }}</td>
                                <td>{{ $subcategory->Category_name }}</td>
                                <td>{{ $subcategory->product_count }}</td>
                                <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu" style="">
                                    <a class="dropdown-item" href="{{ route('Subcategoryedit',['id'=>$subcategory->id]) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item" href="{{ route('Subcategorydestroy',['id'=>$subcategory->id]) }}"><i class="bx bx-trash me-1"></i> Delete</a>
                                    </div>
                                </div>
                                </td>
                            </tr>
                 @empty
                 <tr >
                    <td class="d-block"><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>no SubCategory</strong></td>

                </tr>
                 @endforelse


                </tbody>
              </table>
            </div>
          </div>
        </div>
        </div>
@endsection
