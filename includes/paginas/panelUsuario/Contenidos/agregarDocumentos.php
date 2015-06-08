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
	<form class="formulario" onsubmit="return agregarDocumento()" method="post">		<div id="error"></div>
				<h1 class="titulo2">Añadir nuevo Documento</h1>
				<?php
					require_once "script/webConfig.php";
					$page=explode("/",$pagina);
					$back="administracion/documentos";
				?>
				<div>
					<label>Nombre</label>
					<input required x-moz-errormessage="Debe ingresar el nombre del Documento" type="text" id="txtNombre" name="txtNombre" maxlength="255">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgNombre">
				</div>
				<div>
					<label>Tipo del documento</label>
					<select required x-moz-errormessage="Debe seleccionar un Tipo" id="txtTipodoc" name="txtTipodoc">
					<option value="" disabled selected></option>
					<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$td=listarTipodoc($arg);
							for($i=0;$i<count($td);$i++)
							{
								?>
						<option value="<?php echo $td [$i] ['id_td']; ?>"><?php echo $td [$i] ['nom_td']; ?></option>
					<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgTipodoc">
				</div>
				<div>
					<label>Url</label>
					<input required x-moz-errormessage="Debe ingresar el nombre del Documento" type="text" id="txtUrl" name="txtUrl" maxlength="255">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgUrl">
				</div>
				<div>
					<input type="submit" value="añadir">
				</div>
				<a href="<?php echo WEB_BASE.$back; ?>">Cancelar</a>
	</form>
</section>


	<?php cc_footer(); ?>
</body>
</html>