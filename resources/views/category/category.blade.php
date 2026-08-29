@extends('../master')

@section('title', 'Category')
@section('prob', 'Category from')

@section('content')

<div class="row">
  @can('view-cate','Category')
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> View Category</h4>
        <p class="category"> Here you view your all Category</p>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <table border="0" width="100%">
            <tr>
            @can('add-cate','Category')
            <td><input type="submit" name="add" class="btn btn-success" value="New" data-toggle="modal" data-target="#myModal">
            @endcan
            &nbsp;&nbsp;Show
            <select name="show" id="show" onchange="show(this.value)" style="font-size: 14px;">
              <option>10</option>
              <option>25</option>
              <option>50</option>
              <option>100</option>
              <option>200</option>
            </select>
            entries </td>
          <!-- <td style="text-align: right;">Search:</td> -->
          <td><input type="text" name="search" id="myInput" class="form-control" placeholder="Search By Name" autocomplete="off" autofocus="on" style="float: right; width: 50%" onkeyup="myFunction()"><span style="float: right;margin-top: 9px;">Search:&nbsp;</span></td>
        </tr>
      </table>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Sr#</th>
                <th>Name</th>
                <th>Status</th>
                <th>Operation</th>
              </tr>
            </thead> 
            <tbody id="tableData">
              <?php $count=0;?>
              @foreach($category as $data) 
              <?php $count++;  $txt="Unactive"; $txt2="Activate"; $color="badge-danger"; 
               if($data->status == 1){
                $txt = "Active";
                $txt2 = "Deactivate";
                $color="badge-success";
               }
              ?>
              <tr>
                <td>{{$count}}</td>
                <td>{{$data->name}}</td>
                <td><span class="badge badge-pill {{$color}}">{{$txt}}</span></td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Action
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="/editCategory/{{$data->id}}">Edit</a>
                      <a class="dropdown-item" href="/statusCategory/{{$data->status}}/{{$data->id}}">{{$txt2}}</a>
                      <!-- <a class="dropdown-item" href="/deleteCategory/{{$data->id}}">Delete</a> -->
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody> 
          </table>
          <span>
            <style type="text/css">
                .w-5 {
                  display: none;
                }
                .z-0 {
                  display: none;
                }
                .leading-5 {
                  padding-left: 20px;
                  padding-top: 20px;
                }
              </style>
              {{ $category->links() }}
          </span>
        </div>
      </div>
    </div>
  </div>
  @endcan
</div>
 <!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content" style="width: 100%;">
      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">Form</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body" id="modal-body">
        <form id="lockForm">
        @csrf
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" placeholder="Category Name" name="cat_name" autofocus="true" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <button class="btn btn-primary" id="sub" onclick="saveData()">Submit</button>
            </div>
          </div>
        </div>
        </form>
      </div>           
    </div>
  </div>
</div>  
<!-- Modal end -->
@endsection
@section('script')
<script type="text/javascript">
function saveData() {
  var formData = new FormData($("#lockForm")[0]);
  $.ajax({
      url: "/insertCategory",
      type: 'POST',
      data: formData,
      async: false,
      success: function (info) {
        alert(info);
        if(info==1){
          alert("Inserted Successfully");
        }
        else {
          alert("Failed: try again later");
        }
      },
      cache: false,
      contentType: false,
      processData: false
  });
}

function show(num) {
  location.href="/category/"+num;
  // $.ajax({
  //     url: "/category/"+num,
  //     type: 'GET',
  //     success: function (info) {
  //       $("#tableData").html(info);
  //     },
  //     cache: false,
  //     contentType: false,
  //     processData: false
  // });
}

function liveSearch() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("tableData");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}
</script>
@endsection
