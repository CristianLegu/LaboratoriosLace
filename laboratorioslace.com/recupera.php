<?php

foreach($_GET as $loc=>$item) $_GET[$loc] = urldecode(base64_decode($item));
include("includes/conexion.php");
$con = mysqli_connect($host, $user, $pwd, $db);

$url = "";
$idpr   = 0;
$idpac  = 0;
$idmed  = 0;

  if( isset($_GET['idpr']) && isset($_GET['idpac']) && isset($_GET['idm']) ){
        $idpr   = $_GET['idpr'];
        $idpac  = $_GET['idpac'];
        $idmed  = $_GET['idm'];

        $url = 'www.laboratorioslace.com/reporte.php?idpac='.urlencode(base64_encode($idpac)).'&idpr='.urlencode(base64_encode($idpr)).'&idm='.urlencode(base64_encode($idmed));
        
        if( mysqli_connect_errno() ){
          echo "Falló la conexión: ".mysqli_connect_error();
        }else{
          $sql = "SELECT nombre, email
                    FROM pacientes 
                    WHERE idpacientes = '$idpac'";
          $query = $con -> query($sql);
      $fila = mysqli_fetch_array($query, MYSQLI_ASSOC);
            $nombrePac  = $fila['nombre'];
            $email      = $fila['email'];
            
              $asunto ="Reporte de análisis realizado";
              $remitente="administracion@laboratorioslace.com";
              $headers = "MIME-Version: 1.0\r\n";
              $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
              $headers .= "From: Laboratorios LACE <$remitente>\r\n".
                          'Sender: administracion@laboratorioslace.com' . "\r\n" .
                          'X-Mailer: PHP/' . phpversion();
              $headers .= "Reply-To: $remitente\r\n";
              $headers .= "Return-path: $remitente\r\n"; 
              $contenidomail= '
                              <html>
                              <head>
                              <style type="text/css">
                              img{
                                width: 100%;  
                                align: center;
                              }

                              </style>
                              </head>

                              <body>
                              <div id="encabezado">
                              <img src="http://www.laboratorioslace.com/img/banner3.jpg">
                              </div><br><br>
                              </body>
                              </html>
                              ';
                              $msj = "Apreciable ".$nombrePac.", en el siguiente enlace usted podrá visualizar los resultados del análisis realizado. ".$url;
                              $fondo = '
                                      <html>
                                      <head>
                                      <style type="text/css">
                                      img{
                                        width: 100%;
                                        align: center;  
                                      }
                                      .encabezado{
                                         width: 100%;
                                         background: #F2F2F2;
                                         font-size: 3px;
                                        }

                                      </style>
                                      </head>

                                      <body>
                                      <br><br><br><br>
                                      <div id="encabezado">
                                        <p align="justify">
                                        <em><strong>AVISO IMPORTANTE:</strong> Este correo electrónico y/o el material adjunto es para uso exclusivo de la persona o la entidad a la que expresamente se le ha enviado, el cual contiene información confidencial. Si no es el destinatario legítimo del mismo, por favor repórtelo inmediatamente a la cuenta del remitente y elimínelo. Cualquier revisión, almacenamiento, retransmisión, difusión o cualquier otro uso de este correo, por personas o entidades distintas a las del destinatario legítimo, queda expresamente prohibida. Este correo electrónico no pretende ni debe ser considerado como constitutivo de ninguna relación legal, contractual o de otra índole similar.
                                        </em>
                                        </p>
                                      </div>
                                      <div >
                                      <img src="http://www.laboratorioslace.com/img/banner4.jpg">
                                      </div>
                                      </body>
                                      </html>
                                      ';
                      $enviado = mail ($email, $asunto, $contenidomail.$msj.$fondo, $headers);

                      if($enviado){
                        session_start();
                        $_SESSION['enviado']= "report";
                        include("includes/enviomail.php");
                      }
                      else{
                        session_start();
                        $_SESSION['enviado']= "vvv";
                        include("includes/errormail.php");
                      }
             

          
          mysqli_close($con);
        }
        
        
    }

    


    if(isset($_GET['u'])){

      $id = $_GET['u'];


            if (mysqli_connect_errno()) {
              echo "Falló la conexión: ".mysqli_connect_error();
            }
      $sql = "SELECT
                        u.n_user,
                        u.email,
                        r.respuscol
                        FROM usuarios u
                        join respus r on u.idusuarios = r.id
                        where u.idusuarios = '$id'" ;
                $query = $con -> query($sql);
            $fila = mysqli_fetch_array($query, MYSQLI_ASSOC);
              $email = $fila['email'];
              $user = $fila['n_user'];
              $pass = $fila['respuscol'];

              $asunto ="Recuperación de contraseña LACE";
              $remitente="administracion@laboratorioslace.com";
              $headers = "MIME-Version: 1.0\r\n";
              $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
              $headers .= "From: Laboratorios LACE <$remitente>\r\n".
                          'Sender: administracion@laboratorioslace.com' . "\r\n" .
                          'X-Mailer: PHP/' . phpversion();
              $headers .= "Reply-To: $remitente\r\n";
              $headers .= "Return-path: $remitente\r\n"; 
              $contenidomail= '
                              <html>
                              <head>
                              <style type="text/css">
                              img{
                                width: 70%;  
                                heigth: 70%;
                                align: center;
                              }

                              </style>
                              </head>

                              <body>
                              <div id="encabezado">
                              <img src="http://www.laboratorioslace.com/img/banner1.jpg">
                              </div><br><br>
                              </body>
                              </html>
                              ';
                              $msj = "Apreciable ".$user.", su contraseña actual es: ".$pass;
                              $fondo = '
                                      <html>
                                      <head>
                                      <style type="text/css">

                                      .encabezado{
                                         width: 70%;
                                         background: #F2F2F2;
                                         font-size: 6px;
                                        }

                                      </style>
                                      </head>

                                      <body>
                                      <br><br>
                                      <div id="encabezado">
                                        <em>Si usted no solicitó este cambio, favor de notificarlo respondiendo a éste correo.</em>
                                      </div>
                                      <div >
                                      <img src="http://www.laboratorioslace.com/img/banner2.jpg">
                                      </div>
                                      </body>
                                      </html>
                                      ';
                      $enviado =mail ($email, $asunto,$contenidomail.$msj.$fondo,$headers);
                      if($enviado){
                        session_start();
                        $_SESSION['enviado']= "si";
                        include("includes/enviomail.php");
                      }
                      else{
                        echo "Error con el servidor.";
                      }


      mysqli_close($con);
    }
    
?>