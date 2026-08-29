@extends('../master')

@section('title', 'Home')
@section('prob', 'Update Category from')

@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title"> Update Category</h4>
        <p class="category"> Update your Category here</p>
      </div>
      <div class="card-body">
        <form name="myform" action="/updateCategory" method="post">
           @csrf
           <input type="hidden" name="id" value="{{$category[0]->id}}">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Category Name" name="cat_name" value="{{$category[0]->name}}" autofocus="true" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <button class="btn btn-primary" id="sub">Update</button>
                      </div>
                    </div>
                  </div>
          </form> 
      </div>
    </div>
  </div>
</div>
@endsection

