@extends('../master')

@section('title', 'Home')
@section('prob', 'View Accounts')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> View Accounts</h4>
        <p class="category"> Here you view your all Accounts</p>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <!-- <th>Sr#</th> -->
                <th>Type</th>
                <th>A/C#</th>
                <th>A/C Title</th>
                <th>City</th>
                <th>Address</th>
                <th>Contact.Per</th>
                <th>Mobile</th>
                <!-- <th>Tel1</th> -->
                <!-- <th>Tel2</th> -->
                <th>Status</th>
                <th>Operation</th>
              </tr>
            </thead> 
            <tbody>
              <?php $count=0; ?>
              @foreach($cust as $data) 
              <?php $count++; $txt="Unactive"; $txt2="Activate"; $color="badge-danger";
              if (empty($data->tel_1)) {
                $text1 = 'N/A';
              } else {
                $text1 = $data->tel_1;
              } 
              if (empty($data->tel_2)) {
                $text2 = 'N/A';
              } else {
                $text2 = $data->tel_2;
              }
              if($data->status == 1){
                $txt = "Active";
                $txt2 = "Deactivate";
                $color="badge-success";
               }
               ?>
              <tr>
                <!-- <td>{{$count}}</td> -->
                <td style="color: red;">{{$data->type}}</td>
                <td>{{$data->id}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->city}}</td>
                <td>{{$data->address}}</td>
                <td>{{$data->contact_person}}</td>
                <td>{{$data->mobile}}</td>
                <!-- <td>{{$text1}}</td> -->
                <!-- <td>{{$text2}}</td> -->
                <!-- <td>{{$data->type}}</td> -->
                <td><span class="badge badge-pill {{$color}}">{{$txt}}</span></td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Action
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="/editCustVen/{{$data->id}}">Edit</a>
                      <a class="dropdown-item" href="/statusCust/{{$data->status}}/{{$data->id}}">{{$txt2}}</a>
                      <!-- <a class="dropdown-item" href="/deleteCustVen/{{$data->id}}">Delete</a> -->
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody> 
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection