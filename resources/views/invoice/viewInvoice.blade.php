@extends('../master')

@section('title', 'Home')
@section('prob', 'All Invoice')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> View {{$from}} Invoice</h4>
        <p class="category"> Here you view your all {{$from}} Invoice</p>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <form id="lockForm">
            <input type="Number" name="searchInv" id="searchInv" class="form-control" placeholder="Search Invoice#" required>
            <button class="btn btn-primary" id="search">Search</button>
            </form>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Day</th>
                <th>Invoice_No</th>      
                <th>Reference</th>
                <th>Operation</th>
              </tr>
            </thead> 
            <tbody id="item-detail">
              <?php $count=0; ?>
              @foreach($invoice as $data) 
              <?php $count++; ?>
              <tr>
                <td>{{date("d-M-y", strtotime($data->day))}}</td>
                <td><u>{{$data->id}}</u></td>
                <td>{{$data->ref}}</td>
                <td><a class="btn btn-primary" href="/{{$url}}/{{$data->id}}">Print</a> <!-- <a class="btn btn-info" href="/{{$url2}}/{{$data->id}}">Return</a> --></td>
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
              {{ $invoice->links() }}
          </span>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
  $('#search').on('click', function (e) {
    
    id = $('#searchInv').val();
    if (id!='') {
      e.preventDefault();
      $.ajax({
        type: "GET",
        url:"/getSInvoice",
        data: $('#lockForm').serialize(),
        success:function(response) {
          //alert(response);
          //console.log(response);
          $('#item-detail').html(response);
        },
        error: function (error) {
          console.log(error);
          //alert(error);
          //nowuiDashboard.showNotification('top','center','danger',error);
        }
      });
    }
  });
  
  
  var from = '<?php echo $from ?>';
  var x = $('.a');
  if(from == 'Sale'){
    x[6].className = "active";
  }
  else{
    x[13].className = "active";
  }
</script>
@endsection