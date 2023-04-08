@extends('backend.layouts.app')
@push('css')

@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0 text-dark">Manage Invocie</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
             <li class="breadcrumb-item active">Invoice</li>
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
               <h4>Invoice No: #{{$invoice->invoice_no}} &nbsp;&nbsp;&nbsp;&nbsp;Date: ({{date('d-m-Y',strtotime($invoice->date))}})
                  <a class="btn btn-success btn-sm float-right" href="#" target="_blank"><i class="fa fa-print"></i>&nbsp;&nbsp;Print Invoice</a>
               </h4>
             </div><!-- /.card-header -->
             <div class="card-body">
               @php
                  $payment = App\Models\Payment::where('invoice_id',$invoice->id)->first();
               @endphp
               <table width="100%">
                   <tbody style="color: #4d0026">
                     <tr>
                       <td width="15"><p><strong>Customer Info</strong></p></td>
                       <td width="25"><p><strong>Name : </strong>{{$payment->customer->customer_name}}</p></td>
                       <td width="25"><p><strong>Mobile No : </strong>{{$payment->customer->mobile_no}}</p></td>
                       <td width="35"><p><strong>Address : </strong>{{$payment->customer->address}}</p></td>
                     </tr>
                     <tr>
                       <td width="15%"></td>
                       <td width="85%" colspan="3"><p><strong>Desciption : </strong>{{$invoice->description}}</p></td>
                     </tr>
                   </tbody>
                 </table>
                 <form action="#" method="post">
                   @csrf
                   <table class="table table-sm table-bordered "  width="100%">
                       <thead>
                         <tr class="text-center">
                           <th width="5%">SL.</th>
                           <th width="15%">Category</th>
                           <th width="20%">Product Name</th>
                           <th width="15%" class="text-center" style="background-color: #ddd;padding: 1px;">Current Stock</th>
                           <th width="15%">Quantity</th>
                           <th width="15%">Unit Price</th>
                           <th width="15%">Total Price</th>
                         </tr>
                       </thead>
                       <tbody>
                         @php
                           $total_sum = '0';
                         @endphp
                         @foreach($invoice['invoiceDetails'] as $key => $details)
                         <tr class="text-center">
                           <input type="hidden" name="category_id[]" value="{{$details->category_id}}">
                           <input type="hidden" name="product_id[]" value="{{$details->product_id}}">
                           <input type="hidden" name="selling_qty[{{$details->id}}]" value="{{$details->selling_qty}}">
                           <td>{{$key + 1}}</td>
                           <td>{{$details->category->category_name}}</td>
                           <td>{{$details->product->product_name}}</td>
                           <td class="text-center"><strong>{{$details->product->quantity}}</strong></td>
                           <td>{{$details->selling_qty}}</td>
                           <td>{{$details->unit_price}}</td>
                           <td>{{$details->selling_price}}</td>
                         </tr>
                         @php
                           $total_sum += $details->selling_price;
                         @endphp
                         @endforeach
                         <tr class="text-center">
                             <td colspan="6" class="text-right"><strong>Sub Total</strong></td>
                             <td style="background-color: #D8FDBA" ><strong>{{$total_sum}}</strong></td>
                         </tr >
                         <tr class="text-center">
                             <td colspan="6" class="text-right"><strong>Discount</strong></td>
                             <td style="background-color: #D8FDBA" ><strong>{{$payment->discount_amount}}</strong></td>
                         </tr>
                         <tr class="text-center">
                             <td colspan="6" class="text-right"><strong>Paid Amount</strong></td>
                             <td style="background-color: #D8FDBA" ><strong>{{$payment->paid_amount}}</strong></td>
                         </tr>
                         <tr class="text-center">
                             <td colspan="6" class="text-right"><strong>Due Amount</strong></td>
                             <td style="background-color: #D8FDBA" ><strong>{{$payment->due_amount}}</strong></td>
                         </tr>
                         <tr class="text-center">
                             <td colspan="6" class="text-right"><strong>Grand Total</strong></td>
                             <td style="background-color: #D8FDBA" ><strong>{{$payment->total_amount}}</strong></td>
                         </tr>
                       </tbody>
                   </table>
                    {{-- <button class="btn btn-success" type="submit" style="margin-top: 5px;">Invoice Approve</button> --}}
                 </form>
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
