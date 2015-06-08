<html lang="es" dir="LTR" >
<head>
	<?php 
		cc_head();
	?>
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
<section id="contenido">
	<form class="formulario" onsubmit="return agregarTipoCod()" method="post">
		<div id="error"></div>
			<h1 class="titulo2">Agregar Categoria</h1>
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
			<div>
				<label>Nombre</label>
				<input required x-moz-errormessage="Debe ingresar el nombre " type="text" required maxlength="255" id="txtNombre" name="txtNombre">
				<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgNombre">
			</div>
			<div>
				<label>Seleccione una pagina</label>
				<select required x-moz-errormessage="Debe seleccionar una pagina" id="txtPagina" name="txtPagina" required>
				<option value="" disabled selected></option>
				<?php
						require_once('script/function.php');
						$arg=array ('nada'=>0);
						$pag=listarPagina($arg);
						for($i=0;$i<count($pag);$i++)
						{
							?>
					<option value="<?php echo $pag [$i] ['id_pag']; ?>"><?php echo $pag [$i] ['nom_pag']; ?></option>
				<?php } ?>
				</select>
				<img src="<?php echo WEB_BASE; ?>imagenes/none.png" id="imgPagina">
			</div>
			<div>
				<input type="submit" value="Añadir">
			</div>
			<a href="<?php echo WEB_BASE.$back; ?>">Cancelar</a>
	</form>
</section>


	<?php cc_footer(); ?>
</body>
</html>