<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<?php
	if(isset($titulo))
	{
		echo '<title>'.$titulo.'</title>';
	}
	else
	{
		echo '<title>Contrato en Chile</title>';
	}
	if(isset($description))
	{
		echo '<meta name="description" content="'.$description.'">';
	}
	else
	{
		echo '<meta name="description" content="Contrato en Chile">';
	}
	if(isset($keywords))
	{
		echo '<meta name="keywords" content="'.$keywords.'">';
	}
	else
	{
		echo '<meta name="keywords" content="Contrato en Chile">';
	}
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<meta name="author" content="Juan Retamales">
<link rel="shortcut icon" href="<?php echo WEB_BASE; ?>imagenes/icon/256.png">


<LINK href="<?php echo WEB_BASE; ?>estilos/final.css" rel="stylesheet" type="text/css">

<LINK href="<?php echo WEB_BASE; ?>estilos/768px.css" rel="stylesheet" type="text/css">
<LINK href="<?php echo WEB_BASE; ?>estilos/1024px.css" rel="stylesheet" type="text/css">
<LINK href="<?php echo WEB_BASE; ?>estilos/1200px.css" rel="stylesheet" type="text/css">

<script src="<?php echo WEB_BASE; ?>script/jquery-1.11.0.min.js"></script>
<script src="<?php echo WEB_BASE; ?>script/holder.js"></script>
<!--<script src="<?php echo WEB_BASE; ?>script/sortable.js"></script>-->

<script src="<?php echo WEB_BASE; ?>script/tablas.js"></script>
<script src="<?php echo WEB_BASE; ?>script/Chart.min.js"></script>
<script src="<?php echo WEB_BASE; ?>script/formulario.js"></script>