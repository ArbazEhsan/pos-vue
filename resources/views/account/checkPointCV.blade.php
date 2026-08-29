@extends('../master')

@section('title', 'Customer/Vendor')
@section('prob', 'Check Point')

@section('content')
<div class="row">
  <div class="col-md-2">
    <div class="card">
      <div class="card-body">
        <center><h4><i class="now-ui-icons users_single-02"></i><a href="/viewCustomer">Customer</a></h4></center>
      </div>
    </div>
  </div>

  <div class="col-md-2">
    <div class="card">
      <div class="card-body">
        <center><h4><i class="now-ui-icons users_single-02"></i><a href="/viewVendor"><br>Vendor</a></h4></center>
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
  var x = $('.a');
  x[4].className = "active";
</script>
@endsection
