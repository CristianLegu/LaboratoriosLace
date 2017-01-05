<?php
	include("includes/conexion.php");
   $_SESSION['idpaciente'] = null;
?>
<html>
	<header>
		<script src="js/sweetalert.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	</header>

	<script type="text/javascript">

			swal({
  				title: "Guardado",
   				text: "Guardado con éxito.",
    			type: "success"
  			}, function(){


								window.location.href = 'menu_pacientes.php';




				}
			);
	</script>

</html>
