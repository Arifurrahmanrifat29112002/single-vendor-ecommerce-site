@extends('admin.layouts.template')
@section('Content')


    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Add SubCategory</h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
          <!-- Basic Layout -->
          <div class="col-xxl">
            <div class="card mb-4">
              <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Create a SubCategory</h5>

              </div>
              <div class="card-body">
                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <ul>
                            <li>
                                <p class="text-danger">{{ $error }}</p>
                            </li>
                        </ul>
                    @endforeach
                @endif
                <form action="{{ route('SubCategoryStore') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">SubCategory Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="basic-default-name" placeholder="SubCategory Name" name="SubCategory_name"/>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="SubCategory_image">SubCategory Image</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="SubCategory_image"  name="SubCategory_image"/>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="Category">Category</label>
                    <div class="col-sm-10">
                        <select id="Category" class="form-select" name="Category_id">
                            <option selected>select Category</option>
                            @foreach ($categorices as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach

                          </select>
                    </div>
                  </div>


                  <div class="row justify-content-end">
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">Create a SubCategory</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
@endsection
