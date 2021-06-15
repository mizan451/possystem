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
              <a href="{{route('units.add')}}" class="btn btn-block btn-success btn-lg"><i class="fa fa-add"></i>Add Units</a>
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
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                     <th>SL</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($allData as $key=>$suplier)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$suplier->name}}</td>

                    @php
                       $count_suplier = App\Model\Product::where('unit_id', $suplier->id)->count();
                    @endphp
                      <td>
                       <a href="{{route('units.edit', $suplier->id)}}" title="EDIT" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>

                    @if($count_suplier<1)
                       <a id="delete" href="{{route('units.delete', $suplier->id)}}" title="DELETE" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>

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
