<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <style type="text/css">
    h6, h5, h4, h3, h2, h1 {
      font-weight: normal;
    }
  </style>
</head>
<body>
  <div class="row">
    <div class="col-md-12">
      <table align="center">
        <tr>
          <td>
             <center><h3><u>{{$company[0]->name}}</u></h3><i class="fa fa-phone" aria-hidden="true" style="margin-top: -10px;">  {{$company[0]->phone1}} | {{$company[0]->phone2}}</i></center>
          </td>
        </tr>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <table>
        <tr>
          <tr>
            <td><h4>Bill #: </h4></td>
            <td><h4>{{$trans[0]->bill_no}} | {{date('d-m-Y', strtotime($trans[0]->day))}}</h4></td>
          </tr>
        </tr>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <center><h4><u><em>{{$from}} Receipt</em></u></h4></center>
    </div>
  </div><br>
  <div class="row">
    <div class="col-md-12">
      <table class="main" border="1" width="100%" cellpadding="0" cellspacing="0" style="text-align: center;margin-top: -20px;">
        <tr>
          <th>Sr#</th>  
          <th>Amount Received</th>
          <th>Received By</th>
        </tr>
        <?php $count=0; ?>
        @foreach($trans as $data)
        <?php $count++; ?>
        <tr>
          <td>{{$count}}</td>
          <td>{{$data->amount}}</td>
          <td>{{$account}}</td>
        </tr>
        @endforeach
      </table><br>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <table>
        <tr>
          <td>Signature:________________</td>
        </tr>
      </table>
    </div>
  </div>
<hr>
 <center><footer><h6>THANK YOU FOR SHOPPING WITH US.<br>&copy; Developed By Arbaz Ehsan</h6></footer></center>
</body>
</html>