<?php
	$pagina="";
	if(isset($_REQUEST['pagina']))
	{
		$pagina=$_REQUEST['pagina'];
	}
?>
<html lang="es" dir="LTR" >
<head>
	<?php cc_head(); ?>
</head>
<body>
		<?php cc_header(); ?>
			<?php cc_menu($pagina); ?>
		<section id="contenido">
			<?php
			$page=explode("/",$pagina);
			if(isset($page[1]) && $page[0]=='registrar')
			{
				
			?>
				<form class="formulario" onsubmit="return verificarCodigo()" action="<?php echo WEB_BASE; ?>registrar-paso3" method="post">
		<div id="error"></div>
					<h1 class="titulo2">Registro paso 2</h1>
					<p>Se envio un correo su email e ingrese el codigo o acceda al enlace enviado</p>
					<div>
						<label>Ingrese el Codigo</label>
						<input type="text" required x-moz-errormessage="Debe ingresar el codigo" value="<?php echo $page[1]; ?>" id="txtCode" name="txtCode">
					</div>
					<div>
							<input class="boton submit" type="submit" value="Verificar codigo">
						</div>
				</form>
			<?php
			}
			else
			{
			?>
				<form class="formulario" onsubmit="return registrarse()">
				<div id="error"></div>
				<h1 class="titulo2">Registro paso 1</h1>
				<div>
					<label>Email:</label>
					<input required x-moz-errormessage="Debe ingresar un correo" id="txtEmail" name="txtEmail" type="email" maxlength="255">
				</div>
				<div>
					<label>Reescriba el Email:</label>
					<input required x-moz-errormessage="Debe ingresar el mismo correo" id="txtReEmail" name="txtReEmail" type="email" maxlength="255">
				</div>
				<div>
					<img title="Captcha" onclick="actualizarCaptcha()" id="Captcha" src="<?php echo WEB_BASE; ?>script/captcha/captcha.php" />
				</div>
				<div>
					<label title="Copie el texto de la imagen">Captcha:</label>
					<input required x-moz-errormessage="Por favor ingrese el texto de la imagen." maxlength="255"  type="text" size="16" id="txtCaptcha" name="txtCaptcha" title="Ingrese el texto de la imagen." placeholder="Ingrese el texto de la imagen." /><br>
				</div>
				<div>
					<label><a href="<?php echo WEB_BASE; ?>terminos_y_condiciones">He leido y acepto los terminos y condiciones</a><label>
				</div>
				<div>
					<input class="boton submit" type="submit" value="Enviar Correo">
					<a class="boton cancel" href="<?php echo WEB_BASE;?>">Cancelar</a>
				</div>
			</form>
			<?php } ?>
		</section>
		<?php cc_footer(); ?>
</body>
</html>
