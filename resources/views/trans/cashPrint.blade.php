<style type="text/css">
  .lower{
    border-left:1px solid black;
  }
  .main td{
    font-size: 14px;
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
  }
}
</style>
<!DOCTYPE html>
<html>
<head>
  <title>Inventory</title>
</head>
<body>
  <br>
 <center>
   <h3><u>{{$company[0]->name}}</u></h3><center><i class="fa fa-phone" aria-hidden="true" style="margin-top: -10px;">  {{$company[0]->phone1}} | {{$company[0]->phone2}}</i></center>
 </center>
 
  <table class="">
   <br><br>
    <tr><td><h4>Receipt # </h4></td><td><h4>{{$invoice[0]->id}}<?php echo " | ". date("d-m-Y", strtotime($invoice[0]->day))." | ". date("h:i-a"); ?></h4></td></tr>
  </table>
  

</div>
<div class="party">
 <table style="margin-top: -20px;">
   <tr><th>Customer :</th><td>{{$invoice[0]->cust_name}}</td><th> | Address :</th><td>{{$invoice[0]->address}}</td></tr>
</table>

</div>
<br>
<center><h3 style="margin-top: -20px;"><u><em>Cash Receipt</em></u></h3></center>
<table class="main" border="1" width="100%" cellpadding="0" cellspacing="0" style="text-align: center;margin-top: -15px;">
 <tr>
   <th>Sr#</th>  
   <th>Amount Received</th>
   <th>Bill no</th>
   <th>Reference</th>
 </tr>
 <?php $counter=0; ?>
 @foreach($invoice as $data)
 <?php $counter++; ?>
 <tr>
  <td>{{$counter}}</td>
  <td>{{$data->amount}}</td>
  <td>{{$data->bill_no}}</td>
  <td>{{$data->remarks}}</td>
 </tr>
 @endforeach
</table>
<div style="width: 74%;float: right;">
  <br><br>
  <span style="float: right;">Signature:__________________</span>
</div>
 
 <div style="width: 100%;float: left;margin-top: 20px;border-top:1px solid black; ">
  <center><footer><h6>THANK YOU FOR SHOPPING WITH US.<br>&copy;<span style="font-family: sans;"> Arbaz Ehsan</span> 03137747660; arbazehsan988@gmail.com</h6></footer></center>
 </div>
</body>
</html>