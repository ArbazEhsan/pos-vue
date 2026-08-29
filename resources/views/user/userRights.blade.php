@can('view-userrights','userrights')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          User Rights | <a href="#" onClick="javascript:history.go(-1)">back</a>
        </h2>
        <span>
          ID#: {{$uid}}, Title: {{$name}}
        </span>
    </x-slot>
<style type="text/css">
  .th-width {
    width: 40%;
  }
  .th-display {
    visibility: hidden;
  }
</style>


<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <form id="lockForm">
            <h4 class="category">Pages</h4>
            <input type="hidden" name="userID" value="{{$uid}}">
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <?php 
                  $pages = array('Category','Add Product','View Product','Bulk Price Editing','Countsheet','Sale Voucher','Purchase Voucher','Cash In','Cash Out','View Cash In','View Cash Out');
                  for ($i=0;$i<count($pages);$i++) {
                    $none=$ve=$add=$admin='';
                    if($i==1 || $i==5 || $i==6 || $i==7 || $i==8){
                      $ve='th-display';
                    }
                    if($i==2 || $i==3 || $i==4 || $i==9 || $i==10){
                      $add='th-display';
                    }
                    if($i!=0){
                      $admin='th-display';
                    }
                  ?>
                  <tr>
                    <th class="th-width"><?php echo $pages[$i]; ?></th>
                    <th class="<?php echo $none; ?>"><input type="checkbox" name="pagenone[]" id="pagenone<?php echo $i; ?>" class="pagenone" value="<?php echo $pages[$i]; ?>/none"> None</th>
                    <th></th>
                    <th class="<?php echo $ve; ?>"><input type="checkbox" name="pageve[]" id="pageve<?php echo $i; ?>" class="pageve" value="<?php echo $pages[$i]; ?>/ve"> View & Edit</th>
                    <th class="<?php echo $add; ?>"><input type="checkbox" name="pageadd[]" id="pageadd<?php echo $i; ?>" class="pageadd" value="<?php echo $pages[$i]; ?>/add"> Add</th>
                    <th class="<?php echo $admin; ?>"><input type="checkbox" name="pageadmin[]" id="pageadmin<?php echo $i; ?>" class="pageadmin" value="<?php echo $pages[$i]; ?>/admin"> Admin</th>
                  </tr>
                  <?php } ?>
                </thead>
              </table>
              </form>
              <button class="btn btn-primary" onclick="save()">Save</button>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
</div>

</x-app-layout>
<script type="text/javascript">
  $('body').delegate('.pagenone','click', function() 
  {
    var tr=$(this).parent().parent();
    tr.find('.pageve').prop("checked", false);
    tr.find('.pageadd').prop("checked", false);
    tr.find('.pageadmin').prop("checked", false);
  })
  $('body').delegate('.pageve','click', function() 
  {
    var tr=$(this).parent().parent();
    tr.find('.pagenone').prop("checked", false);
    tr.find('.pageadd').prop("checked", false);
    tr.find('.pageadmin').prop("checked", false);
  })
  $('body').delegate('.pageadd','click', function() 
  {
    var tr=$(this).parent().parent();
    tr.find('.pagenone').prop("checked", false);
    tr.find('.pageve').prop("checked", false);
    tr.find('.pageadmin').prop("checked", false);
  })
  $('body').delegate('.pageadmin','click', function() 
  {
    var tr=$(this).parent().parent();
    tr.find('.pagenone').prop("checked", false);
    tr.find('.pageadd').prop("checked", false);
    tr.find('.pageve').prop("checked", false);
  })

  result = JSON.parse('<?php echo $result ?>');
  size = Object.keys(result).length;
  var jspages = <?php echo json_encode($pages); ?>;
  for (var i=0;i<size;i++) {
    for (var j=0;j<11;j++) {
      if (result[i].pages==jspages[j]) {
        if (result[i].permission=='none') {
          $('#pagenone'+j).prop("checked", true);
          break;
        }
        if (result[i].permission=='ve') {
          $('#pageve'+j).prop("checked", true);
          break;
        }
        if (result[i].permission=='add') {
          $('#pageadd'+j).prop("checked", true);
          break;
        }
        if (result[i].permission=='admin') {
          $('#pageadmin'+j).prop("checked", true);
          break;
        }
      }
    }
  }

  function save() {
    $.ajax({
        type: "GET",
        url:"/saveUserRights",
        data: $('#lockForm').serialize(),
        success:function(response) {
          alert(response);
        },
        error: function (error) {
          console.log(error);
          //alert(error);
          nowuiDashboard.showNotification('top','center','danger',error);
        }
    });
  }
</script>
@endcan