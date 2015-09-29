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
<section id="contenido"><h1 class="titulo">Calificar Contrato</h1>
	<form class="formulario" onsubmit="return calificarCon()" method="post">		<div id="error"></div>
				
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
						echo '<script language="javascript">window.location="'.WEB_BASE.'administracion/mis_contratos"</script>';
					}
					$arg=array ('id_con'=>$_POST['txtCode'], 'id_est'=>9,'rut'=>$_SESSION['rut']);
					$contrato=listarContactosSinDetalle($arg);
					if(count($contrato)<=0)
					{
						echo '<script language="javascript">window.location="'.WEB_BASE.'administracion/mis_contratos"</script>';
					}
					require_once('script/function.php');
					$arg=array ();
					$preguntas=listarTipocal($arg);
					$respuestas=listarEscalacal($arg);
					for($i=0;$i<count($preguntas);$i++) {
				?>
				<div>
					<label><?php echo $preguntas [$i] ['desc_tc']; ?></label><br>
					<select required x-moz-errormessage="Debe seleccionar un usuario" id="txtUsuario" name="txtPregunta<?php echo $preguntas [$i] ['id_tc']; ?>">
					<?php
						for($j=0;$j<count($respuestas);$j++)
						{
					?>
						<option value="<?php echo $respuestas [$j] ['id_ec']; ?>"><?php echo $respuestas [$j] ['nom_ec']; ?></option>
					<?php } ?>
					</select>
				</div>
				<?php } ?>
				<div>					<input class="boton submit" type="submit" value="Terminar">					<a class="boton cancel" href="<?php echo WEB_BASE;?>administracion/mis_contratos">Cancelar</a>				</div>
				
	</form><div id="watfk"></div>
</section>


	<?php cc_footer(); ?>
</body>
</html>