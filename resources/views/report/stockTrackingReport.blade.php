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
        <p class="category"> Stock Tracking Report</p>
      </div>
      <div class="card-body table-responsive">
        <form id="lockForm">
        <div class="row">
            <div class="col-md-3">
                <label>From Date</label>
                <input type="date" name="startdate" class="form-control">
            </div>
            <div class="col-md-3">
                <label>To Date</label>
                <input type="date" name="enddate" class="form-control">
            </div>
        </div><br>
        </form>
        <div class="row">
            <div class="col-md-4">
                <button class="btn btn-primary" name="btn" onclick="getTrack()">Generate Report</button>
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
          <td style="text-align: center;">Stock Tracking Report</td>
          <td style="float: right;">To: <span id="to"></span></td>
        </tr>
      </table>
        </div>
        <div class="">
            <form id="updateStock"><br>
              
          <table class="table-striped" width="100%">
            <thead>
              <tr>
                <th style="border:1px solid black; border-right: none;border-left: none;">Date</th>
                <th style="border:1px solid black; border-right: none;border-left: none;">Title of A/C</th>
                <th style="border:1px solid black; border-right: none;border-left: none;">Product</th>
                <th style="border:1px solid black; border-right: none;border-left: none;">Qty</th>
              </tr>
            </thead>
            <tbody id="stock">
              @foreach($product as $data)
              <tr>
                <td>{{ date('d/m/Y', strtotime($data->day)) }}</td>
                <td>{{ $data->u_name }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->qty }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <br>
          <h6 style="border:1px solid black; border-right: none;border-left: none;border-bottom: none;margin-bottom: 5px;"></h6>
          <!-- <center><h6 style="border:1px solid black; border-right: none;border-left: none;border-bottom: none;padding-top: 10px;"><span style="font-family: sans;"> Arbaz Ehsan;</span> 03137747660; arbazehsan988@gmail.com</h6></center> -->
        </form>
        </div>
        </div>
        <button onclick="printDiv('printableArea')" class="btn btn-info"> Print </button>
        <span>
            <style type="text/css">
                .w-5 {
                  display: block;
                }
                .z-0 {
                  display: block;
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
</div>
</x-app-layout>


<script type="text/javascript">
function getTrack(){
    $.ajax({
        type: "GET",
        url:"/getStockTrackReport",
        data: $('#lockForm').serialize(),
        success:function(response) {
          //alert(response);
          var display = response;
          display = display.split(',');
          $('#stock').html(display[0]);
          $('#uname').html(display[1]);
          $('#to').html(display[3]);

          if(display[2] !=""){
            $('#from').html(display[2]);
          }
          
        },
        error: function (error) {
          console.log(error);
          //alert(error);
          //nowuiDashboard.showNotification('top','center','danger',error);
        }
    });
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
