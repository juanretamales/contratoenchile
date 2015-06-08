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
	}
	if($('#txtNombre').val().length<=0 && $('#txtNombre').val().length>255)
	{
		mensaje="Debe completar el nombre";
	}
	if($('#txtRut').val().length<=0 && $('#txtRut').val().length>255)
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
	if($('#txtDv').val().length!=1)
	{
		mensaje="Debe completar el digito verificador";
	}
	if($('#txtApellido').val().length<=0 && $('#txtApellido').val().length>255)
	{
		mensaje="Debe completar el apellido";
	}
	if($('#ddlDia').val().length<=0)
	{
		mensaje="Debe seleccionar el dia de nacimiento";
	}
	if($('#ddlMes').val().length<=0)
	{
		mensaje="Debe seleccionar el mes de nacimiento";
	}
	if($('#ddlAno').val().length<=0)
	{
		mensaje="Debe seleccionar el año de nacimiento";
	}
	if($('#txtComuna').val().length<=0)
	{
		mensaje="Debe seleccionar la comuna";
	}
	if($('#txtNumcasa').val().length<=0 && $('#txtNumcasa').val().length>255)
	{
		mensaje="Debe numero de la casa";
	}
	if($('#txtOtros').val().length<=0 && $('#txtOtros').val().length>255)
	{
		mensaje="Debe ingresar la direccion";
	}
	if($('#txtPassword').val().length<=6 && $('#txtPassword').val().length>255)
	{
		mensaje="Debe ingresar la contraseña mayor a 5 caracteres";
	}
	if($('#txtTelefono').val().length<=0 && $('#txtTelefono').val().length>255)
	{
		mensaje="Debe completar el telefono";
	}
	if($('#captcha').val().length<=0 && $('#captcha').val().length>255)
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
		data:  {"validarRut" : 1, "rut": $('#txtRut').val()+"-"+$('#txtDv').val()},
		url:   '../../../script/transicion.php',
		type:  'post',
		success:  function (response) {
			if(parseInt(response)==0)
			{
				respuesta="";
			}
			else
			{
				respuesta="Ya existe un rut registrado";
			}
			alert(respuesta+"\n"+response);
		}
	});
}
function validarafk()
{
	alert('no funciona');
	validarRut();
	alert(respuesta);
}
$( document ).ready(function() {
	$(".region").hide();
	$(".provincia").hide();
	$(".comuna").hide();
	$('#txtPais').change(function() 
	{
		var id=$('#txtPais').val();
		$(".region").hide();
		$(".reg"+id).show();
	}
	$('#txtRegion').change(function() 
	{
		var id=$('#txtRegion').val();
		$(".provincia").hide();
		$(".prov"+id).show();
	}
	$('#txtProvincia').change(function() 
	{
		var id=$('#txtProvincia').val();
		$(".comuna").hide();
		$(".com"+id).show();
	}
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
//print_r($page);
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
		<strong>Registro de usuarios</strong><!--<a onclick="validarafk()">validar</a>--><br>
		<input name="txtEmail" type="hidden"  maxlength="255" value="<?php echo $page[2]; ?>">
		<div>
			<label>Rut:</label>
			<input required x-moz-errormessage="Debe ingresar el rut sin puntos ni digito verificador"  maxlength="255" id="txtRut" name="txtRut" type="text" size="10">-
			<input required x-moz-errormessage="Debe ingresar el digito verificador del rut" id="txtDv"  maxlength="1" name="txtDv" type="text" size="1">Sin puntos
		</div>
		<div>
			<label>Nombre:</label>
			<input required x-moz-errormessage="Debe ingresar el/los nombres" id="txtNombre" name="txtNombre" maxlength="255"  type="text">
		</div>
		<div>
			<label>Apellido:</label>
			<input required x-moz-errormessage="Debe ingresar el/los apellidos" id="txtApellido"  maxlength="255" name="txtApellido" type="text"><br>
		</div>
		<div>
			<label>fecha de nacimiento:</label>
			<select required x-moz-errormessage="Debe seleccionar el dia" id="ddlDia" name="ddlDia">
			<?php for($i=1;$i<32;$i++)
			{ ?>
			<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php
			} ?>
			</select>/
			<select required x-moz-errormessage="Debe seleccionar el mes" id="ddlMes" name="ddlMes">
				<option value="volvo">Enero</option>
				<option value="volvo">Febrero</option>
				<option value="volvo">Marzo</option>
				<option value="volvo">Abril</option>
				<option value="volvo">Mayo</option>
				<option value="volvo">Junio</option>
				<option value="volvo">Julio</option>
				<option value="volvo">Agosto</option>
				<option value="volvo">Septiembre</option>
				<option value="volvo">Octubre</option>
				<option value="volvo">Noviembre</option>
				<option value="volvo">Diciembre</option>
			</select>/
			<select required x-moz-errormessage="Debe seleccionar el año" id="ddlAno" name="ddlAno">
			<?php for($i=1900;$i<2014;$i++)
			{ ?>
			<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php
			} ?>
			</select><br>
		</div>
		<div>
			<label>Telefono:</label>
			<input required x-moz-errormessage="Debe ingresar un telefono de contacto" id="txtTelefono" name="txtTelefono" type="phone">
		</div>
		<div>
					<label>Seleccione el pais</label>
					<select required x-moz-errormessage="Debe seleccionar un pais" id="txtPais" name="txtPais">
					<option value="" disabled selected></option>
					<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$paises=listarPais($arg);
							for($i=0;$i<count($paises);$i++)
							{
								?>
					<option value="<?php echo $paises [$i] ['id_pais']; ?>"><?php echo $paises [$i] ['nom_pais']; ?></option>
				<?php } ?>
					</select>
				</div>
		<div>
					<label>Seleccione la region</label>
					<select required x-moz-errormessage="Debe seleccionar una region" id="txtRegion" name="txtRegion">
					<option value="" disabled selected></option>
					<?php
							$arg=array ('nada'=>0);
							$reg=listarRegion($arg);
							for($i=0;$i<count($reg);$i++)
							{
								?>
					<option class="reg<?php echo $reg [$i] ['id_pais']; ?> region" value="<?php echo $reg [$i] ['id_reg']; ?>"><?php echo $reg [$i] ['nom_reg']; ?></option>
				<?php } ?>
					</select>
				</div>
		<div>
					<label>Seleccione la provincia</label>
					<select required x-moz-errormessage="Debe seleccionar un pais" id="txtProvincia" name="txtProvincia">
					<option value=""  selected></option>
					<?php
							$arg=array ('nada'=>0);
							$prov=listarProvincia($arg);
							for($i=0;$i<count($prov);$i++)
							{
								?>
					<option class="prov<?php echo $prov [$i] ['id_reg']; ?> provincia" value="<?php echo $prov [$i] ['id_prov']; ?>"><?php echo $prov [$i] ['nom_prov']; ?></option>
				<?php } ?>
					</select>
				</div>
		<div>
					<label>Seleccione la comuna</label>
					<select required x-moz-errormessage="Debe seleccionar un pais" id="txtComuna" name="txtComuna">
					<option value="" disabled selected></option>
					<?php
							$arg=array ('nada'=>0);
							$com=listarComuna($arg);
							for($i=0;$i<count($com);$i++)
							{
								?>
					<option class="com<?php echo $com [$i] ['id_prov']; ?> comuna" value="<?php echo $com [$i] ['id_com']; ?>"><?php echo $com [$i] ['nom_com']; ?></option>
				<?php } ?>
					</select>
				</div>
		<div>
			<label>Codigo postal:</label>
			<input required x-moz-errormessage="Debe ingresar el Codigo postal" id="txtNumcasa" maxlength="255"  name="txtNumcasa" type="text">
		</div>
		<div>
			<label>Direccion</label>
			<input required x-moz-errormessage="Debe ingresar otros datos de la direccion"  maxlength="255" id="txtOtros" name="txtOtros" type="text">
		</div>
		<div>
			<label>Contraseña:</label>
			<input required x-moz-errormessage="Ingrese una contraseña" type="password" maxlength="255"  id="txtPassword" name="txtPassword">
		</div>
		<div>
			<label>RE-Contraseña:</label>
			<input required x-moz-errormessage="Ingrese nuevamente la contraseña" type="password" maxlength="255"  id="txtRepassword" name="txtRepassword">
		</div>
		<div>
			<img title="Captcha" src="../../script/captcha/captcha.php" />
			<input required x-moz-errormessage="Ingrese el texto de la imagen." type="text" size="16" maxlength="255"  id="captcha" name="captcha" title="Ingrese el texto de la imagen." placeholder="Ingrese el texto de la imagen." />
		</div>
		<div>
			<label style="width: 400px;" for="txtCondicion">Estoy de acuerdo con los <a>Términos y Condiciones</a></label>
			<input id="txtCondicion" type="checkbox" required x-moz-errormessage="Debe aceptar los terminos y condiciones" />
		</div>
		<div>
		<br>
			<input type="submit" name="btnRegistrarCliente" value="Registrar Usuario">
		</div>
	</form>
</section>
		</section>
		<?php cc_footer(); ?>
</body>
</html>
