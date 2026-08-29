@extends('../master')

@section('title', 'Home')
@section('prob', 'All Stock')

@section('content')

@can('view-post','Admin')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> View Stock</h4>
        <p class="category"> Here you view your all Stock</p>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Sr#</th>
                <th>Barcode</th>
                <th>Name</th>
                <th>Cat</th>
                <th>Min Qty</th>
                <th>Qty</th>
                <th>Status</th>
              </tr>
            </thead> 
            <tbody>
              <?php $count=0;?>
              @foreach($product as $data) 
              <?php $count++;  $txt="Unactive"; $txt2="Activate"; $color="badge-danger"; 
                if($data->status == 1){
                  $txt = "Active";
                  $txt2 = "Deactivate";
                  $color="badge-success";
                 }
              ?>
              <tr>
                <td>{{$count}}</td>
                <td>{{$data->barcode}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->cat_name}}</td>
                <td>{{$data->min_qty}}</td>
                <td>{{$data->qty}}</td>
                <td><span class="badge badge-pill {{$color}}">{{$txt}}</span></td>
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
@endcan
@endsection
@section('script')
<script type="text/javascript">
  var x = $('.a');
  x[11].className = "active";
</script>
@endsection