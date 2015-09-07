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
	<section id="contenido">
	
		<h1 class="titulo">Cambiar contraseña</h1>
	<form method="post" onsubmit="return modificarContrasena()" class="formulario">
		<div>
			<label>Antigua Contraseña:</label>
			<input required x-moz-errormessage="Ingrese una contraseña" type="password" maxlength="255"  id="txtOldPassword" name="txtPassword">
		</div>
		<div>
			<label>Nueva Contraseña:</label>
			<input required x-moz-errormessage="Ingrese una contraseña" type="password" maxlength="255"  id="txtNewPassword" name="txtNewPassword">
		</div>
		<div>
			<label>Nueva RE-Contraseña:</label>
			<input required x-moz-errormessage="Ingrese nuevamente la contraseña" maxlength="255"  type="password" id="txtNewRePassword" name="txtNewRePassword">
		</div>
		<div>
			<img title="Captcha" onclick="actualizarCaptcha()"	 src="<?php echo WEB_BASE; ?>script/captcha/captcha.php" id="captcha" />
		</div>
		<div>
			<label>Captcha:</label>
			<input required x-moz-errormessage="Ingrese el texto de la imagen." type="text" maxlength="255"  size="16" id="txtCaptcha"  name="captcha" title="Ingrese el texto de la imagen." placeholder="Ingrese el texto de la imagen." />
		</div>
		<div>
			<input class="boton submit" type="submit" value="Modificar">
			<a class="boton cancel" href="<?php echo WEB_BASE;?>">Cancelar</a>
		</div>
	</form>
</section>
	<?php cc_footer(); ?>
</body>
</html>
