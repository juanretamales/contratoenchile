<html lang="es" dir="LTR" >
<head>	<?php cc_head(); ?></head>
<body>	<?php cc_header(); ?>	
<section>		
<?php 			
$pagina="";
if(isset($_REQUEST['pagina']))
{	$pagina=$_REQUEST['pagina'];}			
cc_menu($pagina); ?>	
</section>	
<section id="contenido" >	
<form class="formulario" onsubmit="return modificarDocumento()" method="post">				
<h1 class="titulo2">Modificar Documento</h1>				