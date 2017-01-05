<?php   include("includes/conexion.php");
         $mysqli = mysqli_connect($host, $user, $pwd, $db);
      if (mysqli_connect_errno()) {
      // echo "Falló la conexión:".mysqli_connect_error();
      }
          else{
      // echo "Error ".mysqli_error($mysqli);
       }
session_start();
  if(empty($_SESSION['valueuser'])){

  include("includes/error_nologin.php");

     }

foreach($_GET as $loc=>$item) $_GET[$loc] = urldecode(base64_decode($item));

  $cont = 1;
  $i = 1;
  $idmed = 0;?>
 
  <?php if(!isset($_GET['p'])){
  // include("includes/error_usuario1.php"); 
      include("includes/error_nologin.php");
  }
  else{ 
    ?>
				   <script language='javascript'>
				  var i = 1;
			</script>
<!doctype html>
 <html lang="en-US">
      <head>
           <title>Análisis</title>
           <script src="js/jquery.min.js"></script>
                    <?php
 $idpac = $_GET['p']; ?>
 <link rel="stylesheet" type="text/css" media="all" href="css/styles.css">
  <?php if ($_GET['pro'] != 0){


    $idpropio = $_GET['pro'];
    $sql    = "SELECT * FROM analisis where idpropio = '$idpropio' ";
        $query  = mysqli_query($mysqli, $sql);
        $fila = $mysqli->query($sql);
        $fila1 = mysqli_fetch_array($query);
    mysqli_close($mysqli);
          ?>

    <?php    }
    else{ $fila = null;
         $fila1 = null;

       }
  }?>




           <link rel="shortcut icon" href="img/icon.png">
           <meta charset="utf-8">
           <!-- Pantalla de carga-->
           <script type="text/javascript">
             window.onload = detectarCarga;
               function detectarCarga(){
                 document.getElementById("cargando").style.visibility="hidden";
               }
           </script>

           <!-- Pantalla de carga-->
      </head>
        <!-- Pantalla de carga-->
              <div id="cargando">
                <div class="cssload-thecube">
                  <div class="cssload-cube cssload-c1"></div>
                  <div class="cssload-cube cssload-c2"></div>
                  <div class="cssload-cube cssload-c4"></div>
                  <div class="cssload-cube cssload-c3"></div>
                </div>
              </div>
        <!-- Pantalla de carga-->
<body>
<nav id="hola">
  <ul>
    <li><p>
          <a href="<?php echo $_SERVER['HTTP_REFERER'];?>">
	        <img src="img/logo2.png" id="logo">
        </a>
        </p>

    </li>

    <li>
      <h1>An&aacute;lisis</h1>
    </li>
  </ul>
</nav>

      <div class="container">
        <div class="form-group">
          <form name="add_name" id="add_name" method="post" action="agrega_analisis.php " ALIGN=center autocomplete="off">
      <div>
      <label >
        Elegir Medico
    <!--    <select id="idmedico"  name="idmedico" >
-->
<form name="add_name" id="add_name" method="post" action="agrega_analisis.php " ALIGN=center autocomplete="off">
        <select id="idmedico"  name="idmedico" >
          
          <?php
            $mysqli = mysqli_connect($host, $user, $pwd, $db);

            if($idpropio != 0){
              if(isset($_GET['idm'])){
                $idmed = $_GET['idm'];
              }
              $querymedicos = $mysqli -> query ("SELECT idmedicos, nombre FROM medicos WHERE idmedicos = '$idmed'");
              $querymedicos2 = $mysqli -> query ("SELECT idmedicos, nombre FROM medicos");

              
              while ($valores =  mysqli_fetch_array($querymedicos, MYSQLI_ASSOC)) {
                echo '<option value="'.$valores['idmedicos'].'">'.$valores['nombre'].'</option>';
              } 
              while ($valores =  mysqli_fetch_array($querymedicos2, MYSQLI_ASSOC)) {
                echo '<option value="'.$valores['idmedicos'].'">'.$valores['nombre'].'</option>';
              } 


              /*
              while ($valores =  mysqli_fetch_array($querymedicos, MYSQLI_ASSOC)) {
                echo '<option value="'.$valores['idmedicos'].'">'.$valores['nombre'].'</option>';
              } 
              */ 
            }else{
              echo "<option  value=".$idmedico.">Seleccionar Médico</option>";
              $querymedicos = $mysqli -> query ("SELECT idmedicos, nombre FROM medicos");
              while ($valores =  mysqli_fetch_array($querymedicos, MYSQLI_ASSOC)) {
                echo '<option value="'.$valores['idmedicos'].'">'.$valores['nombre'].'</option>';
              }
            }
            mysqli_close($mysqli);
            
          ?>
        </select>
      </label>
      </div>
      <div class="col-4">
    	 <label>
      				Área <?php //echo $name;?>
      			  <input name="area" value="<?php if($fila1 != null) { echo $fila1 [1]; }?>" style="background-color:powderblue; "required>
    	 </label>
  		 </div>
  				<div class="col-4">
      			<label >
      					Departamento
      					<input name="departamento" value="<?php if($fila1 != null) { echo $fila1 [2]; }?>" style="background-color:powderblue; "required>
    				</label>
  				</div>
    	    <div class="col-4">
      			<label >
     					  Estudio
    						<input name="estudio" value="<?php if($fila1 != null) { echo $fila1 [3]; }?>" style="background-color:powderblue; "required>
    				</label>
  				</div>

          <div class="table-responsive">

