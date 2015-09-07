<html lang="es" dir="LTR" >
<head>
	<?php cc_head();
		require_once "script/webConfig.php";
		$arg=array ('rut'=>$_SESSION['rut']);
		$empresas=listarEntidadPorPersona($arg);
		if(count($empesas)>=MAX_EMPRESAS)
		{
			echo '<script language="javascript">window.location="'.WEB_BASE.'"</script>';
		}
	?>
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

			<h1 class="titulo">Registro de Empresas</h1>
	<form onsubmit="return agregarEmpresa()" class="formulario" id="empresa">
		<div>
			<label>Rut:</label>
			<input required x-moz-errormessage="Debe ingresar el rut sin puntos ni digito verificador"  maxlength="255" id="txtRut" name="txtRut" type="text" size="15">
		</div>
		<div>
			<label>Nombre:</label>
			<input required x-moz-errormessage="Debe ingresar el/los nombres" id="txtNombre" maxlength="255"  name="txtNombre" type="text">
		</div>
		<div>
			<label>Descripcion:</label>
			<input required x-moz-errormessage="Debe ingresar una descripcion de la empresa"  maxlength="255" id="txtDescripcion" name="txtDescripcion" type="text">
		</div>
		<div>
			<label>Telefono:</label>
			<input required x-moz-errormessage="Debe ingresar un telefono de contacto"  maxlength="255" id="txtTelefono" name="txtTelefono" type="phone">
		</div>
		<div>
			<label>Email:</label>
			<input required x-moz-errormessage="Debe ingresar un telefono de contacto"  maxlength="255" id="txtEmail" name="txtEmail" type="email">
		</div>
		<div>
			<img title="Captcha" id="Captcha" src="<?php echo WEB_BASE; ?>script/captcha/captcha.php" />
			<input required x-moz-errormessage="Ingrese el texto de la imagen." type="text" maxlength="255"  size="16" id="captcha"  name="captcha" title="Ingrese el texto de la imagen." placeholder="Ingrese el texto de la imagen." />
		</div>
		<div>
			<label style="width: 400px;" for="txtCondicion">Estoy de acuerdo con los <a  href="<?php echo WEB_BASE;?>terminos_y_condicionesterminos_y_condiciones">Términos y Condiciones</a></label>
			<input id="txtCondicion" type="checkbox" required x-moz-errormessage="Debe aceptar los terminos y condiciones" />
		</div>
		<div>
			<input class="boton submit" type="submit" value="Registrar">
			<a class="boton cancel" href="<?php echo WEB_BASE;?>">Cancelar</a>
		</div>
	</form>
</section>

	<?php cc_footer(); ?>
</body>
</html>
