<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<style type="text/css">
	.td {
		margin-left: 163px;
	} 
	body {
		margin-left: 30px;
		margin-right: 30px;
		margin-top: 25px;
	}
	@media (max-width: 600px){
	   /*.td{
	    height: 70px;
	    margin-left: 350px;
		}*/
	}	
</style>
<body>
<div style="border: 1px solid white;">
	<span><?php echo $result; ?></span>
	<span class="td"><?php echo $result; ?></span>
	<span class="td"><?php echo $result; ?></span>
	<span class="td"><?php echo $result; ?></span>
</div>
<?php $n = $n-1; ?>
@for ($i=0;$i<$n;$i++)
<div style="border: 1px solid white;margin-top: 25px;">
	<span><?php echo $result; ?></span>
	<span class="td"><?php echo $result; ?></span>
	<span class="td"><?php echo $result; ?></span>
	<span class="td"><?php echo $result; ?></span>
</div>
@endfor
</body>
</html>