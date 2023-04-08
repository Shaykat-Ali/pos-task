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
           <h1 class="m-0 text-dark">Manage Stock</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
             <li class="breadcrumb-item active">Stock</li>
           </ol>
         </div><!-- /.col -->
       </div><!-- /.row -->
     </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->

   <!-- Main content -->
   <section class="content">
     <div class="container-fluid">
       <!-- Main row -->
       <div class="row">
         <!-- Left col -->
         <section class="col-md-12">
           <!-- Custom tabs (Charts with tabs)-->
           <div class="card">
             <div class="card-header">
               <h3>Stock List
                  <a class="btn btn-success btn-sm float-right" href="#" target="_blank"><i class="fa fa-print"></i>&nbsp;&nbsp;Print Stock</a>
               </h3>
             </div><!-- /.card-header -->
             <div class="card-body">
               <table id="example1" class="table table-sm table-bordered table-hover " style="color:#00004d">
                   <thead>
                     <tr>
                       <th width="5%">SL.</th>
                       <th width="15%">Supplier</th>
                       <th width="15%">Category</th>
                       <th width="15%">Product Name</th>
                       <th width="10%">Unit</th>
                       <th width="10%">In.Qty</th>
                       <th width="10%">Out.Qty</th>
                       <th width="10%">Stcok</th>
                     </tr>
                   </thead>
                   <tbody style="color: #4d0026">
                     @foreach($stock_info as $key => $product)
                     @php
                         $buying_total_qty = App\Models\Purchase::where('category_id',$product->category_id)->where('product_id', $product->id)->sum('buying_qty');

                         $selling_total_qty = App\Models\InvoiceDetails::where('category_id',$product->category_id)->where('product_id', $product->id)->sum('selling_qty');
                     @endphp
                     <tr>
                       <td># {{$key+1}}</td>
                       <td >{{$product->supplier->company_name}}</td>
                       <td>{{$product->category->category_name}}</td>
                       <td >{{$product->product_name}}</td>
                       <td>{{$product->unit->unit_name}}</td>
                       <td>{{ $buying_total_qty}}</td>
                       <td>{{$selling_total_qty}}</td>
                       <td style="text-align: center;background-color:orange">{{$product->quantity}}</td>
                     </tr>
                     @endforeach
                   </tbody>
                 </table>
              <!-- /.card-body -->
             </div>
           </div>
           <!-- /.card -->
         </section>
         <!-- /.Left col -->
       </div>
       <!-- /.row (main row) -->
     </div><!-- /.container-fluid -->
   </section>
   <!-- /.content -->
 </div>
@endsection
