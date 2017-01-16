<?php
	//session_start();
	//if($_SESSION['ver3'] == null){
	//	include("includes/error_nologin.php");
	//}
	//$ver=$_SESSION['ver3'];
	if(isset($_GET['idpac']) && isset($_GET['idpr']) && isset($_GET['idm'])){
        $idpac  = $_GET['idpac'];
        $idprop = $_GET['idpr'];
        $idm = $_GET['idm'];
     
    }
	$membrete = "php/pdf/reporte.php?idpac=".urlencode(base64_encode($idpac))."&idpr=".urlencode(base64_encode($idprop))."&idm=".urlencode(base64_encode($idm))."&memb=".urlencode(base64_encode('true'));
	//$membrete= '&memb='.urlencode(base64_encode('true'));
	$nomemb = "php/pdf/reporte.php?idpac=".urlencode(base64_encode($idpac))."&idpr=".urlencode(base64_encode($idprop))."&idm=".urlencode(base64_encode($idm))."&memb=".urlencode(base64_encode('false'));
	//$nomemb = '&memb='.urlencode(base64_encode('false'));
	
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
