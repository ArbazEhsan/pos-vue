@extends('../master')

@section('title', 'Home')
@section('prob', 'Product from')

@section('content')

@can('add-pro','Add Product')
<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> Add Product</h4>
        <p class="category"> Add your Product here</p>
      </div>
      <div class="card-body">
        <form action="/insertProduct" method="post">
           @csrf
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Product Name" name="pname" autofocus="true" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Short Code</label>
                        <input type="number" class="form-control" placeholder="Short Code" name="barcode" id="barcode" onblur="checkCode(this.value)" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Select Category</label>
                          <select class="form-control" id="exampleFormControlSelect1" name="cat_id">
                            <option>-- Select --</option>
                            <?php echo $category; ?>
                          </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Enter Purchase Price</label>
                        <input type="number" class="form-control" placeholder="Purchase Price" name="pp" value="0" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Enter Whole Sale Price</label>
                        <input type="number" class="form-control" placeholder="Whole Sale" name="ws" value="0" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Enter Retail Price</label>
                        <input type="number" class="form-control" placeholder="Retail Price" name="rp" value="0" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Minimum Qty</label>
                        <input type="number" class="form-control" placeholder="Min qty" name="mq" required>
                      </div>
                    </div>
                    <!-- <div class="col-md-12"></div> -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <button class="btn btn-primary" id="sub">Submit</button>
                      </div>
                    </div>
                  </div>
          </form>
      </div>
    </div>
  </div>
</div>
@endcan

@endsection
@section('script')
<script type="text/javascript">
  function checkCode(code) {
    $.ajax({
      type: "GET",
      url:"/checkCode/"+code,
      success:function(response) {
        //console.log(response); 
        if(response != 0) {
          alert(response);  
          $('#barcode').val(''); 
        }
      },
      error: function (error) {
        //alert('Data Not Updated');
        console.log(error);
        //nowuiDashboard.showNotification('top','center','danger',error);
      }
    });
  }
</script>
@endsection