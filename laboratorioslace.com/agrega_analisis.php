<?php
include("includes/conexion.php");
 $mysqli = mysqli_connect($host, $user, $pwd, $db);
//session_start();
//echo $_SESSION['p'];



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
       $estudio_aux = "";
       $cont =$idpropio;
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

            if($estudio_aux!=$estudio){
            	$estudio_aux = $estudio;
         $idpropio = $cont;
         $cont++;
            }  
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
//$var = "php/pdf/reporte.php?idpr=".urlencode(base64_encode($idpropio))."&idpac=".urlencode(base64_encode($idpaciente))."&idm=".urlencode(base64_encode($medicos_idmedicos));

          //correo
  //        $bar = "recupera.php?idpr=".urlencode(base64_encode($idpropio))."&idpac=".urlencode(base64_encode($idpaciente))."&idm=".urlencode(base64_encode($medicos_idmedicos));
include("includes/alert_analisis.php");
 ?>