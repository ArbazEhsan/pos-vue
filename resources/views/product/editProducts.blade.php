@extends('../master')

@section('title', 'Home')
@section('prob', 'Update Stock from')

@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> Update Stock</h4>
        <p class="category"> Update your Stock here</p>
      </div>
      <div class="card-body">
        <form name="myform" action="/updateProduct" method="post">
           @csrf
           <input type="hidden" name="id" value="{{$product[0]->id}}">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Product Name" name="pname" value="{{$product[0]->name}}" autofocus="true" required>
                      </div>
                    </div>
                    <!--<div class="col-md-6">-->
                    <!--  <div class="form-group">-->
                    <!--    <label>Short Code</label>-->
                        <input type="hidden" class="form-control" placeholder="Short Code" name="barcode" id="barcode" value="{{$product[0]->barcode}}" onblur="checkCode(this.value)">
                    <!--  </div>-->
                    <!--</div>-->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Select Category</label>
                          <select class="form-control" id="exampleFormControlSelect1" name="cat_id">
                            <?php echo $cat; ?>
                          </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Enter Purchase Price</label>
                        <input type="number" class="form-control" placeholder="Purchase Price" name="pp" value="{{$product[0]->purchase}}" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Enter Whole Sale Price</label>
                        <input type="number" class="form-control" placeholder="Whole Sale" name="ws" value="{{$product[0]->whole_sale}}" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Enter Retail Price</label>
                        <input type="number" class="form-control" placeholder="Retail Price" name="rp" value="{{$product[0]->retail}}" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Minimum Qty</label>
                        <input type="number" class="form-control" placeholder="Min qty" name="mq" value="{{$product[0]->min_qty}}" required>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <button class="btn btn-primary" id="sub">Update</button>
                      </div>
                    </div>
                  </div>
          </form> 
      </div>
    </div>
  </div>
</div>
@endsection

