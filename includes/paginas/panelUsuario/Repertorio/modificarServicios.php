<html lang="es" dir="LTR" >
<head>
	<?php cc_head(); ?>	<link rel="stylesheet" type="text/css" href="<?php echo WEB_BASE; ?>estilos/quill/quill.snow.css">
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
	<section id="contenido" ><h1 class="titulo">Modificar Servicio</h1>
	<form class="formulario" onsubmit="return modificarServicio()" method="post">
				
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
					if(isset($_POST['txtCode']))
					{
						echo '<input id="txtCode" name="txtCode" type="hidden" required value="'.$_POST['txtCode'].'">';
					}
					else
					{
						echo '<script language="javascript">window.location="'.WEB_BASE.$back.'"</script>';
					}
					require_once('script/function.php');
					$arg=array ('id_serv'=>$_POST['txtCode']);
					$servicios=listarServiciosSinDetalle($arg);					$arg=array ('nada'=>0);					$cat=listarCategorias($arg);					$ts=listarTiposervicio($arg);					$arg=array(					'id_ent'=>$_SESSION['empresa']					);					$media=listarMedia($arg);										$id_cat=0;			
					?><div class="formulario">			<div>				<label>Categoria</label>				<select onchange="listarSubcategoria()" required x-moz-errormessage="Debe seleccionar un Tipo" id="txtCategoria" name="txtCategoria" required>					<?php														for($i=0;$i<count($cat);$i++)							{								?>					<option <?php if($cat [$i] ['nom_cat']==$servicios [0] ['nom_cat'])					{ $id_cat=$cat [$i] ['id_cat']; 				echo ' selected '; 				} ?> value="<?php echo $cat [$i] ['id_cat']; ?>"><?php echo $cat [$i] ['nom_cat']; ?></option>					<?php } ?>				</select>			</div>		</div>		<div class="mensaje informativo">		<em></em>		<p>2-Luego seleccione la imagen a mostrar, la subcategoria y el tipo.</p>		<a onclick="this.parentNode.remove()">X</a>		</div>		<article class="servicios">			<a id="imagenDescripcion" ><img onclick="cambiarImagen()" style="background: transparent url('<?php echo $servicios [0] ['desc_img']; ?>')  no-repeat scroll left center / 100% 100%; " src="<?php echo WEB_BASE; ?>imagenes/1x1.png">			<input type="hidden" id="txtimagenDescripcion" name="txtimagenDescripcion" value="<?php for($i=0;$i<count($media);$i++)					{						if($media[$i]['url_med']==$servicios[0]['desc_img'])						{							echo $media[$i]['id_med'];						}					} ?>">						<label class="titulo"><input required x-moz-errormessage="Debe ingresar el nombre del servicio" value="<?php echo $servicios [0] ['nom_serv']; ?>" type="text" id="txtNombre" name="txtNombre" required maxlength="255"> de 						<?php 			$arg=array ('id_ent'=>$_SESSION['empresa']);							$ent=listarEntidad($arg);			echo $ent [0]['nom_ent']; ?></label>			<p class="descripcion">La descripcion se llenara con el bloque de abajo</p>			<p class="tipo">				<a><select required x-moz-errormessage="Debe seleccionar un Tipo" id="txtSubcategoria" name="txtSubcategoria" required>					<?php											$arg=array ('id_cat'=>$id_cat);					$scat=listarSubcategorias($arg);						for($i=0;$i<count($scat);$i++)							{								?>					<option <?php if($scat [$i] ['nom_scat']==$servicios [0] ['nom_scat']){ echo ' selected '; } ?> value="<?php echo $scat [$i] ['id_scat']; ?>"><?php echo $scat [$i] ['nom_scat']; ?></option>					<?php } ?>				</select>				</a>														<a><select required x-moz-errormessage="Debe seleccionar un Tipo" id="txtTipoServicio" name="txtTipoServicio" required>					<?php							for($i=0;$i<count($ts);$i++)							{								?>					<option <?php if($ts [$i] ['nom_ts']==$servicios [0] ['nom_ts']){ echo ' selected '; } ?> value="<?php echo $ts [$i] ['id_ts']; ?>"><?php echo $ts [$i] ['nom_ts']; ?></option>				<?php } ?>					</select></a>				<a onclick="" class="canasta">Agregar a Canasta</a>				<a onclick="" class="comparar">Agregar a Comparacion</a>												</a>		</article>		<div class="mensaje informativo">		<em></em>		<p>3-Ahora agregue la descripcion del servicio.</p>		<a onclick="this.parentNode.remove()">X</a>		</div>		<article class="servicios">						<div id="content-container">			  <div class="advanced-wrapper">				<div class="toolbar-container"><span class="ql-format-group">					<select title="Font" class="ql-font">					  <option value="sans-serif" selected>Sans Serif</option>					  <option value="Georgia, serif">Serif</option>					  <option value="Monaco, 'Courier New', monospace">Monospace</option>					</select>					<select title="Size" class="ql-size">					  <option value="10px">Small</option>					  <option value="13px" selected>Normal</option>					  <option value="18px">Large</option>					  <option value="32px">Huge</option>					</select></span><span class="ql-format-group"><span title="Bold" class="ql-format-button ql-bold"></span><span class="ql-format-separator"></span><span title="Italic" class="ql-format-button ql-italic"></span><span class="ql-format-separator"></span><span title="Underline" class="ql-format-button ql-underline"></span></span><span class="ql-format-group">					<select title="Text Color" class="ql-color">					  <option value="rgb(0, 0, 0)" selected></option>					  <option value="rgb(230, 0, 0)"></option>					  <option value="rgb(255, 153, 0)"></option>					  <option value="rgb(255, 255, 0)"></option>					  <option value="rgb(0, 138, 0)"></option>					  <option value="rgb(0, 102, 204)"></option>					  <option value="rgb(153, 51, 255)"></option>					  <option value="rgb(255, 255, 255)"></option>					  <option value="rgb(250, 204, 204)"></option>					  <option value="rgb(255, 235, 204)"></option>					  <option value="rgb(255, 255, 204)"></option>					  <option value="rgb(204, 232, 204)"></option>					  <option value="rgb(204, 224, 245)"></option>					  <option value="rgb(235, 214, 255)"></option>					  <option value="rgb(187, 187, 187)"></option>					  <option value="rgb(240, 102, 102)"></option>					  <option value="rgb(255, 194, 102)"></option>					  <option value="rgb(255, 255, 102)"></option>					  <option value="rgb(102, 185, 102)"></option>					  <option value="rgb(102, 163, 224)"></option>					  <option value="rgb(194, 133, 255)"></option>					  <option value="rgb(136, 136, 136)"></option>					  <option value="rgb(161, 0, 0)"></option>					  <option value="rgb(178, 107, 0)"></option>					  <option value="rgb(178, 178, 0)"></option>					  <option value="rgb(0, 97, 0)"></option>					  <option value="rgb(0, 71, 178)"></option>					  <option value="rgb(107, 36, 178)"></option>					  <option value="rgb(68, 68, 68)"></option>					  <option value="rgb(92, 0, 0)"></option>					  <option value="rgb(102, 61, 0)"></option>					  <option value="rgb(102, 102, 0)"></option>					  <option value="rgb(0, 55, 0)"></option>					  <option value="rgb(0, 41, 102)"></option>					  <option value="rgb(61, 20, 102)"></option>					</select><span class="ql-format-separator"></span>					<select title="Background Color" class="ql-background">					  <option value="rgb(0, 0, 0)"></option>					  <option value="rgb(230, 0, 0)"></option>					  <option value="rgb(255, 153, 0)"></option>					  <option value="rgb(255, 255, 0)"></option>					  <option value="rgb(0, 138, 0)"></option>					  <option value="rgb(0, 102, 204)"></option>					  <option value="rgb(153, 51, 255)"></option>					  <option value="rgb(255, 255, 255)" selected></option>					  <option value="rgb(250, 204, 204)"></option>					  <option value="rgb(255, 235, 204)"></option>					  <option value="rgb(255, 255, 204)"></option>					  <option value="rgb(204, 232, 204)"></option>					  <option value="rgb(204, 224, 245)"></option>					  <option value="rgb(235, 214, 255)"></option>					  <option value="rgb(187, 187, 187)"></option>					  <option value="rgb(240, 102, 102)"></option>					  <option value="rgb(255, 194, 102)"></option>					  <option value="rgb(255, 255, 102)"></option>					  <option value="rgb(102, 185, 102)"></option>					  <option value="rgb(102, 163, 224)"></option>					  <option value="rgb(194, 133, 255)"></option>					  <option value="rgb(136, 136, 136)"></option>					  <option value="rgb(161, 0, 0)"></option>					  <option value="rgb(178, 107, 0)"></option>					  <option value="rgb(178, 178, 0)"></option>					  <option value="rgb(0, 97, 0)"></option>					  <option value="rgb(0, 71, 178)"></option>					  <option value="rgb(107, 36, 178)"></option>					  <option value="rgb(68, 68, 68)"></option>					  <option value="rgb(92, 0, 0)"></option>					  <option value="rgb(102, 61, 0)"></option>					  <option value="rgb(102, 102, 0)"></option>					  <option value="rgb(0, 55, 0)"></option>					  <option value="rgb(0, 41, 102)"></option>					  <option value="rgb(61, 20, 102)"></option>					</select><span class="ql-format-separator"></span>					<select title="Text Alignment" class="ql-align">					  <option value="left" selected></option>					  <option value="center"></option>					  <option value="right"></option>					  <option value="justify"></option>					</select></span>					<span class="ql-format-group">					<span title="Link" class="ql-format-button ql-link"></span>					<span class="ql-format-separator"></span><span onclick="anadirBiblioteca()" title="Image" class="ql-format-button ql-image"></span>					<span class="ql-format-separator"></span><span title="List" class="ql-format-button ql-list"></span>					</span>					</div>				<div id="editor" class="editor-container"><?php echo urldecode($servicios [0] ['desc_serv']); ?></div>				<textarea class="oculto"  rows="4" cols="22" spellcheck="false" wrap="off" autofocus placeholder="Describe tu servicio..." required x-moz-errormessage="Debe ingresar el Url de la Pagina" id="txtDescripcion" name="txtDescripcion" maxlength="255">				asdasd				</textarea>			  </div>			</div>			<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/lodash.js/2.4.1/lodash.js"></script>			<script type="text/javascript" src="http://cdn.quilljs.com/0.20.0/quill.js"></script>			<script type="text/javascript">				var fullEditor = new Quill('.editor-container', {				  modules: {					'multi-cursor': true,					'toolbar': { container: '.toolbar-container' },					'link-tooltip': true				  //, 'image-tooltip': true				  },				  theme: 'snow'				});				var authorship = fullEditor.getModule('authorship');				var cursorManager = fullEditor.getModule('multi-cursor');				fullEditor.on('text-change', function(delta, source) {				  if (source === 'user') {					basicEditor.updateContents(delta);				  }				});				basicEditor.on('text-change', function(delta, source) {				  if (source === 'user') {					fullEditor.updateContents(delta);				  }				});												function actualizarDescripcion()				{					document.getElementById('txtDescripcion').innerHTML = document.getElementById('editor').innerHTML;				}				var plantilla ="";				function anadirBiblioteca()				{					//var div = document.getElementsByClassName('ql-image-tooltip');					//plantilla = '<a class="boton" >Ver biblioteca</a><br>';					if ($("#divImage").hasClass('oculto')){						//actualizarChat=setInterval(actualizarChat(), 10000);						document.getElementById("divImage").className="divMultimedia";						//console.log("header era: activo");					}else{						document.getElementById("divImage").className="divMultimedia oculto";						//console.log("header era: inactivo");					}					//plantilla = '<div id="" class="divMultimedia"> <div class="listado"> <?php $media=listarMedia($arg); for($i=0;$i<count($media);$i++) { ?><div onclick="seleccionarImg(&quot;<?php echo $media[$i]['id_med']; ?>&quot;,&quot;<?php echo $media[$i]['url_med']; ?>&quot;)"><img src="<?php echo $media[$i]['url_med']; ?>"></div><?php } ?> </div></div>';					//div[0].innerHTML = plantilla + div[0].innerHTML;				}			</script>		</article>		<div class="mensaje informativo">		<em></em>		<p><a style="color: black;" href="<?php echo WEB_BASE.$back; ?>">Opcional: Contrato en chile le recomienda leer las recomendaciones de nuestro panel de especialistas</a></p>		<a onclick="this.parentNode.remove()">X</a>		</div>		<article class="servicios" >					<div>					<input class="boton submit" type="submit" value="Añadir Servicio">			</div>			</div>				<a class="boton cancel" href="				<?php 					echo WEB_BASE.$back;				?>				">Cancelar</a>			</div>		</article>		<div id="seleccionarMultimedia" class="divMultimedia oculto">		<a class="boton" onclick="cambiarImagen()" >cerrar</a><br>			<div class="listado">				<?php					for($i=0;$i<count($media);$i++)					{						?><div onclick="seleccionarImagen('<?php echo $media[$i]['id_med']; ?>','<?php echo $media[$i]['url_med']; ?>')">									<img src="<?php echo $media[$i]['url_med']; ?>">							</div>						<?php					}				?>			</div>		</div>		<div id="divImage" class="divMultimedia oculto">			<a class="boton" onclick="anadirBiblioteca()" >cerrar</a><br>			<div class="listado">				<?php					for($i=0;$i<count($media);$i++)					{						?><div onclick="seleccionarImg('<?php echo $media[$i]['id_med']; ?>','<?php echo $media[$i]['url_med']; ?>')">									<img src="<?php echo $media[$i]['url_med']; ?>">							</div>						<?php					}				?>			</div>					</div>		<script>		function cambiarImagen()		{			if ($("#seleccionarMultimedia").hasClass('oculto')){				//actualizarChat=setInterval(actualizarChat(), 10000);				document.getElementById("seleccionarMultimedia").className="divMultimedia";				//console.log("header era: activo");			}else{				document.getElementById("seleccionarMultimedia").className="divMultimedia oculto";				//console.log("header era: inactivo");			}		}		function seleccionarImagen(imagen, url)		{			//console.log("seleccionarImagen Imagen");			document.getElementById("imagenDescripcion").firstChild.style.background = "url('"+url+"')";			document.getElementById("imagenDescripcion").firstChild.style.backgroundRepeat = "no-repeat";						document.getElementById("imagenDescripcion").firstChild.style.backgroundPosition  = "left";						document.getElementById("imagenDescripcion").firstChild.style.backgroundSize  = "100% 100%";			//console.log(imagen);			document.getElementById("txtimagenDescripcion").value = imagen;			cambiarImagen();		}		function seleccionarImg(imagen, url)		{			anadirBiblioteca()		  $("#ql-editor-1").append('<div><img src="'+url+'"></div>');		}		function actualizarEditor(editor)		{					}	</script>	</form></section>	<?php cc_footer(); ?></body></html>