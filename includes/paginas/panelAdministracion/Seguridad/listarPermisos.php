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

			<h1 class="titulo">Permisos</h1>
			<a class="boton" onclick="actualizarPermisos()">Guardar Cambios</a>
			<form id="frmModificar" method="post" name="frmModificar" action="<?php echo WEB_BASE; ?><?php echo $pagina; ?>/modificar">
				<input type="hidden" id="txtCode" name="txtCode">
			</form>
			
		<div id="error"></div>
			<table cellpadding="0" cellspacing="0" border="0" id="table" class="sortable">
				<thead>
					<tr>
						<th><h3>Codigo pagina</h3></th>
						<th><h3>Nombre pagina</h3></th>
						<th class="unsortable"><h3>Tipo Usuario</h3></th>
					</tr>
				</thead>
				<tbody>
			<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							//$arg=array ('id_pag'=>15);
							$permiso=listarPermisos($arg);
							//print_r($permiso);
							$pagina=listarPagina($arg);
							$usuario=listarTipousuario($arg);
							for($i=0;$i<count($pagina);$i++)
							{
								?>
				<tr>
					<td>
						<?php echo $pagina[$i]['id_pag'];?> 
					</td>
					<td>
						<?php echo $pagina[$i]['nom_pag'];?> 
					</td>
					<td><?php
					for($j=0;$j<count($usuario);$j++)
					{
						?><input type="checkbox"  onclick="actualizarPermiso('<?php echo $pagina[$i]['id_pag'];?>','<?php echo $usuario[$j]['id_tu']; ?>', this)" name="<?php echo $pagina[$i]['id_pag'].'-'.$usuario[$j]['id_tu']; ?>" value="1"<?php
						if(in_array(array('id_pag'=>$pagina[$i]['id_pag'],'id_tu'=>$usuario[$j]['id_tu']),$permiso))
						{
							echo 'checked';
						}
						echo '>'.$usuario[$j]['nom_tu'].'<br>';
					}
					?></td>
				</tr>
				<?php } ?>
			</tbody>
			</table>
			<?php table_footer(); ?>
			<script>
				
			var permisos=new Array();
			</script>

	</section>
	<?php cc_footer(); ?>
</body>
</html>
