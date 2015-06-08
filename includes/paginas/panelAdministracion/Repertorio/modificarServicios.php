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
	<form class="formulario" onsubmit="return modificarServicio()" method="post">		<div id="error"></div>
				<h1 class="titulo2">Modificar Servicio</h1>
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
					$arg=array ('id_serv'=>$_POST['txtCode']);
					$servicios=listarServicio($arg);
					$arg=array ('id_scat'=> $servicios[0]['id_scat']);
					$subcat=listarSubcategorias($arg);
				?>
				<div>
					<label>Nombre</label>
					<input value="<?php echo $servicios[0]['nom_serv']; ?>"  required x-moz-errormessage="Debe ingresar el nombre del servicio" type="text" id="txtNombre" name="txtNombre" required maxlength="255">
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgNombre">
				</div>
				<div>
					<label>Categoria</label>
					<select onchange="listarSubcategoria()" required x-moz-errormessage="Debe seleccionar un Tipo" id="txtCategoria" name="txtCategoria" required>
						<?php
								require_once('script/function.php');
								$arg=array ('nada'=>0);
								$cat=listarCategorias($arg);
								for($i=0;$i<count($cat);$i++)
								{
									?>
						<option <?php if($subcat[0]['id_cat']==$cat [$i] ['id_cat']) { echo "selected"; } ?>  value="<?php echo $cat [$i] ['id_cat']; ?>"><?php echo $cat [$i] ['nom_cat']; ?></option>
						<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgCategoria">
				</div>
				<div>
					<label>Subcategoria</label>
					<select required x-moz-errormessage="Debe seleccionar un Tipo" id="txtSubcategoria" name="txtSubcategoria" required>
						<?php
								require_once('script/function.php');
								$arg=array ('id_cat'=>$subcat[0]['id_cat']);
								$scat=listarSubcategorias($arg);
								for($i=0;$i<count($scat);$i++)
								{
									?>
						<option <?php if($servicios[0]['id_scat']==$scat [$i] ['id_scat']) { echo "selected"; } ?>  value="<?php echo $scat [$i] ['id_scat']; ?>"><?php echo $scat [$i] ['nom_scat']; ?></option>
						<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgSubcategoria">
				</div>
				<div>
					<label>Tipo Servicio</label>
					<select required x-moz-errormessage="Debe seleccionar un Tipo" id="txtTipoServicio" name="txtTipoServicio" required>
						<?php
								require_once('script/function.php');
								$arg=array ('nada'=>0);
								$ts=listarTiposervicio($arg);
								for($i=0;$i<count($ts);$i++)
								{
									?>
						<option <?php if($servicios[0]['id_ts']==$ts [$i] ['id_ts']) { echo "selected"; } ?> value="<?php echo $ts [$i] ['id_ts']; ?>"><?php echo $ts [$i] ['nom_ts']; ?></option>
					<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgTipoServicio">
				</div>
				<div>
					<label>Descripcion</label>
					<textarea rows="4" cols="22" required x-moz-errormessage="Debe ingresar el Url de la Pagina" id="txtDescripcion" name="txtDescripcion" maxlength="255"><?php echo $servicios[0]['desc_serv']; ?></textarea>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgDescripcion">
				</div>
				<div>
					<label>Empresa</label>
					<select required x-moz-errormessage="Debe seleccionar una empresa" id="txtEmpresa" name="txtEmpresa">
					<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$ent=listarEntidad($arg);
							for($i=0;$i<count($ent);$i++)
							{
								?>
						<option <?php if($servicios[0]['id_ent']==$ent [$i] ['id_ent']) { echo "selected"; } ?>  value="<?php echo $ent [$i] ['id_ent']; ?>"><?php echo $ent [$i] ['nom_ent']; ?></option>
					<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgEmpresa">
				</div>
				<div>
					<label>Estado</label>
					<select required x-moz-errormessage="Debe seleccionar una empresa" id="txtEstado" name="txtEstado">
					<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$est=listarEstado($arg);
							for($i=0;$i<count($est);$i++)
							{
								?>
						<option <?php if($servicios[0]['id_est']==$est [$i] ['id_est']) { echo "selected"; } ?>  value="<?php echo $est [$i] ['id_est']; ?>"><?php echo $est [$i] ['nom_est']; ?></option>
					<?php } ?>
					</select>
					<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgEstado">
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