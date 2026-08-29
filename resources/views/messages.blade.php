@if(count($errors) > 0)
	@foreach($errors->all as $error)
		<div class="alert alert-danger">
			{{$error}}
		</div>
	@endforeach
@endif

@if(session('success'))
	<script type="text/javascript">
		$(document).ready(function (argument) {
			nowuiDashboard.showNotification('top','center','primary','{{session('success')}}');
		});
	</script>
@endif

@if(session('error'))
	<script type="text/javascript">
		$(document).ready(function (argument) {
			nowuiDashboard.showNotification('top','center','danger','{{session('error')}}');
		});
	</script>
@endif

