<html lang="es" dir="LTR" >
<head>
		
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title>Contrato en Chile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Contrato en Chile">
        <meta name="keywords" content="Contrato en Chile">
        <meta name="author" content="Juan Retamales">
        <link rel="shortcut icon" href="./imagenes/icon/256.png">
	
	<LINK href="../../../estilos/banner.css" rel="stylesheet" type="text/css">
	
	<LINK href="../../../estilos/formulario.css" rel="stylesheet" type="text/css">
	<LINK href="../../../estilos/menu.css" rel="stylesheet" type="text/css">
	<LINK href="../../../estilos/menu-admin.css" rel="stylesheet" type="text/css">
	<LINK href="../../../estilos/normal.css" rel="stylesheet" type="text/css">
	<LINK href="../../../estilos/radiobutton.css" rel="stylesheet" type="text/css">
	<LINK href="../../../estilos/servicios.css" rel="stylesheet" type="text/css">
	<LINK href="../../../estilos/footer.css" rel="stylesheet" type="text/css">
	<LINK href="../../../estilos/tablas.css" rel="stylesheet" type="text/css">
	
	<script src="../../../script/jquery-1.11.0.min.js"></script>
	<script src="../../../script/holder.js"></script>
	<script src="../../../script/sortable.js"></script>
	<script src="../../../script/Chart.min.js"></script>
	<script>
	var respuesta="";
function validar()
{
	var mensaje="";
	if($('#txtPassword').val()!=$('#txtRepassword').val())
	{
		mensaje="Las contraseñas no coinciden";
	}
	if($('#txtNombre').val().length<=0)
	{
		mensaje="Debe completar el nombre";
	}
	if($('#txtRut').val().length<=0)
	{
		mensaje="Debe completar el rut";
	}
	if($('#txtDv').val().length!=1)
	{
		mensaje="Debe completar el digito verificador";
	}
	if($('#txtRut').val().length>0)
	{
		validarRut();
		if(respuesta!="")
		{
			mensaje=respuesta;
		}
		
	}
	if($('#txtEmail').val().length<=1)
	{
		mensaje="Debe completar el email";
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

function validarRut()
{
	$.ajax({
		data:  {"validarRut" : 3, "rut": $('#txtRut').val()+"-"+$('#txtDv').val()},
		url:   '../../script/transicion.php',
		type:  'post',
		success:  function (response) {
			if(response==0)
			{
				respuesta="";
			}
			else
			{
				respuesta="Ya existe un rut registrado";
			}
		}
	});
	//return "erro de conexion";
}
</script>
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
			<section id="contenido">
	<form action="../../../script/transicion.php" onsubmit="return validar()" method="post" class="formulario" id="usuario">
		<strong>Registrar un Moderador</strong><br>
		<div>
			<label>Rut:</label>
			<input required x-moz-errormessage="Debe ingresar el rut sin puntos ni digito verificador" id="txtRut" name="txtRut" type="text" size="10">-
			<input required x-moz-errormessage="Debe ingresar el digito verificador del rut" id="txtDv" name="txtDv" type="text" size="1">Sin puntos
		</div>
		<div>
			<label>Nombre:</label>
			<input required x-moz-errormessage="Debe ingresar el/los nombres" id="txtNombre" name="txtNombre" type="text">
		</div>
		<div>
			<label>Email:</label>
			<input required x-moz-errormessage="Debe ingresar el email" id="txtEmail" name="txtNombre" type="mail">
		</div>
		<div>
			<label>Contraseña:</label>
			<input required x-moz-errormessage="Ingrese una contraseña" type="password" id="txtPassword" name="txtPassword">
		</div>
		<div>
			<label>RE-Contraseña:</label>
			<input required x-moz-errormessage="Ingrese nuevamente la contraseña" type="password" id="txtRepassword" name="txtRepassword">
		</div>
		<div>
			<img title="Captcha" src="../../../script/captcha/captcha.php" />
			<input required x-moz-errormessage="Ingrese el texto de la imagen." type="text" size="16" id="captcha" name="captcha" title="Ingrese el texto de la imagen." placeholder="Ingrese el texto de la imagen." />
		</div>
		<div>
			<label style="width: 400px;" for="txtCondicion">Estoy de acuerdo con los <a>Términos y Condiciones</a></label>
			<input id="txtCondicion" type="checkbox" required x-moz-errormessage="Debe aceptar los terminos y condiciones" />
		</div>
		<div>
		<br>
			<input type="submit" name="btnRegistrarModerador" value="Registrar">
		</div>
	</form>
</section>
		</section>
		<?php cc_footer(); ?>
</body>
</html>