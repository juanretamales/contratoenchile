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
			<section id="contenido">
				<form onsubmit="return modificarTipousuario()" method="post" class="formulario">
		<div id="error"></div>
					<h1 class="titulo2">Modificar de Tipo Usuario</h1>
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
							require_once('script/function.php');
							$arg=array ('id_tu'=>$_POST["txtCode"]);
							$tu=listarTipousuario($arg);
						?>
					<div>
						<label>Nombre:</label>
						<input value="<?php echo $tu[0]['nom_tu']; ?>" required x-moz-errormessage="Debe ingresar el nombre" id="txtNombre" name="txtNombre" type="text" required maxlength="255">
						<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgNombre">
					</div>
					<div>
						<input type="submit" value="Modificar">
					</div>
					<a href="<?php 
					echo WEB_BASE.$back;
					?>">Cancelar</a>
				</form>
			</section>
		</section>
		<?php cc_footer(); ?>
</body>
</html>