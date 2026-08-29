@extends('../master')

@section('title', 'Home')
@section('prob', 'Create Accounts')

@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> Update Accounts</h4>
        <p class="category"> Update your Accounts here</p>
      </div>
      <div class="card-body">
        <form name="myform" action="/updateCustVen" method="post">
           @csrf
           <input type="hidden" name="id" value="{{$custven[0]->id}}">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Enter Name" name="cvname" value="{{$custven[0]->name}}" autofocus="true" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Type</label>
                        <select class="form-control" name="type">
                          <?php echo $type; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" placeholder="City" name="city" value="{{$custven[0]->city}}">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" placeholder="Address" name="address" value="{{$custven[0]->address}}">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Contact Person</label>
                        <input type="text" class="form-control" placeholder="Contact Person" name="contact" value="{{$custven[0]->contact_person}}">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Mobile</label>
                        <input type="text" class="form-control" placeholder="Mobile" name="mobile" value="{{$custven[0]->mobile}}">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" placeholder="Email" name="email" value="{{$custven[0]->email}}">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Telephone No 1</label>
                        <input type="text" class="form-control" placeholder="Telephone No 1" value="{{$custven[0]->tel_1}}" name="tel1">
                      </div>
                    </div>
                    <div class="col-md-6">
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

