<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Report | <a href="#" onClick="javascript:history.go(-1)">back</a>
        </h2>
    </x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

<style type="text/css">
  h6{
    font-weight: normal;
  }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <p class="category"> Profit & Loss Report</p>
      </div>
      <div class="card-body table-responsive">
        <form id="lockForm">
        <div class="row">
            
            <div class="col-md-3">
                <label>From Date *</label>
                <input type="date" class="form-control" name="startdate" id="startdate" required><br>
            </div>
            <div class="col-md-3">
                    <label>To Date *</label>
                <input type="date" class="form-control" name="enddate"
                id="enddate" required><br>
            </div>
            
        </div>
        </form>
        <div class="row">
            <div class="col-md-4">
                <button class="btn btn-primary" name="btn" onclick="pal()">Generate Report</button>
            </div>
        </div><br><br>
        <div id="printableArea">
        <div class="row">
        <table border="1" width="97%" align="center">
        <tr>
          <td width="28%">Print Date: <?php date_default_timezone_set("Asia/Karachi"); echo date("d/m/Y");?></td>
          <td style="text-align: center;font-size: 18px;font-weight: bold;"><i>{{ $company[0] }}</i>
          </td>
          <td style="float: right;">From: <span id="from"><?php echo date("d/m/Y"); ?></span></td>
        </tr>
        <tr>
          <td><span id="uname">{{$uname}}</span></td>
          <td style="text-align: center;">Profit & Loss Report</td>
          <td style="float: right;">To: <span id="to"></span></td>
        </tr>
      </table>
        </div>
        <div class="">
            <form id="updateStock"><br>
          <table class="table-bordered" width="100%" cellpadding="10">
            <thead>
              <tr style="background: green;color: white;">
                <th>Particulars</th>
                <th>Qty</th>
                <th>Amount (Rs.)</th>
              </tr>
            </thead>
            <tbody id="stock"></tbody>
          </table>
          <!-- <center><h6><span style="font-family: sans;"> Arbaz Ehsan;</span> 03137747660; arbazehsan988@gmail.com</h6></center> -->
        </form>
        </div>
        </div><br>
        <button onclick="printDiv('printableArea')" class="btn btn-info" accesskey="p"> Print </button>
      </div>
    </div>
  </div>
</div>

    </div>
</div>
</x-app-layout>


<script type="text/javascript">
function pal(){
  var startdate = $('#startdate').val();
  var enddate = $('#enddate').val();
  if (startdate=='') {
    alert("Please Select Dates!");
  }
  else if(enddate==''){
    alert("Please Select Dates!");
  }
  else {
    $.ajax({
        type: "GET",
        url:"/getpalReport",
        data: $('#lockForm').serialize(),
        success:function(response) {
          //alert(response);
          $('#stock').html(response);
        },
        error: function (error) {
          console.log(error);
          alert(error);
          //nowuiDashboard.showNotification('top','center','danger',error);
        }
    });
  }
}

function printDiv(divName) {
  var printContents = document.getElementById(divName).innerHTML;
  var originalContents = document.body.innerHTML;
  document.body.innerHTML = printContents;
  window.print();
  document.body.innerHTML = originalContents;
}

function popup(str,from){
  window.open('/salePrint/'+str,'popUpWindow','height=400,width=1000,left=50,top=50,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
}
</script>
