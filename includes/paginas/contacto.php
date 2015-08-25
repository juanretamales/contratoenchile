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
		<section id="contenido" >			<h1 class="titulo">Ayuda - Enviar Correo a soporte</h1>
			<form class="formulario" onsubmit="return enviarCorreo()" method="post">		<div id="error"></div>
				
				<div>
					<label>Nombre y apellidos</label>
					<input required x-moz-errormessage="Debe ingresar su nombre" type="text" id="txtNombre" name="txtNombre" maxlength="255">
				</div>
				<div>
					<label>Email:</label>
					<input required x-moz-errormessage="Debe ingresar un correo" id="txtEmail" name="txtEmail" type="email" maxlength="255">
				</div>
				<div>
					<label>Mensaje</label>
					<textarea rows="4" cols="22" required x-moz-errormessage="Debe ingresar el mensaje" id="txtMensaje" name="txtMensaje" maxlength="255"></textarea>
				</div>
				<div>					<img title="Captcha" onclick="actualizarCaptcha()" id="Captcha" src="<?php echo WEB_BASE; ?>script/captcha/captcha.php" />				</div>				<div>					<label title="Copie el texto de la imagen">Captcha:</label>					<input required x-moz-errormessage="Por favor ingrese el texto de la imagen." maxlength="255"  type="text" size="16" id="txtCaptcha" name="txtCaptcha" title="Ingrese el texto de la imagen." placeholder="Ingrese el texto de la imagen." /><br>				</div>
				<div>					<input class="boton submit" type="submit" value="Enviar Correo">					<a class="boton cancel" href="<?php echo WEB_BASE;?>">Cancelar</a>				</div>
			</form>
		</section>
		<?php cc_footer(); ?>
	</body>
</html>