<?php
	session_start();
	include('../../includes/conexion.php');
	//foreach($_GET as $loc=>$item) $_GET[$loc] = urldecode(base64_decode($item));

    $idpr   = 0;
    $idpac  = 0;
    $idmed  = 0;
	$membrete = "";
    $queryhead = "";
    $nombrePaciente = "";
    $nombreMedico   = "";
    $fecha = "";
    $conCuenta = "";
	$observaciones = "";
	$dia    = "";
    $mes    = "";
    $anio   = "";
    $fechaAct  = "";

	$dia    = date("d");
	$mes    = date("m");
    $anio   = date("Y");
	$fechaAct  = $anio."-".$mes."-".$dia;
	$estudio = "";
	$subtitulo = "";
	$filacontar =0;
	
$array = [];
    
		if(isset($_GET['memb'])){
			$membrete = $_GET['memb'];
		}
		if(isset($_GET['array'])){
			$array_restored_from_db = unserialize($_GET['array']);
			
		    foreach( $array_restored_from_db as $c){
				  $sqlContar = "SELECT  a.prueba, a.resultados, a.unidades, a.valorreferencia, a.comentario, a.subtitulo, a.estudio
                    FROM analisis AS a 
                    JOIN pacientes AS p 
                    ON a.pacientes_idpacientes = p.idpacientes
                    JOIN medicos m
                    ON a.medicos_idmedicos = m.idmedicos
                    WHERE a.idpropio = '$c'
                    ORDER BY a.idpropio";
    			$conContar = mysqli_connect($host, $user, $pwd, $db);
    			$resultContar = mysqli_query($conContar, $sqlContar);
    			$filacontar = mysqli_num_rows($resultContar) + $filacontar;
				
			}
		} 

		
  
	

	if($filacontar <= 6){

		$con = mysqli_connect($host, $user, $pwd, $db);

        $sql = "SELECT  a.prueba, a.resultados, a.unidades, a.valorreferencia, a.comentario
                    FROM analisis AS a 
                    JOIN pacientes AS p 
                    ON a.pacientes_idpacientes = p.idpacientes
                    JOIN medicos m
                    ON a.medicos_idmedicos = m.idmedicos
                    WHERE a.idpropio = '$idpr'
                    ORDER BY a.idpropio;";

        
        $query = $con -> query($sql);


		//$conname = mysqli_connect($host, $user, $pwd, $db);
        $sqlname = "SELECT  m.nombre AS medico, p.nombre AS paciente, a.fecha AS fecha, a.estudio, a.subtitulo
                    FROM analisis AS a 
                    JOIN pacientes AS p 
                    ON a.pacientes_idpacientes = p.idpacientes
                    JOIN medicos m
                    ON a.medicos_idmedicos = m.idmedicos
                    WHERE a.idpropio = '$idpr'
                    ORDER BY a.idpropio;";

        
        $queryname = $con -> query($sqlname);

	
	
	
?>
<!-- IMPORTANTE: El contenido de la etiqueta style debe estar entre comentarios de HTML -->
<style>
<!--
#encabezado {padding:20px 0; border-top: 1px solid #0B08AB; border-bottom: 1px solid #0B08AB; width:100%;}
#encabezado .fila #col_1 {width: 10%}
#encabezado .fila #col_2 {padding: 0px 0px 0px 100px; width: 88%; }
/*#encabezado .fila #col_3 {width: 30%}*/


#encabezado .fila td img {width:120%; margin: 0 0 10px 0;}
#encabezado .fila #col_2 #span1{font-size: 18px; padding: 100px 0 0 0px;}
#encabezado .fila #col_2 #span2{margin:10px 0 0 50px;font-size: 10px; color: #000000; }
#encabezado .fila #col_2 #span3{margin:8px 0 0 45px;font-size: 10px; color: #000000; }
#encabezado .fila #col_2 #span4{margin:8px 0 0 65px;font-size: 10px; color: #000000; }
#encabezado .fila #col_2 #span5{margin:6px 0 0 50px;font-size: 10px; color: #000000; }

#footer {padding-top:5px 0; border-top: 2px solid #10C86F; width:100%;}
#footer .fila td {text-align:right; width:100%;}
#footer .fila td span {font-size: 10px; color: #000;}

#central {width:100%; margin: 20px 0 0 -40px;}
#central tr td {text-align: left; width:100%; font-size:12px;}

#titulo tr td {font-size:11.5px; text-decoration: underline; font-weight: bold;}
#subtitulo tr td {font-size:11.5px; align-text: center; font-weight: bold;}
#line {margin-top:10px ; border-top: 1px solid #0B08AB; width:118%;}
#atte {margin-top:30px;}
#paciente {margin-top:100px;}
#paciente tr td {font-size: 11px;}
#nobreak { page-break-inside: avoid;}


-->
</style>

<!-- page define la hoja con los márgenes señalados -->
<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="20mm">
    <!-- Define el header de la hoja -->
	<?php
		if($membrete == 'true'){
		?>
    <page_header> 
		<table id="encabezado">
            <tr class="fila">
                <td id="col_1" >
					<span id="span2">
						<img src="../../img/logo2.png"/>
					</span>
				</td>
                <td id="col_2">
					<span id="span1">LABORATORIOS DE ANALISIS CLINICOS ESPINOSA</span>
					<br>
					<span id="span2">Suc. Centro, Calle Hidalgo No. 9 Int 1-A Tel. (469) 692 08 75 Pénjamo. Gto.</span>
					<br>
					<span id="span3">Suc. Arboledas, Prol. Insurgentes No. 100 Tel.(469) 692 21 95 Pénjamo. Gto.</span>
					<br>
					<span id="span4">Universidad de Guanajuato Ced. Profesional 1888051 SSA 1931</span>
					<br>
					<span id="span5">Instituto de Hemopatología Ced. Especialidad 5554071 SSA Esp. 4564</span>
				</td>
            </tr>
        </table>

    </page_header>
	<?php
		}
	?>
        

    
    <!-- Define el cuerpo de la hoja -->
	<?php
		foreach( $array_restored_from_db as $c){

			$sql = "SELECT p.nombre AS paciente, m.nombre AS medico, a.fecha as fecha, a.estudio, a.subtitulo
						FROM analisis AS a 
						JOIN pacientes AS p 
						ON a.pacientes_idpacientes = p.idpacientes
						JOIN medicos m
						ON a.medicos_idmedicos = m.idmedicos
						WHERE a.idpropio = '$c'
						ORDER BY a.estudio;";

					
				$query = $con -> query($sql);
			}
		while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
			$nombreMedico = $row['medico'];
			$nombrePaciente = $row['paciente'];
			$fecha = $row['fecha'];
			$estudio = $row['estudio'];
			$subtitulo = $row['subtitulo'];
		}
		/*
		while ($row = mysqli_fetch_array($queryname, MYSQLI_ASSOC)) {
			$nombreMedico = $row['medico'];
			$nombrePaciente = $row['paciente'];
			$fecha = $row['fecha'];
			$estudio = $row['estudio'];
			$subtitulo = $row['subtitulo'];
		}
		*/
	?>


	<table id="paciente">
		<tr>
			<td>
				<span>Examen practicado a: <?php echo $nombrePaciente;?></span>
			</td>
		</tr>
		<tr>
			<td>
				<span>Practicado por el médico: <?php echo $nombreMedico;?></span>
			</td>
		</tr>
		<tr>
			<td>
				<span>Fecha de aplicación: <?php echo $fecha;?></span>
			</td>
		</tr>
	</table>

	<table id="titulo">
		<tr>
			<td>
				<span> <?php echo $estudio;?></span>
			</td>
		</tr>
	</table>
	<table id="subtitulo">
		<tr>
			<td>
				<span> <?php echo $subtitulo;?></span>
			</td>
		</tr>
	</table>
	
	<table id="central">
		<tr>
			<td >
				<table id="datos">
					<tr class="fila">
						<td style="width:300px">
							Prueba
						</td>
						<td style="width:90px">
							Resultados
						</td>
						<td style="width:100px">
							Unidades
						</td>
						<td style="width:120px">
							Valor de Referencia
						</td>
					</tr>
				</table>
			</td>
		</tr>
				<?php
					foreach( $array_restored_from_db as $c){

						$sql = "SELECT  a.prueba, a.resultados, a.unidades, a.valorreferencia, a.comentario, a.subtitulo, a.estudio
									FROM analisis AS a 
									JOIN pacientes AS p 
									ON a.pacientes_idpacientes = p.idpacientes
									JOIN medicos m
									ON a.medicos_idmedicos = m.idmedicos
									WHERE a.idpropio = '$c'
									ORDER BY a.estudio;";	
						$query = $con -> query($sql);
					}
					while($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
        					{
								
								$observaciones = $row['comentario'];
							
				?>
						<tr>
							<td >
							<nobreak>
								<table id="datos">
									<tr>
									
										<td style="width:300px; font-size:10px;">
											<?php 	
													$pru = $row['prueba'];
													//$prueba = wordwrap($pru, 10, "\n");
													echo $pru;		
											?>
										</td>
										<td style="width:90px; font-size:10px;">
											<?php
													$res = $row['resultados'];
												 	//$resultados = wordwrap($res, 10, "\n");
													echo $res;		
											?>
										</td>
										<td style="width:100px; font-size:10px;">
											<?php 	
													$uni = $row['unidades'];
													//$unidades = wordwrap($uni, 10, "\n") ;
													echo $uni;
											?>
										</td>
										<td style="width:120px; font-size:10px;">
											<?php 	
													$val = $row['valorreferencia'];
													//$valorref = wordwrap($val, 3, true);
													echo "$val ";
											?>
										</td>						
									</tr>
								</table>
							</nobreak>
							</td>
						</tr>
				<?php
							}
				?>
				<table id="line">
					<tr>
						<td></td>
					</tr>
				</table>
				<table>
					<tr>
						<td style="font-size:10px;">
							Observaciones: <?php echo $observaciones;?>
						</td>
					</tr>
				</table>
				<table id="atte">
					<tr>
						<td>
							Atentamente
						</td>
					</tr>
					<tr>
						<td>
							Q. F. B. Fabiola Espinosa Bribiesca ________________________________
						</td>
					</tr>
				</table>
				
				
	</table>
    <!-- Fin del cuerpo de la hoja -->

	<page_footer> <!-- Define el footer de la hoja -->
		<table id="footer">
            <tr class="fila">
				<td>
					<span>Pénjamo, Gto. <?php echo $fechaAct; ?></span>
				</td>
			</tr>
        </table>
    </page_footer>
	<table id="nobreak">
		<tr>
			<td>
			</td>
		</tr>
	</table>

</page>
<?php 
	}
	else{
		$con = mysqli_connect($host, $user, $pwd, $db);
		$estudio = "";
		$subtitulo = "";
		

		//$conname = mysqli_connect($host, $user, $pwd, $db);
        $sqlname = "SELECT  m.nombre AS medico, p.nombre AS paciente, a.fecha AS fecha, a.estudio, a.subtitulo
                    FROM analisis AS a 
                    JOIN pacientes AS p 
                    ON a.pacientes_idpacientes = p.idpacientes
                    JOIN medicos m
                    ON a.medicos_idmedicos = m.idmedicos
                    WHERE a.idpropio = '$idpr'
                    ORDER BY a.idpropio;";

        
        $queryname = $con -> query($sqlname);

		$sqlTitles = "SELECT  a.estudio, a.subtitulo
						FROM analisis AS a 
						JOIN pacientes AS p 
						ON a.pacientes_idpacientes = p.idpacientes
						JOIN medicos m
						ON a.medicos_idmedicos = m.idmedicos
						WHERE a.idpropio = '$idpr'
						group by a.estudio
						ORDER BY a.idpropio;";
		$queryTitles = $con -> query($sqlTitles);

		$array = [];

?>
<!-- IMPORTANTE: El contenido de la etiqueta style debe estar entre comentarios de HTML -->
<style>
<!--
#encabezado {padding:20px 0; border-top: 1px solid #0B08AB; border-bottom: 1px solid #0B08AB; width:100%;}
#encabezado .fila #col_1 {width: 10%}
#encabezado .fila #col_2 {padding: 0px 0px 0px 100px; width: 88%; }
/*#encabezado .fila #col_3 {width: 30%}*/


#encabezado .fila td img {width:120%; margin: 0 0 10px 0;}
#encabezado .fila #col_2 #span1{font-size: 18px; padding: 100px 0 0 0px;}
#encabezado .fila #col_2 #span2{margin:10px 0 0 50px;font-size: 10px; color: #000000; }
#encabezado .fila #col_2 #span3{margin:8px 0 0 45px;font-size: 10px; color: #000000; }
#encabezado .fila #col_2 #span4{margin:8px 0 0 65px;font-size: 10px; color: #000000; }
#encabezado .fila #col_2 #span5{margin:6px 0 0 50px;font-size: 10px; color: #000000; }

#footer {padding-top:5px 0; border-top: 2px solid #10C86F; width:100%;}
#footer .fila td {text-align:right; width:100%;}
#footer .fila td span {font-size: 10px; color: #000;}

#central {width:100%; margin: 20px 0 0 -40px;}
#central tr td {text-align: left; width:100%; font-size:12px; height:0px;}

#central #datos .fila {font-weight: bold; text-decoration: underline;}


#line {margin-top:10px ; border-top: 1px solid #0B08AB; width:118%;}
#atte {font-size:10px;}
#paciente {margin-top:-15px;}
#paciente tr td {font-size: 11.5px;}

#encabezado2 {padding:20px 0; border-top: 0px solid #0B08AB; border-bottom: 0px solid #0B08AB; width:100%;}
#encabezado2 .fila2 #col_12 {width: 10%}
#encabezado2 .fila2 #col_22 {padding: 0px 0px 0px 100px; width: 88%; }
/*#encabezado .fila #col_3 {width: 30%}*/
#encabezado2 .fila2 td img {width:120%; margin: 0 0 10px 0;}
#encabezado2 .fila2 #col_2 #span12{font-size: 18px; padding: 100px 0 0 0px;}
#encabezado2 .fila2 #col_2 #span22{margin:10px 0 0 50px;font-size: 10px; color: #000000; }
#encabezado2 .fila2 #col_2 #span32{margin:8px 0 0 45px;font-size: 10px; color: #000000; }
#encabezado2 .fila2 #col_2 #span42{margin:8px 0 0 65px;font-size: 10px; color: #000000; }
#encabezado2 .fila2 #col_2 #span52{margin:6px 0 0 50px;font-size: 10px; color: #000000; }


-->
</style>

<!-- page define la hoja con los márgenes señalados -->
<page backtop="40mm" backbottom="10mm" backleft="10mm" backright="20mm">
    <!-- Define el header de la hoja -->
	<?php
		if($membrete == 'true'){
		?>
    <page_header> 
		<table id="encabezado">
            <tr class="fila">
                <td id="col_1" >
					<span id="span2">
						<img src="../../img/logo2.png"/>
					</span>
				</td>
                <td id="col_2">
					<span id="span1">LABORATORIOS DE ANALISIS CLINICOS ESPINOSA</span>
					<br>
					<span id="span2">Suc. Centro, Calle Hidalgo No. 9 Int 1-A Tel. (469) 692 08 75 Pénjamo. Gto.</span>
					<br>
					<span id="span3">Suc. Arboledas, Prol. Insurgentes No. 100 Tel.(469) 692 21 95 Pénjamo. Gto.</span>
					<br>
					<span id="span4">Universidad de Guanajuato Ced. Profesional 1888051 SSA 1931</span>
					<br>
					<span id="span5">Instituto de Hemopatología Ced. Especialidad 5554071 SSA Esp. 4564</span>
				</td>
            </tr>
        </table>
    </page_header>
	<?php
		}
		else{
	?>
	<page_header> 
		<table id="encabezado2">
            <tr class="fila2">
                <td id="col_12" >
					<span id="span22">
						<!--img src="../../img/logo2.png"/-->
					</span>
				</td>
                <td id="col_22">
					<span id="span12"></span>
					<br>
					<span id="span22"></span>
					<br>
					<span id="span32"></span>
					<br>
					<span id="span42"></span>
					<br>
					<span id="span52"></span>
				</td>
            </tr>
        </table>
    </page_header>
	<?php
		}
	?>

    <!-- Fin del cuerpo de la hoja -->

	<page_footer> <!-- Define el footer de la hoja -->
		<table id="footer">
			<tr id="atte">
				<td>
					Atentamente
				</td>
			</tr>
			<tr id="atte">
				<td>
					Q. F. B. Fabiola Espinosa Bribiesca ________________________________
				</td>
			</tr>
            <tr class="fila">
				<td>
					<span>Pénjamo, Gto. <?php echo $fechaAct; ?></span>
				</td>
			</tr>
        </table>
    </page_footer>

        

    
    <!-- Define el cuerpo de la hoja -->
	<?php
		foreach( $array_restored_from_db as $c){

			$sql = "SELECT  p.nombre AS paciente, m.nombre AS medico, a.fecha as fecha
						FROM analisis AS a 
						JOIN pacientes AS p 
						ON a.pacientes_idpacientes = p.idpacientes
						JOIN medicos m
						ON a.medicos_idmedicos = m.idmedicos
						WHERE a.idpropio = '$c'
						ORDER BY a.estudio;";

					
				$query = $con -> query($sql);
			}
		while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
			$nombreMedico = $row['medico'];
			$nombrePaciente = $row['paciente'];
			$fecha = $row['fecha'];
		}
	?>


	<table id="paciente">
		<tr>
			<td>
				<span>Examen practicado a: <?php echo $nombrePaciente;?></span>
			</td>
		</tr>
		<tr>
			<td>
				<span>Practicado por el médico: <?php echo $nombreMedico;?></span>
			</td>
		</tr>
		<tr>
			<td>
				<span>Fecha de aplicación: <?php echo $fecha;?></span>
			</td>
		</tr>
	</table>


	
	<table id="central">
		<tr>
			<td >
				<table id="datos">
					<tr class="fila">
						<td style="width:300px">
							Prueba
						</td>
						<td style="width:90px">
							Resultados
						</td>
						<td style="width:100px">
							Unidades
						</td>
						<td style="width:120px">
							Valor de Referencia
						</td>
					</tr>
				</table>
			</td>
		</tr>
				<?php
					foreach( $array_restored_from_db as $c){

						$sql = "SELECT  a.prueba, a.resultados, a.unidades, a.valorreferencia, a.comentario, a.subtitulo, a.estudio
									FROM analisis AS a 
									JOIN pacientes AS p 
									ON a.pacientes_idpacientes = p.idpacientes
									JOIN medicos m
									ON a.medicos_idmedicos = m.idmedicos
									WHERE a.idpropio = '$c'
									ORDER BY a.estudio;";	
						$query = $con -> query($sql);
					}

					while($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
        					{
								$observaciones = $row['comentario'];
								

?>
<?php									
									
							
																
								
				?>
						<tr>
							<td>
								<?php
							
									if($estudio != $row['estudio']){
											$estudio = $row['estudio'];
											echo "<b><u>".$estudio."</u></b>"."<br>";
										}	
							
									if($subtitulo != $row['subtitulo']){
										$subtitulo = $row['subtitulo'];
										echo "<div align='center'><b>".$row['subtitulo']."</b></div>";
									}
								?>
								<table id="datos">
									<tr>
										<td style="width:300px; font-size:10px;">
											<?php 	
													$pru = $row['prueba'];
													//$prueba = wordwrap($pru, 10, "\n");
													echo $pru;		
											?>
										</td>
										<td style="width:90px; font-size:10px;">
											<?php
													$res = $row['resultados'];
												 	//$resultados = wordwrap($res, 10, "\n");
													echo $res;		
											?>
										</td>
										<td style="width:100px; font-size:10px;">
											<?php 	
													$uni = $row['unidades'];
													//$unidades = wordwrap($uni, 10, "\n") ;
													echo $uni;
											?>
										</td>
										<td style="width:120px; font-size:10px;">
											<?php 	
													$val = $row['valorreferencia'];
													//$valorref = wordwrap($val, 3, true);
													echo "$val ";
											?>
										</td>						
									</tr>
								</table>
							</td>
						</tr>
				<?php
							
							
							} 
				?>

				<table id="line">
					<tr>
						<td></td>
					</tr>
				</table>
				<table>
					<tr>
						<td style="font-size:10px;">
							Observaciones: <?php echo $observaciones;?>
						</td>
					</tr>
	</table>		
	</table>
	


</page>




<?php
	}
?>