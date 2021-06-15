@extends('backend.layouts.app')

@section('content') 
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
       <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="{{route('stock.report.pdf')}}" terget="_blank" class="btn btn-block btn-success btn-lg"><i class="fa fa-download"></i> Download Pdf</a>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with minimal features & hover style</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                     <th>SL</th>
                    <th>Suplier Name</th>
                    <th>Category</th>
                    <th>Product Name</th>
                    <th>In.Qty</th>
                    <th>Out.Qty</th>
                    <th>Stock</th>
                    <th>Unit</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($allData as $key=>$product)
                    @php
                      $buying_total = App\Model\Purchase::where('category_id', $product->category_id)->where('product_id', $product->id)->where('status', '1')->sum('buying_qty');

                      $selling_total = App\Model\InvoiceDetail::where('category_id', $product->category_id)->where('status', '1')->sum('selling_qty');
                    @endphp
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$product['Category']['name']}}</td>
                    <td>{{$product['Suplier']['name']}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$buying_total}}</td>
                    <td>{{$selling_total}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{$product['Unit']['name']}}</td>
                  </tr>
                @endforeach
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  @endsection('content') 