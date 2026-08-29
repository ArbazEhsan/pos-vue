@extends('../master')

@section('title', 'Home')
@section('prob', 'Product Form')

@section('content')

@can('view-pro','View Product')
<div class="row">
  <div class="col-md-12 ">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> View Product</h4>
        <p class="category"> Here you view your all Product</p>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <table border="0" width="100%">
            <tr>
            @can('add-cate','Category')
            <td><input type="submit" name="add" class="btn btn-success" value="New" data-toggle="modal" data-target="#myModal">
            @endcan
            &nbsp;&nbsp;Show
            <select name="show" id="show" onchange="show(this.value)" style="font-size: 14px;">
              <option>10</option>
              <option>25</option>
              <option>50</option>
              <option>100</option>
              <option>200</option>
            </select>
            entries </td>
          <!-- <td style="text-align: right;">Search:</td> -->
          <td><input type="text" name="search" id="myInput" class="form-control" placeholder="Search By Name" autocomplete="off" autofocus="on" style="float: right; width: 50%" onkeyup="liveSearch()"><span style="float: right;margin-top: 9px;">Search:&nbsp;</span></td>
        </tr>
      </table>
          </div>
        </div>        
        <div class="table-responsive"><hr>
          <table class="table table-hover" id="productData">
            <thead>
              <tr>
                <th>Sr#</th>
                <th>Barcode</th>
                <th>Name</th>
                <th>Cat</th>
                <th>P.P</th>
                <th>W.S</th>
                <th>R.P</th>
                <th>Min Qty</th>
                <th>Qty</th>
                <th>Status</th>
                <th>Operation</th>
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
                <td>{{$data->purchase}}</td>
                <td>{{$data->whole_sale}}</td>
                <td>{{$data->retail}}</td>
                <td>{{$data->min_qty}}</td>
                <td>{{$data->qty}}</td>
                <td><span class="badge badge-pill {{$color}}">{{$txt}}</span></td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Action
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="/editProduct/{{$data->id}}">Edit</a>
                      <a class="dropdown-item" href="/statusProduct/{{$data->status}}/{{$data->id}}">{{$txt2}}</a>
                      <!-- <a class="dropdown-item" href="/deleteProduct/{{$data->id}}">Delete</a> -->
                    </div>
                  </div>
                </td>
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
  function liveSearch() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("productData");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}

</script>
@endsection