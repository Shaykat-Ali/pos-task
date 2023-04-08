@extends('backend.layouts.app')
@push('css')
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Purchase</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">home</a></li>
              <li class="breadcrumb-item active">purchase</li>
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
                <h3>Add Purchase
                  <a class="btn btn-success btn-sm float-right" href="{{route('purchases.index')}}"><i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;Purchase List</a>
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                  <div class="row">
                      <div class="form-group col-md-4">
                          <label for="purchase_no">Purchase No</label>
                          <input type="text" readonly name="purchase_no" value="{{$purchase_no}}"  class="form-control form-control-sm" id='purchase_no'>
                      </div>
                      <div class="form-group col-md-4">
                          <label for="sup_com_name">Supplier</label>
                          <select name="supplier_id" class="form-control select2 form-control-sm" id="supplier_id">
                              <option value="">Select Supplier Company Name</option>
                              @foreach($suppliers as $k => $supplier)
                              <option value="{{$supplier->id}}">{{$supplier->company_name}}</option>
                              @endforeach
                          </select>
                          <font style="color:#e60000">
                              {{($errors->has('supplier_id'))?($errors->first('supplier_id')):' '}}
                          </font>
                      </div>
                      <div class="form-group col-md-4">
                          <label for="category">Category</label>
                          <select name="category_id" class="form-control select2 form-control-sm" id="category_id">
                              <option value="">Select Category</option>
                          </select>
                      </div>
                      <div class="form-group col-md-4">
                          <label for="purchase_date">Purchase Date</label>
                          <input type="text" name="purchase_date"  class="form-control form-control-sm datepicker"  id="purchase_date" placeholder="MM-DD-YYYY">
                      </div>
                      <div class="form-group col-md-4">
                          <label for="product_name">Product Name</label>
                          <select name="product_id" class="form-control select2 form-control-sm" id="product_id">
                            <option value="">Select Product</option>
                          </select>
                      </div>
                      <div class="form-group col-md-2" style="padding: 30px">
                          <a  class="btn btn-success btn-sm  addeventmore"><i class="fa fa-plus-circle"></i> Add Item</a>
                      </div>
                  </div>
              </div><!-- /.card-body -->
              <!--second card body-->
              <div class="card-body">
              <form action="{{route('purchases.store')}}" method="post">
                @csrf
                <table class="table-sm table-bordered" width="100%">
                  <thead>
                    <tr>
                      <th>Product Name</th>
                      <th width="10%">Unit</th>
                      <th width="15%">Unit Price</th>
                      <th>Description</th>
                      <th width="10%">Total Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="addRow" class="addRow">

                  </tbody>
                  <tbody>
                    <tr>
                      <td colspan="4" style="text-align: right" ><strong>Total</strong></td>
                      <td><input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control form-control-sm text-right estimated_amount" readonly style="background-color: #D8FDBA"></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
                <br/>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary"  id="storeButton">Purchase Store</button>
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
     <input type="hidden" name="purchase_date[]" value="@{{purchase_date}}">
     <input type="hidden" name="purchase_no[]" value="@{{purchase_no}}">
     <input type="hidden" name="supplier_id[]" value="@{{supplier_id}}">
     <input type="hidden" name="category_id[]" value="@{{category_id}}">
      <td>
        <input type="hidden" name="product_id[]" value="@{{product_id}}">
        @{{product_name}}
      </td>
      <td>
        <input type="number" min="1" class="form-control form-control-sm text-right buying_qty" name="buying_qty[]" value="1">
      </td>
       <td>
        <input type="number"  class="form-control form-control-sm text-right unit_price" name="unit_price[]" value="">
      </td>
       <td>
        <input type="text"  class="form-control form-control-sm" name="description[]" >
      </td>
       <td>
        <input type="number" class="form-control form-control-sm text-right buying_price" name="buying_price[]" value="0" readonly>
      </td>
      <td><i class="btn btn-danger btn-sm fa fa-window-close removeeventmore"></i></td>
    </tr>
</script>

<script type="text/javascript">
//purchase js
$(document).ready(function(){
    var productIds = [];
   $(document).on("click",".addeventmore",function(){
        var purchase_date = $('#purchase_date').val();
        var purchase_no = $('#purchase_no').val();
        var supplier_id = $('#supplier_id').val();
        var category_id = $('#category_id').val();
        var category_name = $('#category_id').find('option:selected').text();
        var product_id = $('#product_id').val();
        var product_name = $('#product_id').find('option:selected').text();
        if(purchase_date == ''){
         $.notify("Purchase Date is required",{globalPosition: 'top right',className: 'error'});
         return false;
        }
        if(purchase_no == ''){
         $.notify("Purchase_no is required",{globalPosition: 'top right',className: 'error'});
         return false;
        }
         if(supplier_id == ''){
         $.notify("Supplier Field is required",{globalPosition: 'top right',className: 'error'});
         return false;
        }
        if(category_id == ''){
         $.notify("Category Field is required",{globalPosition: 'top right',className: 'error'});
         return false;
        }

        if(product_id == '' || product_name == 'Select Product'){
         $.notify("Product Field is required",{globalPosition: 'top right',className: 'error'});
         return false;
        }
        var source = $('#document-template').html();
        var template = Handlebars.compile(source);
        var data = {
                  purchase_date:purchase_date,
                  purchase_no:purchase_no,
                  supplier_id:supplier_id,
                  category_id:category_id,
                  category_name:category_name,
                  product_id:product_id,
                  product_name:product_name
                 };
        var html = template(data);

        if (!productIds.includes(data.product_id)) {
            productIds.push(data.product_id);
            $("#addRow").append(html);
            // localStorage.setItem('productIds', JSON.stringify(productIds));
        }else{
            $.notify("Product already added",{globalPosition: 'top right',className: 'error'});
            return false;
        }


    });
     $(document).on("click",".removeeventmore",function(){
        $(this).closest(".delete_add_more_item").remove();
        totalAmountPrice();
     });
     $(document).on('keyup click','.unit_price,.buying_qty',function(){
           var unit_price = $(this).closest("tr").find("input.unit_price").val();
           var qty = $(this).closest("tr").find("input.buying_qty").val();
           var total = unit_price*qty;
           $(this).closest("tr").find("input.buying_price").val(total);
           totalAmountPrice();
     });
     function totalAmountPrice(){
        var sum = 0;
        $(".buying_price").each(function(){
            var value = $(this).val();
            if(!isNaN(value) && value.length != 0){
              sum += parseFloat(value);
            }
        });
          $('#estimated_amount').val(sum);
     }
 });
 //Supplier selected
$(function(){
   $(document).on('change','#supplier_id',function(){
      var supplier_id = $(this).val();
     // console.log( supplier_id);
      $.ajax({
         url:"{{route('get-category')}}",
         dataType:'json',
         type:"GET",
         data:{supplier_id:supplier_id},
         success:function(data){

           var html = '<option value="">Select Category</option>';

           $.each(data,function(key,v){
               html +='<option value = "'+v.category_id+'">'+v.category.category_name+'</option>';

           });
                $('#category_id').html(html);
         }
      });
   });
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
//date picker
       $('.datepicker').datepicker({
           uiLibrary: 'bootstrap4',
         });
   </script>
 @endpush
