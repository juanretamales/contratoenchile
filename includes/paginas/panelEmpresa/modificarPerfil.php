<html lang="es" dir="LTR" >
<head>
		
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title>Contrato en Chile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Contrato en Chile">
        <meta name="keywords" content="Contrato en Chile">
        <meta name="author" content="Juan Retamales">
        <link rel="shortcut icon" href="./imagenes/icon/256.png">
	
	<LINK href="../../estilos/banner.css" rel="stylesheet" type="text/css">
	
	<LINK href="../../estilos/formulario.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/menu.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/menu-admin.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/normal.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/radiobutton.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/servicios.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/footer.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/tablas.css" rel="stylesheet" type="text/css">
	
	<script src="../../script/jquery-1.11.0.min.js"></script>
	<script src="../../script/holder.js"></script>
	<script src="../../script/sortable.js"></script>
	<script src="../../script/Chart.min.js"></script>
	<script src="../../script/formulario.js"></script>
</head>
<body>
	<?php cc_header(); ?>
	<section>
		<?php 
			$pagina="";
if(isset($_REQUEST['pagina']))
{
	$pagina=$_REQUEST['pagina'];
}
			cc_menu($pagina); ?>
	</section>
	<section id="contenido">

			<h1 class="titulo">Modificar Perfil</h1>
	<form action="script/negocios.php" method="post" class="formulario" id="empresa">
		<div>
		<?php
			$arg= array('rut'=>$_SESSION['rut']);
			$persona=listarPersona($arg);
			//print_r($arg);
		?>	
			<label>Rut: <?php echo $persona[0]['rut']; ?></label>
		</div>
		<div>
			<label>Nombre:</label>
			<input required x-moz-errormessage="Debe ingresar el/los nombres" id="txtNombre" name="txtNombre" value="<?php echo $persona[0]['nombre']; ?>" onchange="validarFormularioPersona()" maxlength="255"  type="text">
			<img src="http://www.contratoenchile.cl/imagenes/none.png" id="imgNombre">
		</div>
		<div>
			<label>Apellido:</label>
			<input required x-moz-errormessage="Debe ingresar el/los apellidos" id="txtApellido" value="<?php echo $persona[0]['apellido']; ?>" onchange="validarFormularioPersona()"  maxlength="255" name="txtApellido" type="text"><br>
			<img src="http://www.contratoenchile.cl/imagenes/none.png" id="imgApellido">
		</div>
		<div>
			<label>fecha de nacimiento:</label>
			<input required value="<?php echo $persona[0]['fecha_nac']; ?>" x-moz-errormessage="Debe ingresar un telefono de contacto" id="txtFecha" name="txtFecha" type="date">
			<img src="http://www.contratoenchile.cl/imagenes/none.png" id="imgFecha">
			<br>
		</div>
		<div>
			<label>Telefono:</label>
			<input required value="<?php echo $persona[0]['tel_per']; ?>" x-moz-errormessage="Debe ingresar un telefono de contacto" id="txtTelefono" name="txtTelefono" type="phone">
			<img src="http://www.contratoenchile.cl/imagenes/none.png" id="imgTelefono">
		</div>
		<div>
					<label>Seleccione el pais</label>
					<select required x-moz-errormessage="Debe seleccionar un pais" id="txtPais" name="txtPais">
					<option value="" disabled selected></option>
					<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$paises=listarPais($arg);
							for($i=0;$i<count($paises);$i++)
							{
								?>
					<option value="<?php echo $paises [$i] ['id_pais']; ?>"><?php echo $paises [$i] ['nom_pais']; ?></option>
				<?php } ?>
					</select>
				</div>
		<div>
					<label>Seleccione la region</label>
					<select required x-moz-errormessage="Debe seleccionar una region" id="txtRegion" name="txtRegion">
					<option value="" disabled selected></option>
					<?php
							$arg=array ('nada'=>0);
							$reg=listarRegion($arg);
							for($i=0;$i<count($reg);$i++)
							{
								?>
					<option class="reg<?php echo $reg [$i] ['id_pais']; ?> region" value="<?php echo $reg [$i] ['id_reg']; ?>"><?php echo $reg [$i] ['nom_reg']; ?></option>
				<?php } ?>
					</select>
					<img src="http://www.contratoenchile.cl/imagenes/none.png" id="imgPais">
				</div>
		<div>
					<label>Seleccione la provincia</label>
					<select required x-moz-errormessage="Debe seleccionar un pais" id="txtProvincia" name="txtProvincia">
					<option value=""  selected></option>
					<?php
							$arg=array ('nada'=>0);
							$prov=listarProvincia($arg);
							for($i=0;$i<count($prov);$i++)
							{
								?>
					<option class="prov<?php echo $prov [$i] ['id_reg']; ?> provincia" value="<?php echo $prov [$i] ['id_prov']; ?>"><?php echo $prov [$i] ['nom_prov']; ?></option>
				<?php } ?>
					</select>
					<img src="http://www.contratoenchile.cl/imagenes/none.png" id="imgProvincia">
				</div>
		<div>
					<label>Seleccione la comuna</label>
					<select required x-moz-errormessage="Debe seleccionar un pais" id="txtComuna" name="txtComuna">
					<option value="" disabled selected></option>
					<?php
							$arg=array ('nada'=>0);
							$com=listarComuna($arg);
							for($i=0;$i<count($com);$i++)
							{
								?>
					<option class="com<?php echo $com [$i] ['id_prov']; ?> comuna" value="<?php echo $com [$i] ['id_com']; ?>"><?php echo $com [$i] ['nom_com']; ?></option>
				<?php } ?>
					</select>
					<img src="http://www.contratoenchile.cl/imagenes/none.png" id="imgComuna">
				</div>
		<div>
			<label>Direccion</label>
			<input required value="<?php echo $persona[0]['direccion']; ?>" x-moz-errormessage="Debe ingresar su direccion"  maxlength="255" id="txtDireccion" name="txtDireccion" type="text">
			<img src="http://www.contratoenchile.cl/imagenes/none.png" id="imgDireccion">
		</div>
		<div>
			<img title="Captcha" src="../../script/captcha/captcha.php" />
			<input required x-moz-errormessage="Ingrese el texto de la imagen." type="text" maxlength="255"  size="16" id="captcha"  name="captcha" title="Ingrese el texto de la imagen." placeholder="Ingrese el texto de la imagen." />
		</div>
		<div>
		<br>
			<input type="submit" name="btnRegistrarEmpresa" value="Registrar">
		</div>
	</form>
</section>

	<?php cc_footer(); ?>
</body>
</html>
