@extends('../master')

@section('title', 'Stock')
@section('prob', 'Strock Opening')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> Update Stock</h4>
        <p class="category"> Here you update your Stock</p>
      </div>
      <div class="card-body">
        <form id="searchForm">
        @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Barcode</label>
              <input type="number" class="form-control" placeholder="Product Barcode" id="barcode" name="barcode">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Product Name</label>
              <input type="text" class="form-control" placeholder="Product Name" id="pname" name="pname">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <button class="btn btn-primary" id="sub">Search or All</button>
            </div>
          </div>
        </div></form><br><br><br>
        <div class="table-responsive">
            <form id="updateStock">
              @csrf
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Sr#</th>
                <th>Barcode</th>
                <th>Name</th>
                <th>Qty</th>
              </tr>
            </thead>
            <tbody id="stock"></tbody> 
          </table><hr>
          <button class="btn btn-primary">Update</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
  $(document).ready(function (argument) {
    $('#searchForm').on('submit',function (e) {
    e.preventDefault();

      $.ajax({
        type: "POST",
        url:"/searchStockOpening",
        data: $('#searchForm').serialize(),
        success:function(response)
        {
          //alert(response);
          $('#stock').html(response);
        },
        error: function (error) {
          //console.log(error);
          //alert('Data Not Searched');
          nowuiDashboard.showNotification('top','center','danger',error);
        }
      });
    });
  });

  $(document).ready(function (argument) {
    $('#updateStock').on('submit',function (e) {
    e.preventDefault();

      $.ajax({
        type: "POST",
        url:"/updateStockOpening",
        data: $('#updateStock').serialize(),
        success:function(response)
        {
          //alert(response);
          //$('#stock').html(response);
          nowuiDashboard.showNotification('top','center','primary',response);
        },
        error: function (error) {
          //console.log(error);
          //alert('Data Not Updated');
          nowuiDashboard.showNotification('top','center','danger',response);
        }
      });
    });
  });
</script>
@endsection