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
            <h1 class="m-0 text-dark">Product Management</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">home</a></li>
              <li class="breadcrumb-item active">product</li>
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
                <h3>Add Product
                  <a class="btn btn-success btn-sm float-right" href="{{route('products.index')}}"><i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;Product List</a>
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <form  method="post" action="{{route('products.store')}}"  id="myForm" enctype="multipart/form-data">
                  @csrf
                    <div class="row">
                      <div class="form-group col-md-6">
                          <label for="supp_com_name">Supplier</label>
                          <select name="supplier_id" class="form-control required">
                            <option value="">Select Supplier</option>
                            @foreach($supplier_info as $k => $supplier)
                            <option value="{{$supplier->id}}">{{$supplier->company_name}}</option>
                            @endforeach
                          </select>
                          <font style="color:#e60000">
                              {{($errors->has('supplier_id'))?($errors->first('supplier_id')):' '}}
                          </font>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="category">Category</label>
                          <select name="category_id" class="form-control required">
                            <option value="">Select Category</option>
                            @foreach($category_info as $k => $category)
                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                          </select>
                          <font style="color:#e60000">
                              {{($errors->has('category_id'))?($errors->first('category_id')):' '}}
                          </font>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="unit">Unit</label>
                          <select name="unit_id" class="form-control required">
                            <option value="">Select Unit</option>
                            @foreach($unit_info as $k => $unit)
                            <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
                            @endforeach
                          </select>
                          <font style="color:#e60000">
                            {{($errors->has('unit_id'))?($errors->first('unit_id')):' '}}
                          </font>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="product_name">Product Name</label>
                           <input type="text" name="product_name" class="form-control" placeholder="Please enter product name" >
                           <font style="color:#e60000">
                                {{($errors->has('product_name'))?($errors->first('product_name')):' '}}
                           </font>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="image">Image</label>
                           <input type="file" name="image" id="image" class="form-control">
                        </div>
                        <div class="form-group col-md-6" style="padding: 30px;">
                           <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                        </div>
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

 @endpush
