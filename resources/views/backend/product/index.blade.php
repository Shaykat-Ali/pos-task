@extends('backend.layouts.app')
@push('css')
<style>
    thead{
      background:#e0e0eb;
    }
</style>
@endpush
@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ trans('page.product') }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ trans('page.product') }}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex">
                <div class="col-md-6">
                    <h4>{{ trans('page.product_list') }}</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus-circle"></i> {{ trans('page.add_product') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-sm table-bordered text-center align-baseline-center">
                        <thead>
                            <tr>
                                <th width="10%">SL.</th>
                                <th width="15%">Supplier</th>
                                <th width="15%">Category</th>
                                <th width="15%">Product</th>
                                <th width="10%">Image</th>
                                <th width="10%">Unit</th>
                                <th width="15%">Stock</th>
                                <th width="10%">Action</th>
                              </tr>
                          </thead>
                        <tbody>
                            @foreach ($products as $key => $product)
                            <tr>
                                <td>#{{ $key + 1 }}</td>
                                <td>{{ $product->supplier->company_name}}</td>
                                <td>{{ $product->category->category_name }}</td>
                                <td>{{ $product->product_name}}</td>
                                <td><img src="{{(!empty($product->image)) ? asset('storage/'.$product->image) : ('avatar.jpg')}}" style="height:60px;width:60px;"></td>
                                <td>{{ $product->unit->unit_name }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>---</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12  justify-content-end">

                    <div class="col-md-12">
                       {{ $products->links() }}
                    </div>

                </div>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
@push('js')
@endpush
