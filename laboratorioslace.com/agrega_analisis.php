<?php
include("includes/conexion.php");
 $mysqli = mysqli_connect($host, $user, $pwd, $db);





  $idpropio           =  $_POST["idpropio"];


$idpaciente = 0;

  $linkmenu  = "menu.php?V=".urlencode(base64_encode('variable')); 


if ($idpropio == 0) {
      $sql    = "SELECT idpropio FROM analisis order by idpropio desc";
      $query  = mysqli_query($mysqli, $sql);
      $fila   = mysqli_fetch_array($query, MYSQLI_ASSOC);
      if($fila == null) {
        $idpropio = 1;
      }
      else{
         $idpropio = $fila['idpropio'] + 1;
      }
  
       $fecha         =  date("Y") . date("m") . date("d") ;
       $area          = $_POST["area"];
       $pacientes_idpacientes = $_POST["idpaciente"];
       $medicos_idmedicos = $_POST["idmedico"];
       $number        = count($_POST["pruebas"]);


      if ($medicos_idmedicos != null || $medicos_idmedicos != "") {
        //echo "ID MEDICOS dentro de if ".$medicos_idmedicos;
      }
      else{
        include('includes/alert_medico.php');
      }



      if($number > 0)
      {
          for($i=0; $i<$number; $i++)
          {
             if(trim($_POST["pruebas"][$i] != ''))
             {
                $mysqli = mysqli_connect($host, $user, $pwd, $db);
              if(mysqli_connect_errno()) {
                }
            $prueba          =  $_POST["pruebas"][$i];
            $resultados      =  $_POST["resultados"][$i];
            $unidades        =  $_POST["unidades"][$i];
            $estudio         =  $_POST["estudios"][$i];
            $valorreferencia =  $_POST["valorreferencia"][$i];
            $subtitulo       =  $_POST["subtitulo"][$i];
            $comentario      =  $_POST["comentario"];

               // $sql = "INSERT INTO analisis(idanalisis, area,  estudio, pruebas, resuldados, unidades, valorreferencia, pacientes_idpacientes, medicos_idmedicos ) VALUES('".mysqli_real_escape_string($connect, $_POST["name"][$i])."')";

                $sql = "INSERT INTO analisis ( area, estudio, subtitulo, prueba, resultados, unidades, valorreferencia, comentario,  fecha, pacientes_idpacientes, medicos_idmedicos, idpropio)
                  VALUES( '$area', '$estudio', '$subtitulo', '$prueba', '$resultados', '$unidades', '$valorreferencia',          '$comentario', '$fecha', '$pacientes_idpacientes', '$medicos_idmedicos', '$idpropio')";

                if( mysqli_query($mysqli, $sql)){
                } else{
                 echo "Error antes de cerrar 1 ".mysqli_error($mysqli);
                }
                mysqli_close($mysqli);
            }
        }
      }
      else
      {
        echo "Please Enter Name";
      }
    
}
else {
  $eliminar = "DELETE FROM analisis WHERE idpropio = $idpropio;";
     // $eliminar = "DELETE FROM analisis WHERE idpropio = $idpropio;";

  if ($mysqli->query($eliminar) === TRUE) {
   
       $fecha                 =  date("Y") . date("m") . date("d") ;
       $area                  = $_POST["area"];
       $pacientes_idpacientes = $_POST["idpaciente"];
       $medicos_idmedicos     = $_POST["idmedico"];
       $number                = count($_POST["pruebas"]);
       $comentario            =  $_POST["comentario"];
    if ($medicos_idmedicos != null || $medicos_idmedicos != "") {
        //echo "ID MEDICOS dentro de if ".$medicos_idmedicos;
      }
      else{
        include('includes/alert_medico.php');
      }
      if($number > 0)
      {
        for($i=0; $i<$number; $i++)
        {
           if(trim($_POST["pruebas"][$i] != ''))
           {
              $mysqli = mysqli_connect($host, $user, $pwd, $db);
              if (mysqli_connect_errno()) {

              }
            
            $prueba          =  $_POST["pruebas"][$i];
            $resultados      =  $_POST["resultados"][$i];
            $unidades        =  $_POST["unidades"][$i];
            $estudio         =  $_POST["estudios"][$i];
            $valorreferencia =  $_POST["valorreferencia"][$i];
            $subtitulo       =  $_POST["subtitulo"][$i];
            $observaciones   =  "";

         //       $sql = "INSERT INTO analisis(idanalisis, area, departamento, estudio, pruebas, observaciones, pacientes_idpacientes, medicos_idmedicos ) VALUES('".mysqli_real_escape_string($connect, $_POST["name"][$i])."')";
                $sql = "INSERT INTO analisis ( area, estudio, subtitulo, prueba, resultados, unidades, valorreferencia, comentario,  fecha, pacientes_idpacientes, medicos_idmedicos, idpropio)
                  VALUES( '$area', '$estudio', '$subtitulo', '$prueba', '$resultados', '$unidades', '$valorreferencia',          '$comentario', '$fecha', '$pacientes_idpacientes', '$medicos_idmedicos', '$idpropio')";
                if( mysqli_query($mysqli, $sql)){
                } else{
                 echo "Error antes de cerrar 1 ".mysqli_error($mysqli);
                }
                mysqli_close($mysqli);
            }
        }
      }
      else
      {
        echo "Please Enter Name";
      }
     
    }
}
 //session_start();
 //$_SESSION['idpropio'] = $idpropio;
 //include('reporte.php');
      //echo '<script type="text/javascript">
        //          window.open("reporte.php?id=", "_blank");
          //  </script>';

          //visualizar
          $var = "php/pdf/reporte.php?idpr=".urlencode(base64_encode($idpropio))."&idpac=".urlencode(base64_encode($idpaciente))."&idm=".urlencode(base64_encode($medicos_idmedicos));

          //correo
          $bar = "recupera.php?idpr=".urlencode(base64_encode($idpropio))."&idpac=".urlencode(base64_encode($idpaciente))."&idm=".urlencode(base64_encode($medicos_idmedicos));

 ?>
 <!DOCTYPE html>
