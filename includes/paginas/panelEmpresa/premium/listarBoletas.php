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
		<h1 class="titulo2">Boletas</h1>
			<section id="descripcion">
				Aqui se ve un listado de todas las boletas de subscripciones.
			
			<?php
				require_once('script/function.php');
					$arg=array ('id_ent'=>$_SESSION['empresa']);
					$boleta=listarBoleta($arg);
					$estado=listarEstado($arg);
					if(count($boleta)==0)
					{
						echo " No has realizado ninguna compra de subscripciones.</section>";
					}
					else
					{
			?></section>
			
			<table cellpadding="0" cellspacing="0" border="0" id="table" class="sortable">
				<thead>
					<tr>
						<th><h3>Fecha</h3></th>
						<th><h3>Monto</h3></th>
						<th><h3>Estado</h3></th>
					</tr>
				</thead>
				<tbody>
				<?php
					
					for($i=0;$i<count($boleta);$i++)
					{
					?>
				<tr>
					<td><?php echo $boleta [$i] ['fecha_bol']; ?></td>
					<td><?php echo $boleta [$i] ['monto']; ?></td>
					<td><?php
						for($j=0;$j<count($estado);$j++)
						{
							if($boleta [$i] ['id_est']==$estado [$j] ['id_est'])
							{
								echo $estado [$j] ['nom_est'];
							}
						}
						?>
					</td>
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
		<script type="text/javascript" src="<?php echo WEB_BASE;?>script/tablas.js"></script><style>	@media only screen and (max-width: 760px),(min-device-width: 768px) and (max-device-width: 1024px)  	{		td:nth-of-type(1):before { content: "Fecha:"; }		td:nth-of-type(2):before { content: "Monto:"; }		td:nth-of-type(3):before { content: "Estado:"; }	}</style>
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
			<?php } ?>
		</section>
	</section>

	<?php cc_footer(); ?>
</body>
</html>