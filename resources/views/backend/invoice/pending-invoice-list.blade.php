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
                    <th>Status</th>
                    <th width="12%">Action</th>
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
                       <td>
                          @if($invoice->status=='0')
                            <span style="background-color: red">Pending</span>
                          @elseif($invoice->status=='1')
                            <span style="background-color: green">Approved</span>
                          @endif
                        </td>
                        <td>
                           @if($invoice->status=='0')
                           <a title="approve"  title="approve" class="btn btn-sm btn-success" href="{{route('invoice.approve', $invoice->id)}}"><i class="fa fa-check-circle"></i></a>
                           <a title="delete" href="{{route('invoice.delete', $invoice->id)}}" title="DELETE" class="btn btn-sm btn-success"><i class="fa fa-trash"></i></a>
                           @endif
                        </td>
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
