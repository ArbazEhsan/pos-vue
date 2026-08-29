@extends('../master')

@section('title', 'Trans')
@section('prob', 'Cash Out from')

@section('content')

@can('add-cashin','Cash Out')
<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> Add Cash Out</h4>
        <p class="category"> Add your Cash Out here</p>
      </div>
      <div class="card-body">
        <form action="/insertTransOut" method="post">
           @csrf
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Date</label>
                        <input type="date" class="form-control" name="day" value="<?php echo date('Y-m-d'); ?>" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Choose Vendor</label>
                          <select class="form-control" id="exampleFormControlSelect1" name="cust_id">
                            <option>-- Select --</option>
                            <?php echo $vendor; ?>
                          </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Amount</label>
                        <input type="number" class="form-control" placeholder="Amount" name="amount" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Remarks</label>
                        <input type="text" class="form-control" placeholder="Enter Remarks" name="remarks">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Bill No</label>
                        <input type="number" class="form-control" placeholder="Enter Bill No" name="bill_no">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <button class="btn btn-primary btn-block" id="sub">Submit</button>
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
  var x = $('.a');
  x[8].className = "active";
</script>
@endsection