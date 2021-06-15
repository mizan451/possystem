@extends('backend.layouts.app')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('Add Invoice') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="{{route('invoice.view')}}" class="btn btn-block btn-success btn-lg"><i class="fa fa-list"></i> Invoice List</a>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  <!-- Main content -->


   <form method="GET" action="{{route('invoice.daily.report.pdf')}}" tergate="_blank" id="myForm">
      <div class="form-row">
          <div class="form-group col-md-2">
            <label>Date</label>
            <input type="text" name="date" id="date"  class="form-control datepicker" placeholder="YYYY-MM-DD" readonly="">
          </div>
          <div class="form-group col-md-2">
            <label>Date</label>
            <input type="text" name="end_date" id="end_date"  class="form-control datepicker1" placeholder="YYYY-MM-DD" readonly="">
          </div>

          <div class="form-group col-md-2">
           <button type="submit">Submit</button>>
          </div>
      </div>
   </form>

<script>
  $('.datepicker').datepicker({
    uiLibrary: 'bootstrap4',
    format:'yyyy-mm-dd'
  });
</script>
<script>
  $('.datepicker1').datepicker({
    uiLibrary: 'bootstrap4',
    format:'yyyy-mm-dd'
  });
</script>

@endsection

