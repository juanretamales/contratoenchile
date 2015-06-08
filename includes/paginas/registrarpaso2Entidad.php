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
	var respuesta="";
function validar()
{
	var mensaje="";
	if($('#txtPassword').val()!=$('#txtRepassword').val())
	{
		mensaje="Las contraseñas no coinciden";
		//alert(mensaje);
	}
	if($('#txtNombre').val().length<=0)
	{
		mensaje="Debe completar el nombre";
	}
	if($('#txtTelefono').val().length<=0)
	{
		mensaje="Debe completar el nombre";
	}
	if($('#txtRut').val().length<=0)
	{
		mensaje="Debe completar el rut";
	}
	if($('#txtRut').val().length>0)
	{
		validarRut();
		if(respuesta!="")
		{
			mensaje=respuesta;
		}
		
	}
	if($('#txtRut').val().length<=0)
	{
		mensaje="Debe completar el rut";
	}
	if($('#txtDv').val().length!=1)
	{
		mensaje="Debe completar el digito verificador";
	}
	if($('#txtPassword').val().length<=6)
	{
		mensaje="Debe ingresar la contraseña mayor a 5 caracteres";
	}
	if($('#txtDescripcion').val().length<=6)
	{
		mensaje="Debe ingresar la descripcion";
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
		data:  {"validarRut" : 2, "rut": $('#txtRut').val()+"-"+$('#txtDv').val()},
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
			<?php cc_menu($pagina); ?>
			<section id="contenido">
<?php
$pagina="";
if(isset($_REQUEST['pagina']))
{
	$pagina=$_REQUEST['pagina'];
}
$page=explode("/",$pagina);
if(isset($page[2]))
{	
	if($page[2]=="")
	{
	echo '<script language="javascript">window.location="http://www.contratoenchile.cl"</script>;';
	}
}
else
{
echo '<script language="javascript">window.location="http://www.contratoenchile.cl"</script>;';
}
//print_r($page);
?>
	<form action="../../script/transicion.php" onsubmit="return validar()" method="post" class="formulario" id="usuario">
		<strong>Registro de empresas</strong><br>
		<input name="txtEmail" type="hidden" value="<?php echo $page[2]; ?>">
		<div>
			<label>Rut:</label>
			<input required x-moz-errormessage="Debe ingresar el rut sin puntos ni digito verificador"  maxlength="255" id="txtRut" name="txtRut" type="text" size="10">-
			<input required x-moz-errormessage="Debe ingresar el digito verificador del rut" id="txtDv" maxlength="1"  name="txtDv" type="text" size="1">Sin puntos
		</div>
		<div>
			<label>Nombre:</label>
			<input required x-moz-errormessage="Debe ingresar el/los nombres" id="txtNombre" maxlength="255"  name="txtNombre" type="text">
		</div>
		<div>
			<label>Descripcion:</label>
			<input required x-moz-errormessage="Debe ingresar una descripcion de la empresa"  maxlength="255" id="txtDescripcion" name="txtDescripcion" type="text"><br>
		</div>
		
		<div>
			<label>Telefono:</label>
			<input required x-moz-errormessage="Debe ingresar un telefono de contacto"  maxlength="255" id="txtTelefono" name="txtTelefono" type="phone">
		</div>
		
		<div>
			<label>Contraseña:</label>
			<input required x-moz-errormessage="Ingrese una contraseña" type="password" maxlength="255"  id="txtPassword" name="txtPassword">
		</div>
		<div>
			<label>RE-Contraseña:</label>
			<input required x-moz-errormessage="Ingrese nuevamente la contraseña" maxlength="255"  type="password" id="txtRepassword" name="txtRepassword">
		</div>
		<div>
			<img title="Captcha" src="../../script/captcha/captcha.php" />
			<input required x-moz-errormessage="Ingrese el texto de la imagen." type="text" maxlength="255"  size="16" id="captcha"  name="captcha" title="Ingrese el texto de la imagen." placeholder="Ingrese el texto de la imagen." />
		</div>
		<div>
			<label style="width: 400px;" for="txtCondicion">Estoy de acuerdo con los <a>Términos y Condiciones</a></label>
			<input id="txtCondicion" type="checkbox" required x-moz-errormessage="Debe aceptar los terminos y condiciones" />
		</div>
		<div>
		<br>
			<input type="submit" name="btnRegistrarEmpresa" value="Registrar">
		</div>
	</form>
</section>
		</section>
		<?php cc_footer(); ?>
</body>
</html>
