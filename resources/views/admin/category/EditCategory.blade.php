@extends('admin.layouts.template')
@section('Content')


<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Edit Category</h4>

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
      <!-- Basic Layout -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Edit Category</h5>

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
            <form action="{{ route('categoryupdate',['id'=>$Category->id]) }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Category Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="basic-default-name" placeholder="Category Name" name="category_name" value="{{ $Category->category_name }}"/>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="category_image">Category Image</label>
                <div class="col-sm-10">
                    <img src="{{ asset('upload/category_image') }}/{{  $Category->category_image }}" alt="Avatar" class="m-2" width="70">

                  <input type="file" class="form-control" id="category_image"  name="category_image"/>
                </div>
              </div>


              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Update Category</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection
