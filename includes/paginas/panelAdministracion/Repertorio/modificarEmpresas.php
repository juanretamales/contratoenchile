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
	<section id="contenido" ><h1 class="titulo">Modificar Empresa</h1>
	<form class="formulario" onsubmit="return modificarEmpresa()"  method="post">		<div id="error"></div>
				
				<?php
					require_once "script/webConfig.php";
					$page=explode("/",$pagina);
					$back="";
					for($i=0;$i<(count($page)-1);$i++)
					{
						if($i!=0)
						{
							$back=$back."/".$page[$i];
						}
						else
						{
							$back=$back.$page[$i];
						}
					}
					if(isset($_POST['txtCode']))
					{
						echo '<input id="txtCode" name="txtCode" type="hidden" required value="'.$_POST['txtCode'].'">';
					}
					else
					{
						echo '<script language="javascript">window.location="'.WEB_BASE.$back.'"</script>';
					}
					require_once('script/function.php');
					$arg=array ('id_ent'=>$_POST['txtCode']);
					$entidad=listarEntidad($arg);
				?>
				<div>
					<label>Rut:</label>
					<input value="<?php echo $entidad[0]['rut_sii']; ?>" required x-moz-errormessage="Debe ingresar el rut sin puntos ni digito verificador"  maxlength="255" id="txtRut" name="txtRut" type="text" size="15">
				
				</div>
				<div>
					<label>Nombre:</label>
					<input value="<?php echo $entidad[0]['nom_ent']; ?>"  required x-moz-errormessage="Debe ingresar el/los nombres" id="txtNombre" maxlength="255"  name="txtNombre" type="text">
				
				</div>
				<div>
					<label>Descripcion:</label>
					<input value="<?php echo urldecode($entidad[0]['desc_ent']); ?>"  required x-moz-errormessage="Debe ingresar una descripcion de la empresa"  maxlength="255" id="txtDescripcion" name="txtDescripcion" type="text"><br>
				
				</div>
				<div>
					<label>Telefono:</label>
					<input value="<?php echo $entidad[0]['tel_ent']; ?>"  required x-moz-errormessage="Debe ingresar un telefono de contacto"  maxlength="255" id="txtTelefono" name="txtTelefono" type="phone">
				
				</div>
				<div>
					<label>Email:</label>
					<input value="<?php echo $entidad[0]['email_ent']; ?>"  required x-moz-errormessage="Debe ingresar un telefono de contacto"  maxlength="255" id="txtEmail" name="txtEmail" type="email">
				
				</div>
				<div>
					<label>Estado</label>
					<select required x-moz-errormessage="Debe seleccionar un pais" id="txtEstado" name="txtEstado">
					<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$estados=listarEstado($arg);
							for($i=0;$i<count($estados);$i++)
							{
								?>
					<option <?php if($entidad[0]['id_est']==$estados [$i] ['id_est']) { echo "selected"; } ?> value="<?php echo $estados [$i] ['id_est']; ?>"><?php echo $estados [$i] ['nom_est']; ?></option>
				<?php } ?>
					</select>
				
				</div>
				<div>
					<label>Subscripcion: 					<?php if($entidad [0] ['subscripcion'] > date( "Y-m-j" , time()))
					{ echo 'Si, hasta: ';  } else { echo 'No'; }?></label>
					<input value="<?php echo str_replace("-","/",dateDecode($entidad[0]['subscripcion'])); ?>"  required x-moz-errormessage="Debe ingresar un telefono de contacto"  maxlength="255" id="txtSub" name="txtSub" type="text">
				
				</div>
				<div>				<input class="boton submit" type="submit" value="Modificar">				<a class="boton cancel" href="<?php echo WEB_BASE.$back;?>">Cancelar</a>			</div>
	</form>
</section>
	<?php cc_footer(); ?>
</body>
</html>