<html lang="es" class="no-js">
<head>
		<meta charset="UTF-8" />
		<title>Opciones de reporte</title>
		<link rel="shortcut icon" href="img/icon.png">
		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/menu.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<script src="js/modernizr.custom.js"></script>
	</head>
  <body>
    <div class="container">
        <header>
				  <span><a href="<?php echo $linkmenu; ?>"><img src="img/logo2.png" class="imag"></a></span>
			  </header>
      <div class="main clearfix">
          <nav id="menu" class="nav" style="">
              <ul>
                  <li style="visibility:hidden;">
                    <a href="">
								    <span class="icon">
									    <i aria-hidden="true" class="icon-services"></i>
								    </span>
								    <span>Correo electr&oacutenico</span>
							      </a>
                  </li>
                  <li style="visibility:hidden;">
                    <a href="">
								    <span class="icon">
									    <i aria-hidden="true" class="icon-services"></i>
								    </span>
								    <span>Visualizar PDF</span>
							      </a>
                  </li>
<!--*****************************************************************************************-->
                   <li>
                    <a href="<?php echo $bar;?>">
								    <span class="icon">
									    <i aria-hidden="true" class="icon-orina"></i>
								    </span>
								    <span>Correo electr&oacutenico</span>
							      </a>
                  </li>
                  <li>
                    <a href="<?php echo $var;?>" target="_blank">
								    <span class="icon">
									    <i aria-hidden="true" class="icon-pdf"></i>
								    </span>
								    <span>Visualizar PDF</span>
							      </a>
                  </li>
<!--*****************************************************************************************-->
                   <li style="visibility:hidden;">
                    <a href="">
								    <span class="icon">
									    <i aria-hidden="true" class="icon-services"></i>
								    </span>
								    <span>Correo electr&oacutenico</span>
							      </a>
                  </li>
                  <li style="visibility:hidden;">
                    <a href="">
								    <span class="icon">
									    <i aria-hidden="true" class="icon-services"></i>
								    </span>
								    <span>Visualizar PDF</span>
							      </a>
                  </li>
              </ul>
          </nav><!--NAV-->
      </div> <!--class = "main clearfix"-->
    </div> <!--Cointainer-->
  </body>

</html>


 <script type="text/javascript">
     // var prop  = <?php echo $idpropio; ?>;
     // var pac   = <?php echo $idpaciente; ?>;
     // var med   = <?php echo $medicos_idmedicos; ?>;
     // alert(prop+" "+pac+" "+med);
     // window.open("reporte.php?idpr=" + prop + "&idpac=" + pac + "&idm=" + med, "_blank");
 </script>
