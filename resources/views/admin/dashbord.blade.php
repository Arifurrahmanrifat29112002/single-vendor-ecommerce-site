@extends('admin.layouts.template')
@section('Content')


<div class="content-wrapper mt-3">

      <div class="row">

        <div class="col-xl-6">
            <h6 class="text-muted">Filled Tabs</h6>
            <div class="nav-align-top mb-4">
              <ul class="nav nav-tabs nav-fill" role="tablist">
                <li class="nav-item">
                  <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-home" aria-controls="navs-justified-home" aria-selected="true">
                    <i class="tf-icons bx bx-home"></i> Category
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger">{{ $category_count }}</span>
                  </button>
                </li>
                <li class="nav-item">
                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-profile" aria-controls="navs-justified-profile" aria-selected="false">
                    <i class="tf-icons bx bx-user"></i> SubCategory
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger">{{ $subcategory_count }}</span>
                  </button>
                </li>
                <li class="nav-item">
                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-messages" aria-controls="navs-justified-messages" aria-selected="false">
                    <i class="tf-icons bx bx-message-square"></i> Product
                    <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger">{{ $product_count }}</span>
                  </button>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
                    @forelse ($Category as $cate)
                        <h1 class="badge bg-label-warning rounded-pill"> {{ $cate->category_name  }} </h1>
                        @empty
                        <h1 class="badge bg-label-warning rounded-pill">No Category</h1>
                        @endforelse
                </div>
                <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                    @forelse ($subcategory as $subcate)
                <h1 class="badge bg-label-warning rounded-pill"> {{ $subcate->SubCategory_name  }} </h1>
                @empty
                <h1 class="badge bg-label-warning rounded-pill">No SubCategory</h1>
                @endforelse
                </div>
                <div class="tab-pane fade" id="navs-justified-messages" role="tabpanel">
                    @forelse ($product as $produc)
                    <h1 class="badge bg-label-warning rounded-pill"> {{ $produc->product_name  }} </h1>
                    @empty
                    <h1 class="badge bg-label-black rounded-pill">No Product</h1>
                    @endforelse
                </div>
              </div>
            </div>
          </div>
      </div>
</div>

@endsection
