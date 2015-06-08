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
<section id="contenido" style="margin: 10px 0px 0px 10px;">
	<form class="formulario" onsubmit="return modificarTipopag()" method="post">
	<div id="error"></div>
				<h1 class="titulo2">Modificar Tipo de Pagina</h1>
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
					$arg=array ('id_tp'=>$_POST['txtCode']);
					$tp=listarTipopagina($arg);
				?>
				<div>
					<label>Nombre</label>
					<input value="<?php echo $tp[0]['nom_tp']; ?>" required x-moz-errormessage="Debe ingresar el nombre del pais" type="text" required maxlength="255" id="txtNombre" name="txtNombre">
					<img src="<?php 
					echo WEB_BASE;?>imagenes/none.png" id="imgNombre">
				</div>
				<div>
					<input type="submit" value="Modificar">
				</div>
				<a href="
				<?php 
					echo WEB_BASE.$back; ?>
				">Cancelar</a>
	</form>
</section>


	<?php cc_footer(); ?>
</body>
</html>