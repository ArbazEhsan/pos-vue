@extends('../master')

@section('title', 'Home')
@section('prob', 'User')

@section('content')

<div class="row">
	<div class="col-md-4">
        <div class="card card-user">
            <div class="image">
                <img src="../assets/img/bg5.jpg" alt="...">
            </div>
            <div class="card-body">
                <div class="author">
                    <img class="avatar border-gray" src="../assets/img/avatar.png" alt="...">
                        <h5 class="title">{{$result[0]->name}} ({{$result[0]->type}})</h5>
                    <hr>
                    <p class="title">
                        {{$result[0]->email}}
                    </p>
                    <p>@can('view-post',$result[0]->type)
                        <a href="/viewUserForm">Create User</a>
                    </p>@endcan
                </div>
            </div>
        </div>
    </div>
</div>
@can('view-post',$result[0]->type)
<div class="row">
    <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> View Employee</h4>
        <h4 class="category"> Here you can View Employee</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Sr#</th>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Type</th>
                <th>Operation</th>
              </tr>
            </thead> 
            <tbody>
            <?php $count=0; ?>
              @foreach($result2 as $data) 
              <?php $count++; ?>
              <tr>
                <td>{{$count}}</td>
                <td>{{$data->id}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->email}}</td>
                <td>{{$data->account_type}}</td>
                <td>
                  <a class="btn btn-danger" href="/deleteUser/{{$data->id}}">Delete</a>
                  <a class="btn btn-info" href="/userRights/{{$data->id}}/{{$data->name}}">Permissions</a>
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
@endcan
@endsection