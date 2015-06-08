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
			if(count($page)>1)
			{
				$arg=array ();
				if($page[1]!="nada" || $page[1]!="")
				{
					$arg['nom_ent']=$page[1];					
				}				//print_r($arg);
				$entidad=listarEntidad($arg);				//print_r($entidad);
				if(count($entidad)==0)
				{
					echo '<h1 class="titulo2">No se encontraros Empresas con estas caracteristicas, ¿Deseas intentar crearlo tu?</h1>';
				}
				else
				{					echo '<h1 class="titulo2">'.$arg['nom_ent'].'</h1>';
			?>				<div class="fb-like" data-href="<?php echo WEB_BASE.$_REQUEST['pagina'];?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>				<div id="fb-root"></div>				<?php					$arg=array (						'id_ent'=>$entidad [0] ['id_ent'],						'id_est'=>5					);					//print_r($arg);					$servicios=listarServiciosSinDetalle($arg);					if(count($servicios)==0)					{						echo "La empresa no presenta servicios registrados.";					}					else					{						//print_r($servicios);						shuffle($servicios);						for($i=0;$i<count($servicios);$i++)						{							$arg=array(							'id_serv'=>$servicios [$i] ['id_serv'],							'id_tm'=>3							);							$imagenes=listarMedia($arg);				?>					<article class="servicios">						<a href="<?php echo WEB_BASE.'detalle/'.$servicios [0] ['nom_ent'].'/'.$servicios [$i] ['nom_serv']; ?>">						<?php							if(count($imagenes)==0)							{						?>							<img width="120" height="95" src="<?php echo WEB_BASE; ?>script/holder.js/120x95">						<?php							}							else							{						?>							<img width="120" height="95" src="<?php echo $imagenes [$i] ['url_med']; ?>">						<?php							}						?>							<label><?php echo $servicios [$i] ['nom_serv'] . ' de ' . $servicios [$i] ['nom_ent']; ?></label>							<p><?php echo $servicios [$i] ['desc_serv']; ?></p>							<p>Tipo: <?php echo $servicios [$i] ['nom_ts']; ?>. <?php echo $servicios [$i] ['nom_cat']; ?>/<?php echo $servicios [$i] ['nom_scat']; ?></p>							<?php								if(isset($_SESSION['rol']))								{							?>								<a onclick="agregarAlCarro(<?php echo $servicios [$i] ['id_serv']; ?>)" class="canasta">Agregar a Canasta</a>								<a onclick="agregarAComparacion(<?php echo $servicios [$i] ['id_serv']; ?>)" class="comparar">Agregar a comparacion</a>							<?php								}							?>						</a>					</article>					<?php } ?>
						<div class="fb-comments" data-href="<?php echo WEB_BASE.$_REQUEST['pagina']; ?>" data-numposts="5" data-colorscheme="light"></div>					<?php 
					}									}
			}
			?>
			</section>
		<?php cc_footer(); ?>
		<style>
			.fbConnectWidgetFooter { display: none }
		</style>
	</body>
</html>