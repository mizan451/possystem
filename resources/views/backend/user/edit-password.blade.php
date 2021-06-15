@extends('backend.layouts.app')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Register') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="{{route('users.view')}}" class="btn btn-block btn-success btn-lg"><i class="fa fa-list"></i> User List</a>
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
                    <form method="POST" action="{{route('profile.password.update')}}" id="myForm">
                        @csrf
                  <div class="form-group col-md-8">
                    <label for="current_password">Current Password</label>
                    <input type="password" name="current_password" class="form-control"  placeholder="Enter Name" required>
                  </div>

                   <div class="form-group col-md-8">
                    <label for="new_password">New Password</label>
                    <input type="password" name="new_password" class="form-control"  placeholder="Enter password_confirmation" id="new_password" required>
                  </div>

                  <div class="form-group col-md-8">
                    <label for="again_new_password">Again Password</label>
                    <input type="password" name="again_new_password" class="form-control"  placeholder="Enter password_confirmation" id="again_new_password" required>
                  </div>
                  
                      <input type="submit" value="Update" class="btn btn-primary">
                          
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
      current_password: {
        required: true,
      },
      new_password: {
        required: true,
      },
      again_new_password: {
        required: true,
        equalTo : '#new_password'
      },
    },
    messages: {
      current_password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },

      new_password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      again_new_password: {
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