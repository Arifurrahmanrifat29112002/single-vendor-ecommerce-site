@extends('admin.layouts.template')
@section('Content')


    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>All Category</h4>
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
          <!-- Basic Layout -->


          <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                         <h5 class="card-header">All Category Info</h5>
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
                                      <th>Category Name</th>
                                      <th>SubCategory Count</th>
                                      <th>Product Count</th>
                                      <th>Actions</th>
                                    </tr>
                                  </thead>
                                  <tbody class="table-border-bottom-0">
                                   @forelse ($trashCategories as $trashCategory)
                                   <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $loop->iteration }}</strong></td>
                                    <td>{{ $trashCategory->category_name }}</td>
                                    <td>{{ $trashCategory->SubCategory_count }}</td>
                                    <td>{{ $trashCategory->product_count }}</td>
                                    <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu" style="">
                                        <a class="dropdown-item" href="{{ route('categoryrestore',['id'=>$trashCategory->id]) }}"><i class="bx bx-edit-alt me-1"></i> Restore</a>
                                        <a class="dropdown-item" href="{{ route('categorydelete',['id'=>$trashCategory->id]) }}"><i class="bx bx-trash me-1"></i> Delete</a>
                                        </div>
                                    </div>
                                    </td>
                                </tr>
                                   @empty
                                   <tr>
                                      <td class="d-block">No Category</td>
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
                    <th>Category Name</th>
                    <th>Slug</th>
                    <th>SubCategory Count</th>
                    <th>Product Count</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                 @forelse ($categories as $category)
                         <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $loop->iteration }}</strong></td>
                            <td>{{ $category->category_name }}</td>
                            <td>{{ $category->category_slug}}</td>
                            <td>{{ $category->SubCategory_count }}</td>
                            <td>{{ $category->product_count }}</td>
                            <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu" style="">
                                <a class="dropdown-item" href="{{ route('categoryedit',['id'=>$category->id]) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                <a class="dropdown-item" href="{{ route('categorydestroy',['id'=>$category->id]) }}"><i class="bx bx-trash me-1"></i> Delete</a>
                                </div>
                            </div>
                            </td>
                        </tr>
                 @empty
                 <tr>
                    <td>No Category</td>
                </tr>
                 @endforelse


                </tbody>
              </table>
            </div>
          </div>
        </div>
        </div>
@endsection
