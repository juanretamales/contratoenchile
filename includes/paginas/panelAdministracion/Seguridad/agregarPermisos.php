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
	<section id="contenido">
	<form class="formulario"  onsubmit="return agregarPermiso()" method="post">
		<div id="error"></div>
				<h1 class="titulo2">Añadir nuevo permiso</h1>
				<div>
					<label>Seleccione un tipo de usuario</label>
					<select required x-moz-errormessage="Debe seleccionar un tipo de usuario" name="txtTipoUsuario" id="txtTipoUsuario" required>
					<option value="" disabled selected></option>
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
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$tu=listarTipousuario($arg);
							for($i=0;$i<count($tu);$i++)
							{
								?>
					<option value="<?php echo $tu [$i] ['id_tu']; ?>"><?php echo $tu [$i] ['nom_tu']; ?></option>
				<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgTipoUsuario">
				</div>
				<div>
					<label>Seleccione una pagina</label>
					<select required x-moz-errormessage="Debe seleccionar una pagina" id="txtPagina" name="txtPagina" required>
					<option value="" disabled selected></option>
					<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$pag=listarPagina($arg);
							for($i=0;$i<count($pag);$i++)
							{
								?>
					<option value="<?php echo $pag [$i] ['id_pag']; ?>"><?php echo $pag [$i] ['nom_pag']; ?></option>
				<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgPagina">
				</div>
				<div>
					<input type="submit" value="Añadir">
				</div>
				<a href="<?php 
					echo WEB_BASE.$back;
				?>">Cancelar</a>
	</form>
</section>

	<?php cc_footer(); ?>
</body>
</html>
