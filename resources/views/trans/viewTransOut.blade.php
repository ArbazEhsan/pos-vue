@extends('../master')

@section('title', 'Transaction')
@section('prob', 'Transaction / View Cash Out')

@section('content')

@can('view-cashout','View Cash Out')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> View Cash Out</h4>
        <p class="category"> Here you view your all Cash Out Transaction</p>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Sr#</th>
                <th>Bill#</th>
                <th>Inv #</th>
                <th>Customer Name</th>
                <th>Remarks</th>
                <th>Day</th>
                <th>Amt</th>
                <th>Operation</th>
              </tr>
            </thead> 
            <tbody>
              <?php $count=0; ?>
              @foreach($transout as $data) 
              <?php $count++; ?>
              <tr>
                <td>{{$count}}</td>
                <td>{{$data->bill_no}}</td>
                <td onclick="printWindow(<?php echo $data->id; ?>)"><u>{{$data->id}}</u></td>
                <td>{{$data->cust_name}}</td>
                <td>{{$data->remarks}}</td>
                <td>{{date("d/m/Y", strtotime($data->day))}}</td>
                <td>{{$data->amount}}</td>
                <td>
                  <a class="btn btn-danger" href="/deleteTransOut/{{$data->id}}">Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody> 
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endcan

@endsection
@section('script')
<script type="text/javascript">
  function printWindow(info) {
    window.open('/cashPrint/'+info,'popUpWindow','height=400,width=1000,left=50,top=50,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
  }
</script>
@endsection