@extends('../master')

@section('title', 'Home')
@section('prob', 'Transaction')

@section('content')

<div class="row">
    @can('view-cashin','View Cash In')
	<div class="col-md-4">
        <div class="card card-user">
            <div class="image">
                <img src="../assets/img/bg5.jpg" alt="...">
            </div>
            <div class="card-body">
                <div class="author">
                     <a href="/viewTransIn">
                    <img class="avatar border-gray" src="../assets/img/avatar.png" alt="...">
                        <h5 class="title">View Cash In</h5>
                    </a><hr>
                    <p class="description">
                        View Your All Cash In <br>Transactions
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endcan
    @can('view-cashout','View Cash Out')
    <div class="col-md-4">
        <div class="card card-user">
            <div class="image">
                <img src="../assets/img/bg5.jpg" alt="...">
            </div>
            <div class="card-body">
                <div class="author">
                     <a href="/viewTransOut">
                    <img class="avatar border-gray" src="../assets/img/avatar.png" alt="...">
                        <h5 class="title">View Cash Out</h5>
                    </a><hr>
                    <p class="description">
                        View Your All Cash Out <br>Transactions
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endcan
</div>

@endsection
@section('script')
<script type="text/javascript">
  var x = $('.a');
  x[9].className = "active";
</script>
@endsection