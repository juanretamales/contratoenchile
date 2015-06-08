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
		<section id="contenido" >
			<h1 class="titulo">Documentos</h1>
			<a class="boton" style="width: 50px;" href="<?php
				echo WEB_BASE;
				$pagina="";
				if(isset($_REQUEST['pagina']))
				{
					$pagina=$_REQUEST['pagina'];
				}
				echo $pagina;
			?>/agregar">Agregar</a>
			<form id="frmModificar" method="POST" name="frmModificar" action="<?php echo WEB_BASE.$pagina; ?>/modificar">
				<input type="hidden" id="txtCode" name="txtCode">
			</form>
		<div id="error"></div>
			<section id="descripcion">
				Los documentos son archivos que se muestran en el sitio de la empresa generada por contrato en chile, sirven para demostrar conocimiento, legalidad que exista en la empresa, puede ser desde certificaciones hasta cartas de recomendacion.
			</section>
			<table class="sortable" id="anyid" cellpadding="0" cellspacing="0">
				<tr>
					<th>Codigo</th>
					<th>Nombre</th>
					<th>Tipo doc</th>
					<th>URL</th>
					<th colspan="2" class="unsortable">Accion</th>
				</tr>
			<?php
							require_once('script/function.php');
							require_once "script/webConfig.php";
							$arg=array ('id_ent'=>$_SESSION['empresa']);
							$doc=listarDocumento($arg);
							$td=listarTipodoc($arg);
							for($i=0;$i<count($doc);$i++)
							{
								?>
				<tr>
					<td><?php echo $doc [$i] ['id_doc']; ?></td>
					<td><?php echo $doc [$i] ['nom_doc']; ?></td>
					<td><?php
							for($j=0;$j<count($td);$j++)
							{
								if($doc [$i] ['id_td']==$td [$j]['id_td'])
								{
									echo $td [$j]['nom_td'];
								}
							}
					?></td>
					<td><a href="
					<?php 
							$urlmedia=$doc [$i] ['url_doc'];
								if(strpos('http',$urlmedia)===false && strpos('https',$urlmedia)===false)
								{
									$urlmedia='http://'.$urlmedia;
								}
							echo $urlmedia; 
						?>">
						<img title="Url" width="20px" src="<?php echo WEB_BASE; ?>imagenes/UI/adjuntar.png">
					</a></td>
					<td><a onclick="modificar(<?php echo $doc [$i] ['id_doc']; ?>)">
						<img title="Modificar" width="20px" src="<?php echo WEB_BASE; ?>imagenes/UI/modificar.png">
					</a></td>
					<td><a onclick="eliminarDocumento(<?php echo $doc [$i] ['id_doc']; ?>, '<?php echo $doc [$i] ['nom_doc']; ?>')">
						<img title="Eliminar" width="20px" src="<?php echo WEB_BASE; ?>imagenes/UI/borrar.png">
					</a></td>
				</tr>
				<?php } ?>
			</table>
		</section>
		<?php cc_footer(); ?>
	</body>
</html>