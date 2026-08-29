<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Add Company | <a href="/inventoryCheck">next</a>
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

@can('add-company','addcompany')
<div class="row">
  <div class="col-md-5">
    <div class="card">
      <div class="card-header">
        <p class="category"> Add your Company Details</p>
      </div>
      <div class="card-body">
        <form action="/insertCompany" method="post">
           @csrf
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Company Name" name="company_name" autofocus="true" required>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Phone</label>
                        <input type="number" class="form-control" placeholder="Phone 1" name="p_1" required>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Phone</label>
                        <input type="number" class="form-control" placeholder="Phone 2" name="p_2" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <button class="btn btn-primary" id="sub">Submit</button>
                      </div>
                    </div>
                  </div>
          </form>
      </div>
    </div>
  </div>
  <div class="col-md-7">
    <div class="card">
      <div class="card-header">
        <h4 class="category"> View Company</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Sr#</th>
                <th>Name</th>
                <th>Phone_1</th>
                <th>Phone_2</th>
                <th>Operation</th>
              </tr>
            </thead> 
            <tbody>
              <?php $count=0; ?>
              @foreach($company as $data) 
              <?php $count++; ?>
              <tr>
                <td>{{$count}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->phone1}}</td>
                <td>{{$data->phone2}}</td>
                <td>
                  <a class="btn btn-danger" href="/deleteCompany/{{$data->id}}">Delete</a>
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
</div>
  </div>
</x-app-layout>
