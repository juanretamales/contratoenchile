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

			<h1 class="titulo">Funciones de Codigo</h1>
			<a class="boton" style="width: 50px;" href="<?php
				echo WEB_BASE;
				$pagina="";
				if(isset($_REQUEST['pagina']))
				{
					$pagina=$_REQUEST['pagina'];
				}
				echo $pagina;
			?>/agregar">Agregar</a>
			<form id="frmModificar" method="POST" name="frmModificar" action="<?php echo WEB_BASE; ?><?php echo $pagina; ?>/modificar">
				<input type="hidden" id="txtCode" name="txtCode">
			</form>
			
		<div id="error"></div>
			<table cellpadding="0" cellspacing="0" border="0" id="table" class="sortable">
				<thead>
					<tr>
						<th><h3>Codigo</h3></th>
						<th><h3>Nombre</h3></th>
						<th colspan="2" class="nosort"><h3>Accion</h3></th>
					</tr>
				</thead>
				<tbody>
				<?php
					require_once('script/transaccion.php');
					$transaccion=new transaccion();
					$query="SELECT fc.`id_fc`, fc.`nom_fc` FROM funcodigo fc";
					$mysqli=$transaccion->conectar();
					$mysqli->real_query($query);
					$resultado = $mysqli->use_result();
					while($fila = $resultado -> fetch_assoc())
					{
				?>
					<tr>
						<td><?php echo $fila ['id_fc']; ?></td>
						<td><?php echo $fila ['nom_fc']; ?></td>
						<td><a onclick="modificar(<?php echo $fila ['id_cod']; ?>)">
							<img title="Modificar" width="40px" src="<?php echo WEB_BASE; ?>imagenes/UI/modificar.png">
						</a></td>
						<td><a onclick="eliminarCodigo(<?php echo $fila ['id_cod']; ?>, '<?php echo $fila ['nom_cod']; ?>')">
							<img title="Eliminar" width="40px" src="<?php echo WEB_BASE; ?>imagenes/UI/borrar.png">
						</a></td>
					</tr>
				<?php 
					}
					$resultado->free();
					$mysqli->close();
				?>
				</tbody>
			</table>
			<div id="controls">
		<div id="perpage">
			<select onchange="sorter.size(this.value)">
				<option value="1">1</option>
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
			<style>
				@media screen and (max-width:600px)
				{
					td:nth-of-type(1):before { content: "Codigo"; }
					td:nth-of-type(2):before { content: "Nombre"; }
				}
			</style>
		</div>
	</section>
</section>
	<?php cc_footer(); ?>
</body>
</html>

