<html lang="es" dir="LTR" >
	<head>
		<?php cc_head(); ?>
		
	</head>
	<body>
	<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&appId=259290437609367&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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
			require_once('script/function.php');
			$page=explode("/",$pagina);
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
				if(count($servicios)==0)
				{
					echo '<h1 class="titulo2">No se encontraros servicios con estas caracteristicas, ¿Deseas intentar crearlo tu?</h1>';
				}								
				else
				{
					
			?>
					<article class="servicios">						<label class="titulo"><?php echo $servicios [0] ['nom_serv'] . ' de ' . $servicios [0] ['nom_ent']; ?></label>						<p class="descripcion"><?php echo $servicios [0] ['desc_serv']; ?></p>						<p class="tipo">							<a><?php echo $servicios [0] ['nom_scat']; ?></a>							<a><?php echo $servicios [0] ['nom_ts']; ?></a>						<?php							if(isset($_SESSION['rol']))							{								if($_SESSION['rol']>0)								{						?>							<a onclick="agregarAlCarro(<?php echo $servicios [0] ['id_serv']; ?>)" class="canasta">Agregar a Canasta</a>							<a onclick="agregarAComparacion(<?php echo $servicios [0] ['id_serv']; ?>)" class="comparar">Agregar a comparacion</a>						<?php								} 							}						?>					</article>
					<div class="fb-like" data-href="<?php echo WEB_BASE.$_REQUEST['pagina'];?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
					
						
						<?php
							$arg=array(
								'id_serv'=>$servicios [$i] ['id_serv']
								//, 'id_tm'=>3
							);
							$media=listarMedia($arg);
							if(count($media)>0)
							{
								echo '<article class="servicios"><ul><h2>Multimedia</h2>';
								for($i=0;$i<count($media) && $i<5;$i++)
								{
									switch($media [$i] ['id_tm'])
									{
										case 3:
						?>
										<li>
											<span>
												<img border="0" src="<?php echo $media [$i] ['url_med'];?>" />
												<a class="mensaje" href="<?php echo $media [$i] ['url_med'];?>"><?php echo $media [$i] ['nom_med'];?></a>
											</span>
										</li>
						<?php
										break;
										case 1:
									
										$enlaces = explode(";", $media [$i] ['url_med']);
						?>
										<li>
											<audio controls>
												<source src="<?php echo $enlaces[0];?>" type="audio/mpeg">
												<source src="<?php echo $enlaces[1];?>" type="audio/ogg">
												<source src="<?php echo $enlaces[2];?>" type="audio/wav">
											</audio> 
										</li>
						<?php			
										break;
										case 2:
										$enlaces = explode(";", $media [$i] ['url_med']);
						?>
										<li>
											<audio controls>
												<source src="<?php echo $enlaces[0];?>" type="video/mp4">
												<source src="<?php echo $enlaces[1];?>" type="video/ogg">
												<source src="<?php echo $enlaces[2];?>" type="video/webm">
											</audio> 
										</li>
						<?php			
										break;
										default:
						?>
										<li>
											<a href="<?php												$urlmedia=$media [$i] ['url_med'];												if(strpos('http',$urlmedia)===false && strpos('https',$urlmedia)===false)												{													$urlmedia='http://'.$urlmedia;												}											echo str_replace(';','',$urlmedia); 																						?>">
												<img title="<?php echo $media [$i] ['nom_med']; ?>" src="<?php echo WEB_BASE; ?>imagenes/UI/adjuntar.png">
											</a>
										</li>
						<?php			
										break;
									}
								}
								echo "</ul></article>";
							}
							
							$arg=array(
								'id_serv'=>$servicios [$i] ['id_serv'],
							);
							echo '<article class="servicios">';
							echo '<h2>Reputacion: Aqui esta un resumen de las calificaciones hechos por otros usuarios.</h2>';
							echo '<ul class="reputacion">';
								
							$promedio=listarPromedioCalificacionserv($arg);
							if(count($promedio)>0)
							{
								for($i=0;$i<count($promedio);$i++)
								{
									echo '<li class="cal'. str_replace(' ','_',$promedio [$i] ['nom_ec']).'">'.$promedio [$i] ['desc_tc'].'<label title="Valor: '.$promedio [$i] ['valor'].'">'.$promedio [$i] ['nom_ec']."</label></li>";
								}
							}
							else
							{
								echo "<li>Aun no a sido calificado este servicio.</li>";
							}
							echo '</ul></article>';
						?>
						<!--<div id="fb-root"></div>

<div class="fb-comments" data-href="<?php echo WEB_BASE.$_REQUEST['pagina']; ?>" data-numposts="5" data-colorscheme="light"></div>-->
					
				<?php 
				}
			}
			else
			{
				echo '<h1 class="titulo2">No se encontraros servicios con estas caracteristicas, ¿Deseas intentar crearlo tu?</h1>';
			}
			?>
			</section>
		<?php cc_footer(); ?>
		<style>
			.fbConnectWidgetFooter { display: none }
		</style>
	</body>
</html>