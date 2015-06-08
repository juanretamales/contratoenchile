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
	<form method="post" onsubmit="return modificarContrasena()" class="formulario">
		<div id="error"></div>
		<h1 class="titulo2">Cambiar contraseña</h1>
		<div>
			<label>Antigua Contraseña:</label>
			<input required x-moz-errormessage="Ingrese una contraseña" type="password" maxlength="255"  id="txtOldPassword" name="txtPassword">
			<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgOldPassword">
		</div>
		<div>
			<label>Nueva Contraseña:</label>
			<input required x-moz-errormessage="Ingrese una contraseña" type="password" maxlength="255"  id="txtNewPassword" name="txtNewPassword">
			<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgNewPassword">
		</div>
		<div>
			<label>Nueva RE-Contraseña:</label>
			<input required x-moz-errormessage="Ingrese nuevamente la contraseña" maxlength="255"  type="password" id="txtNewRePassword" name="txtNewRePassword">
			<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgNewRePassword">
		</div>
		<div>
			<img title="Captcha" src="<?php echo WEB_BASE; ?>script/captcha/captcha.php" id="captcha" />
		</div>
		<div>
			<label>Captcha:</label>
			<input required x-moz-errormessage="Ingrese el texto de la imagen." type="text" maxlength="255"  size="16" id="txtCaptcha"  name="captcha" title="Ingrese el texto de la imagen." placeholder="Ingrese el texto de la imagen." />
			<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgCaptcha">
		</div>
		<div>
			<input type="submit" value="Modificar">
		</div>
	</form>
</section>
	<?php cc_footer(); ?>
</body>
</html>
