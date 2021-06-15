@extends('backend.layouts.app')

@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
       <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Paid Customer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="{{route('customers.credit.pdf')}}" class="btn btn-block btn-success btn-lg" terget="_blank"><i class="fa fa-add"></i>Download PDF</a>
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
                    <th>Customer Name</th>
                    <th>Invoice No</th>
                    <th>Date</th>
                    <th>Ammount</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                       $total_paid = '0';
                    @endphp
                    @foreach($allData as $key=>$payment)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$payment['customer']['name']}}
                        {{$payment['customer']['mobile_no']}}-{{$payment['customer']['address']}}
                    </td>
                    <td>Invoice No #{{$payment['invoice']['invoice_no']}}</td>
                    <td>{{date('d-m-Y',strtotime($payment['invoice']['date']))}}</td>
                    <td>{{$payment->paid_amount}}</td>
                      <td>
                       <a href="{{route('customers.edit.invoice', $payment->invoice_id)}}" title="EDIT" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                       <a href="{{route('invoice.details.pdf', $payment->invoice_id)}}" title="EDIT" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                     </td>
                     <td>
                       @php
                         $total_paid += $payment->paid_amount;
                       @endphp
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
