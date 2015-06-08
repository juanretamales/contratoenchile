<html lang="es" dir="LTR" >
<head>
		
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title>Contrato en Chile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Contrato en Chile">
        <meta name="keywords" content="Contrato en Chile">
        <meta name="author" content="Juan Retamales">
        <link rel="shortcut icon" href="./imagenes/icon/256.png">
	
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
	<script>
function eliminar(id, nombre)
{
	if(confirm('Desea eliminar la region '+nombre))
	{
		$.ajax({
                data:  {"txtReg" : id, "btnEliminarProvincia" : "Eliminar"},
                url:   'script/transicion.php',
                type:  'post',
                success:  function (response) {
                        location.reload();
                }
        });
	}
}
</script>
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
	<section id="contenido" >
	<form class="formulario" action="../../../script/transicion.php"  method="post">
				<p>Añadir nueva Pagina</p>
				<div>
					<label>Nombre de la Pagina</label>
					<input required x-moz-errormessage="Debe ingresar el nombre de la Pagina" type="text" name="txtNombre" required maxlength="255">
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
					<option value="<?php echo $tipo [$i] ['id_tp']; ?>"><?php echo $tipo [$i] ['nom_tp']; ?></option>
				<?php } ?>
					</select>
				</div>
				<div>
					<label>Url de la Pagina</label>
					<input required x-moz-errormessage="Debe ingresar el Url de la Pagina" type="text" name="txtUrlFicticio" maxlength="255">
				</div>
				<div>
					<label>Direccion del archivo</label>
					<input required x-moz-errormessage="Debe ingresar la direccion del archivo a cargar" type="text" name="txtUrlReal" maxlength="255">
				</div>
				<div>
					<input type="submit" name="btnRegistrarPagina" value="Añadir Pagina">
				</div>
				<a href="http://www.contratoenchile.cl/administracion/contenido/pagina">Cancelar</a>
	</form>
</section>


	<?php cc_footer(); ?>
</body>
</html>