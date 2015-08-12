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
					}				}				if(isset($page[3]))
				{
					if($page[3]!="Todos")
					{
						$arg['nom_ts']=$page[3];
					}
				}
				if(isset($page[4]))
				{	
					if($page[4]>1)
					{
						$arg['limit']= 1+($page[4]*10) . "," . ($page[4]+1)*10;
					}
					else
					{
						$arg['limit']= "0, 10";
					}
				}
				else
				{
					$arg['limit']= "0, 10";
				}
				$servicios=listarServiciosSinDetalle($arg);
				if(count($servicios)==0)
				{
					?>
					<div class="mensaje informativo">
					<em></em>
					<p>No se encontraros servicios con estas caracteristicas, ¿Deseas ser el primero en ofrecer servicios?</p>
					<a onclick="this.parentNode.remove()">X</a>
					</div>
				<?php
				}
				for($i=0;$i<count($servicios);$i++)
				{
			?>
					<a href="<?php echo WEB_BASE.'detalle/'.$servicios [0] ['nom_ent'].'/'.$servicios [$i] ['nom_serv']; ?>">					<article class="servicios">										<?php						if($servicios [$i] ['desc_img']=="")						{					?>							<img  style="background: url(<?php echo WEB_BASE; ?>script/holder.js/120x95);" src="<?php echo WEB_BASE; ?>imagenes/1x1.png">					<?php						}						else						{					?>	
						<img  style="background: url(<?php echo $servicios [$i] ['desc_img']; ?>); background-size: 100% auto;" src="<?php echo WEB_BASE; ?>imagenes/1x1.png">					<?php						}					?>						<label class="titulo"><?php echo $servicios [$i] ['nom_serv'] . ' de ' . $servicios [$i] ['nom_ent']; ?></label>						<p class="descripcion"><?php echo substr($servicios [$i] ['desc_serv'], 0, 250); ?></p>						<p class="tipo">							<a><?php echo $servicios [$i] ['nom_scat']; ?></a>							<a><?php echo $servicios [$i] ['nom_ts']; ?></a>						<?php							if(isset($_SESSION['rol']))							{								if($_SESSION['rol']>0)								{						?>							<a onclick="agregarAlCarro(<?php echo $servicios [$i] ['id_serv']; ?>)" class="canasta">Agregar a Canasta</a>							<a onclick="agregarAComparacion(<?php echo $servicios [$i] ['id_serv']; ?>)" class="comparar">Agregar a comparacion</a>						<?php								} 							}						?>					</article>				</a>
			<?php } 
			
				$arg=array ('id_est'=>5);
				if($page[1]!="nada" || $page[1]!="")
				{
					$arg['nom_cat']=$page[1];
				}
				if(isset($page[2]))
				{
					if($page[2]!="Todos")
					{
						$arg['nom_scat']=$page[2];
					}
				}
				if(isset($page[3]))
				{
					if($page[3]!="Todos")
					{
						$arg['nom_ts']=$page[3];
					}
				}
				//print_r($arg);
				$paginas = round((listarCantidadServicio($arg)/10+1), 0, PHP_ROUND_HALF_UP);
			?>				<ul class="navegacion">
				<?php 
					for($i=1;$i<$paginas;$i++)
					{
						echo '<li><a ';
						if(isset($page[4]))
						{
							if($page[4]==$i)
							{
								echo ' class="seleccionado" ';
							}
						}
						echo ' href="'.WEB_BASE.'/';
						if(isset($page[2]))
						{
							echo '/'.$page[2];
						}
						else
						{
							echo '/'."Todos";
						}
						if(isset($page[3]))
						{
							echo '/'.$page[3];
						}
						else
						{
							echo '/'."Todos";
						}
						echo '/'.$i.'">'.$i.'</a></li>';
					}
					
				?>
					
				</ul>
			</section>
		<?php cc_footer(); ?>
	</body>
</html>