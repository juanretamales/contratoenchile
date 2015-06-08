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
				}
				if($page[2]!="Todos")
				{
					$arg['nom_scat']=$page[2];
				}
				if($page[3]!="")
				{
					$arg['nom_ts']=$page[3];
				}
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
					<a href="<?php echo WEB_BASE.'detalle/'.$servicios [0] ['nom_ent'].'/'.$servicios [$i] ['nom_serv']; ?>">
			<?php } ?>
			</section>
		<?php cc_footer(); ?>
	</body>
</html>