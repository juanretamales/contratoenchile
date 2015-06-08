<?php
$subpagina="";
$ruta="";
if(isset($_GET["subpagina"]))
{
	$subpagina=$_GET["subpagina"];
}
if($_SESSION['rol']=="Empresa")
{
	$ruta="includes/paginas/panelEmpresa";
	switch ($subpagina){
		case "Paises";
			include('Posicionamiento/Paises.php');
			break;
		default:
			include($ruta.'inicio.php');
			break;
	}
}
if($_SESSION['rol']=="Moderador")
{
	$ruta="includes/paginas/panelAdministracion/";
	switch ($subpagina){
	//Comunidad
	
	//Repertorio
		case "Categorias";
			include($ruta.'Repertorio/listarCategorias.php');
			break;
		case "Servicios";
			include($ruta.'Repertorio/listarServicios.php');
			break;
		case "Subcategorias";
			include($ruta.'Repertorio/listarSubcategorias.php');
			break;
		case "Tiposervicio";
			include($ruta.'Repertorio/listarTiposervicio.php');
			break;
		case "agregarCategorias";
			include($ruta.'Repertorio/agregarCategorias.php');
			break;
		case "agregarServicios";
			include($ruta.'Repertorio/agregarServicios.php');
			break;
		case "agregarSubcategorias";
			include($ruta.'Repertorio/agregarSubcategorias.php');
			break;
		case "agregarTiposervicio";
			include($ruta.'Repertorio/agregarTiposervicio.php');
			break;
	//contratos
	
	//contenido
		case "Paginas";
			include($ruta.'Contenido/listarPaginas.php');
			break;
		case "Tipopagina";
			include($ruta.'Contenido/listarTipopagina.php');
			break;
		case "Documentos";
			include($ruta.'Contenido/listarPaginas.php');
			break;
		case "Tipodocumento";
			include($ruta.'Contenido/listarTipodocumento.php');
			break;
		case "Tipomedia";
			include($ruta.'Contenido/listarTipomedia.php');
			break;
		case "agregarPaginas";
			include($ruta.'Contenido/agregarPagina.php');
			break;
		case "agregarTipopagina";
			include($ruta.'Contenido/agregarTipopagina.php');
			break;
		case "agregarDocumento";
			include($ruta.'Contenido/agregarDocumento.php');
			break;
		case "agregarTipodocumento";
			include($ruta.'Contenido/agregarTipodocumento.php');
			break;
		case "agregarTipomedia";
			include($ruta.'Contenido/agregarTipomedia.php');
			break;
	//posicionamiento
		case "Paises";
			include($ruta.'Posicionamiento/listarPaises.php');
			break;
		case "agregarPaises";
			include($ruta.'Posicionamiento/agregarPaises.php');
			break;
		case "modificarPaises";
			include($ruta.'Posicionamiento/listarPaises.php');
			break;
		case "Regiones";
			include($ruta.'Posicionamiento/listarRegion.php');
			break;
		case "agregarRegiones";
			include($ruta.'Posicionamiento/agregarRegiones.php');
			break;
		case "modificarRegiones";
			include($ruta.'Posicionamiento/listarPaises.php');
			break;
		case "Provincias";
			include($ruta.'Posicionamiento/listarProvincia.php');
			break;
		case "agregarProvincias";
			include($ruta.'Posicionamiento/agregarProvincia.php');
			break;
		case "Comunas";
			include($ruta.'Posicionamiento/listarComuna.php');
			break;
		case "agregarComunas";
			include($ruta.'Posicionamiento/agregarProvincia.php');
			break;
		
		default:
			include($ruta.'inicio.php');
			break;
	}
}

?>