@extends('../master')

@section('title', 'Ledger')
@section('prob', 'Ledger / vendor')

@section('content')

<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> Generate Vendor Ledger</h4>
        <p class="category"> Generate your Vendor Ledger here</p>
      </div>
      <div class="card-body">
        <form action="/Ledger" method="post">
           @csrf
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>From</label>
                        <input type="date" class="form-control" name="from">
                        <input type="hidden" name="source" value="ven">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>To</label>
                        <input type="date" class="form-control" name="to" >
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

@endsection
