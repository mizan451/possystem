@extends('backend.layouts.app')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Category') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="{{route('users.view')}}" class="btn btn-block btn-success btn-lg"><i class="fa fa-list"></i> Category List</a>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  <!-- Main content -->
   
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-body">
                    <form method="POST" action="{{ route('categories.update',$editData->id ) }}" id="myForm">
                        @csrf

                  <div class="form-group col-md-8">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control"  value="{{$editData->name}}" required>
                  </div>

                  
                    <input type="submit" value="Submit" class="btn btn-primary">
                          
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
            


<script type="text/javascript">
jQuery(document).ready(function () {
  jQuery('#myForm').validate({
    rules: {

      
      name: {
        required: true,
        name: true,
      }
      
    },
    messages: {

      usertype: {
        required: "Please enter a usertype",
        usertype: "Please enter a vaild usertype"
      },
      name: {
        required: "Please enter a Name",
        name: "Please enter a Name"
      },
      email: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      password2: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
@endsection