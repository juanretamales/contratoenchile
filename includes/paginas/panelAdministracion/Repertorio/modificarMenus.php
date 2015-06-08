<html lang="es" dir="LTR" >
<head>
	<?php 
		cc_head();
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
<section id="contenido">
	<form class="formulario" onsubmit="return modificarMenu()" method="post">		<div id="error"></div>
				<h1 class="titulo2">Modificar Menus</h1>
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
					$arg=array ('id_menu'=>$_POST['txtCode']);
					$menu=listarMenu($arg);
				?>
				<div>
					<label>Nombre</label>
					<input value="<?php echo $menu[0]['nom_menu']; ?>" required x-moz-errormessage="Debe ingresar el nombre " type="text" required maxlength="255" id="txtNombre" name="txtNombre">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgNombre">
				</div>
				<div>
					<label>Descripcion</label>
					<input value="<?php echo $menu[0]['desc_menu']; ?>" required x-moz-errormessage="Debe ingresar el nombre" type="text" required maxlength="255" id="txtDescripcion" name="txtDescripcion">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgDescripcion">
				</div>
				<div>
					<label>Tipo de usuario</label>
					<select required x-moz-errormessage="Debe seleccionar un tipo" maxlength="255"  id="txtTipo" name="txtTipo">
					<option value="" disabled selected></option>
					<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$tu=listarTipousuario($arg);
							for($i=0;$i<count($tu);$i++)
							{
								?>
					<option <?php if($menu[0]['id_tu']==$tu [$i] ['id_tu']) { echo "selected"; } ?> value="<?php echo $tu [$i] ['id_tu']; ?>"><?php echo $tu [$i] ['nom_tu']; ?></option>
					<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgTipo">
				</div>
				<div>
					<input type="submit" value="Modificar">
				</div>
				<a href="
				<?php 
					echo WEB_BASE.$back;
				?>
				">Cancelar</a>
	</form>
</section>


	<?php cc_footer(); ?>
</body>
</html>