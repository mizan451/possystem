@extends('backend.layouts.app')

@section('content') 
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
       <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pending Purchase List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!--<a href="{{route('purchase.add')}}" class="btn btn-block btn-success btn-lg"><i class="fa fa-add"></i>Add Purchase</a>-->
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
                    <th>Purchase No</th>
                    <th>Date</th>
                    <th>Suplier Name</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Buying Price</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($allData as $key=>$Purchase)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$Purchase->purchase_no }}</td>
                    <td>{{date('d-m-Y', strtotime($Purchase->date))}}</td>
                    <td>{{$Purchase['Suplier']['name']}}</td>
                    <td>{{$Purchase['Product']['name']}}</td>
                    <td>{{$Purchase['Category']['name']}}</td>
                    <td>{{$Purchase->description }}</td>
                    <td>{{$Purchase->buying_qty }}
                        {{$Purchase['Product']['unit']['name']}}</td>
                    <td>{{$Purchase->unit_price }}</td>
                    <td>{{$Purchase->buying_price }}</td>
                    <td>
                      @if($Purchase->status=='0')
                      <span style="background-color: red">Pending</span>
                      @elseif($Purchase->status=='1')
                      <span style="background-color: green">Approved</span>
                      @endif
                    </td>

                    <td>
                       @if($Purchase->status=='0')
                       <a title="approve" id="approveBtn" href="{{route('purchase.approve', $Purchase->id)}}" title="DELETE" class="btn btn-sm btn-success"><i class="fa fa-check-circle"></i></a>
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