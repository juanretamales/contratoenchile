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
		<form class="formulario" onsubmit="return modificarComuna()"   method="post">
		<div id="error"></div>
			<h1 class="titulo2">Modificar Comuna</h1>
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
					$arg=array ('id_com'=>$_POST['txtCode']);
					$comuna=listarComuna($arg);
				?>
			<div>
				<label>Nombre</label>
				<input value="<?php echo $comuna[0]['nom_com']; ?>" required x-moz-errormessage="Debe ingresar el nombre de la comuna" type="text" id="txtNombre" name="txtNombre" maxlength="255" >
				<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgNombre">
			</div>
			<div>
				<label>Seleccione el pais</label>
				<select onchange="listarRegiones()" required x-moz-errormessage="Debe seleccionar un pais" name="txtPais" id="txtPais">
				<option value="" disabled selected></option>
				<?php
							$arg=array ('id_prov'=>$comuna[0]['id_prov']);
							$lprovincia=listarProvincia($arg);
							$arg=array ('id_reg'=>$lprovincia[0]['id_reg']);
							$lregion=listarRegion($arg);
							$arg=array ('none'=>$lregion[0]['id_pais']);
							$paises=listarPais($arg);
							for($i=0;$i<count($paises);$i++)
							{
								?>
					<option <?php if($lregion[0]['id_pais']==$paises [$i] ['id_pais']) { echo "selected"; } ?> value="<?php echo $paises [$i] ['id_pais']; ?>"><?php echo $paises [$i] ['nom_pais']; ?></option>
				<?php } ?>
				</select>
				<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgPais">
			</div>
			<div>
				<label>Seleccione la region</label>
				<select required onchange="listarProvincias()"  x-moz-errormessage="Debe seleccionar una region" id="txtRegion" id="txtRegion" name="txtRegion">
					<?php
							$arg=array ('id_pais'=>$lregion[0]['id_pais']);
							$region=listarRegion($arg);
							for($i=0;$i<count($region);$i++)
							{
								?>
					<option <?php if($provincia[0]['id_reg']==$region [$i] ['id_reg']) { echo "selected"; } ?> value="<?php echo $region [$i] ['id_reg']; ?>"><?php echo $region [$i] ['nom_reg']; ?></option>
				<?php } ?>
				</select>
				<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgPais">
			</div>
			<div>
				<label>Seleccione la provincia</label>
				<select required  x-moz-errormessage="Debe seleccionar un pais" id="txtProvincia" name="txtProvincia">
					<?php
							$arg=array ('id_reg'=>$lprovincia[0]['id_reg']);
							$provincia=listarProvincia($arg);
							for($i=0;$i<count($provincia);$i++)
							{
								?>
					<option <?php if($comuna[0]['id_prov']==$provincia [$i] ['id_prov']) { echo "selected"; } ?> value="<?php echo $provincia [$i] ['id_prov']; ?>"><?php echo $provincia [$i] ['nom_prov']; ?></option>
				<?php } ?>
				</select>
				<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgProvincia">
			</div>
			<div>
				<input type="submit" name="btnRegistrarRegion" value="Modificar">
			</div>
			<a href="<?php 
					echo WEB_BASE.$back;
				?>">Cancelar</a>
		</form>
	</section>
	<?php cc_footer(); ?>
</body>
</html>
