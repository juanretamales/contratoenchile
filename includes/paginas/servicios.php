<html lang="es" dir="LTR" >
	<head>
		<?php cc_head(); ?>
	</head>
	<body>
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
				$arg=array ('id_est'=>5);
				//print_r($page);
				if($page[1]!="nada" || $page[1]!="")
				{
					$arg['nom_cat']=$page[1];
				}				if(isset($page[2]))				{
					if($page[2]!="Todos")
					{
						$arg['nom_scat']=$page[2];
					}				}				if(isset($page[3]))				{
					if($page[3]!="")
					{
						$arg['nom_ts']=$page[3];
					}				}
				$servicios=listarServiciosSinDetalle($arg);
				if(count($servicios)==0)
				{
					echo '<h1 class="titulo2">No se encontraros servicios con estas caracteristicas, ¿Deseas intentar crearlo tu?</h1>';
				}
				for($i=0;$i<count($servicios) && $i<5;$i++)
				{
					$arg=array(
					'id_serv'=>$servicios [$i] ['id_serv'],
					'id_tm'=>3
					);
					$imagenes=listarMedia($arg);
			?>
					<a href="<?php echo WEB_BASE.'detalle/'.$servicios [0] ['nom_ent'].'/'.$servicios [$i] ['nom_serv']; ?>">					<article class="servicios">										<?php						if(count($imagenes)==0)						{					?>						<img width="120" height="95" src="<?php echo WEB_BASE; ?>script/holder.js/120x95">					<?php						}						else						{					?>						<img width="120" height="95" src="<?php echo $imagenes [$i] ['url_med']; ?>">					<?php						}					?>						<label class="titulo"><?php echo $servicios [$i] ['nom_serv'] . ' de ' . $servicios [$i] ['nom_ent']; ?></label>						<p class="descripcion"><?php echo substr($servicios [$i] ['desc_serv'], 0, 250); ?></p>						<p class="tipo">							<a><?php echo $servicios [$i] ['nom_scat']; ?></a>							<a><?php echo $servicios [$i] ['nom_ts']; ?></a>						<?php							if(isset($_SESSION['rol']))							{								if($_SESSION['rol']>0)								{						?>							<a onclick="agregarAlCarro(<?php echo $servicios [$i] ['id_serv']; ?>)" class="canasta">Agregar a Canasta</a>							<a onclick="agregarAComparacion(<?php echo $servicios [$i] ['id_serv']; ?>)" class="comparar">Agregar a comparacion</a>						<?php								} 							}						?>					</article>				</a>
			<?php } ?>
			</section>
		<?php cc_footer(); ?>
	</body>
</html>