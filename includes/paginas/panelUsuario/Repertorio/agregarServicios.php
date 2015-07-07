<html lang="es" dir="LTR" >
<head>
	<?php cc_head(); ?>
	<LINK href="<?php echo WEB_BASE; ?>estilos/editor.css" rel="stylesheet" type="text/css">
	<script src="<?php echo WEB_BASE; ?>script/ckeditor/ckeditor.js"></script>
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
	<form class="" onsubmit="return agregarServicio()" method="post">
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
		<h1>Agregar un servicio</h1>
		<p class="instrucciones">Primero seleccione una categoria</p>
		<div class="formulario">
			<div>
				<label>Categoria</label>
				<select onchange="listarSubcategoria()" required x-moz-errormessage="Debe seleccionar un Tipo" id="txtCategoria" name="txtCategoria" required>
					<option value="" disabled selected></option>
					<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$cat=listarCategorias($arg);
							for($i=0;$i<count($cat);$i++)
							{
								?>
					<option value="<?php echo $cat [$i] ['id_cat']; ?>"><?php echo $cat [$i] ['nom_cat']; ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<p class="instrucciones">Previzualizacion del servicio</p>
		<article class="servicios">
			<img  style="background: url('<?php echo WEB_BASE; ?>script/holder.js/120x95/text:Agregar_imagen'); background-size: 100% auto;" src="<?php echo WEB_BASE; ?>imagenes/1x1.png">
			<input type="hidden" id="txtimagenDescripcion" name="txtimagenDescripcion" value="<?php echo WEB_BASE; ?>script/holder.js/120x95/text:Agregar imagen">
			
			<label class="titulo"><input required x-moz-errormessage="Debe ingresar el nombre del servicio" type="text" id="txtNombre" name="txtNombre" required maxlength="255"> de <?php echo $_SESSION['empresa'];?></label>
			<p class="descripcion">Esta seccion se llenara con el bloque de abajo</p>
			<p class="tipo">
				<a><select required x-moz-errormessage="Debe seleccionar un Tipo" id="txtSubcategoria" name="txtSubcategoria" required>
						<option value="" disabled selected></option>
					</select></a>
				<a><select required x-moz-errormessage="Debe seleccionar un Tipo" id="txtTipoServicio" name="txtTipoServicio" required>
					<option value="" disabled selected></option>
					<?php
							require_once('script/function.php');
							$arg=array ('nada'=>0);
							$ts=listarTiposervicio($arg);
							for($i=0;$i<count($ts);$i++)
							{
								?>
					<option value="<?php echo $ts [$i] ['id_ts']; ?>"><?php echo $ts [$i] ['nom_ts']; ?></option>
				<?php } ?>
					</select></a>
				<a onclick="" class="canasta">Agregar a Canasta</a>
				<a onclick="" class="comparar">Agregar a Comparacion</a>
			
			
			
			
		</article>
		<article class="servicios">
		<textarea rows="4" cols="22" spellcheck="false" wrap="off" autofocus placeholder="Describe tu servicio..." required x-moz-errormessage="Debe ingresar el Url de la Pagina" id="txtDescripcion" name="txtDescripcion" maxlength="255">
			Modifique este texto y cree la descripcion para su servicio
		</textarea>
		</article>
		<article class="servicios" >
				<div>
					
					<a style="color: black;" href="
				<?php 
					echo WEB_BASE.$back;
				?>
				">Contrato en chile le recomienda leer las recomendaciones de nuestro panel de especialistas</a>
				</div>
				<div>
					<input type="submit" value="Añadir"><a style="color: black;" href="
				<?php 
					echo WEB_BASE.$back;
				?>
				">Cancelar</a>
				</div>
		</article>
		<div id="seleccionarMultimedia" class="divMultimedia inactivo">
			<a class="boton">Agregar mas multimedia</a>
			<div class="listado">
				<?php
					$arg=array(
					'id_ent'=>$_SESSION['empresa']
					);
					$media=listarMedia($arg);
					for($i=0;$i<count($media);$i++)
					{
						?>'<div onclick="seleccionarImagen('<?php echo $media[$i]['url_med']; ?>')">
									<img src="<?php echo $media[$i]['url_med']; ?>">
							</div>
						<?php
					}
				?>
			</div>
		</div>
		<div id="seleccionarImagen" class="divMultimedia inactivo">
			<a class="boton">Agregar mas multimedia</a>
			<div class="listado">
				<?php
					for($i=0;$i<count($media);$i++)
					{
						if($media[$i]['id_tm']==3 || $media[$i]['id_tm']==4)
						{
						?><div onclick="seleccionarImagen('<?php echo $media[$i]['url_med']; ?>')">
									<img src="<?php echo $media[$i]['url_med']; ?>">
							</div>
						<?php
						}
					}
				?>
			</div>
		</div>
		<script>
		CKEDITOR.inline('txtDescripcion');
		//var boton = $(".cke_button_icon .cke_button__image_icon");
		//boton.addEventListener("click", cambiarImagen());
		function cambiarImagen()
		{
				var data = CKEDITOR.instances.txtDescripcion.getData();
				console.log(data);
			if ($("#seleccionarImagen").hasClass('divMultimedia activo')){
				//actualizarChat=setInterval(actualizarChat(), 10000);
				document.getElementById("seleccionarImagen").className="divMultimedia inactivo";
				//console.log("header era: activo");
			}else{
				document.getElementById("seleccionarImagen").className="divMultimedia activo";
				//console.log("header era: inactivo");
			}
		}
		function seleccionarImagen(imagen)
		{
			if ($("#seleccionarImagen").hasClass('divMultimedia activo'))
			{
				//console.log("seleccionarImagen Imagen");
				document.getElementById("imagenDescripcion").src = imagen;
				document.getElementById("txtimagenDescripcion").value = imagen;
				cambiarImagen()
			}
			if ($("#seleccionarImagen").hasClass('divMultimedia activo2'))
			{
				
			}
		}
	</script>
	</form>
</section>


	<?php cc_footer(); ?>
</body>
</html>