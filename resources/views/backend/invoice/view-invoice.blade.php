@extends('backend.layouts.app')

@section('content') 
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
       <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="{{route('invoice.add')}}" class="btn btn-block btn-success btn-lg"><i class="fa fa-add"></i>Add Invoice</a>
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
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover table-responsive">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Customer Name</th>
                    <th>Invoice No</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Amount</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($allData as $key => $invoice)
                     <tr>
                       <td>{{$key+1}}</td>
                       <td>{{$invoice['payment'] ['customer']['name']}}-{{$invoice['payment'] ['customer']['mobile_no']}}-{{$invoice['payment'] ['customer']['address']}}</td>
                       <td>Invoice No #{{$invoice->invoice_no}}</td>
                       <td>{{date('d-m-Y',strtotime($invoice->date))}}</td>
                       <td>{{$invoice->description}}</td>
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