@extends('../master')

@section('title', 'Ledger')
@section('prob', 'Ledger')

@section('content')

<div class="row">
	<div class="col-md-4">
        <div class="card card-user">
            <div class="image">
                <img src="../assets/img/bg5.jpg" alt="...">
            </div>
            <div class="card-body">
                <div class="author">
                     <a href="/viewCustLedger">
                    <img class="avatar border-gray" src="../assets/img/avatar.png" alt="...">
                        <h5 class="title">View Customer Ledger</h5>
                    </a><hr>
                    <p class="description">
                        View Your All Customer Ledger
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-user">
            <div class="image">
                <img src="../assets/img/bg5.jpg" alt="...">
            </div>
            <div class="card-body">
                <div class="author">
                     <a href="/viewVenLedger">
                    <img class="avatar border-gray" src="../assets/img/avatar.png" alt="...">
                        <h5 class="title">View Vendor Ledger</h5>
                    </a><hr>
                    <p class="description">
                        View Your All Vendor Ledger
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
  var x = $('.a');
  x[10].className = "active";
</script>
@endsection