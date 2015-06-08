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
	
	$captcha = imagecreatetruecolor(120,35);
	$color = rand(128,160);
	$background_color = imagecolorallocate($captcha, $color, $color, $color);
	imagefill($captcha, 0, 0, $background_color);
	for($i=0;$i<10;$i++)
	{
		$color = rand(48,96);
		imageline($captcha, rand(0,130),rand(0,35), rand(0,130), rand(0,35),imagecolorallocate($captcha, $color, $color, $color));
	}
	$texto = substr(md5(rand()*time()),0,5);
	$texto = strtoupper($texto);
	$texto = str_replace("O","B", $texto);
	$texto = str_replace("0","C", $texto);
	session_start();
	$_SESSION["captcha"]=$texto;
	$letras =  str_split($texto);
	putenv('GDFONTPATH=' . realpath('.'));
	$font[0] = 'Arial.ttf';
	$font[1] = 'Alpaca.ttf';
	$font[2] = 'Geosans.ttf';
	$font[3] = 'Optimus.ttf';
	$font[4] = 'Sanford.ttf';
	for($i=0;$i<5;$i++)
	{
		$fuente=$font[rand(0,4)];
		$color = rand(0,32);
		if(file_exists($fuente)){
			$x=4+$i*23+rand(0,6);
			$y=rand(18,28);
			imagettftext  ($captcha, 15, rand(-25,25), $x, $y, imagecolorallocate($captcha, $color, $color, $color), $fuente, $letras[$i]);
		}else{
			$x=5+$i*24+rand(0,6);
			$y=rand(1,18);
			imagestring($captcha, 5, $x, $y, $letras[$i], imagecolorallocate($captcha, $color, $color, $color));
		}
	}
	$distorcion = array(array(1, 1, 1), array(1.0, 7, 1.0), array(1, 1, 1));
	imageconvolution($captcha, $distorcion, 16, 32);
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: private",false);
	header("Content-type: image/gif");
	imagejpeg($captcha);
?>