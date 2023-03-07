@extends('admin.layouts.template')
@section('Content')


    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Add Product</h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
          <!-- Basic Layout -->
          <div class="col-xxl">
            <div class="card mb-4">
              <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Add Product</h5>

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
                <form action="{{ route('Productstore') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Product Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="basic-default-name" placeholder="Product Name" name="product_name"/>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="product_price">Product Price</label>
                    <div class="col-sm-10">

                      <input type="number" class="form-control" id="product_price" placeholder="Product Price" name="product_price"/>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="product_quantity">Product Quantity</label>
                    <div class="col-sm-10">

                      <input type="number" class="form-control" id="product_quantity" placeholder="Product Quantity" name="product_quantity"/>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="image">Product Image</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="image" name="product_image"/>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="parent_category">Category</label>
                    <div class="col-sm-10">
                        <select id="parent_category" class="form-select" name="Category_id">
                            @foreach ($categorices as $Category)
                                <option value="{{ $Category->id }}">{{ $Category->category_name }}</option>
                            @endforeach
                          </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="SubCategory_id">SubCategory</label>
                    <div class="col-sm-10">
                        <select id="SubCategory_id" class="form-select" name="SubCategory_id">

                          </select>
                    </div>
                  </div>

                   <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="short_description">Product Short Description</label>
                    <div class="col-sm-10">
                      <textarea id="short_description" class="form-control" placeholder="Enter Product short description"  rows="1" name="short_description"></textarea>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-2 form-label" for="long_description">Product Long Description</label>
                    <div class="col-sm-10">
                      <div class="input-group input-group-merge">
                        <span id="long_description" class="input-group-text"><i class="bx bx-comment"></i></span>
                        <textarea id="long_description" class="form-control" placeholder="Enter Product Long description"  name="long_description"></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="SubCategory_status">Product Status</label>
                    <div class="col-sm-10">
                        <select id="SubCategory_status" class="form-select" name="product_status">

                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                          </select>
                    </div>
                  </div>

                  <div class="row justify-content-end">
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">Add Product</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
@endsection
<!-- ajax code -->
@section('script')
<script>
    $(document).ready(function() {
        // category ajax
        $('#parent_category').change(function() {
            var category_id = $(this).val();
            if (category_id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '/admin/post/subcategorylist',
                    data: {
                        category_id: category_id
                    },
                    success: function(data) {
                        $("#SubCategory_id").html(data);
                    }
                });
            }
        })
    })
</script>
@endsection
