<style type="text/css">
  .lower{
    border-left:1px solid black;
  }
  .main td{
    font-size: 18px;
    /*letter-spacing: 2px;*/
  }
  .header1{
    width: 60%;
    float: left;
    height: 30px;
    color: white;
  }
  .header1 td{
    text-align: right;
    color: white;
  }
  .header2{
    width: 37%;
    float: left;
    font-weight: bold;
    text-align: right;
    color: white;
  }
  .header2 hr{
    margin-top: 9px;
  }
  @media (max-width: 600px){
  .main td{
    font-size: 12px;
    letter-spacing: 2px;
  }
}
</style>
<!DOCTYPE html>
<html>
<head>
  <title>Inventory</title>
</head>
<body onload="window.print()">
  <br>
 <center>
   <h3><u>{{$company[0]->name}}</u></h3><center><i class="fa fa-phone" aria-hidden="true" style="margin-top: -10px;">  {{$company[0]->phone1}} | {{$company[0]->phone2}}</i></center>
 </center>
 
  <table class="" width="100%">
   <br><br>
    <tr>
        <td><h4>Order No: {{$invoice[0]->pur_no}}</h4></td>
        <td style="text-align:right"><h6><i>Print Date: <?php date_default_timezone_set("Asia/Karachi"); echo date("d-M-y");?></i></h6></td>
    </tr>
    
  </table>
  

</div>
<div class="party">
 <table style="margin-top: -20px;">
   <tr><th>Customer :</th><td>{{$invoice[0]->cust_name}}</td>
    <th> | Address :</th><td>{{$invoice[0]->address}}</td></tr>
</table>

</div>
<br>
<center><h3 style="margin-top: -20px;"><u><em>Purchase Invoice</em></u></h3></center>
<table class="main" border="1" width="100%" cellpadding="0" cellspacing="0" style="text-align: center;margin-top: -15px;">
 <tr>
   <th>Sr#</th>
   <th>Product Name</th>
   <th>Qty</th>
   <th>price</th>  
   <th>Final</th>
 </tr>
 <?php $gross=$counter=0; ?>
 @foreach($invoice as $data)
 <?php $gross=+$data->final;$counter++; ?>
 <tr>
  <td>{{$counter}}</td>
  <td>{{$data->name}}</td>
  <td>{{$data->qty}}</td>
  <td>{{$data->price}}</td>
  <td>{{$data->final}}</td>
 </tr>
 @endforeach
</table><br>
<div style="width: 25%;float: left;">
<table width="100%" cellpadding="0" border="0" cellspacing="0" style="" >
  <tr>
  <td>Gross Amount: </td><td>{{$gross}}</td>
  </tr>
  <tr>
  <td>Disc:<td>{{$data->InvDiscount}}</td>
</tr>
<tr>
  <td>Final Amount:<td>{{$data->finalVal}}</td>
</tr>

  <tr><td>Advance:</td><td>{{$data->received}}</td>
  </tr>
  <tr>
    <td>Remaining:</td><td>{{$data->remaining}}</td>
    
  </tr>
</table>
</div>
<div style="width: 74%;float: right;">
  <br><br>
  <span style="float: right;">Signature:__________________</span>
</div>
 
 <div style="width: 100%;float: left;margin-top: 20px;border-top:1px solid black; ">
  <center><footer><h6>THANK YOU FOR SHOPPING WITH US.<br>&copy;<span style="font-family: sans;"> Arbaz Ehsan</span> 03137747660; arbazehsan988@gmail.com</h6></footer></center>
 </div>
</body>
</html>