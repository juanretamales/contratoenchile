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
	//error_reporting(E_ERROR);//solo mostrara errores fatales
	if(isset($_REQUEST['pagina']))
	{
		cc_contenido($_REQUEST['pagina']); 
		//echo '<!--'.$_REQUEST['pagina'].'-->';
	}
	else
	{
		cc_contenido(""); 
	}
	//var_dump($_GET); // Element 'foo' is string(1) "a"
	//var_dump($_POST); // Element 'bar' is string(1) "b"
	//var_dump($_REQUEST); // Does not contain elements 'foo' or 'bar'
}
else
{
	echo "<html><head></head><body>En mantenimiento</body></html>";
}
?>