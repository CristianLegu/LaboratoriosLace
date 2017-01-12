<?php   include("includes/conexion.php");
         $mysqli = mysqli_connect($host, $user, $pwd, $db);
      if (mysqli_connect_errno()) {
      // echo "Falló la conexión:".mysqli_connect_error();
      }
session_start();
  $_SESSION['valueF'] = 'ESTUDIO';
  if(empty($_SESSION['valueuser'])){

  include("includes/error_nologin.php");

     }

foreach($_GET as $loc=>$item) $_GET[$loc] = urldecode(base64_decode($item));

  $cont = 1;
  $i = 1;
  $idmed = 0;?>
 
  
				   <script language='javascript'>
				  var i = 1;
          var vi = 1;
                 sessionStorage.LocalToGlobalVar = vi;

			</script>
<!doctype html>
 <html lang="en-US">
      <head>
           <title>Análisis</title>
           <script src="js/jquery.min.js"></script>
            
 <link rel="stylesheet" type="text/css" media="all" href="css/styles.css">
  <?php if (isset($_GET['es'])){

if(isset($_GET['es'])){
  $es = $_GET['es'];
    $sql    = "SELECT * FROM estudios where idpropio = '$es' ";
        $query  = mysqli_query($mysqli, $sql);
        $fila = $mysqli->query($sql);

        $fila1 = mysqli_fetch_array($query);
    mysqli_close($mysqli);
}
          ?>

    <?php    }
    else{ $fila = null;
         $fila1 = null;

       }
  ?>




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
      <h1>Estudio</h1>
    </li>
  </ul>
</nav>

      <div class="container">
        <div class="form-group">
          <form name="add_name" id="add_name" method="post" action="guarda.php " ALIGN=center autocomplete="off">				
    	    <div class="col-2">
      			<label >
     					Nombre del Estudio
    						<input name="estudio" value="<?php if($fila1 != null) { echo $fila1 [1]; }?>" style="background-color:powderblue; "required>
            </label>
  				</div>

          <div class="table-responsive">

