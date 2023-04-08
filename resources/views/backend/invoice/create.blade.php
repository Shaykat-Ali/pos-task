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
           <h1 class="m-0 text-dark">Manage Invoice</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
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
               <h3>Add Invocie
                 <a class="btn btn-success btn-sm float-right" href="{{route('invoices.index')}}"><i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;Invoice List</a>
               </h3>
             </div><!-- /.card-header -->
             <div class="card-body">
                 <div class="row">
                     <div class="form-group col-md-3">
                         <label for="invoice_no">Invoice No</label>
                         <input type="text" name="invoice_no" value="{{$invoice_no}}"  class="form-control form-control-sm" id='invoice_no' readonly style="background-color: #D8FDBA">
                     </div>
                      <div class="form-group col-md-3">
                         <label for="date">Date</label>
                         <input type="text" name="date" value="{{$selling_date}}"  class="form-control form-control-sm datepicker"  id="date" placeholder="MM-DD-YYYY"  readonly>
                     </div>
                     <div class="form-group col-md-3">
                         <label for="category_name">Category Name</label>
                         <select name="category_id" class="form-control select2 form-control-sm" id="category_id">
                             <option value="">Select category Name</option>
                             @foreach($categories as $k => $category)
                             <option value="{{$category->id}}">{{$category->category_name}}</option>
                             @endforeach
                         </select>
                         <font style="color:#e60000">
                             {{($errors->has('category_id'))?($errors->first('category_id')):' '}}
                         </font>
                     </div>

                     <div class="form-group col-md-3">
                         <label for="product_name">Product Name</label>
                         <select name="product_id" class="form-control select2 form-control-sm" id="product_id">
                           <option value="">Select Product</option>
                         </select>
                     </div>
                      <div class="form-group col-md-3">
                         <label for="stock">Stock</label>
                         <input type="text" name="current_stock_qty"  class="form-control form-control-sm" id="current_stock_qty" readonly style="background-color: #D8FDBA">
                     </div>
                     <div class="form-group col-md-2" style="padding-top: 30px;">
                         <a  class="btn btn-success btn-sm  addeventmore"><i class="fa fa-plus-circle"></i> Add Item</a>
                     </div>
                 </div>
             </div><!-- /.card-body -->
             <!--second card body-->
             <div class="card-body">
             <form action="{{route('invoices.store')}}" method="post">
               @csrf
               <table class="table-sm table-bordered" width="100%">
                 <thead>
                   <tr>
                     <th width="20%">Category Name</th>
                     <th width="20%">Product Name</th>
                     <th width="10%">Unit</th>
                     <th width="20%">Unit Price</th>
                     <th width="20%">Total Price</th>
                     <th width="10%">Action</th>
                   </tr>
                 </thead>
                 <tbody id="addRow" class="addRow">

                 </tbody>
                 <tbody>
                   <tr>
                     <td colspan="4">Discount</td>
                     <td><input type="text" name="discount_amount"  id="discount_amount" class="form-control form-control-sm  discount_amount text-right" placeholder="Enter discount amount"></td>
                     <td></td>
                   </tr>
                   <tr>
                     <td colspan="4"></td>
                     <td><input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control form-control-sm text-right estimated_amount" readonly style="background-color: #D8FDBA"></td>
                     <td></td>
                   </tr>
                 </tbody>
               </table>
                <br/>
               <div class="form-row">
                 <div class="form-group col-md-12">
                    <textarea name="description" class="form-control" id="description" placeholder="Write Description Here"></textarea>
                 </div>
               </div>
               <div class="form-row">
                  <div class="form-group col-md-4">
                      <label for="paid-status">Paid status</label>
                      <select name="paid_status" id="paid-status" class="form-control form-control-sm">
                        <option value="">Select Status</option>
                        <option value="full_paid">Full Paid</option>
                        <option value="full_due">Full Due</option>
                        <option value="partial_paid">Partial Paid</option>
                      </select>
                      <input type="text" name="paid_amount" class="form-control form-control-sm paid_amount" style="display:none" placeholder="Enter Paid Amount">
                  </div>
                  <div class="form-group col-md-8">
                     <label for="customer_name">Customer Name</label>
                     <select name="customer_id" id="customer_id" class="form-control form-control-sm select2">
                       <option value="">Select Customer</option>
                         @foreach($customers as $cus)
                       <option value="{{$cus->id}}">{{$cus->customer_name}}({{$cus->mobile_no}}-{{$cus->address}})</option>
                         @endforeach
                       <option value="0">New Customer</option>
                     </select>
                  </div>
               </div>
               <div class="form-row new_customer" style="display:none">
                 <div class="form-group col-md-4">
                     <input type="text" name="customer_name" id="name" class="form-control form-control-sm" placeholder="Enter Customer name">
                 </div>
                 <div class="form-group col-md-4">
                     <input type="text" name="mobile_no" id="mobile_no " class="form-control form-control-sm" placeholder="Enter Mobile No">
                 </div>
                 <div class="form-group col-md-4">
                     <input type="text" name="address" id="address " class="form-control form-control-sm" placeholder="Enter Address">
                 </div>
               </div>
               <div class="form-group">
                 <button type="submit" class="btn btn-primary"  id="storeButton">Invoice Store</button>
               </div>
              </form>

             <!-- /.card-body -->
             </div>
           </div>
         </section>
       </div>
       <!-- /.card -->
     </div><!-- /.container-fluid -->
   </section>
   <!-- /.content -->
 </div>

