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
            <h1 class="m-0">{{ trans('page.purchase') }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ trans('page.purchase') }}</li>
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
                    <h4>{{ trans('page.purchase_list') }}</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('purchases.create') }}" class="btn btn-sm btn-primary" >
                        <i class="fa fa-plus-circle"></i> {{ trans('page.add_purchase') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table-sm table-bordered text-center align-baseline-center">
                        <thead>
                            <tr>
                              <th width="10%">SL.</th>
                              <th width="10%">Purchase No</th>
                              <th width="10%">Purchase Date</th>
                              <th width="10%">Spplier</th>
                              <th width="10%">Category</th>
                              <th width="10%">Product</th>
                              <th width="10%">Buying Qty</th>
                              <th width="10%">Unit Price</th>
                              <th width="10%">Buying Price</th>
                              <th width="10%">Action</th>
                            </tr>
                          </thead>
                        <tbody>
                            @foreach ($purchases as $key => $purchase)
                            <tr>
                                <td># {{$key+1}}</td>
                                <td>{{$purchase->purchase_no}}</td>
                                <td>{{date('d-m-Y',strtotime($purchase->purchase_date))}}</td>
                                <td>{{$purchase->supplier->company_name}}</td>
                                <td>{{$purchase->category->category_name}}</td>
                                <td>{{$purchase->product->product_name}}</td>
                                <td>{{$purchase->buying_qty}}
                                    {{$purchase->product->unit->unit_name}}
                                </td>
                                <td>{{$purchase->unit_price}}</td>
                                <td>{{$purchase->buying_price}}</td>
                                <td>---</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12  justify-content-end">

                    <div class="col-md-12">
                        {{$purchases->links()}}
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
