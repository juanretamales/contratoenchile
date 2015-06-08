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

			<h1 class="titulo">Menu</h1>
			<a class="myButton" style="width: 50px;" href="<?php echo WEB_BASE; ?><?php
				$pagina="";
				if(isset($_REQUEST['pagina']))
				{
					$pagina=$_REQUEST['pagina'];
				}
				echo $pagina;
			?>/agregar">Agregar</a>
			<form id="frmModificar" method="post" name="frmModificar" action="<?php echo WEB_BASE; ?><?php echo $pagina;?>/modificar">
				<input type="hidden" id="txtCode" name="txtCode">
			</form>
	<div id="error"></div>
			<table cellpadding="0" cellspacing="0" border="0" id="table" class="sortable">
				<thead>
					<tr>
						<th><h3>Codigo</h3></th>
						<th><h3>Nombre</h3></th>
						<th><h3>Descripcion</h3></th>
						<th><h3>Tipo</h3></th>
						<th class="nosort">Items</th>
						<th colspan="2" class="nosort"><h3>Accion</h3></th>
					</tr>
				</thead>
				<tbody>
			<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$menu=listarMenu($arg);
							$tipo=listarTipousuario($arg);
							$item=listarMenuContenido($arg);
							for($i=0;$i<count($menu);$i++)
							{
								?>
				<tr>
					<td><?php echo $menu [$i] ['id_menu']; ?></td>
					<td><?php echo $menu [$i] ['nom_menu']; ?></td>
					<td><?php echo $menu [$i] ['desc_menu']; ?></td>
					<td><?php 
							for($j=0;$j<count($tipo);$j++)
							{
								if($tipo [$j] ['id_tu']==$menu [$i] ['id_tu'])
								{
									echo $tipo [$j] ['nom_tu'];
								}
							}
							?></td>
					<td><?php 
					for($j=0;$j<count($item);$j++)
					{
						if($item [$j] ['id_menu']==$menu [$i] ['id_menu'])
						{
							echo "- ".$item [$j] ['nom_pag']."<br>";
						}
					}
					?></td>
					<td><a onclick="modificar(<?php echo $menu [$i] ['id_menu']; ?>)">
						<img title="Modificar" width="20px" src="<?php echo WEB_BASE; ?>imagenes/UI/modificar.png">
					</a></td>
					<td><a onclick="eliminarMenu(<?php echo $menu [$i] ['id_menu']; ?>, '<?php echo $menu [$i] ['nom_menu']; ?>')">
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