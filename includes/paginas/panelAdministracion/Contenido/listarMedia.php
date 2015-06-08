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
				cc_menu($pagina); 
				
				require_once('script/function.php');
					$arg=array ('nada'=>0);
					$tm=listarTipomedia($arg);
					$page=explode("/",$pagina);
					$servicio="";
					$servicio=listarServicio($arg);
						$entidad=listarEntidad($arg);
					$media=listarMedia($arg);
				?>
		</section>
		<section id="contenido" >
			<h1 class="titulo">Multimedia</h1>
			<a class="myButton" style="width: 50px;" href="<?php
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
			
			<table cellpadding="0" cellspacing="0" border="0" id="table" class="sortable">
				<thead>
					<tr>
						<th><h3>Nombre</h3></th>
						<th><h3>Tipo</h3></th>
						<th><h3>Servicio</h3></th>
						<th><h3>Empresa</h3></th>
						<th><h3>URL</h3></th>
						<th colspan="2" class="nosort"><h3>Accion</h3></th>
					</tr>
				</thead>
				<tbody>
				<?php
					
					
					for($i=0;$i<count($media);$i++)
					{
						?>
				<tr>
					<td><?php echo $media [$i] ['nom_med']; ?></td>
					<td><?php
					//echo $media [$i] ['id_tm'];
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
						$arg=array ('nada'=>0);
						$ent="";
						for($j=0;$j<count($servicio);$j++)
						{
							if($servicio [$j] ['id_serv']==$media [$i] ['id_serv'])
							{
								echo $servicio [$j] ['nom_serv'];
								$ent=$servicio [$j] ['id_ent'];
								break;
							}
						}
					?>
					</td>
					
					<td>
					<?php
						
						$arg=array ('nada'=>0);
						for($j=0;$j<count($entidad);$j++)
						{
							if($entidad [$j] ['id_ent']==$ent)
							{
								echo $entidad [$j] ['nom_ent'];
								break;
							}
						}
					?>
					</td>
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
			</tbody>
			</table>
			<div id="controls">
		<div id="perpage">
			<select onchange="sorter.size(this.value)">
			<option value="5">5</option>
				<option value="10" selected="selected">10</option>
				<option value="20">20</option>
				<option value="50">50</option>
				<option value="100">100</option>
			</select>
			<span>Entradas por pagina</span>
		</div>
		<div id="navigation">
			<img src="<?php echo WEB_BASE;?>imagenes/tabla/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
			<img src="<?php echo WEB_BASE;?>imagenes/tabla/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
			<img src="<?php echo WEB_BASE;?>imagenes/tabla/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
			<img src="<?php echo WEB_BASE;?>imagenes/tabla/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
		</div>
		<div id="text">Desplegando pagina <span id="currentpage"></span> de <span id="pagelimit"></span></div>
		<script type="text/javascript" src="<?php echo WEB_BASE;?>script/tablas.js"></script>
	<script type="text/javascript">
  var sorter = new TINY.table.sorter("sorter");
	sorter.head = "head";
	sorter.asc = "asc";
	sorter.desc = "desc";
	sorter.even = "evenrow";
	sorter.odd = "oddrow";
	sorter.evensel = "evenselected";
	sorter.oddsel = "oddselected";
	sorter.paginate = true;
	sorter.currentid = "currentpage";
	sorter.limitid = "pagelimit";
	sorter.init("table",1);
	sorter.size(10);
  </script>
	</div>
		</section>
		<?php cc_footer(); ?>
	</body>
</html>