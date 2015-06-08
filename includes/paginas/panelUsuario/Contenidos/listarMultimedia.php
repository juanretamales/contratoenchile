<html lang="es" dir="LTR" >
	<head>
		<?php 
		$titulo = "Listar multimedia";
		cc_head(); ?>
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
				cc_menu($pagina); 
				//corregir ya que esta mostrando todos los multimedia del sitio
				require_once('script/function.php');
					$arg=array ('nada'=>0);
					$tm=listarTipomedia($arg);
					$arg=array ('id_ent'=>$_SESSION['empresa']);
					$page=explode("/",$pagina);
					$media=listarMedia($arg);
				?>
		</section>
		<section id="contenido" >
			<h1 class="titulo">Multimedia</h1>
			<a class="boton" href="<?php
				echo WEB_BASE;
				$pagina="administracion/multimedia";
				echo $pagina;
			?>/agregar">Agregar</a>
			<form id="frmModificar" method="POST" name="frmModificar" action="<?php echo WEB_BASE.$pagina; ?>/modificar">
				<input type="hidden" id="txtCode" name="txtCode">
			</form>
		<div id="error"></div>
			<section id="descripcion">
				Los archivos multimedia se muestran en la descripcion del servicio, tales como imagenes, fotos, videos o musica.
			</section>
			<table class="sortable" id="anyid" cellpadding="0" cellspacing="0">
				<tr>
					<th>Nombre</th>
					<th>Tipo</th>
					<th>URL</th>
					<th colspan="2" class="unsortable">Accion</th>
				</tr>
				<?php
					
					
					for($i=0;$i<count($media);$i++)
					{
						?>
				<tr>
					<td><?php echo $media [$i] ['nom_med']; ?></td>
					<td><?php
					for($j=0;$j<count($tm);$j++)
						{
							if($media [$i] ['id_tm']==$tm [$j] ['id_tm'])
							{
								echo $tm [$j] ['nom_tm'];
								break;
							}
						}
					?></td>
					<td>
					<?php
						$enlaces = explode(";", $media [$i] ['url_med']);
						for($j=0;$j<count($enlaces);$j++)
						{
					?>
						<a href="<?php 
							$urlmedia=$enlaces[$j];
								if(strpos('http',$urlmedia)===false && strpos('https',$urlmedia)===false)
								{
									$urlmedia='http://'.$urlmedia;
								}
							echo $urlmedia; 
						?>">
							<img title="<?php echo $media [$i] ['nom_med']; ?>" width="20px" src="<?php echo WEB_BASE; ?>imagenes/UI/adjuntar.png">
						</a>
					<?php
						}
					?>
					</td>
					<td><a onclick="modificar(<?php echo $media [$i] ['id_med']; ?>)">
						<img title="Modificar" width="20px" src="<?php echo WEB_BASE; ?>imagenes/UI/modificar.png">
					</a></td>
					<td><a onclick="eliminarMultimedia(<?php echo $media [$i] ['id_med']; ?>, '<?php echo $media [$i] ['nom_med']; ?>')">
						<img title="Eliminar" width="20px" src="<?php echo WEB_BASE; ?>imagenes/UI/borrar.png">
					</a></td>
				</tr>
				<?php } ?>
			</table>
		</section>
		<?php cc_footer(); ?>
	</body>
</html>