@endsection
@push('js')
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js"></script>
<script id="document-template" type="text/x-handlebars-template">
    <tr class="delete_add_more_item" id="delete_add_more_item">
        <input type="hidden" name="date" value="@{{date}}">
        <input type="hidden" name="invoice_no" value="@{{invoice_no}}">
     <td>
        <input type="hidden" name="category_id[]" value="@{{category_id}}">
        @{{category_name}}
     </td>
     <td>
        <input type="hidden" name="product_id[]" value="@{{product_id}}">
        @{{product_name}}
     </td>
     <td>
        <input type="number" min="1" class="form-control form-control-sm text-right selling_qty" name="selling_qty[]" value="1">
     </td>
     <td>
        <input type="number"  class="form-control form-control-sm text-right unit_price" name="unit_price[]" value="">
     </td>
     <td>
        <input class="form-control form-control-sm text-right selling_price" name="selling_price[]" value="0" readonly>
     </td>
     <td><i class="btn btn-danger btn-sm fa fa-window-close removeeventmore"></i></td>
    </tr>
</script>

<script type="text/javascript">
//purchase js
$(document).ready(function(){
   $(document).on("click",".addeventmore",function(){
        var invoice_no = $('#invoice_no').val();
        var date = $('#date').val();
        var category_id = $('#category_id').val();
        var category_name = $('#category_id').find('option:selected').text();
        var product_id = $('#product_id').val();
        var product_name = $('#product_id').find('option:selected').text();
        var current_stock = $('#current_stock_qty').val();
        if(current_stock < 1){
         $.notify("Current Stock is 0",{globalPosition: 'top right',className: 'error'});
         return false;
        }
        if(date == ''){
         $.notify("Date is required",{globalPosition: 'top right',className: 'error'});
         return false;
        }

        if(category_id == ''){
         $.notify("Category_id is required",{globalPosition: 'top right',className: 'error'});
         return false;
        }

        if(product_id == ''){
         $.notify("Product_id is required",{globalPosition: 'top right',className: 'error'});
         return false;
        }

        var source = $('#document-template').html();
        var template = Handlebars.compile(source);
        var data = {
                 invoice_no:invoice_no,
                 date:date,
                 category_id:category_id,
                 category_name:category_name,
                 product_id:product_id,
                 product_name:product_name

                 };
         var html = template(data);

         $("#addRow").append(html);
   });

     $(document).on("click",".removeeventmore",function(){
        $(this).closest(".delete_add_more_item").remove();
        totalAmountPrice();
     });

     $(document).on('keyup click','.unit_price,.selling_qty',function(){
           var unit_price = $(this).closest("tr").find("input.unit_price").val();
           var qty = $(this).closest("tr").find("input.selling_qty").val();
           var total = unit_price*qty;
           $(this).closest("tr").find("input.selling_price").val(total);
           $('#discount_amount').trigger('keyup');
     });

     $(document).on("keyup","#discount_amount",function(){
        totalAmountPrice();
     });

     function totalAmountPrice(){
        var sum = 0;
        $(".selling_price").each(function(){
            var value = $(this).val();
            if(!isNaN(value) && value.length != 0){
              sum += parseFloat(value);
            }
        });

        var dicount_amount = parseFloat($('#discount_amount').val());
        if(!isNaN(dicount_amount) && dicount_amount.length != 0){
              sum -= parseFloat(dicount_amount);
            }

          $('#estimated_amount').val(sum);
     }
 });

//category selected

 $(function(){
   $(document).on('change','#category_id',function(){

      var category_id = $(this).val();
     // console.log( supplier_id);
      $.ajax({
         url:"{{route('get-product')}}",
         dataType:'json',
         type:"GET",
         data:{category_id:category_id},
         success:function(data){

           var html = '<option value=" ">Select Product</option>';

           $.each(data,function(key,v){
               html +='<option value = "'+v.id+'">'+v.product_name+'</option>';

           });
                $('#product_id').html(html);
         }

      });

   });


});

//check-product-stock
 $(function(){
   $(document).on('change','#product_id',function(){
         var product_id = $(this).val();
         $.ajax({
              url: "{{route('check-product-stock')}}",
              type: "GET",
              data: {product_id:product_id},
              success: function(data){
                  $('#current_stock_qty').val(data);               }
         });
     });
 });

//display hide show

$(document).on('change','#customer_id',function(){
   var customer_id = $(this).val();
   if(customer_id == '0'){
       $('.new_customer').show();
   }else{
       $('.new_customer').hide();
   }

});

$(document).on('change','#paid-status',function(){
   var paid_status = $(this).val();
   if(paid_status == 'partial_paid'){
       $('.paid_amount').show();
   }else{
       $('.paid_amount').hide();
   }

});

//date picker
      $('.datepicker').datepicker({
           uiLibrary: 'bootstrap4',
         });
   </script>
@endpush
