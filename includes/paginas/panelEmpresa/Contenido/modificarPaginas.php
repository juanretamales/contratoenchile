<html lang="es" dir="LTR" >
<head>
		
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title>Contrato en Chile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Contrato en Chile">
        <meta name="keywords" content="Contrato en Chile">
        <meta name="author" content="Juan Retamales">
        <link rel="shortcut icon" href="../../../imagenes/icon/256.png">
	
	<LINK href="../../../estilos/banner.css" rel="stylesheet" type="text/css">
	
	<LINK href="../../../estilos/formulario.css" rel="stylesheet" type="text/css">
	<LINK href="../../../estilos/menu.css" rel="stylesheet" type="text/css">
	<LINK href="../../../estilos/menu-admin.css" rel="stylesheet" type="text/css">
	<LINK href="../../../estilos/normal.css" rel="stylesheet" type="text/css">
	<LINK href="../../../estilos/radiobutton.css" rel="stylesheet" type="text/css">
	<LINK href="../../../estilos/servicios.css" rel="stylesheet" type="text/css">
	<LINK href="../../../estilos/footer.css" rel="stylesheet" type="text/css">
	<LINK href="../../../estilos/tablas.css" rel="stylesheet" type="text/css">
	
	<script src="../../../script/jquery-1.11.0.min.js"></script>
	<script src="../../../script/holder.js"></script>
	<script src="../../../script/sortable.js"></script>
	<script src="../../../script/Chart.min.js"></script>
	<script src="../../../script/formulario.js"></script>
</head>
<body>
<?php cc_header(); ?>
		<section>
			<?php cc_menu($pagina); ?>
			<section id="contenido">
				<form action="../../../script/transicion.php" onsubmit="return validar()" method="post" class="formulario" id="usuario">
				<p>Modificar Pagina</p>
				<?php
					if(isset($_POST["txtCode"]))
					{
					 echo '<input type="hidden" id="txtCode" name="txtCode" value="'.$_POST["txtCode"].'">';
					}
					else
					{
						echo '<script language="javascript">window.location="http://www.contratoenchile.cl"</script>';
					}
					require_once('script/function.php');
					$arg=array ('id_pag'=>$_POST["txtCode"]);
					$pag=listarPagina($arg);
				?>
				<div>
					<label>Nombre de la Pagina</label>
					<input value="<?php echo $pag [0] ['nom_pag']; ?>" required x-moz-errormessage="Debe ingresar el nombre de la Pagina" type="text" name="txtNombre" required maxlength="255">
					<img src="http://www.contratoenchile.cl/imagenes/none.png" id="imgNombre">
				</div>
				<div>
					<label>Tipo de la pagina</label>
					<select required x-moz-errormessage="Debe seleccionar un Tipo" name="txtTp" required>
					<option value="" disabled selected></option>
					<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$tipo=listarTipopagina($arg);
							for($i=0;$i<count($tipo);$i++)
							{
								?>
					<option <?php if($pag [0] ['id_tp']==$tipo [$i] ['id_tp'])
								{
									echo " selected ";
								}?> value="<?php echo $tipo [$i] ['id_tp']; ?>"><?php echo $tipo [$i] ['nom_tp']; ?></option>
				<?php } ?>
					</select>
					<img src="http://www.contratoenchile.cl/imagenes/none.png" id="imgTp">
				</div>
				<div>
					<label>Url de la Pagina</label>
					<input value="<?php echo $pag [0] ['url_pag']; ?>"  required x-moz-errormessage="Debe ingresar el Url de la Pagina" type="text" name="txtUrlFicticio" maxlength="255">
					<img src="http://www.contratoenchile.cl/imagenes/none.png" id="imgUrlFicticio">
				</div>
				<div>
					<label>Direccion del archivo</label>
					<input  value="<?php echo $pag [0] ['url_real']; ?>" required x-moz-errormessage="Debe ingresar la direccion del archivo a cargar" type="text" name="txtUrlReal" maxlength="255">
					<img src="http://www.contratoenchile.cl/imagenes/none.png" id="imgUrlReal">
				</div>
				<div>
					<input type="submit" name="btnModificarPagina" value="Modificar">
				</div>
				<a href="http://www.contratoenchile.cl/administracion/contenido/pagina">Cancelar</a>
				</form>
			</section>
		</section>
		<?php cc_footer(); ?>
</body>
</html>