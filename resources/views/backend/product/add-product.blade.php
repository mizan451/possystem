@extends('backend.layouts.app')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Products') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="{{route('users.view')}}" class="btn btn-block btn-success btn-lg"><i class="fa fa-list"></i> Products List</a>
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
                    <form method="POST" action="{{ route('products.store') }}" id="myForm">
                        @csrf

                    <div class="form-group col-md-8">
                      <label for="suplier_id">Suplier Name</label>
                        <select name="suplier_id" class="form-control" required>
                          <option value="">Select Suplier</option>
                         
                          @foreach ($supliers as $suplier)
                          <option value="{{$suplier->id}}">{{$suplier->name}}</option>
                            
                          @endforeach
                        </select>  
                    </div>

                    <div class="form-group col-md-8">
                      <label for="unit_id">Unit </label>
                        <select id="unit_id" name="unit_id" class="form-control" required>
                          <option value="">Select Unit</option>
                          @foreach($units as $unit)
                            <option value="{{$unit->id}}">{{$unit->name}}</option>
                          @endforeach
                        </select>  
                    </div>

                    <div class="form-group col-md-8">
                      <label for="category_id">Category </label>
                        <select id="category_id" name="category_id" class="form-control" required>
                          <option value="">Select Category</option>
                          @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                          @endforeach
                        </select>  
                    </div>

                  <div class="form-group col-md-8">
                    <label for="name">Product Name</label>
                    <input type="text" name="name" id="name" class="form-control"  placeholder="Enter Name" required>
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
      },
      suplier_id: {
        required: true,
        suplier_id: true,
      },
      unit_id: {
        required: true,
      },
      category_id: {
        required: true,
      },
      
    },
    messages: {
      name: {
        required: "Please enter a Name",
        name: "Please enter a Name"
      },
      suplier_id: {
        required: "Please enter a Suplier address",
        email: "Please enter a vaild email address"
      },
      unit_id: {
        required: "Please provide a Unit",
        minlength: "Your unite must be at least 5 characters long"
      },
       category_id: {
        required: "Please provide a Unit",
        minlength: "Your unite must be at least 5 characters long"
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