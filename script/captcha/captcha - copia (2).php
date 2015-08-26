<?php 
	###########################################################################################
	#
	#  CAPTCHA CONTRATO EN CHILE
	#
	#  Autor: Juan Pablo Retamales Lepe
	#  Contact: contrato at contratoenchile dot cl
	#  Date: august 1, 2014
	#  Version: 1.2
	#  En la version 2 quiero que sea por funcion, pidiendo arg y configurando el captcha para una venta
	###########################################################################################
	
	//$captcha = imagecreatetruecolor(120,35);
	######################
	# Contiguracion      #
	######################
	//Ancho
	$width = 240;
	//Alto
	$height = 70;
	$tamanoFuente = 25;
	$cantidadLetras = 5;
	$lineas = false;
	//nombre del parametro que se guardara la session
	$session = "captcha";
	//Formatos: jpg, png, gif
	$formatoSalida="png";
	//Distorcion 
	$distorcion = false;
	//Color de fondo: color rgb
	$fondo=true;
	$colorFondoR = 0;
	$colorFondoG = 0;
	$colorFondoB = 0;
	######################
	# Fuentes agregadas  #
	######################
	$font[0] = 'Arial.ttf';
	$font[1] = 'Alpaca.ttf';
	$font[2] = 'Geosans.ttf';
	$font[3] = 'Optimus.ttf';
	$font[4] = 'Sanford.ttf';
	######################
	# Inicio Codigo      #
	######################
	//Se crea la imagen
	$captcha = imagecreatetruecolor(240,70);
	if($fondo==true)
	{
		$colorFondoR = rand(128,160);
		$colorFondoG = rand(128,160);
		$colorFondoB = rand(128,160);
	}
	$background_color = imagecolorallocate($captcha, $colorFondoR, $colorFondoG, $colorFondoB);
	//si falla al poner el color automaticamente asignara aleatorio
	if($background_color==false)
	{
		while($background_color==false)
		{
			$colorFondoR = rand(128,160);
			$colorFondoG = rand(128,160);
			$colorFondoB = rand(128,160);
			$background_color = imagecolorallocate($captcha, $colorFondoR, $colorFondoG, $colorFondoB);
		}
	}
	imagefill($captcha, 0, 0, $background_color);
	if($lineas==true)
	{
		for($i=0;$i<10;$i++)
		{
			$color = rand(48,96);
			imageline($captcha, rand(0,130),rand(0,35), rand(0,130), rand(0,35),imagecolorallocate($captcha, $color, $color, $color));
		}
	}
	$texto = substr(md5(rand()*time()),0,$cantidadLetras);
	$texto = strtoupper($texto);
	$texto = str_replace("O","B", $texto);
	$texto = str_replace("0","C", $texto);
	session_start();
	$_SESSION[$session]=$texto;
	$letras =  str_split($texto);
	putenv('GDFONTPATH=' . realpath('.'));
	$posicionLetrasX = round($width/$cantidadLetras, 0, PHP_ROUND_HALF_DOWN);
	//$posicionLetrasY = ; // aun no implementado
	for($i=0;$i<5;$i++)
	{
		$fuente=$font[rand(0,4)];
		$color = rand(0,32);
		if(file_exists($fuente)){
			$x=4+$i*$posicionLetrasX - 1 +rand(0,6);
			$y=rand($tamanoFuente+5, $height-($tamanoFuente+5));
			imagettftext  ($captcha, $tamanoFuente, rand(-25,25), $x, $y, imagecolorallocate($captcha, $color, $color, $color), $fuente, $letras[$i]);
		}else{
			$x=5+$i*$posicionLetrasX+rand(0,6);
			$y=rand(1,18);
			imagestring($captcha, 5, $x, $y, $letras[$i], imagecolorallocate($captcha, $color, $color, $color));
		}
	}
	if($distorcion==true)
	{
		$distorcion = array(array(1, 1, 1), array(1.0, 7, 1.0), array(1, 1, 1));
		imageconvolution($captcha, $distorcion, 16, 32);
	}
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: private",false);
	header("Content-type: image/"+$formatoSalida);
	switch ($formatoSalida) {
    case "png":
        imagepng($captcha);
        break;
    case "gif":
        imagegif($captcha);
        break;
    case "jpg":
	default: 
        imagejpeg($captcha);
        break;
	}
	
?>