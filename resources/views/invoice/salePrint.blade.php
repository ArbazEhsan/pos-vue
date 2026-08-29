<!DOCTYPE html>
<html>
<head>
  <title>Inventory</title>
  <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">

  <style type="text/css">
    .headerCenter {
      text-align: center;
    }
    .headerCenterItem {
      font-weight: bolder;
      font-size: 25px;
    }
    .headerCenterPhone {
      font-size: 13px;
    }
    .mainTable {
      border-bottom: 1px solid black; 
      border-top: 1px solid black;
      text-align: left;
    }
    .mainTable2 {
      border-bottom: 1px solid black; 
      border-top: 1px solid black;
      text-align: right;
    }
    .mainTableTd {
      text-align: right;
    }
    body {
      font-family: sans-serif;
    }
    .dateStyle {
      margin-left: 28px;
      font-size: 15px;
      font-weight: bold;
    }
    .dateStyle2 {
      margin-left: 18px;
      font-size: 15px;
      font-weight: bold;
    }
    .branding {
      font-size: 11px;
    }
  </style>
</head>
<body onload="window.print()">
  <!-- header start -->
 <table align="center" border="0">
   <tr>
     <td class="headerCenter">
      <img src="{{asset('assets/img/msm-logo.png')}}" width="100" style="margin-bottom: -10px;">
     </td>
   </tr>
   <tr>
     <td class="headerCenter headerCenterItem">{{$company[0]->name}}</td>
   </tr>
   <tr>
     <td class="headerCenter headerCenterPhone"><i>{{$company[0]->phone1}} | {{$company[0]->phone2}}</i></td>
   </tr>
 </table>
 <!-- header end -->

  <table width="100%" style="border-top: 1px solid black;">
    <tr>
      <td class="headerCenterPhone">
        Date: <span class="dateStyle">{{date('d-M-Y', strtotime($invoice[0]->day))}}</span>
      </td>
      <td  class="headerCenterPhone" style="text-align:right">Time: <?php $time = explode(' ',$invoice[0]->time); echo $time[1];?></td>
    </tr>
    <tr>
        <td  class="headerCenterPhone">Bill No: <span class="dateStyle2">{{$invoice[0]->sale_no}}</span></td>
        <td  class="headerCenterPhone" style="text-align:right">Salesman: {{$invoice[0]->user}}</td>
    </tr>
    
  </table>
  

 <table>
   <tr><td class="headerCenterPhone">Customer: {{$invoice[0]->cust_name}}</td></tr>
</table>

<!-- <center><h3 style="margin-top: -20px;"><u><em>Sale INVOICE</em></u></h3></center> -->
<table class="main" border="0" width="100%" cellpadding="0" cellspacing="0" style="font-size: 14px;">
 <tr>
   <th class="mainTable">Sr#</th>
   <th class="mainTable">Product Name</th>
   <th class="mainTable2">Rate</th>
   <th class="mainTable2">Qty</th>  
   <th class="mainTable2">Amount</th>
 </tr>
 <?php $gross=$counter=0; ?>
 @foreach($invoice as $data)
 <?php $gross=$gross+$data->final;$counter++; ?>
 <tr>
  <td>{{$counter}}</td>
  <td>{{$data->name}}</td>
  <td class="mainTableTd">{{$data->price}}</td>
  <td class="mainTableTd">{{$data->qty}}</td>
  <td class="mainTableTd">{{$data->final}}</td>
 </tr>
 @endforeach
 <tr>
   <td style="border-top: 1px solid black;" colspan="5"></td>
 </tr>
</table><!-- <br> -->
<!-- <div style="width: 100%;float: left;"> -->
<table width="100%" cellpadding="0" border="0" cellspacing="0" style="font-size: 13px;margin-top: 6px;">
  <tr>
    <td>Total items: {{$counter}}</td>
    <td class="mainTableTd">Total Amount: </td>
    <td class="mainTableTd">{{$gross}}</td>
  </tr>
  <tr>
    <td></td>
    <td class="mainTableTd">Discount:</td>
    <td class="mainTableTd">{{$data->InvDiscount}}</td>
  </tr>
  <tr>
    <td></td>
    <td class="mainTableTd">Net Bill:</td>
    <td class="mainTableTd" style="border-bottom: 2px solid black;font-weight: bolder;font-size: 15px;">{{$data->finalVal}}</td>
  </tr>
  <tr>
    <td></td>
    <td class="mainTableTd">Total Recieved:</td>
    <td class="mainTableTd" style="border-bottom: 2px solid black;font-weight: bolder;">{{$data->received}}</td>
  </tr>
  <tr>
    <td></td>
    <td class="mainTableTd">Remaining:</td>
    <td class="mainTableTd">{{$data->remaining}}</td>
  </tr>
</table>
<!-- </div> -->
<!-- <div style="width: 74%;float: right;">
  <br><br>
  <span style="float: right;">Signature:__________________</span>
</div> -->
  <div>
   <p class='headerCenterPhone' id="words"></p></div>
 <div style="margin-top: -10px;border-top:1px solid black; ">
  <div style="margin-top: -5px;">
  <p class="headerCenterPhone">TERMS & CONDITIONS</p>
  <ol class="headerCenterPhone" style="margin-left: -24px;margin-top: -10px;">
    <li>
      Check Cash and ensure quality & quantity before leaving.
    </li>
    <li>
      Damage Products are non Returnable.
    </li>
    <li>
      Return with Invoice.
    </li>
  </ol>
  <p class="headerCenterPhone">This is computer generated slip, stamp & signature not required</p>
  </div>
  <center>
    <footer class="branding">
      THANK YOU FOR SHOPPING WITH US.<br>Developer: &copy; Arbaz Ehsan 03137747660; arbazehsan988@gmail.com
    </footer>
  </center>
 </div>

</body>
</html>

<script type="text/javascript">
  var a = ['','ONE ','TWO ','THREE ','FOUR ', 'FIVE ','SIX ','SEVEN ','EIGHT ','NINE ','TEN ','ELEVEN ','TWELVE ','THIRTEEN ','FOURTEEN ','FIFTEEN ','SIXTEEN ','SEVENTEEN ','EIGHTEEN ','NINETEEN '];
  var b = ['', '', 'TWENTY','THIRTY','FORTY','FIFTY', 'SIXTY','SEVENTY','EIGHTY','NINETY'];

  function inWords (num) {
      if ((num = num.toString()).length > 9) return 'overflow';
      n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
      if (!n) return; var str = '';
      str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'CRORE ' : '';
      str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'LAKH ' : '';
      str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'THOUSAND ' : '';
      str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'HUNDRED ' : '';
      str += (n[5] != 0) ? ((str != '') ? 'AND ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + '' : '';
      return str;
  }

  var num = "<?php echo $data->finalVal; ?>";
  document.getElementById('words').innerHTML = "RUPESS "+inWords(num)+"ONLY";
</script>