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
	<form class="formulario" onsubmit="return modificarDocumento()" method="post">						<div id="error"></div>
	<h1 class="titulo2">Modificar Documento</h1>				
	<?php					require_once "script/webConfig.php";					
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
	$arg=array ('id_doc'=>$_POST['txtCode']);					
	$doc=listarDocumento($arg);				?>				
	<div>					
		<label>Nombre</label>					
		<input value="<?php echo $doc[0]['nom_doc']; ?>" required x-moz-errormessage="Debe ingresar el nombre del Documento" type="text" id="txtNombre" name="txtNombre" maxlength="255">					
		<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgNombre">				
	</div>				
	<div>					
		<label>Tipo del documento</label>					
		<select required x-moz-errormessage="Debe seleccionar un Tipo" id="txtTipodoc" name="txtTipodoc">					
		<?php require_once('script/function.php');	
		$arg=array ('nada'=>0);	$td=listarTipodoc($arg);	for($i=0;$i<count($td);$i++) { 	?>						
		<option <?php if($doc[0]['id_tp']==$td [$i] ['id_tp']) { echo "selected"; } ?> value="<?php echo $td [$i] ['id_td']; ?>">
		<?php echo $td [$i] ['nom_td']; ?></option>					
		<?php } ?>					
		</select>					
		<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgTipodoc">				
	</div>
	<div>					
		<label>Url</label>					
		<input value="<?php echo $doc[0]['url_doc']; ?>" required x-moz-errormessage="Debe ingresar el nombre del Documento" type="text" id="txtUrl" name="txtUrl" maxlength="255">					
		<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgUrl">				
	</div>				
	<div>					
		<input type="submit" value="Modificar">				
	</div>				
	<a href="<?php echo WEB_BASE.$back; ?>">Cancelar</a>	
	</form></section>	<?php cc_footer(); ?>
	</body></html>