<?php  if($fila == null) { ?>
          <table class="table table-bordered" id="dynamic_field">
            <tr>
              <td><input type="form-control" name="pruebas[]" placeholder="Prueba" class="form-control name_list" /></td>
              <td><input type="form-control" name="resultado[]" placeholder="Resultado" class="form-control name_list" /></td>
              <td><input type="form-control" name="unidades[]" placeholder="Unidades" class="form-control name_list" /></td>
              <td><input  type="form-control" name="valorreferencia[]" placeholder="Valor de referencia" class="form-control name_list" /></td>
              <td><input  type="form-control" name="observaciones[]" placeholder="Observaciones" class="form-control name_list" /></td>
              <td><button type="button" name="add" id="add" class="agregar">Agregar</button></td>
            </tr>
          </table>
<?php
      }
      else{ ?>
         <table id="dynamic_field">
  <?php  while (  $row = mysqli_fetch_array($fila, MYSQLI_ASSOC)) {
  ?>   <?php $renglon = "row".$i; ?>
           <tr id="<?php echo $renglon; ?>">
              <td><input type="form-control" name="pruebas[]" placeholder="Prueba" class="form-control name_list" value="<?php  echo $row ['prueba'] ?> " /></td>
              <td><input  type="form-control" name="resultado[]" placeholder="Resultado" class="form-control name_list" value="<?php  echo $row ['resultado'] ?> " /></td>
              <td><input type="form-control" name="unidades[]" placeholder="Unidades" class="form-control name_list" value="<?php  echo $row ['unidades'] ?> " /></td>
              <td><input  type="form-control" name="valorreferencia[]" placeholder="Valor de referencia" class="form-control name_list" value="<?php  echo $row ['valorreferencia'] ?> " /></td>
              <td><input  type="form-control" name="observaciones[]" placeholder="Observaciones" class="form-control name_list" value="<?php  echo $row ['observaciones'] ?> " /></td>
                  <?php if ($cont == 1) { ?>
              <td><button type="button" name="add" id="add" class="agregar">Agregar</button></td>
                  <?php } else { ?>
              <td><button type="button" name="remove" id="<?php echo $i; ?>" class="eliminar btn_remove">X</button></td>
                    <?php } ?>
           </tr>
           
<script language='javascript'>
   var i = i + 1;
</script>
  <?php $cont++; $i++;} ?>
      </table>
     	<?php	 }   $i ;   ?>
       </div>
   <div class="col-2">
    <label >
       Comentarios
    </label>
           <textarea rows="6" cols="50" name="comentario" value="<?php if($fila1 != null) { echo $fila1 [8]; }?>"  style="background-color:powderblue; "></textarea>
   </div>
      <div class="col-submit button">
        <input name="idpropio" value="<?php if($fila1 != null) { echo $idpropio; } else {$idpropio = 0; echo $idpropio;}?>"  style='display:none;'>
        <input name="idpaciente" value = "<?php echo $idpac; ?>" style="display:none;">
            <button name="submit1"   class="guardar" >GUARDAR</button>
      </div>
  </form>
      </div>
    </div>
  </body>
 </html>

 <script>
 $(document).ready(function(){
      $('#add').click(function(){
           i++;


           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="form-control" name="pruebas[]" placeholder="Prueba" class="form-control name_list" /></td><td><input type="form-control" name="resultado[]" placeholder="Resultado" class="form-control name_list" /></td><td><input type="form-control" name="unidades[]" placeholder="Unidades" class="form-control name_list" /></td><td><input type="form-control" name="valorreferencia[]" placeholder="Valor de referencia" class="form-control name_list" /></td> <td><input type="form-control" name="observaciones[]" placeholder="Observaciones" class="form-control name_list" /></td> <td><button type="button" name="remove" id="'+i+'" class="eliminar btn_remove">X</button></td></tr>');
      });
      $(document).on('click', '.btn_remove', function(){
           var button_id = $(this).attr("id");
           $('#row'+button_id+'').remove();
      });
      $('#submit').click(function(){
           $.ajax({
                url:"agrega_analisis.php",
                method:"POST",
                data:$('#add_name').serialize(),
                success:function(data)
                {
                     alert(data);
                     $('#add_name')[0].reset();
                }
           });
      });
 });
 </script>
