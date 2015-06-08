<html lang="es" dir="LTR" >
<head>
		
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title>Contrato en Chile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Contrato en Chile">
        <meta name="keywords" content="Contrato en Chile">
        <meta name="author" content="Juan Retamales">
        <link rel="shortcut icon" href="./imagenes/icon/256.png">
	
	<LINK href="../../estilos/banner.css" rel="stylesheet" type="text/css">
	
	<LINK href="../../estilos/formulario.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/menu.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/menu-admin.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/normal.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/radiobutton.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/servicios.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/footer.css" rel="stylesheet" type="text/css">
	<LINK href="../../estilos/tablas.css" rel="stylesheet" type="text/css">
	
	<script src="./script/jquery-1.11.0.min.js"></script>
	<script src="./script/holder.js"></script>
	<script src="./script/sortable.js"></script>
	<script src="./script/Chart.min.js"></script>
</head>
<body>
<?php cc_header();
			<?php cc_menu($pagina); ?>
			<section id="contenido">
<?php
$pagina="";
if(isset($_REQUEST['pagina']))
{
	$pagina=$_REQUEST['pagina'];
}
$page=explode("/",$pagina);
switch($page[1])
{
	case "usuario":
		$arg=array ('rut'->$page[2]);
		$cliente=listarCliente($arg);
		if(count($cliente)==1)
		{
			echo "<div>".$cliente[0]['rut']."</div>";
			echo "<div>".$cliente[0]['id_com']."</div>";
			echo "<div>".$cliente[0]['id_id']."</div>";
			echo "<div>".$cliente[0]['id_est']."</div>";
			echo "<div>".$cliente[0]['nombre']."</div>";
			echo "<div>".$cliente[0]['apellido']."</div>";
			echo "<div>".$cliente[0]['direccion']."</div>";
			echo "<div>".$cliente[0]['fecha_nac']."</div>";
			echo "<div>".$cliente[0]['tel_clie']."</div>";
			echo "<div>".$cliente[0]['email_clie']."</div>";
		}
		//buscar si empresa con este rut existe
		else
		{
			echo 'Cliente no encontrado';
		}
		break;
	case "empresa":
		$arg=array ('rut_sii'->$page[2]);
		$empresa=listarEntidad($arg);
		if(count($empresa)==1)
		{
			echo "<div>".$empresa[0]['id_ent']."</div>";
			echo "<div>".$empresa[0]['id_id']."</div>";
			echo "<div>".$empresa[0]['id_est']."</div>";
			echo "<div>".$empresa[0]['subscripcion']."</div>";
			echo "<div>".$empresa[0]['rut_sii']."</div>";
			echo "<div>".$empresa[0]['nom_ent']."</div>";
			echo "<div>".$empresa[0]['sitio']."</div>";
			echo "<div>".$empresa[0]['sitio_ext']."</div>";
			echo "<div>".$empresa[0]['seo_ent']."</div>";
			echo "<div>".$empresa[0]['desc_ent']."</div>";
			echo "<div>".$empresa[0]['email_ent']."</div>";
			echo "<div>".$empresa[0]['tel_ent']."</div>";
		}
		//buscar si empresa con este rut existe
		else
		{
			echo 'empresa no encontrada';
		}
		break;

	case "moderador":
		$arg=array ('rut_mod'->$page[2]);
		$moderador=listarModerador($arg);
		if(count($moderador)==1)
		{
			echo "<div>".$moderador[0]['id_mod']."</div>";
			echo "<div>".$moderador[0]['id_id']."</div>";
			echo "<div>".$moderador[0]['nom_mod']."</div>";
			echo "<div>".$moderador[0]['email_mod']."</div>";
			echo "<div>".$moderador[0]['rut_mod']."</div>";
		}
		//buscar si empresa con este rut existe
		else
		{
			echo 'Moderador no encontrado';
		}
		break;
}
?>
		</section>
		<?php cc_footer(); ?>
</body>
</html>
