<?php
require_once "script/webConfig.php";
if(MANTENIMIENTO=='false')
{
	if(!isset($_SESSION)){
		session_start();
	}
	if(!isset($_SESSION['rol']))
	{
		$_SESSION['rol']=0;
	}
	require_once('script/function.php');
	echo "<!---------------------------------------------------**";
	echo "** Todos los derechos reservados: Contrato en Chile **";
	echo "*******************************************************-->";
	error_reporting(E_ERROR);//solo mostrara errores fatales
	$pagina="";
	if(isset($_REQUEST['pagina']))
	{
		$pagina=$_REQUEST['pagina'];
	}
	?>
	<html lang="es" dir="LTR" >
<head>
	<?php cc_menu($pagina); ?>
</head>
<body>
<?php cc_header(); ?>
		<section>
			<?php cc_menu($pagina); ?>
			<section id="contenido">
				<h1 class="titulo2">No se encuentra la pagina</h1>
				<p>La pagina solicitada no pudo ser encontrada o no cumple los requerimientos para acceder a ella.</p>
			</section>
		</section>
		<?php cc_footer(); ?>
</body>
</html>
	<?php
}
else
{
	echo "<html><head></head><body>En mantenimiento</body></html>";
}
?>
