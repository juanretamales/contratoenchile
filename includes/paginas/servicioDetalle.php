<html lang="es" dir="LTR" >
	<head>
		<?php cc_head(); ?>
		
	</head>
	<body>
	<script>(function(d, s, id) {
  /*var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&appId=259290437609367&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));*/</script>
		<?php cc_header(); ?>
		<section>
			<?php 
				$pagina="";
				if(isset($_REQUEST['pagina']))
				{
					$pagina=$_REQUEST['pagina'];
				}
				cc_menu($pagina); ?>
		</section>
		<section id="contenido">
		<?php
		require_once('script/function.php');		$archivo="./in/".urlencode($pagina).".php";		$servicios=array();		if(file_exists($archivo))		{			require_once($archivo);		}		else		{
			$page=explode("/",$pagina);			/*codigo para guardar cache de servicio								$archivo= "./in/".urlencode($pagina).".php";			$registro="<?php test1123 ?>";			$file = fopen($archivo,"w");			fwrite($file,$registro);			fclose($file);*/
			if(count($page)>2)
			{
				$arg=array ('id_est'=>5);
				if($page[1]!="nada" || $page[1]!="")
				{
					$arg['nom_emp']=$page[1];
				}
				if($page[2]!="Todos")
				{
					$arg['nom_serv']=$page[2];
				}
				$servicios=listarServiciosSinDetalle($arg);
			}		}		if($servicios!="nada")		{
		?>
			<article class="servicios">				<label class="titulo"><?php echo $servicios [0] ['nom_serv'] . ' de ' . $servicios [0] ['nom_ent']; ?></label>				<p class="descripcion"><?php echo $servicios [0] ['desc_serv']; ?></p>				<p class="tipo">					<a><?php echo $servicios [0] ['nom_scat']; ?></a>					<a><?php echo $servicios [0] ['nom_ts']; ?></a>				<?php					if(isset($_SESSION['rol']))					{						if($_SESSION['rol']>0)						{				?>					<a onclick="agregarAlCarro(<?php echo $servicios [0] ['id_serv']; ?>)" class="canasta">Agregar a Canasta</a>					<a onclick="agregarAComparacion(<?php echo $servicios [0] ['id_serv']; ?>)" class="comparar">Agregar a Comparacion</a>				<?php						} 					}				?>			</article>
				<?php					$arg=array(
						'id_serv'=>$servicios [0] ['id_serv'],
					);
				?>			<article class="servicios">
				<h2>Reputacion: Aqui esta un resumen de las calificaciones hechos por otros usuarios.</h2>
				<ul class="reputacion">						<?php							$promedio=listarPromedioCalificacionserv($arg);
							if(count($promedio)>0)
							{
								for($i=0;$i<count($promedio);$i++)
								{
									echo '<li class="cal'. str_replace(' ','_',$promedio [$i] ['nom_ec']).'">'.$promedio [$i] ['desc_tc'].'<label title="Valor: '.$promedio [$i] ['valor'].'">'.$promedio [$i] ['nom_ec']."</label></li>";								}
							}
							else
							{
								echo "<li>Aun no a sido calificado este servicio.</li>";
							}
							?>				</ul>			</article>
	<?php 		}		else		{	?>			<div class="mensaje informativo">				<em></em>				<p>No se encontraros servicios con estas caracteristicas, ¿Deseas ser el primero en ofrecer servicios?</p>				<a onclick="this.parentNode.remove()">X</a>			</div>		<?php		}
		?>
			</section>
		<?php cc_footer(); ?>
	</body>
</html>