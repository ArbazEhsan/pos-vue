@extends('../master')

@section('title', 'Sale Return')
@section('prob', 'Sale Return')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> Sale Return</h4>
        <p class="category"> Here you create your Sale Return</p>
      </div>
      <div class="card-body">
        <div class="table-responsive">
            <form id="lockForm">
              @csrf
          <!-- First table start -->
          <table class="table">
            <tbody>
              <tr>
                <td>Entery Date: <div class="input-group"><input type="date" name="sale_day" id="sale_day" placeholder="Entery Date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required></div></td>
                <td>Bilty No: <div class="input-group"><input type="text" name="bilty_no" id="bilty_no" placeholder="Bilty No" value="{{ $result[0]->bilty_no }}" class="form-control" autofocus="true" required></div></td>
                <td>Reference: <div class="input-group"><input type="text" name="reference" id="reference" placeholder="Reference" value="{{ $result[0]->ref }}" class="form-control"></div></td>
                <td>Customer Name: <div class="input-group"><!-- <input type="text" name="cust_name" id="cust_name" list="cust_list" placeholder="-- Select --" class="form-control" autocomplete="off" required> -->
                <select name="cust_name" id="cust_name" class="form-control" required><!-- <option value="0">-- Select --</option> -->
                  <?php echo $account; ?>
                </select>
                </div><!-- <datalist id="cust_list"><?php echo $account; ?></datalist> --></td>                
              </tr>
            </tbody> 
          </table>
        </div>
        <!-- first table end -->

        <!-- Second table start -->
        <div class="table-responsive">
          <table class="table table-bordered" id="tblMain">
            <tbody>
              <tr style="background-color: #F2F2F2;">
                <td>Sr#</td>
                <td>Barcode</td>                               
                <td>Name</td>
                <td>Qty</td>                    
                <td>Price</td>
                <td>Final Amount</td>                          
                <td>Operation</td>
              </tr>
              <tbody id="item-details"></tbody>
            </tbody> 
          </table>
        </div>
        <!-- 2nd table end -->

        <div class="table-responsive">
          <table class="table">
            <tbody>
              <tr>
                <td>Gross.V: <div class="input-group"><input type="text" name="gross" id="gross" placeholder="Gross Value" class="form-control" readonly></div></td>
                <td>Inv. Disc: <div class="input-group"><input type="text" name="discount" id="discount" value="0" placeholder="Inv Discount" value="{{$result[0]->InvDiscount}}" class="form-control" required></div></td>
                <td>Inv Profit: <div class="input-group"><input type="text" name="profit" id="profit" value="0" placeholder="Inv Profit" value="{{$result[0]->InvProfit}}" class="form-control" readonly></div></td>
                <td>Final Value: <div class="input-group"><input type="text" name="final_value" id="final_value" placeholder="Final Value" value="{{$result[0]->finalVal}}" class="form-control" readonly></div></td>
                <td>Amount Received: <div class="input-group"><input type="text" name="received" id="received" placeholder="Received" value="{{$result[0]->received}}" class="form-control" required></div></td>
                <td>Remaining: <div class="input-group"><input type="text" name="remaining" id="remaining" placeholder="Remaining" value="{{$result[0]->remaining}}" class="form-control" readonly></div></td>
              </tr>
            </tbody> 
          </table>
          <button class="btn btn-primary">Submit</button>
        </form>
        </div>
        <!-- Modal start -->
        <!-- Button to Open the Modal -->
        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
          Open modal
        </button> -->

        <!-- The Modal -->
        <div class="modal fade" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content">
            
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Search Product</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              
              <!-- Modal body -->
              <div class="modal-body" id="modal-body">
                <!-- <table class="table table-bordered">
                  <tr>
                    <td colspan="3"><input type="text" name="searchP" class="form-control" placeholder="Search here..."></td>
                    <td><button class="btn btn-primary">Search</button></td>
                  </tr>
                </table> -->
                <table class="table table-bordered" style="text-align: center;">
                  <!-- <tr>
                    <td colspan="6"><input type="text" name="searchP" class="form-control" placeholder="Search here..."></td>
                    <td><button class="btn btn-primary">Search</button></td>
                  </tr> -->
                  <tr>
                    <td></td>
                    <td>Sr#</td>
                    <td>Barcode</td>
                    <td>Name</td>
                    <td>P_Price</td>
                    <td>WS_Price</td>
                    <td>R_Price</td>
                  </tr>
                  <tbody id="productData"></tbody>
                </table>
              </div>
              
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
              
            </div>
          </div>
        </div>  
        <!-- Modal end -->
      </div>
    </div>
  </div>
