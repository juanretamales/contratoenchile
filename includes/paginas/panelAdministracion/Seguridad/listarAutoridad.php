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

			<h1 class="titulo">Autoridad</h1>
			
			<a class="boton" href="<?php
			echo WEB_BASE;
				$pagina="";
				if(isset($_REQUEST['pagina']))
				{
					$pagina=$_REQUEST['pagina'];
				}
				echo $pagina;
			?>/agregar">Agregar</a>
			<form id="frmModificar" method="post" name="frmModificar" action="<?php echo WEB_BASE.$pagina; ?>/modificar">
				<input type="hidden" id="txtCode" name="txtCode">
			</form>
			
		<div id="error"></div>
			<table cellpadding="0" cellspacing="0" border="0" id="table" class="sortable">
				<thead>
					<tr>
						<th><h3>Empresa</h3></th>
						<th><h3>Usuario</h3></th>
						<th colspan="2" class="nosort"><h3>Accion</h3></th>
					</tr>
				</thead>
				<tbody>
			<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$ad=listarAutoridadDetalle($arg);
							for($i=0;$i<count($ad);$i++)
							{
								?>
				<tr>
					<td><?php echo $ad [$i] ['nom_ent']; ?></td>
					<td><?php echo $ad [$i] ['nombre'].' '.$ad [$i] ['apellido']; ?></td>
					<td><a onclick="eliminarAutoridad('<?php echo $ad [$i] ['rut'].'+'.$ad [$i] ['id_ent']; ?>', ' <?php echo $ad [$i] ['nombre'].' '.$ad [$i] ['apellido']; ?> sobre <?php echo $ad [$i] ['nom_ent']; ?>')">
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
  </script>
	</div>
</section>
	<?php cc_footer(); ?>
</body>
</html>
