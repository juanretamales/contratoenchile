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
<section id="contenido"><h1 class="titulo">Modificar Metrica</h1>
	<form class="formulario" onsubmit="return modificarMetrica()" method="post">	<div id="error"></div>
				
					<?php
						require_once "script/webConfig.php";
						require_once('script/function.php');
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
						$arg=array ('id_ec'=>$_POST['txtCode']);
						$ec=listarEscalacal($arg);
					?>
				<div>
					<label>Nombre</label>
					<input value="<?php echo $ec[0]['nom_ec']; ?>" required x-moz-errormessage="Debe ingresar el nombre" type="text" required maxlength="255" id="txtNombre" name="txtNombre">
				</div>
				<div>
					<label>Valor</label>
					<input type="number" min="-50" max="50" step="1" value="<?php echo $ec[0]['valor']; ?>"  id="txtValor" name="txtValor" required>
					<!--<input value="<?php echo $ec[0]['valor']; ?>" required x-moz-errormessage="Debe ingresar el valor" type="text" required maxlength="255" id="txtValor" name="txtValor">-->
				</div>
				<div>					<input class="boton submit" type="submit" value="Añadir">					<a class="boton cancel" href="<?php echo WEB_BASE.$back;?>">Cancelar</a>				</div>
	</form>
</section>
	<?php cc_footer(); ?>
</body>
</html>