</div>


@endsection
@section('script')
<script type="text/javascript">
  n = 0;
  function appendRow() {
    var m = ($('#item-details tr').length-0)+1;
      n = n+1; 
      newRow = '<tr>'+  
      '<td class="no">'+ n +'</td>'+   
      '<td><div class="input-group"><div class="input-group-prepend"><div class="input-group-text searchProduct" id="searchProduct" onclick="searchProduct('+n+')"><i class="now-ui-icons ui-1_simple-add"></i></div></div><input type="text" class="form-control productcode" id="barcode'+n+'" name="barcode['+n+']" placeholder="Barcode" onchange="searchProduct2('+n+')"></div></td>'+  
      '<td><div class="input-group"><input type="text" class="form-control pname" id="productname'+n+'" name="productname['+n+']" placeholder="Name" onchange="searchProduct2('+n+')"></div></td>'+
      '<td><div class="input-group"><input type="text" class="form-control quantity" id="qty'+n+'" placeholder="Qty" onkeyup="calulateFinalAmt('+n+')"></div></td>'+  
      '<td><div class="input-group"><input type="text" class="form-control price" id="price'+n+'" placeholder="Price" onkeyup="calulateFinalAmt('+n+')"></div></td>'+    
      '<td><div class="input-group"><input type="text" class="form-control finalamt" name="final[]" id="finalamt'+n+'" placeholder="Final Amt"></div></td>'+  
      '<td><a href="#" onclick="remove('+n+')" class="btn btn-danger remove">Delete</td>'+  
      '</tr>';
      $("#item-details").append(newRow);
  }

  function appendRow2() {
    var result = JSON.parse('<?php echo $result; ?>');
    var size = Object.keys(result).length;
    for (var i=0;i<size; i++) {
      
    var m = ($('#item-details tr').length-0)+1;
      n = n+1; 
      newRow = '<tr>'+  
      '<td class="no">'+ n +'</td>'+   
      '<td><div class="input-group"><div class="input-group-prepend"><div class="input-group-text searchProduct" id="searchProduct" onclick="searchProduct('+n+')"><i class="now-ui-icons ui-1_simple-add"></i></div></div><input type="text" class="form-control productcode" id="barcode'+n+'" name="barcode['+n+']" placeholder="Barcode" onchange="searchProduct2('+n+')" value="'+result[i].barcode+'"></div></td>'+  
      '<td><div class="input-group"><input type="text" class="form-control pname" id="productname'+n+'" name="productname['+n+']" placeholder="Name" onchange="searchProduct2('+n+')" value="'+result[i].name+'"></div></td>'+
      '<td><div class="input-group"><input type="text" class="form-control quantity" id="qty'+n+'" placeholder="Qty" onkeyup="calulateFinalAmt('+n+')" value="'+result[i].qty+'"></div></td>'+  
      '<td><div class="input-group"><input type="text" class="form-control price" id="price'+n+'" placeholder="Price" onkeyup="calulateFinalAmt('+n+')" value="'+result[i].price+'"></div></td>'+    
      '<td><div class="input-group"><input type="text" class="form-control finalamt" name="final[]" id="finalamt'+n+'" placeholder="Final Amt" value="'+result[i].final+'"></div></td>'+  
      '<td><a href="#" onclick="remove('+n+')" class="btn btn-danger remove">Delete</td>'+  
      '</tr>';
      $("#item-details").append(newRow);
    }
      appendRow();
  }

  function calulateFinalAmt(row) {
    var qty = $('#qty'+row).val();
    var price = $('#price'+row).val(); 
    var x = Number(qty)*Number(price);
    $('#finalamt'+row).val(x);
  };

  $(document).ready(function (argument) {
    appendRow2();
  });

  function searchProduct(rowNum) {
    var txt=txt2='';
    txt = '0';
    txt2 = 'all';
    var from='p1';
    searchFunction(txt,txt2,rowNum,from);
  }

  function searchProduct2(rowNum) {
    var txt=txt2='';
    var from='p2';
    txt = $('#barcode'+rowNum).val();
    txt2 = '';
    if (txt=='') {
      txt='0';
    }
    if (txt2=='') {
      txt2='all';
    }
    searchFunction(txt,txt2,rowNum,from);
  }

  function searchFunction(txt,txt2,rowNum,from) {
    $.ajax({
      type: "GET",
      url:"/searchProduct/"+txt+"/"+txt2+"/"+rowNum,
      success:function(response) {
        if (from=='p1') {
          $('#productData').html(response);
          $('#myModal').modal('toggle');
        }
        if (from=='p2') {
          var display = response;
          display = display.split(',');
          // $('#id'+rowNum).val(display[0]);
          $('#barcode'+rowNum).val(display[1]);
          $('#productname'+rowNum).val(display[2]);
          $('#price'+rowNum).val(display[3]);
          var n = ($('#item-details tr').length-0);
          var blatest = $('#barcode'+n).val();
          var nlatest = $('#productname'+n).val();
          var platest = $('#price'+n).val();
          if(blatest!='' && nlatest!='' && platest!=''){
            appendRow();
          }
        }         
      },
      error: function (error) {
        //alert('Data Not Updated');
        console.log(error);
        //nowuiDashboard.showNotification('top','center','danger',error);
      }
    });
  }

  function addFromModal(id,rowNum){
    $.ajax({
        type: "GET",
        url:"/getDetail/"+id,
        success:function(response) {
          var display = response;
          display = display.split(',');
          // $('#id'+rowNum).val(display[0]);
          $('#barcode'+rowNum).val(display[1]);
          $('#productname'+rowNum).val(display[2]);
          $('#price'+rowNum).val(display[3]);
          var n = ($('#item-details tr').length-0);
          var blatest = $('#barcode'+n).val();
          var nlatest = $('#productname'+n).val();
          var platest = $('#price'+n).val();
          if(blatest!='' && nlatest!='' && platest!=''){
            appendRow();
          }
        },
        error: function (error) {
          //alert('Data Not Updated');
          nowuiDashboard.showNotification('top','center','danger',error);
        }
    });
  }

  $('body').delegate('.remove','click',function() {  
    $(this).parent().parent().remove();
  });

  $('#gross').focus(function (argument) {
    var gross = 0;
    $("#item-details tr").each(function() {
      var g = $(this).find('.finalamt').val();
      gross = Number(g) + Number(gross);
    });
    $('#gross').val(gross);
  });

  $('#discount').keyup(function (argument) {
    var gross = $('#gross').val();
    var d = $('#discount').val();
    var x = gross-d;
    $('#final_value').val(x);
  });

  $('#received').keyup(function (argument) {
    var fvl = $('#final_value').val();
    var rcvd = $('#received').val();
    var x = fvl-rcvd;
    $('#remaining').val(x);
  });

  var productCode = new Array();
  var qty = new Array();
  var price = new Array();
  var finalAmt = new Array();
  $(document).ready(function (argument) {
    $('#lockForm').on('submit',function (e) {
      e.preventDefault();
      $("#item-details tr").each(function() {
        var a = $(this).find('.productcode').val();
        var b = $(this).find('.quantity').val();
        var c = $(this).find('.price').val();
        var d = $(this).find('.finalamt').val();
        if (a!='' && b!='' && c!='' && d!='') {
          productCode.push(a);
          qty.push(b);
          price.push(c);
          finalAmt.push(d);
        }
      });
      var e = JSON.stringify(productCode);
      var f = JSON.stringify(qty);
      var g = JSON.stringify(price);
      var h = JSON.stringify(finalAmt);
      $.ajax({
        type: "POST",
        url:"/saveInvoice/"+e+"/"+f+"/"+g+"/"+h+"/saleReturn",
        data: $('#lockForm').serialize(),
        success:function(info){
          //alert(info);
          //console.log(info);
          window.open('/salePrint/'+info,'popUpWindow','height=400,width=1000,left=50,top=50,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
          location.reload();
        },
        error: function (error) {
          //console.log(error);
          //alert('Data Not Updated');
          nowuiDashboard.showNotification('top','center','danger',error);
        }
      });
    });
  });
</script>
@endsection