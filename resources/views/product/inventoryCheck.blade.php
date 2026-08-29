@extends('../master')

@section('title', 'Inventory')
@section('prob', 'Check Point')

@section('content')
@can('view-post','Admin')
<div class="row">
  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <center><h4><i class="now-ui-icons location_bookmark"></i><a href="/category/10"><br>Category</a></h4></center>
      </div>
    </div>
  </div>
  <!-- <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <center><h4><i class="now-ui-icons shopping_box"></i><br><a href="/addProduct">Add Stock</a></h4></center>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <center><h4><i class="now-ui-icons shopping_box"></i><a href="/viewProduct"><br>View Stock</a></h4></center>
      </div>
    </div>
  </div> -->
  @can('add-pro','Add Product')
  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <center><h4><i class="now-ui-icons shopping_tag-content"></i><a href="/addProduct"><br>Add Product</a></h4></center>
      </div>
    </div>
  </div>
  @endcan
  @can('view-pro','View Product')
  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <center><h4><i class="now-ui-icons shopping_tag-content"></i><a href="/viewProduct"><br>View Product</a></h4></center>
      </div>
    </div>
  </div>
  @endcan
  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <center><h4><i class="now-ui-icons shopping_tag-content"></i><a href="/viewBarcode"><br>Print Label</a></h4></center>
      </div>
    </div>
  </div>
</div>
@endcan


@endsection
@section('script')
<script type="text/javascript">
  var x = $('.a');
  x[0].className = "active";
</script>
@endsection