<?php  if($fila == null) { ?>
          <table class="table table-bordered" id="dynamic_field">
          <tr>
            <td><input type="form-control" name="subtitulo[]" placeholder="Subtitulo" class="form-control name_list" /></td>
            <td><button type="button" name="addsub" id="addsub" class="agregar">Agregar Subtitulo</button></td>
          </tr>
            <tr>
              <td><input type="form-control" name="pruebas[]" placeholder="Prueba" class="form-control name_list" /></td>
              <td><input type="form-control" name="unidades[]" placeholder="Unidades" class="form-control name_list" /></td>
              <td><input  type="form-control" name="valorreferencia[]" placeholder="Valor de referencia" class="form-control name_list" /></td>
              <td><input  type="form-control" name="idsubtitulo[]" value="0" style="display:none;" class="form-control name_list" /></td>
              <td><button type="button" name="add" id="add" class="agregar">Agregar</button></td>
            </tr>
          </table>
          <hr>
          <div id="dynamic_field2">
         
          </div>
<?php
      }
      else{ $subt=""?>
         <table id="dynamic_field">
           
  <?php  while (  $row = mysqli_fetch_array($fila, MYSQLI_ASSOC)) {
  ?>   <?php  $renglon = "row".$i; 
  if($subt != $row ['subtitulo'] ){
    $subt =$row ['subtitulo'] ;
         ?>

          <tr>
            <td><input type="form-sub" name="subtitulo[]" placeholder="Subtitulo" class="form-sub name_list" value="<?php  echo $row ['subtitulo'] ?> "/></td>
            <td><button type="button" name="addsub" id="addsub" class="agregarsub">Agregar Subtitulo</button></td>
          </tr>
          <?php } ?>
           <tr id="<?php echo $renglon; ?>">
              <td><input type="form-control" name="pruebas[]" placeholder="Prueba" class="form-control name_list" value="<?php  echo $row ['prueba'] ?> " /></td>
              <td><input type="form-control" name="unidades[]" placeholder="Unidades" class="form-control name_list" value="<?php  echo $row ['unidades'] ?> " /></td>
              <td><input  type="form-control" name="valorreferencia[]" placeholder="Valor de referencia" class="form-control name_list" value="<?php  echo $row ['valorreferencia'] ?> " /></td>
             
                  <?php if ($cont == 1) { ?>
              <td><button type="button" name="add" id="add" class="agregar">Agregar</button></td>
                  <?php } else { ?>
              <td><button type="button" name="remove" id="<?php echo $i; ?>" class="eliminar btn_remove">X</button></td>
                    <?php } ?>
           </tr>
           
  <?php $cont++; $i++;} ?>
      </table>
     	<?php	 }   $i ;   ?>
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
   var i = 0;
   var j= 0;
   var t= 0;
   var vi=0;
   var arreglo = [""];
 $(document).ready(function(){
      $('#add').click(function(){
           t++;
           $('#dynamic_field').append(
               '<tr id="row'+t+'">'+
               '<td><input type="form-control" name="pruebas[]" placeholder="Prueba'+t+'" class="form-control name_list" /></td>'+
               '<td><input type="form-control" name="unidades[]" placeholder="Unidades'+t+'" class="form-control name_list" /></td>'+
               
               '<td><input type="form-control" name="valorreferencia[]" placeholder="Valor de referencia'+t+'" class="form-control name_list" /></td>'+
               '<td><input  type="form-control" name="idsubtitulo[]" value="'+vi+'" style="display:none"  class="form-control name_list" /></td>'+
               '<td><button type="button" name="remove" id="'+t+'" class="eliminar btn_remove">X</button></td></tr>');
      console.log("T"+t);
      });
      
      $(document).on('click', '.btn_remove', function(){
           var button_id = $(this).attr("id");
           $('#row'+button_id+'').remove();
           t--;
           console.log("T"+t);
      });
      $('#submit').click(function(){
           $.ajax({
                url:"guarda.php",
                method:"POST",
                data:$('#add_name').serialize(),
                success:function(data)
                {
                     alert(data);
                     $('#add_name')[0].reset();
                }
           });
      });
//Subtitulos
$('#addsub').click(function(){
            i++;
            j++;
            vi++;
            
           $('#dynamic_field2').append(
               '<div id="sub'+j+'">'+
               '<div style="display: flex;margin-top: 10px;">'+
                        '<input type="form-control" name="subtitulo[]" placeholder="Subtitulo'+j+'" class="form-control name_list" />'+
                        '<button type="button" name="remove" id="'+j+'" class="eliminar btn_removesub">X</button>'+
                    '</div>'+
               '<div id="row'+j+'" style="display: flex;">'+
                  '<input type="form-control" name="idsubtitulo[]" value="'+vi+'" style="display:none;" class="form-control name_list" />'+
                    '<input type="form-control" name="pruebas[]" placeholder="Prueba'+i+'" class="form-control name_list" />'+
                    '<input type="form-control" name="unidades[]" placeholder="Unidades'+i+'" class="form-control name_list" />'+
                    '<input type="form-control" name="valorreferencia[]" placeholder="Valor de referencia'+i+'" class="form-control name_list" />'+
                    '<button type="button" name="add" id="'+j+'" class="agregar2">Agregar</button></div>'+
                    '<div id="rowx'+j+'"></div><hr></div>');
          arreglo.push(i);
          i=0;
      console.log("i"+i);
      console.log("j"+j);
      console.log(arreglo);

      });

      $(document).on('click', '.agregar2', function(){
    
          var button_id = $(this).attr("id");
         console.log(button_id);
          i = arreglo[button_id];
          i++;
            $('#rowx'+button_id+'').append(
               '<div id="reng'+button_id+'-'+i+'"style="display: flex;">'+
                    '<input type="form-control" name="pruebas[]" placeholder="Prueba'+i+'" class="form-control name_list" />'+
                    '<input type="form-control" name="idsubtitulo[]" value="'+vi+'" style="display:none;" class="form-control name_list" />'+
                  
                    '<input type="form-control" name="unidades[]" placeholder="Unidades'+i+'" class="form-control name_list" />'+
                    '<input type="form-control" name="valorreferencia[]" placeholder="Valor de referencia'+i+'" class="form-control name_list" />'+
                    '<button type="button" name="remove" id="'+button_id+'-'+i+'" class="eliminar btn_remove2">X</button></div>');
           
           arreglo.splice(button_id, 1, i);
           i=0;
           console.log("i"+i);
           console.log("j"+j);
           console.log(arreglo);
      });

      $(document).on('click', '.btn_remove2', function(){
           var button_id = $(this).attr("id");
           var aux= button_id.substring(0, 1);//Arreglar
           var aux2= button_id.substring(2, 3);//arreglar
           console.log(aux+""+aux2);
            i = arreglo[aux];
            i--;
           arreglo.splice(aux, 1, i);
           $('#reng'+aux+'-'+aux2+'').remove();
           vi--;
           console.log("I"+i);
           console.log("j"+j);
           console.log(arreglo);
      });
      $(document).on('click', '.btn_removesub', function(){//arreglar
           var button_id = $(this).attr("id");
           $('#sub'+button_id+'').remove();
           j--;
           vi--;
           console.log("J"+j);
      });
 });
 
 </script>