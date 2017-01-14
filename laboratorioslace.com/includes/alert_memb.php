<?php
	session_start();
	if($_SESSION['ver2'] == null){
		include("includes/error_nologin.php");
	}
	$ver=$_SESSION['ver2'];
	$membrete= $ver.'&memb=true';
	$nomemb = $ver.'&memb=false';
	
?>
<html>
	<header>
		<script src="js/sweetalert.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	</header>

	<script type="text/javascript">

			swal({
				title: "Membrete",
				text: "¿Desea que el reporte tenga membrete?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#94BE2A",
				confirmButtonText: "SI",
				cancelButtonText: "NO",
				closeOnConfirm: false,
				closeOnCancel: false
				}, function(isConfirm){
				  if (isConfirm){
				  window.location.href = '<?php echo $membrete; ?>';
			  } 
			  else{
			  		window.location.href = '<?php echo $nomemb; ?>';
			  }
				}
			);
	</script>

</html>
