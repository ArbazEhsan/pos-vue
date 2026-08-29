<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Ledger | <a href="#" onClick="javascript:history.go(-1)">back</a>
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <p class="category"> Generated Ledger</p>
      </div>
      <div class="card-body table-responsive">
        <br> 
        <div id="printableArea">
        <div class="row">
          <div class="col-md-12">
            <table border="1" width="97%" align="center">
            <tr>
              <td width="28%">Print Date: <?php date_default_timezone_set("Asia/Karachi"); echo date("d/m/Y");?></td>
              <td style="text-align: center;font-size: 18px;font-weight: bold;"><i>{{ $company[0]->name }}</i><!-- <br>
                <i class="fa fa-phone" aria-hidden="true"></i> {{$company[0]->phone1}} | {{$company[0]->phone2}} -->
              </td>
              <td style="float: right;">From: <span id="to">{{$from}}</span></td>
            </tr>
            <tr>
              <td><span id="uname">{{$cust[0]->name}} | {{$cust[0]->address}}</span></td>
              <td style="text-align: center;">Account Statement</td>
              <td style="float: right;">To: {{$to}}</td>
            </tr>
            </table>
          </div>
        </div>
        <div class="">
            <form id="updateStock"><br>
              @csrf
          <table class="table table-bordered" align="center">
            <thead>
              <tr>
                <!-- <th>Sr#</th> -->
                <th>Date</th>
                <th>Type</th>
                <th>V-No</th>
                <th>Remarks</th>
                <th>Debit</th>
                <th>Credit</th>
                <th>Balance</th>
              </tr>
            </thead>
            <style type="text/css">
              h6{
                font-weight: normal;
              }
              .tdalign {
                 text-align: right;
              }
            </style>
            <tbody>
              <tr>
                <td colspan="6" class="opening-balance" align="center"><b>Opening Balance</b></td>
                <td><b>
                  {{number_format(abs($opb['bal'])).' ('.$opb['text'].')'}}
                </b>
                </td>
              </tr>
              <?php $count = $debit = $cr = $balance = $i = 0; $fromTxt=$fromTxt2=''; 
              if($from!='All' && $to!='All'){
               $balance = abs($opb['bal']);
              }?>
              @foreach($ledger as $data) 
              <?php $count++; $btext='';
                if($data->dr>0 && $data->cr=='0' || empty($data->cr)) {
                  $balance = $balance+$data->dr;
                  $btext = 'DR';
                }
                else if($data->cr>0 && $data->dr=='0' || empty($data->dr)) {
                  $balance = $balance-$data->cr;
                  $btext = 'CR';
                }
                $debit = $debit+$data->dr;
                $cr    = $cr+$data->cr;

                $invoiceNo = $invTxt = '';
                $invoiceNo = $data->invoice_id;
                $invTxt = $data->type;
                if($data->type=='CR' || $data->type=='CO'){
                  $invoiceNo = $data->id;
                }
              ?>
              <tr>
                <!-- <td>{{$count}}</td> -->
                <td>{{date('d/m/Y', strtotime($data->day))}}</td>
                <td>{{$data->type}}</td>
                <td><u onclick="popup(this.innerHTML,'<?php echo  $invTxt ?>')">{{$invoiceNo}}</u></td>
                <td>{{$remarks101[$i]}}</td>
                <td class="tdalign">{{number_format(abs($data->dr),0)}}</td>
                <td class="tdalign">{{number_format(abs($data->cr),0)}}</td>
                <td class="tdalign">{{number_format(abs($balance),0)." ".$btext}}</td>
              </tr>
              <?php $i++; ?>
              @endforeach
              <tr class="foot-value">
                <td><b></b></td>
                <td></td><td></td>
                <td class="total"><b>Total</b></td>
                <td class="dt-value tdalign"><b><?php echo number_format(abs($debit),0); ?> </b></td>
                <td class="cr-value tdalign"><b><?php echo number_format(abs($cr),0); ?></b></td>
                <td class="balance-value tdalign">
                  <?php
                    if ($source=='cust') {
                      $fromTxt = ' (Rcvble)';
                      $fromTxt2 = ' (Payable)';
                    } 
                    else {
                      $fromTxt = ' (Payable)';
                      $fromTxt2 = ' (Rcvble)';
                    }
                    if($balance<0)
                    {
                      echo "<b>".number_format(abs($balance),0).$fromTxt."</b>";
                    }
                    else 
                    {
                      echo "<b>".number_format(abs($balance),0).$fromTxt2."</b>";
                    }       
                  ?>
                </td>
              </tr>
            </tbody>
          </table>
          
          <br>
          <center><h6><span style="font-family: sans;"> Arbaz Ehsan;</span> 03137747660; arbazehsan988@gmail.com</h6></center>
        </form>
        </div>
      </div>
      <div class="row">
          <div class="col-md-2">
          <button onclick="printDiv('printableArea')" class="btn btn-info" accesskey="p"> Print </button>
          </div> 
        </div><br>
    </div>
    </div>
  </div>
</div>
</div>
  </div>
</x-app-layout>


<script type="text/javascript">

function printDiv(divName) {
  var printContents = document.getElementById(divName).innerHTML;
  var originalContents = document.body.innerHTML;
  document.body.innerHTML = printContents;
  window.print();
  document.body.innerHTML = originalContents;
}

function popup(str,source){

  if (source=='SV') {
    window.open('/salePrint/'+str,'popUpWindow','height=400,width=1000,left=50,top=50,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
  }
  else if(source=='PV'){
    window.open('/purPrint/'+str,'popUpWindow','height=400,width=1000,left=50,top=50,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
  }
  else {
    window.open('/cashPrint/'+str,'popUpWindow','height=400,width=1000,left=50,top=50,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
  }
}
</script>
