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
           <h1 class="m-0 text-dark">Manage Invoice</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="{{route('home')}}">home</a></li>
             <li class="breadcrumb-item active">invoice</li>
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
               <h3>Invoice List
                  <a class="btn btn-primary btn-sm float-right" href="{{route('invoices.create')}}"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;Add Invoice</a>
               </h3>
             </div><!-- /.card-header -->
             <div class="card-body">
               <table id="example1" class="table table-sm table-bordered table-hover" style="color:#00004d">
                   <thead>
                     <tr>
                       <th width="10%">SL.</th>
                       <th width="15%">invoice No</th>
                       <th width="15%">Customer Name</th>
                       <th width="20%">Date</th>
                       <th width="20%">Total Amount</th>
                       <th width="10%">Created_by</th>
                       <th width="10%">Print</th>
                     </tr>
                   </thead>
                   <tbody style="color: #4d0026">
                    @foreach($invoice_info as $key => $invoice)
                    <tr>
                      <td># {{$key+1}}</td>
                      <td># {{$invoice->invoice_no}}</td>
                      <td>
                          {{$invoice->payment->customer->customer_name}}
                          ({{$invoice->payment->customer->mobile_no}}-{{$invoice->payment->customer->address}})
                      </td>
                      <td>{{date('d-m-Y',strtotime($invoice->date))}}</td>
                      <td>{{$invoice->payment->total_amount}}</td>
                      <td>{{$invoice->user->name}}</td>
                      <td>
                        <a title="Approve" href="{{route('invoices.show',$invoice->id)}}" class="btn btn-success btn-sm approveBtn" ><i class="fa fa-eye"></i></a>
                      </td>
                    </tr>
                    @endforeach
                   </tbody>

                  </table>
              <!-- /.card-body -->
             </div>
             <div class="col-md-12  justify-content-end">

                <div class="col-md-12">
                    {{ $invoice_info->links()}}
                </div>

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
@push('js')

@endpush
