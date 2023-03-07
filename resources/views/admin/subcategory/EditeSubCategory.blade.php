@extends('admin.layouts.template')
@section('Content')


    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Update SubCategory</h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
          <!-- Basic Layout -->
          <div class="col-xxl">
            <div class="card mb-4">
              <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Update SubCategory</h5>

              </div>
              <div class="card-body">
                <form action="{{ route('Subcategoryupdate',['id'=>$subcatergory->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">SubCategory Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="basic-default-name" placeholder="SubCategory Name" name="SubCategory_name" value="{{ $subcatergory->SubCategory_name }}"/>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="SubCategory_image">SubCategory Image</label>
                    <div class="col-sm-10">
                        <img src="{{ asset('upload/SubCategory_image') }}/{{  $subcatergory->SubCategory_image }}" alt="Avatar" class="m-2" width="70">
                      <input type="file" class="form-control" id="SubCategory_image"  name="SubCategory_image"/>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="Category">Category</label>
                    <div class="col-sm-10">
                        <select id="Category" class="form-select" name="Category_id">
                            <option value="{{ $subcatergory->Category_id }}" selected>{{ $subcatergory->Category_name }}</option>
                            @foreach ($categorices as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach

                          </select>
                    </div>
                  </div>


                  <div class="row justify-content-end">
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">Update SubCategory</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
@endsection
