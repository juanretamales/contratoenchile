<html lang="es" dir="LTR" >
<head>
		
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title>Contrato en Chile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Contrato en Chile">
        <meta name="keywords" content="Contrato en Chile">
        <meta name="author" content="Juan Retamales">
        <link rel="shortcut icon" href="./imagenes/icon/256.png">
	
	<LINK href="../../estilos/banner.css" rel="stylesheet" type="text/css">
	
	<LINK href="../../estilos/formulario.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/menu.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/menu-admin.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/normal.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/radiobutton.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/servicios.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/footer.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/tablas.css" rel="stylesheet" type="text/css">
	
	<script src="../../script/jquery-1.11.0.min.js"></script>
	<script src="../../script/holder.js"></script>
	<script src="../../script/sortable.js"></script>
	<script src="../../script/Chart.min.js"></script>
	<script>
function validar()
{
	var mensaje="";
	if($('#txtPassword').val()!=$('#txtRepassword').val())
	{
		mensaje="Las contraseñas no coinciden";
	}
	if($('#txtPassword').val().length<=6)
	{
		mensaje="Debe ingresar la contraseña mayor a 5 caracteres";
	}
	if($('#captcha').val().length<=0)
	{
		mensaje="Debe ingresar el texto de la imagen";
	}
	if(mensaje!="")
	{
		alert(mensaje);
		return false;
	}
	else
	{
		return true;
	}
}
</script>
<?php
$pagina="";
if(isset($_REQUEST['pagina']))
{
	$pagina=$_REQUEST['pagina'];
}
$page=explode("/",$pagina);
if(isset($page[1]))
{	
	if($page[1]=="")
	{
	echo '<script language="javascript">window.location="'.WEB_BASE.'"</script>;';
	}
}
else
{
echo '<script language="javascript">window.location="'.WEB_BASE.'"</script>;';
}
?>
</head>
<body>
<?php cc_header(); ?>
		<section>
			<?php cc_menu($pagina); ?>
			<section id="contenido">
	<form action="<?php echo WEB_BASE; ?>script/transicion.php" onsubmit="return validar()" method="post" class="formulario" id="usuario">
		<div id="error"></div>
		<strong>Cambio de contraseña</strong><br>
		<input name="txtCodigo" type="hidden"  maxlength="255" value="<?php echo $page[1]; ?>">
		<div>
			<label>Contraseña:</label>
			<input required x-moz-errormessage="Ingrese una contraseña"  maxlength="255" type="password" id="txtPassword" name="txtPassword">
		</div>
		<div>
			<label>RE-Contraseña:</label>
			<input required x-moz-errormessage="Ingrese nuevamente la contraseña"  maxlength="255" type="password" id="txtRepassword" name="txtRepassword">
		</div>
		<div>
			<img title="Captcha" src="../../script/captcha/captcha.php" />
			<input required x-moz-errormessage="Ingrese el texto de la imagen."  maxlength="255" type="text" size="16" id="captcha" name="captcha" title="Ingrese el texto de la imagen." placeholder="Ingrese el texto de la imagen." />
		</div>
		<div>
			<label style="width: 400px;" for="txtCondicion">Estoy de acuerdo con los <a>Términos y Condiciones</a></label>
			<input id="txtCondicion" type="checkbox" required x-moz-errormessage="Debe aceptar los terminos y condiciones" />
		</div>
		<div>
		<br>
			<input type="submit" name="btnCambiarcontrasena" value="Cambiar">
		</div>
	</form>
</section>
		</section>
		<?php cc_footer(); ?>
</body>
</html>