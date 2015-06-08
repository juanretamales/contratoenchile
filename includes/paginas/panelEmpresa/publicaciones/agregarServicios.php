<section id="contenido" style="margin: 10px 0px 0px 10px;">
	<form class="formulario" action="./script/transicion.php"  method="post">
				<p>Añadir nuevo Documento</p>
				<div>
					<label>Nombre del Documento</label>
					<input required x-moz-errormessage="Debe ingresar el nombre del Documento" type="text" name="txtNombre">
				</div>
				Error, solo las empresas agregan, los admin ven y eliminan
				<div>
					<label>Tipo del documento</label>
					<select required x-moz-errormessage="Debe seleccionar un Tipo" name="txtPais">
					<option value="" disabled selected></option>
					<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$paises=listarPaises($arg);
							for($i=0;$i<count($paises);$i++)
							{
								?>
					<option value="<?php echo $paises [$i] ['id_pais']; ?>"><?php echo $paises [$i] ['nom_pais']; ?></option>
				<?php } ?>
				</div>
				<div>
					<input type="submit" name="btnRegistrarDocumento" value="Añadir Tipo de Multimedia">
				</div>
				<a href="index.php?pagina=panel&subpagina=Tipomedia">Cancelar</a>
	</form>
</section>