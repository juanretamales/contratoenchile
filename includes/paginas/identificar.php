<html lang="es" dir="LTR" >
<head>
	<?php cc_head(); ?>
</head>
<body>
<?php cc_header(); ?>
		<section>
			<?php 
			if(isset($_REQUEST['pagina']))
			{
				cc_menu($_REQUEST['pagina']); 
			}
			else
			{
				cc_menu(""); 
			}
			
			?>
		</section>
			<section id="contenido">
				<form class="formulario" onsubmit="return validarFormularioLogin()" method="post">
				<div id="error"></div>
					<div>
						<label>Rut:</label>
						<input placeholder="Rut" type="text" x-moz-errormessage="El rut esta incompleto." maxlength="255" title="Rut" required  name="txtRut" class="inputTexto" id="txtRut" maxlength="70"><br>
					</div>
					<div>
						<label>Contraseña:</label>
						<input x-moz-errormessage="Por favor ingrese la contraseña" maxlength="255" id="txtContrasena"  name="txtContrasena" required type="password" placeholder="Contraseña"><br>
					</div>
					<div>
						
						<img title="Captcha" id="Captcha" src="<?php echo WEB_BASE; ?>script/captcha/captcha.php" />
					</div>
					<div>
						<label title="Copie el texto de la imagen">Captcha:</label>
						<input required x-moz-errormessage="Por favor ingrese el texto de la imagen." maxlength="255"  type="text" size="16" id="txtCaptcha" name="txtCaptcha" title="Ingrese el texto de la imagen." placeholder="Ingrese el texto de la imagen." /><br>
					</div>
					<div>
						<input type="submit" name="btnIdentificar" value="identificarme">
					</div>
					<a href="<?php echo WEB_BASE; ?>recuperar-contrasena">Recuperar contraseña<a/>
				</form>
			</section>
		<?php cc_footer(); ?>
</body>
</html>