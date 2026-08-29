@extends('../master')

@section('title', 'Countsheet')
@section('prob', 'Countsheet')

@section('content')
@can('view-count','Countsheet')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> Update Qty</h4>
        <p class="category"> Here you update your Qty</p>
      </div>
      <div class="card-body">
        <form id="searchForm">
        @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Search</label>
              <input type="text" class="form-control" placeholder="Product Name" id="pname" name="pname" autocomplete="off" autofocus="on">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Product Name</label>
              <select id="plist" class="form-control" name="plist"></select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <button class="btn btn-primary" id="sub">Search or All</button>
            </div>
          </div>
        </div>
        <div class="row pull-right">
            <div class="col-md-12">
              <div class="form-group">
                <select onchange="Filter(this.value)" class="form-control" id="filter">
                  <option disabled selected>Filter</option>
                  <option value="product">Product Only</option>
                  <option value="stock">Stock Only</option>
                </select>
              </div>
            </div>
        </div></form>
        <div class="table-responsive"><hr>
            <form id="updateStock">
              @csrf
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Sr#</th>
                <th>Barcode</th>
                <th>Name</th>
                <th>Purchase</th>
                <th>Qty</th>
              </tr>
            </thead>
            <tbody id="stock">
              <?php $count=0; ?>
              @foreach($product as $value)
              <?php $count++; ?>
              <tr>
                <td>{{$count}}</td>
                <td>{{$value->barcode}}</td>
                <td>{{$value->name}}</td>
                <td>{{$value->purchase}}</td>
                <td>{{$value->qty}}</td>
              </tr>
              @endforeach
            </tbody> 
          </table><hr>
          <button class="btn btn-primary">Update</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endcan
@endsection
@section('script')
<script type="text/javascript">
  $(document).ready(function (argument) {
    $('#searchForm').on('submit',function (e) {
    e.preventDefault();
      $("#filter").prop('selectedIndex',0);
      $.ajax({
        type: "POST",
        url:"/searchProductFor",
        data: $('#searchForm').serialize(),
        success:function(response)
        {
          $('#stock').html(response);
        },
        error: function (error) {
          //console.log(error);
          //alert('Data Not Updated');
          nowuiDashboard.showNotification('top','center','danger',error);
        }
      });
    });
  });

  function Filter(filter) {
    $.ajax({
      type: "GET",
      url:"/searchProductByFilter/"+filter,
      data: "none",
      success:function(response){
        $('#stock').html(response);
      },
      error: function (error) {
        //console.log(error);
        //alert('Data Not Updated');
        nowuiDashboard.showNotification('top','center','danger',error);
      }
    });
  }

  $(document).ready(function (argument) {
    $('#pname').on('blur',function (e) {
    e.preventDefault();
    var name = $('#pname').val();
      $.ajax({
        type: "GET",
        url:"/searchProduct/"+name,
        success:function(response)
        {
          $('#plist').html(response);
        },
        error: function (error) {
          console.log(error);
          //alert('Data Not Updated');
          // nowuiDashboard.showNotification('top','center','danger',error);
        }
      });
    });
  });

  $(document).ready(function (argument) {
    $('#updateStock').on('submit',function (e) {
    e.preventDefault();
      $.ajax({
        type: "POST",
        url:"/updateProductQty",
        data: $('#updateStock').serialize(),
        success:function(response)
        {
          //alert(response);
          //$('#stock').html(response);
          nowuiDashboard.showNotification('top','center','primary',response);
        },
        error: function (error) {
          console.log(error);
          //alert('Data Not Updated');
          nowuiDashboard.showNotification('top','center','danger',error);
        }
      });
    });
  });

  var x = $('.a');
  x[1].className = "active";
</script>
@endsection