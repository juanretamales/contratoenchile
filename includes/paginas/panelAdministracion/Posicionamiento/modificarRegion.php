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
	<form class="formulario" onsubmit="return modificarRegion()"  method="post">
		<div id="error"></div>
				<h1 class="titulo2">Modificar Regiones</h1>
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
					$arg=array ('id_reg'=>$_POST['txtCode']);
					$region=listarRegion($arg);
				?>
				<div>
					<label>Nombre de la region</label>
					<input value="<?php echo $region[0]['nom_reg']; ?>" required x-moz-errormessage="Debe ingresar el nombre de la region" type="text" id="txtNombre" name="txtNombre" maxlength="255" >
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgNombre">
				</div>
				<div>
					<label>Pais</label>
					<select required x-moz-errormessage="Debe seleccionar un pais" id="txtPais" name="txtPais">
					<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$paises=listarPais($arg);
							for($i=0;$i<count($paises);$i++)
							{
								?>
					<option <?php if($region[0]['id_pais']==$paises [$i] ['id_pais']) { echo "selected"; } ?> value="<?php echo $paises [$i] ['id_pais']; ?>"><?php echo $paises [$i] ['nom_pais']; ?></option>
				<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgPais">
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