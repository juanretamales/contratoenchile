<html lang="es" dir="LTR" >
<head>
	<?php cc_head(); ?>
</head>
<body>
<?php cc_header(); ?>
		<section>
			<?php cc_menu($pagina); ?>
			<section id="contenido">
			<?php
			$pagina="";
			if(isset($_REQUEST['pagina']))
			{
				$pagina=$_REQUEST['pagina'];
			}
			$page=explode("/",$pagina);
			if(isset($page[1]) && $page[0]=='registrar')
			{
				
			?>
				
				<form class="formulario" onsubmit="return modificarContrasena()" method="post">
		<div id="error"></div>
					<p>Se envio un correo su email e ingrese el codigo o acceda al enlace enviado</p>
					<div>
						<label>Ingrese el Codigo</label>
						<input type="text" required x-moz-errormessage="Debe ingresar el codigo" value="<?php echo $page[1]; ?>" id="txtCode" name="txtCode">
						<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgCode">
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
						<input type="submit" value="Cambiar">
					</div>
				</form>
			<?php
			}
			else
			{
			?>
				<form onsubmit="return recuperarContrasena()" method="post" class="formulario" id="usuario">
				<div id="error"></div>
					<h1 class="titulo2">Recuperar contraseña</h1>
					<div>
						<label>Rut: </label>
						<input required value="" x-moz-errormessage="Debe ingresar el rut" readonly maxlength="255" id="txtRut" name="txtRut"  type="text">
						<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgRut">
					</div>
					<div>
						<label>Email:</label>
						<input value="" required x-moz-errormessage="Debe ingresar el email" id="txtEmail"  maxlength="255" name="txtEmail" type="mail"><br>
						<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgEmail">
					</div>
					<div>
						<img title="Captcha" id="Captcha" src="<?php echo WEB_BASE; ?>script/captcha/captcha.php" />
					</div>
					<div>
						<label>Captcha:</label>
						<input required x-moz-errormessage="Ingrese el texto de la imagen." type="text" maxlength="255"  size="16" id="txtCaptcha"  name="txtCaptcha" title="Ingrese el texto de la imagen." placeholder="Ingrese el texto de la imagen." />
						<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgCaptcha">
					</div>
					<div>
						<label style="width: 400px;" for="txtCondicion">Estoy de acuerdo con los <a>Terminos y Condiciones</a></label>
						<input id="txtCondicion" type="checkbox" required x-moz-errormessage="Debe aceptar los terminos y condiciones" />
					</div>
					<div>
						<input type="submit" value="Recuperar">
					</div>
				</form>
				<?php } ?>
			</section>
		</section>
		<?php cc_footer(); ?>
</body>
</html>