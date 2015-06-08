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
	
	<script src="../../script/jquery-1.11.0.min.js"></script>
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
				<p>Añadir nuevo Documento</p>
				<div>
					<label>Nombre del Documento</label>
					<input required x-moz-errormessage="Debe ingresar el nombre del Documento" type="text" name="txtNombre" maxlength="255">
				</div>
				<div>
					<label>Tipo del documento</label>
					<select required x-moz-errormessage="Debe seleccionar un Tipo" name="txtTipodoc">
					<option value="" disabled selected></option>
					<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$paises=listarPaises($arg);
							for($i=0;$i<count($paises);$i++)
							{
								?>
					<option value="<?php echo $paises [$i] ['id_pais']; ?>"><?php echo $paises [$i] ['nom_pais']; ?></option>
				<?php } ?>
				</div>
				<div>
					<label>Empresa</label>
					<select required x-moz-errormessage="Debe seleccionar una empresa" name="txtEmpresa">
					<option value="" disabled selected></option>
					<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$paises=listarPaises($arg);
							for($i=0;$i<count($paises);$i++)
							{
								?>
					<option value="<?php echo $paises [$i] ['id_pais']; ?>"><?php echo $paises [$i] ['nom_pais']; ?></option>
				<?php } ?>
				</div>
				<div>
					<input type="submit" name="btnRegistrarDocumento" value="Añadir Tipo de Multimedia">
				</div>
				<a href="index.php?pagina=panel&subpagina=Tipomedia">Cancelar</a>
	</form>
</section>


	<?php cc_footer(); ?>
</body>
</html>