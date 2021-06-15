@extends('backend.layouts.app')

@section('content')
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
              <a href="" class="btn btn-block btn-success btn-lg"><i class="fa fa-add"></i>Add User</a>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  <!-- Main content -->
    <section class="col-md-4 offset-md-4">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
             
             <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img id="showImage" class="profile-user-img img-fluid img-circle" src="/upload/{{$user->image}}"
                   alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{$user->name}}</h3>

                <p class="text-muted text-center">Software Engineer</p>

                <table width="100%" class="table table-bordered" >
                  <tbody>
                    <tr>
                      <td>Mobile No</td>
                      <td>{{$user->mobile}}</td>
                    </tr>
                    <tr>
                      <td>Address</td>
                      <td>{{$user->address}}</td>
                    </tr>
                    <tr>
                      <td>Email</td>
                      <td>{{$user->email}}</td>
                    </tr>
                    <tr>
                      <td>Gender</td>
                      <td>{{$user->gender}}</td>
                    </tr>
                  </tbody>
                </table>

                <a href="{{route('profile.edit')}}" class="btn btn-primary btn-block"><b>Edit</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
             
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
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection