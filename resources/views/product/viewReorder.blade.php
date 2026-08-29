@extends('../master')

@section('title', 'Reorder')
@section('prob', 'Reorder Product')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> View Reorder Product</h4>
        <p class="category"> Here you view your all Reorder Product</p>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Sr#</th>
                <th>Barcode</th>
                <th>Name</th>
                <th>Min Qty</th>
                <th>Qty</th>
                <th>Status</th>
              </tr>
            </thead> 
            <tbody>
              <?php $count=0; ?>
              @foreach($product as $data) 
              <?php $count++; ?>
              <tr>
                <td>{{$count}}</td>
                <td>{{$data->id}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->min_qty}}</td>
                <td><span class="text-primary">{{$data->qty}}</span></td>
                <td><span class="btn btn-danger">{{'Please Update Qty'}}</span></td>
              </tr>
              @endforeach
            </tbody> 
          </table>
          <span>
            <style type="text/css">
                .w-5 {
                  display: none;
                }
                .z-0 {
                  display: none;
                }
                .leading-5 {
                  padding-left: 20px;
                  padding-top: 20px;
                }
              </style>
              {{ $product->links() }}
          </span>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
  var x = $('.a');
  x[14].className = "active";
</script>
@endsection