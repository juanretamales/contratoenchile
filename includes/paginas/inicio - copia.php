<html lang="es" dir="LTR" >
<head>
	<?php cc_head(); ?>
</head>
<body>
		<?php cc_header(); ?>
		<section>
			<?php 
			cc_menu($pagina); ?> 
			<section id="contenido">
			<?php
				require_once('script/function.php');
				$arg=array ('id_est'=>5);
				$servicios=listarServiciosSinDetalle($arg);
				shuffle($servicios);
				for($i=0;$i<count($servicios) && $i<5;$i++)
				{
				$arg=array(
					'id_serv'=>$servicios [$i] ['id_serv'],
					'id_tm'=>3
					);
					$imagenes=listarMedia($arg);
			?>
				<article class="servicios">
					<a href="<?php echo WEB_BASE.'detalle/'.$servicios [0] ['nom_ent'].'/'.$servicios [$i] ['nom_serv']; ?>">
					<?php
						if(count($imagenes)==0)
						{
					?>
						<img width="120" height="95" src="<?php echo WEB_BASE; ?>script/holder.js/120x95">
					<?php
						}
						else
						{
					?>
						<img width="120" height="95" src="<?php echo $imagenes [$i] ['url_med']; ?>">
					<?php
						}
					?>
						<label class="titulo"><?php echo $servicios [$i] ['nom_serv'] . ' de ' . $servicios [$i] ['nom_ent']; ?></label>
						<p class="descripcion"><?php echo substr($servicios [$i] ['desc_serv'], 0, 250); ?></p>
						<p class="tipo">Tipo: <?php echo $servicios [$i] ['nom_ts']; ?>. Categoria:<?php echo $servicios [$i] ['nom_cat']; ?>. Subcategoria:<?php echo $servicios [$i] ['nom_scat']; ?></p>
						<?php
							if(isset($_SESSION['rol']))
							{
								/*if($_SESSION['rol']!=0)
								{*/
						?>
							<a onclick="agregarAlCarro(<?php echo $servicios [$i] ['id_serv']; ?>)" class="canasta">Agregar a Canasta</a>
							<a onclick="agregarAComparacion(<?php echo $servicios [$i] ['id_serv']; ?>)" class="comparar">Agregar a comparacion</a>
						<?php
							//} 
							}
						?>
					</a>
				</article>
			<?php } ?>
			</section>
		</section>
		<?php cc_footer(); ?>
</body>
</html>