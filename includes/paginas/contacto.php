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
			<form class="formulario" onsubmit="return enviarCorreo()" method="post">		<div id="error"></div>
				<h1 class="titulo2">Contacto</h1>
				<div>
					<label>Nombre y apellidos</label>
					<input required x-moz-errormessage="Debe ingresar su nombre" type="text" id="txtNombre" name="txtNombre" maxlength="255">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgNombre">
				</div>
				<div>
					<label>Email:</label>
					<input required x-moz-errormessage="Debe ingresar un correo" id="txtEmail" name="txtEmail" type="email" maxlength="255">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgEmail">
				</div>
				<div>
					<label>Mensaje</label>
					<textarea rows="4" cols="22" required x-moz-errormessage="Debe ingresar el mensaje" id="txtMensaje" name="txtMensaje" maxlength="255"></textarea>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgMensaje">
				</div>
				<div>
					<img title="Captcha" id="Captcha" src="<?php echo WEB_BASE; ?>script/captcha/captcha.php" />
				</div>
				<div>
					<label>Ingrese el texto de la imagen:</label>
					<input required x-moz-errormessage="Debe ingresar el texto de la imagen" type="text" size="16" id="txtCaptcha" name="txtCaptcha"  maxlength="255" title="Ingrese el texto de la imagen." placeholder="Ingrese el texto de la imagen." /><br>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgCaptcha">
				</div>
				<div>
					<input type="submit" value="Contactar">
				</div>
				<a href="<?php echo WEB_BASE; ?>">Cancelar</a>
			</form>
		</section>
		<?php cc_footer(); ?>
	</body>
</html>