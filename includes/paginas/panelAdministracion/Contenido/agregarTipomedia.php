<html lang="es" dir="LTR" >
<head>
<?php cc_head(); ?>
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
	<form class="formulario" onsubmit="return agregarTipomedia()" method="post">
	<div id="error"></div>
				<h1 class="titulo2">Añadir tipo de multimedia</h1>
				<div>
					<label>Nombre</label>
					<input required x-moz-errormessage="Debe ingresar el nombre del Tipo de multimedia" type="text" id="txtNombre" name="txtNombre" maxlength="255">
				</div>
				<div>
					<input type="submit" value="Añadir">
				</div>
				<a href="<?php echo WEB_BASE; ?>administracion/contenido/tipomultimedia">Cancelar</a>
	</form>
</section>


	<?php cc_footer(); ?>
</body>
</html>