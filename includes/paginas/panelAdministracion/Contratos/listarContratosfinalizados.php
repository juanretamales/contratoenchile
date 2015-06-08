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
			require_once "script/webConfig.php";
					$page=explode("/",$pagina);
					$back="";
					for($i=0;$i<(count($page)-1);$i++)
					{
						if($i!=0)
						{
							$back=$back."/".$page[$i];
						}
						else
						{
							$back=$back.$page[$i];
						}
					}
					?>
			<h1 class="titulo">Contratos Finalizados</h1>
			<form id="frmModificar" method="post" name="frmModificar" action="<?php echo WEB_BASE.$back; ?>/modificar">
				<input type="hidden" id="txtCode" name="txtCode">
			</form>
			<table cellpadding="0" cellspacing="0" border="0" id="table" class="sortable">
				<thead>
					<tr>
						<th><h3>Fecha</h3></th>
						<th><h3>Empresa</h3></th>
						<th><h3>Persona</h3></th>
						<th colspan="4" class="nosort"><h3>Accion</h3></th>
					</tr>
				</thead>
				<tbody>
			<?php
							require_once('script/function.php');
							$arg=array ('id_est'=>8);
							$contratos=listarContactosSinDetalle($arg);
							for($i=0;$i<count($contratos);$i++)
							{
								?>
				<tr>
					<td><?php echo $contratos [$i] ['fecha_con']; ?></td>
					<td><?php echo $contratos [$i] ['nom_ent']; ?></td>
					<td><?php echo $contratos [$i] ['nombre']." ".$contratos [$i] ['apellido']; ?></td>
					<td><a onclick="verContacto(<?php echo $contratos [$i] ['id_con']; ?>)">
					<img title="ver" width="20px" src="<?php echo WEB_BASE; ?>imagenes/UI/ver.png">
					</a></td>
					<td><a onclick="verMensajes(<?php echo $contratos [$i] ['id_con']; ?>)">
					<img title="ver" width="20px" src="<?php echo WEB_BASE; ?>imagenes/UI/mensajes.png">
					</a></td>
					<td><a onclick="modificar(<?php echo $contratos [$i] ['id_con']; ?>)">
					<img title="modificar" width="20px" src="<?php echo WEB_BASE; ?>imagenes/UI/modificar.png">
					</a></td>
					<td><a onclick="eliminarContacto(<?php echo $contratos [$i] ['id_con']; ?>, '<?php echo $contratos [$i] ['nom_ent'].' con '.$contratos [$i] ['nombre']." ".$contratos [$i] ['apellido']; ?>')">
						<img title="Eliminar" width="20px" src="<?php echo WEB_BASE;?>imagenes/UI/borrar.png">
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
