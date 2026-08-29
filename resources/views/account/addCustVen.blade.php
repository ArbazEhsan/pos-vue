@extends('../master')

@section('title', 'Account Form')
@section('prob', 'Create Accounts')

@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> Create Accounts</h4>
        <p class="category"> Create Accounts here</p>
      </div>
      <div class="card-body">
        <form action="/insertCustVen" method="post">
           @csrf
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>A/C Title</label>
                        <input type="text" class="form-control" placeholder="Enter Name" name="cvname" autofocus="true" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Type</label>
                        <select class="form-control" name="type" required>
                          <option disabled selected>-- Select Type --</option>
                          <option>Asset</option>
                          <option>Capital</option>
                          <option>Customer</option>
                          <option>Expense</option>
                          <option>Liability</option>
                          <option>Vendor</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" placeholder="City" name="city">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" placeholder="Address" name="address">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Contact Person</label>
                        <input type="number" class="form-control" placeholder="Contact Person" name="contact">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Mobile</label>
                        <input type="number" class="form-control" placeholder="Mobile" name="mobile">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" placeholder="Email" name="email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Telephone No 1</label>
                        <input type="number" class="form-control" placeholder="Telephone No 1" name="tel1">
                      </div>
                    </div>
                    <!-- <div class="col-md-6">
                      <div class="form-group">
                        <label>Telephone No 2</label>
                        <input type="text" class="form-control" placeholder="Telephone No 2" name="tel2">
                      </div>
                    </div> -->
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
@endsection
@section('script')
<script type="text/javascript">
  var x = $('.a');
  x[3].className = "active";
</script>
@endsection