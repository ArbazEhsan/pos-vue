@extends('../master')

@section('title', 'Barcode')
@section('prob', 'Generate Barcode')

@section('content')

<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> Generate Barcode</h4>
        <p class="category"> Generate Barcode here</p>
      </div>
      <div class="card-body">
        <form action="/createBarcode" method="post">
           @csrf
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Name</label>
                        <select class="form-control" name="pname" required>
                        <?php echo $result; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Number of Print</label>
                        <input type="Number" class="form-control" name="nprint" placeholder="Number of Print" required>
                      </div>
                    </div>
                    <div class="col-md-12">
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
