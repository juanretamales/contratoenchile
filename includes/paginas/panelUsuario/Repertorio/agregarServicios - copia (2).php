<html lang="es" dir="LTR" >
<head>
	<?php cc_head(); ?>
	<LINK href="<?php echo WEB_BASE; ?>estilos/editor.css" rel="stylesheet" type="text/css">
	<script src="<?php echo WEB_BASE; ?>script/editor/wysihtml5-0.3.0.js"></script>
	<script src="<?php echo WEB_BASE; ?>script/editor/advanced.js"></script>
	
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
		<p>Añadir nuevo servicio</p>
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
		<div class="formulario">
		<div>
			<label>Nombre</label>
			<input required x-moz-errormessage="Debe ingresar el nombre del servicio" type="text" id="txtNombre" name="txtNombre" required maxlength="255">
		</div>
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
		<article class="servicios">
			<img width="120" height="95" id="imagenDescripcion" onclick="cambiarImagen()" src="<?php echo WEB_BASE; ?>script/holder.js/120x95/text:Agregar imagen">
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
				<a onclick="" class="comparar">Agregar a comparacion</a>
			</p>
		</article>
		<div id="wysihtml5-editor-toolbar">
      <header class="editorToolbar">
        <ul class="commands">
          <li data-wysihtml5-command="bold" title="Make text bold (CTRL + B)" class="command"></li>
          <li data-wysihtml5-command="italic" title="Make text italic (CTRL + I)" class="command"></li>
          <li data-wysihtml5-command="insertUnorderedList" title="Insert an unordered list" class="command"></li>
          <li data-wysihtml5-command="insertOrderedList" title="Insert an ordered list" class="command"></li>
          <li data-wysihtml5-command="createLink" title="Insert a link" class="command"></li>
          <li data-wysihtml5-command="insertImage" title="Insert an image" class="command"></li>
          <li data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1" title="Insert headline 1" class="command"></li>
          <li data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2" title="Insert headline 2" class="command"></li>
          <li data-wysihtml5-command-group="foreColor" class="fore-color" title="Color the selected text" class="command">
            <ul>
              <li data-wysihtml5-command="foreColor" data-wysihtml5-command-value="silver"></li>
              <li data-wysihtml5-command="foreColor" data-wysihtml5-command-value="gray"></li>
              <li data-wysihtml5-command="foreColor" data-wysihtml5-command-value="maroon"></li>
              <li data-wysihtml5-command="foreColor" data-wysihtml5-command-value="red"></li>
              <li data-wysihtml5-command="foreColor" data-wysihtml5-command-value="purple"></li>
              <li data-wysihtml5-command="foreColor" data-wysihtml5-command-value="green"></li>
              <li data-wysihtml5-command="foreColor" data-wysihtml5-command-value="olive"></li>
              <li data-wysihtml5-command="foreColor" data-wysihtml5-command-value="navy"></li>
              <li data-wysihtml5-command="foreColor" data-wysihtml5-command-value="blue"></li>
            </ul>
          </li>
          <li data-wysihtml5-command="insertSpeech" title="Insert speech" class="command"></li>
          <li data-wysihtml5-action="change_view" title="Show HTML" class="action"></li>
        </ul>
      </header>
      <div data-wysihtml5-dialog="createLink" style="display: none;">
        <label>
          Link:
          <input data-wysihtml5-dialog-field="href" value="http://">
        </label>
        <a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
      </div>
	<!--insertar imagen desde la galeria multimedia-->
      <div data-wysihtml5-dialog="insertImage" style="display: none;">
        <label>
          Image:
          <input data-wysihtml5-dialog-field="src" value="http://">
        </label>
        <a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
      </div>
    </div>
		<article class="servicios">
		<textarea rows="4" cols="22" spellcheck="false" wrap="off" autofocus placeholder="Describe tu servicio..." required x-moz-errormessage="Debe ingresar el Url de la Pagina" id="txtDescripcion" name="txtDescripcion" maxlength="255"></textarea>
		</article>
		<script>
      var editor = new wysihtml5.Editor("txtDescripcion", {
        toolbar:     "wysihtml5-editor-toolbar",
        stylesheets: ["http://yui.yahooapis.com/2.9.0/build/reset/reset-min.css", "css/editor.css"],
        parserRules: wysihtml5ParserRules
      });
      
      editor.on("load", function() {
        var composer = editor.composer;
        composer.selection.selectNode(editor.composer.element.querySelector("h1"));
      });
    </script>
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
		function cambiarImagen()
		{
				
				$('.wysihtml5-sandbox').append('<br>test');
				var contenido= $("#txtDescripcion").html();
				console.log(contenido);
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