var urlbase="http://127.0.0.1/";
var serviciosComparados="";
var chat="";
var actualizarChat;//actualiza los chats abierto cada 10 segundos preguntando si hay mas
var actualizarContratos;//actualiza la alerta de mensajes de todos lso contratos cada hora
var intervaloTiempo=[5,10];
var intervaloChat=new Array();

//funciones del diseño
$(window).resize(function() {
   verMenu("reestablecer");
});
window.onload = function ()
{
	if (!document.getElementById('divContratos'))
	{
		actualizarChat=setInterval(actualizarChat(),10000);
	}
};
function verMenu(id)
{
	var elem = ["menuDescomprimido", "frmBuscar", "categorias", "divTwitter", "divFacebook", "contenido", "divContratos", "menuVertical"];
	var item="contenido";
	if(id!="")
	{
		if($('#'+id).css('display')=='none')
		{
			item=id;
		}
	}
	for(var i=0; i<elem.length;i++)
	{
		$('#'+elem[i]).css('display', 'none');
	}
	$('#'+item).css('display', "inline");
	if(id=="reestablecer")
	{
		for(var i=0; i<elem.length;i++)
		{
			$('#'+elem[i]).css('display', '');
		}
	}
	/*for(var i=0; i<elem.length;i++)
	{
		$(elem[i]).css('display', '');
	}
	$('#'+id).css('display', 'inline');
	console.log("id:"+id);*/
}
/*
localstorage=>Chat [idcontrato] = mensajes;
*/
function desplegarContratos()
{
	if(document.width<700)
	{
		verMenu('divContratos');
	}
    if ($("#divContratos").hasClass('oculto')){
		//actualizarChat=setInterval(actualizarChat(), 10000);
        document.getElementById("divContratos").className="";
		console.log("contratos: no oculto");
    }else{
        document.getElementById("divContratos").className="oculto";
		console.log("contratos: oculto");
    }
}
function abrirChat(id,nombre)
{
	if (!document.getElementById('divMensajes'+id))
	{
	  console.log("divMensajes"+id+" esta cerrado");
	  document.getElementById("divChat").innerHTML +='<div id="divMensajes'+id+'" class="activo"><div class="cabecera" onclick="minimizarChat(\'divMensajes'+id+'\')"><label >'+nombre+'</label><a onclick="cerrarChat(divMensajes'+id+')" >X</a></div><div class="historial" id="historial'+id+'"></div><div class="escribir"><form onsubmit="return enviarMensaje(this)" method="post"><input id="txtCode" name="txtCode" type="hidden" required value="'+id+'"><input type="text" name="txtMensaje"></form></div></div>';
	  document.getElementById("historial"+id).innerHTML = "Cargando...";
	  if (typeof(Storage) != "undefined") 
	  {
		var chat = "";
		if(localStorage.getItem("Chat")!=null)
		{
		  console.log("encontro y asigno el localstorage.Chat");
		  chat=JSON.parse(localStorage.getItem("Chat"));
		}
		console.log(chat);
		document.getElementById("historial"+id).innerHTML = chat[id];
		for(var i=0;i<chat.length;i++)
		{
		  if(chat[i][0]==id)
		  {
			document.getElementById("historial"+id).innerHTML = chat[i][1];
		  }

		}
		actualizarChat();
	  }
	  else 
	  {
		document.getElementById("historial"+id).innerHTML = "Su navegador no es compatible con WebStorage, actualize a una version reciente del mismo o ocupe otro navegador";
		console.log("Sorry, your browser does not support Web Storage...");
		alert("Sorry, your browser does not support Web Storage...");
	  }
	}
}
function enviarMensaje(form)
{
	var mensaje="";
	if(form.txtCode.value!="" && form.txtMensaje.value!="" && form.txtMensaje.value.length<255)
	{
		var mensaje="txtCode="+form.txtCode.value+"&txtMensaje="+form.txtMensaje.value;
		form.txtMensaje.value="";
		$.ajax({
                data:  
					{
						"agregarMensaje" : mensaje
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
					if(response=="Exito")
					{
						actualizarChat();
					}
					else
					{
						//mostrar mensaje "no se pudo enviar el mensaje"
						document.getElementById("historial"+form.txtCode.value).innerHTML += '<p class="msgSystem">Error, no se pudo enviar el mensaje</p>';
					}
                }
        });
	}
	else
	{
		document.getElementById("historial"+form.txtCode.value).innerHTML += '<p class="msgSystem">Error, no se pudo enviar el mensaje</p>';
	}
	return false;
}
function actualizarChat()
{
	if (document.getElementById('divContratos'))
	{
		//console.log("Actualizando Chat:");
		var chat = [];//aqui se asigna el contenido del localstorage
		var chatActivos="";
		if (typeof(Storage) != "undefined") 
		{
			if(localStorage.getItem("Chat")!=null)
			{
				chat=JSON.parse(localStorage.getItem("Chat"));
			}
			if(document.getElementById("divContratos"))
			{
			  $.ajax({
				data:  {"actualizarContratos" : document.getElementById("divContratos").innerHTML},
				url:   urlbase+'script/ajax.php',
				type:  'post',
				success:  function (response) {
				  if(response!="")
				  {
					document.getElementById("divContratos").innerHTML=response;
				  }
				}
			  });
			}
			//2-Actualizo el localstorage (ahora es distinto por que los contratos ya estan actualizados
			var lista=document.getElementById("divContratos");
			var chatActualizado= [];
			for(var i=0;i<(lista.childNodes.length);i++)
			{
			 // console.log(" - Loop N°"+i);
			  if(lista.childNodes[i].id)//revisa si existe el id
			  {
				//console.log(" - Existe la id");
				if(lista.childNodes[i].id.indexOf("listChat")!=-1)
				{
				  //console.log(" - Encontro el listChat");
				  var id=lista.childNodes[i].id.substring(8);
				  if(id != undefined)
				  {
					//console.log(" - La id fue encontrada");
					//console.log(" - - id del chat: "+id);
					//console.log(" - - contenido: "+chat[id]);
					if(chat[id])
					{
					  //console.log(" - - - Encontro el chat[i]");
					  chatActualizado[chatActualizado.length]=[id,chat[id]];
					}
					else
					{
					  //console.log(" - - - No encontro el chat[i]");
					  chatActualizado[chatActualizado.length]=[id,""];
					}
				  }
				}
			  }
			}
			//3-buscamos el ultimo mensaje de todos los chats (se busca en la variable chat (que contiene lo mismo que el localstorage)
			var mensajes= [];
			//hay que enviar el id y el ultimo mensaje
			for(var i=0;i<chatActualizado.length;i++)
			{
			  var historial = chatActualizado[i][1];
			  var ultimomensaje=0;
			  if(historial!="")
			  {
				var arreglo=historial.split('<p id="msg');
				ultimomensaje=arreglo[arreglo.length-1].substring(0,arreglo[arreglo.length-1].indexOf('"'));
			  }
			  mensajes[mensajes.length]=[chatActualizado[i][0],ultimomensaje];
			}
		//console.log("mensajes:"+mensajes);
		$.ajax({
				data:  {"actualizarMensajes" : mensajes},
				url:   urlbase+'script/ajax.php',
				type:  'post',
				success:  function (response) 
				{
		   if(response!="")
					{
						//console.log("response: "+response);
						mensajes = $.parseJSON(response);
			  //5-actualizamos el chat y el localstorage
			  //console.log("Mensajes: ");
			  for(var i=0;i<mensajes.length;i++)
			  {
				//console.log("id: ["+mensajes[i][0]+"]");
				//console.log("contenido: ["+mensajes[i][1]+"]");
				if(document.getElementById("historial"+mensajes[i][0]))
				{
				  //console.log("Actualizo el div: historial"+mensajes[i][0]);
				  document.getElementById("historial"+mensajes[i][0]).innerHTML += mensajes[i][1];
				}
				if(chatActualizado[mensajes[i][0]])
				{
				 // console.log("Añado mensajes al localstorage"+mensajes[i][0]);
				  chatActualizado[mensajes[i][0]] += mensajes[i][1];
				}
				else
				{
				  chatActualizado[mensajes[i][0]] = mensajes[i][1];
				  //console.log("No existe por lo que creo el localstorage"+mensajes[i][0]);
				}
			  }
			  localStorage.setItem("Chat", JSON.stringify(chatActualizado));  
					}
				}
			});
		}
		else
		{
		  console.log("lo lamentamos, tu navegador no soporta localstorage, por favor descarga una version mas reciente del mismo");
		  alert("lo lamentamos, tu navegador no soporta localstorage, por favor descarga una version mas reciente del mismo");
		  document.getElementById("historial"+id).innerHTML += '<p class="msgSystem">lo lamentamos, tu navegador no soporta localstorage, por favor descarga una version mas reciente del mismo</p>';
		}
	}
	else
	{
		console.log('no encontro el divcontratos');
	}
}
function actualizarChat2()
{
	console.log("Actualizando Chat:");
	var lista=document.getElementById("divChat");
	var chatActivos = new Array;
	console.log(lista.childNodes[0].id);
	for(var i=0;i<(lista.childNodes.length);i++)
	{
		if(lista.childNodes[i].id)//revisa si existe el id
		{
			var idChat = lista.childNodes[i].id;//obtiene el codigo del chat
			console.log("id chat: "+idChat.substring(11));
			//guarda en chatActivos la id del chat ex: 16
			//chatActivos[largo][0]=idChat.substring(11);//ahora se agregara el id del chat al final
			//guarda en listab los elementos hijos de idChat(divChat16) para obtener el ultimo mensaje ex: 
			//var listab = document.getElementById(idChat).childNodes;
			//con esto rescato el ultimo mensaje del chat
			//var mensaje=listab[1].lastChild.id;
			var mensaje=document.getElementById(idChat).childNodes[1].lastChild.id;
			console.log("ultimo mensaje: "+mensaje.substring(3));
			chatActivos.push=[idChat.substring(11), mensaje.substring(3)];
		}
	}
	//aqui agrego los chats de las empresas
	console.log(chatActivos);
	var actualizacion= new Array;
	$.ajax({
		data:  {"actualizarChat" : chatActivos},
		url:   urlbase+'script/ajax.php',
		type:  'post',
		success:  function (response) {
			actualizacion=response;
		}
	});
	for(var i=0;i<chatActivos.length;i++)
	{
		document.getElementById("historial"+chatActivos[i][0]).append = actualizacion[chatActivos[i][0]];
	}
}
function minimizarChat(id)
{
	console.log("minimizarChat("+id+") : ");
	
	
	if ($('#'+id).hasClass('activo')){
        document.getElementById(id).className="inactivo";
		$('#divMensajes'+id).slideToggle(300, 'swing');
		//console.log("inactivo");
    }else{
        document.getElementById(id).className="activo";
		$('#divMensajes'+id).fadeToggle(300, 'swing');
		//console.log("activo");
    }
}
function cerrarChat(id)
{
	//window.clearInterval(intervalVariable)
	document.getElementById("divChat").removeChild(id);
	//guardar chat en localstorage
}
function desplegarFooter()
{
    if ($("#expandir").hasClass('btn btn-collapsed'))
	{
		document.getElementById("expandir").className="btn btn-collapse";
		document.getElementById("masdetalles").className="";
		footer=false;
		//console.log("header era: " + true);
	}
	else
	{
		document.getElementById("expandir").className="btn btn-collapsed";
		document.getElementById("masdetalles").className="oculto";
		footer=true;
		//console.log("header era: " + false);
	}
}
function actualizarPermiso(pagina, tipousuario, estado)
{
	//console.log(pagina +' | '+ tipousuario +' | '+ estado);
	if(pagina!="" && tipousuario!="")
	{
		if(permisos!= 'undefined')
		{
			var iestado = false;
			if(estado.checked)
			{
				iestado = false;
			}
			else
			{
				iestado = true;
			}
			var arreglo = [pagina, tipousuario, estado.checked];
			//console.log(pagina +' | '+ tipousuario +' | '+ iestado +' | '+ posicion);
			posicion=-1;
			for(var i=0;i<permisos.length;i++)
			{
				if(permisos[i][0]==pagina && permisos[i][1]==tipousuario && permisos[i][2]==iestado)
				{
					posicion = i;
					break;
				}
			}
			if(posicion<0)
			{
				//console.log('no existe');
				permisos.push(arreglo);
				//console.log('posicion: '+posicion + ' length: ' + permisos.length);
			}
			else
			{
				//console.log('Lo encontro en posicion: '+posicion);
				permisos = permisos.splice(posicion, 1);
			}
		}
		else
		{
			$.ajax({
				data:  
					{
						"actualizarPermisos" : [[pagina, tipousuario, estado.checked]]
					},
				url:   urlbase+'script/ajax.php',
				type:  'post',
				success:  function (response) {
					if(response=="Exito")
					{
						window.location=urlbase+"administracion/seguridad/permiso";
					}
					else
					{
						alerta(response);
					}
				}
			});
		}
	}
	else
	{
		alerta("ha ocurrido un error inesperado, recargue la pagina");
	}
	return false;
}
function actualizarPermisos()
{
	if(permisos!= 'undefined')
	{
		console.log("actualizando permisos");
		if(permisos.length>0)
		{
			$.ajax({
				data:  
					{
						"actualizarPermisos" : permisos
					},
				url:   urlbase+'script/ajax.php',
				type:  'post',
				success:  function (response) {
					if(response=="Exito")
					{
						window.location=urlbase+"administracion/seguridad/permiso";
					}
					else
					{
						alerta(response);
					}
				}
			});
		}
	}
	else
	{
		alerta("ha ocurrido un error inesperado, recargue la pagina");
	}
	return false;
}
function separarRut(texto)
{	
	var rut=texto;
	var contenido=rut.toString().split("");
	var final="";
	var num=0;
	var caracteres="ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	var numeros="0123456789";
	for(s=(contenido.length-1); s>=0; s--)
	{
		if(numeros.indexOf(contenido[s]) != -1 || (s==contenido.length-1 && caracteres.indexOf(contenido[s])))
		{
			if(s==(contenido.length-2))
			{
				final="-"+final;
			}
			if(s<(contenido.length-2))
			{
				num++;
			}
			if((num%3)==0 && num!=0)
			{
					final="."+final;
			}
			final=contenido[s].toUpperCase()+final;
		}
	}
	return final;
}
function validarRut(rut)
{
	var maximo=16;//cantidad maxima del rut, por ahora esta en 16 para ej 18.789.461.321-3
	var minimo=12;//cantidad minima del rut, por ahora esta en 12 para ej 15.234.158-k
	var contenido=rut.split("");
	var newRut=separarRut(rut);
	var regexp = /[1-9][0-9][.][0-9][0-9][0-9][.][0-9][0-9][0-9][-][A-Z0-9]{1}/;//expresion regular
	if(contenido.length>=minimo && contenido.length<=maximo)
	{
		if(newRut.match(regexp))
		{
			var cantidad=3;
			$.ajax({
			data:  {"validarRut" :  "txtRut="+newRut},
			url:   urlbase+'script/ajax.php',
			type:  'post',
			success:  function (response) {
				cantidad=response;
			}
			});
			if(parseInt(cantidad)==0)
			{
				return true;
			}
		}
	}
	return false;
}
function validarEmail(email)
{
	var maximo=16;//cantidad maxima del rut, por ahora esta en 16 para ej 18.789.461.321-3
	var minimo=12;//cantidad minima del rut, por ahora esta en 12 para ej 15.234.158-k
	var contenido=email.split("");
	var regexp = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;//expresion regular
	if(contenido.length>=minimo && contenido.length<=maximo)
	{
		if(email.match(regexp))
		{
			var cantidad=3;
			$.ajax({
			data:  {"validarEmail" :  "txtEmail="+email},
			url:   urlbase+'script/ajax.php',
			type:  'post',
			success:  function (response) {
				cantidad=response;
			}
			});
			if(parseInt(cantidad)==0)
			{
				return true;
			}
		}
	}
	return false;
}

function validarFormularioCorreo()
{
	//validar si el correo existe en la base de datos
	//alert($('#txtEmail').val());
	
	var email=$('#txtEmail').val();
	var regexp = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
	if(email.match(regexp))
	{
		document.getElementById('imgEmail').src = urlbase+"imagenes/UI/correcto.png";
	}
	else
	{
		document.getElementById('imgEmail').src = urlbase+"imagenes/UI/incorrecto.png";
		document.getElementById('txtEmail').focus();
		return false;
	}
	//validar si el correo es igual en los dos input
	if($('#txtEmail').val()==$('#txtReEmail').val())
	{
		document.getElementById('imgReemail').src = urlbase+"imagenes/UI/correcto.png";
	}
	else
	{
		document.getElementById('imgReemail').src = urlbase+"imagenes/UI/incorrecto.png";
		document.getElementById('txtReEmail').focus();
		return false;
	}
	var cantidad=3;
	$.ajax({
	data:  {"validarEmail" :  "txtEmail="+email},
	async: false,
	url:   urlbase+'script/ajax.php',
	type:  'post',
	success:  function (response) {
		cantidad=response;
	}
	});
	//alert(cantidad);
	if(parseInt(cantidad)==0)
	{
		
		return true;
	}
	document.getElementById('imgEmail').src = urlbase+"imagenes/UI/incorrecto.png";
	document.getElementById('txtEmail').focus();
	return false;
}
//falta actualizar para crear usuario (persona)
function validarFormularioPersona()
{
	var mensaje="";
	//console.log($('#txtRut').val().length);
	if($('#txtRut').val().length>0 && $('#txtRut').val().length<255)
	{
		console.log($('#txtRut').val());
		var rut=$('#txtRut').val();
		$('#txtRut').val(separarRut(rut));
		if(validarRut($('#txtRut').val()))
		{
			document.getElementById('imgRut').src = urlbase+"imagenes/UI/correcto.png";
		}
		else
		{
			document.getElementById('imgRut').src = urlbase+"imagenes/UI/incorrecto.png";
			document.getElementById('txtRut').focus();
			return false;
		}
	}
	else
	{
		document.getElementById('imgRut').src = urlbase+"imagenes/UI/incorrecto.png";
			document.getElementById('txtRut').focus();
			return false;
	}
	if($('#txtNombre').val().length<=0 && $('#txtNombre').val().length>255)
	{
		document.getElementById('imgNombre').src = urlbase+"imagenes/UI/correcto.png";
	}
	else
	{
		document.getElementById('imgNombre').src = urlbase+"imagenes/UI/incorrecto.png";
		document.getElementById('txtNombre').focus();
		return false;
	}
	if($('#txtApellido').val().length<=0 && $('#txtApellido').val().length>255)
	{
		document.getElementById('imgApellido').src = urlbase+"imagenes/UI/correcto.png";
	}
	else
	{
		document.getElementById('imgApellido').src = urlbase+"imagenes/UI/incorrecto.png";
		document.getElementById('txtApellido').focus();
		return false;
	}
	if($('#ddlDia').val().length>0)
	{
		document.getElementById('imgFecha').src = urlbase+"imagenes/UI/correcto.png";
	}
	else
	{
		document.getElementById('imgFecha').src = urlbase+"imagenes/UI/incorrecto.png";
		document.getElementById('ddlDia').focus();
		return false;
	}
	if($('#ddlMes').val().length>0)
	{
		document.getElementById('imgFecha').src = urlbase+"imagenes/UI/correcto.png";
	}
	else
	{
		document.getElementById('imgFecha').src = urlbase+"imagenes/UI/incorrecto.png";
		document.getElementById('ddlMes').focus();
		return false;
	}
	if($('#ddlAno').val().length>0)
	{
		document.getElementById('imgFecha').src = urlbase+"imagenes/UI/correcto.png";
	}
	else
	{
		document.getElementById('imgFecha').src = urlbase+"imagenes/UI/incorrecto.png";
		document.getElementById('ddlAno').focus();
		return false;
	}
	if($('#txtTelefono').val().length<=0 && $('#txtTelefono').val().length>255)
	{
		document.getElementById('imgTelefono').src = urlbase+"imagenes/UI/correcto.png";
	}
	else
	{
		document.getElementById('imgTelefono').src = urlbase+"imagenes/UI/incorrecto.png";
		document.getElementById('txtTelefono').focus();
		return false;
	}
}

function validarFormularioLogin()
{
	var mensaje="";
	var elements = ["Contrasena", "Rut", "Captcha"];
	for (i = 0; i < elements.length; i++)
	{
		//console.log(elements[i]);
		if(comprobador(elements[i])==false)
		{
			mensaje="error con el "+elements[i];
			alerta('Error:'+elements[i]);
			return false;
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"identificarse" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
				async: false,
                success:  function (response) {
                    if(response=="Exito")
					{
						//alert(response);
						window.location=urlbase;
						//alerta(response);
					}
					else
					{
						mensaje="Revise el formulario, "+response;
						alerta(response);
						//alert("Revise el formulario, "+response);
						d = new Date();
						$('#captcha').attr("src", urlbase+"script/captcha/captcha.php?"+d.getTime());
						return false;
					}
                }
        });
	}
	//else
	if(mensaje!="" && mensaje!='Exito')
	{
		d = new Date();
		$('#captcha').attr("src", urlbase+"script/captcha/captcha.php?"+d.getTime());
		//alerta("Revise el formulario, "+mensaje);
		alerta(mensaje);
	}
	return false;
}
function modificar(id)
{
	$('#txtCode').val(id.toString());
	document.frmModificar.submit();
}

////////////////////////////////
// Eliminar                   //
////////////////////////////////
function eliminarCategoria(id, nombre)
{
	if(confirm('Desea eliminar la pagina '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarCategoria" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function eliminarCobertura(id, nombre)
{
	if(confirm('Desea eliminar la pagina '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarCobertura" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function eliminarComuna(id, nombre)
{
	if(confirm('Desea eliminar la comuna '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarComuna" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function eliminarContacto(id, nombre)
{
	if(confirm('Desea eliminar contrato de '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarContacto" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function eliminarDocumento(id, nombre)
{
	if(confirm('Desea eliminar la pagina '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarDocumento" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}function eliminarEmpresa(id, nombre)
{
	if(confirm('Desea eliminar la empresa '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarEntidad" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function eliminarEstado(id, nombre)
{
	if(confirm('Desea eliminar la pagina '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarEstado" : id},
               url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}function eliminarItem(id, nombre)
{
	if(confirm('Desea eliminar la pagina '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarItem" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function eliminarMultimedia(id, nombre)
{
	if(confirm('Desea eliminar el multimedia '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarMultimedia" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function eliminarMensajes(id, nombre)
{
	if(confirm('Desea eliminar el mensaje '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarMensajes" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}function eliminarMenu(id, nombre)
{
	if(confirm('Desea eliminar la pagina '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarMenu" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}function eliminarPagina(id, nombre)
{
	if(confirm('Desea eliminar la pagina '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarPagina" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}function eliminarPais(id, nombre)
{
	if(confirm('Desea eliminar la pagina '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarPais" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}function eliminarPermisos(id, nombre)
{
	if(confirm('Desea eliminar el permiso '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarPermisos" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function eliminarPersona(id, nombre)
{
	if(confirm('Desea eliminar el usuario '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarPersona" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function eliminarPersonaEntidad(id, nombre)
{
	if(confirm('Desea eliminar la pagina '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarPersonaEntidad" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function eliminarProvincia(id, nombre)
{
	if(confirm('Desea eliminar la provincia '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarProvincia" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function eliminarRegion(id, nombre)
{
	if(confirm('Desea eliminar la pagina '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarRegion" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function eliminarServcon(id, nombre)
{
	if(confirm('Desea eliminar la pagina '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarServcon" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function eliminarServicio(id, nombre)
{
	if(confirm('Desea eliminar el servicio '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarServicio" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function borrarServicio(id, nombre)
{
	if(confirm('Desea borrar el servicio '+nombre+'?'))
	{
		$.ajax({
                data:  {"borrarServicio" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function eliminarSubcategoria(id, nombre)
{
	if(confirm('Desea eliminar la pagina '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarSubcategoria" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function eliminarTipoCalificacion(id, nombre)
{
	if(confirm('Desea eliminar la calificacion '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarTipoCalificacion" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function eliminarTipodocumento(id, nombre)
{
	if(confirm('Desea eliminar el tipo de documento '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarTipodocumento" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function eliminarTipomultimedia(id, nombre)
{
	if(confirm('Desea eliminar la pagina '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarTipomultimedia" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function eliminarTipopagina(id, nombre)
{
	if(confirm('Desea eliminar el tipo de pagina '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarTipopagina" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function eliminarTiposervicio(id, nombre)
{
	if(confirm('Desea eliminar el tipo de servicio '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarTiposervicio" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function eliminarTipousuario(id, nombre)
{
	if(confirm('Desea eliminar el tipo de usuario '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarTipousuario" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
////////////////////////////////
// Modificar                  //
////////////////////////////////

function modificarContrasena()
{
	var mensaje="";
	var elements = ["OldPassword", "RePassword", "NewRePassword", "Captcha"];
	if ( document.getElementById( 'txtCode'))
	{
		elements.push("Code");
	}
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error";
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"modificarContrasena" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.history.back();
					}
					else
					{
						alerta(response);
						d = new Date();
						$('#captcha').attr("src", urlbase+"script/captcha/captcha.php?"+d.getTime());
					}
                }
        });
	}
	return false;
}


function modificarPerfil()
{
	var mensaje="";
	var elements = ["Rut", "Nombre", "Apellido", "Telefono", "Pais", "Region", "Provincia", "Comuna", 
	"Direccion", "Email", "Captcha"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(!comprobadorFecha("Fecha"))
	{
		mensaje="error con el formato de fecha";
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"modificarPerfil" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
				async: false,
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/mi_perfil";
					}
					else
					{
						alerta(response);
						d = new Date();
						$('#captcha').attr("src", urlbase+"script/captcha/captcha.php?"+d.getTime());
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
		d = new Date();
		$('#captcha').attr("src", urlbase+"script/captcha/captcha.php?"+d.getTime());
	}
	return false;
}

function modificarEmpresa()
{
	var mensaje="";
	
	var elements = ["Code", "Nombre", "Descripcion", "Telefono", "Seo"];
	if(document.getElementById( 'txtSub'))
	{
		if(!comprobadorFecha('Sub'))
		{
			mensaje="error";
		}
	}
	if(document.getElementById( 'txtEstado'))
	{
		if(!comprobador('Estado'))
		{
			mensaje="error";
		}
	}
	if(!comprobadorEmail('Email'))
	{
		mensaje="error";
	}
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error";
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"modificarEmpresa" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.history.back();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta('Revise el formulario');
	}
	return false;
}
function htmlspecialchars(string, quote_style, charset, double_encode) {
  //       discuss at: http://phpjs.org/functions/htmlspecialchars/
  //      original by: Mirek Slugen
  //      improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //      bugfixed by: Nathan
  //      bugfixed by: Arno
  //      bugfixed by: Brett Zamir (http://brett-zamir.me)
  //      bugfixed by: Brett Zamir (http://brett-zamir.me)
  //       revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //         input by: Ratheous
  //         input by: Mailfaker (http://www.weedem.fr/)
  //         input by: felix
  // reimplemented by: Brett Zamir (http://brett-zamir.me)
  //             note: charset argument not supported
  //        example 1: htmlspecialchars("<a href='test'>Test</a>", 'ENT_QUOTES');
  //        returns 1: '&lt;a href=&#039;test&#039;&gt;Test&lt;/a&gt;'
  //        example 2: htmlspecialchars("ab\"c'd", ['ENT_NOQUOTES', 'ENT_QUOTES']);
  //        returns 2: 'ab"c&#039;d'
  //        example 3: htmlspecialchars('my "&entity;" is still here', null, null, false);
  //        returns 3: 'my &quot;&entity;&quot; is still here'

  var optTemp = 0,
    i = 0,
    noquotes = false;
  if (typeof quote_style === 'undefined' || quote_style === null) {
    quote_style = 2;
  }
  string = string.toString();
  if (double_encode !== false) {
    // Put this first to avoid double-encoding
    string = string.replace(/&/g, '&amp;');
  }
  string = string.replace(/</g, '&lt;')
    .replace(/>/g, '&gt;');

  var OPTS = {
    'ENT_NOQUOTES'          : 0,
    'ENT_HTML_QUOTE_SINGLE' : 1,
    'ENT_HTML_QUOTE_DOUBLE' : 2,
    'ENT_COMPAT'            : 2,
    'ENT_QUOTES'            : 3,
    'ENT_IGNORE'            : 4
  };
  if (quote_style === 0) {
    noquotes = true;
  }
  if (typeof quote_style !== 'number') {
    // Allow for a single string or an array of string flags
    quote_style = [].concat(quote_style);
    for (i = 0; i < quote_style.length; i++) {
      // Resolve string input to bitwise e.g. 'ENT_IGNORE' becomes 4
      if (OPTS[quote_style[i]] === 0) {
        noquotes = true;
      } else if (OPTS[quote_style[i]]) {
        optTemp = optTemp | OPTS[quote_style[i]];
      }
    }
    quote_style = optTemp;
  }
  if (quote_style & OPTS.ENT_HTML_QUOTE_SINGLE) {
    string = string.replace(/'/g, '&#039;');
  }
  if (!noquotes) {
    string = string.replace(/"/g, '&quot;');
  }

  return string;
}
function urlencode(str) {
  //       discuss at: http://phpjs.org/functions/urlencode/
  //      original by: Philip Peterson
  //      improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //      improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //      improved by: Brett Zamir (http://brett-zamir.me)
  //      improved by: Lars Fischer
  //         input by: AJ
  //         input by: travc
  //         input by: Brett Zamir (http://brett-zamir.me)
  //         input by: Ratheous
  //      bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //      bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //      bugfixed by: Joris
  // reimplemented by: Brett Zamir (http://brett-zamir.me)
  // reimplemented by: Brett Zamir (http://brett-zamir.me)
  //             note: This reflects PHP 5.3/6.0+ behavior
  //             note: Please be aware that this function expects to encode into UTF-8 encoded strings, as found on
  //             note: pages served as UTF-8
  //        example 1: urlencode('Kevin van Zonneveld!');
  //        returns 1: 'Kevin+van+Zonneveld%21'
  //        example 2: urlencode('http://kevin.vanzonneveld.net/');
  //        returns 2: 'http%3A%2F%2Fkevin.vanzonneveld.net%2F'
  //        example 3: urlencode('http://www.google.nl/search?q=php.js&ie=utf-8&oe=utf-8&aq=t&rls=com.ubuntu:en-US:unofficial&client=firefox-a');
  //        returns 3: 'http%3A%2F%2Fwww.google.nl%2Fsearch%3Fq%3Dphp.js%26ie%3Dutf-8%26oe%3Dutf-8%26aq%3Dt%26rls%3Dcom.ubuntu%3Aen-US%3Aunofficial%26client%3Dfirefox-a'

  str = (str + '')
    .toString();

  // Tilde should be allowed unescaped in future versions of PHP (as reflected below), but if you want to reflect current
  // PHP behavior, you would need to add ".replace(/~/g, '%7E');" to the following.
  return encodeURIComponent(str)
    .replace(/!/g, '%21')
    .replace(/'/g, '%27')
    .replace(/\(/g, '%28')
    .replace(/\)/g, '%29')
    .replace(/\*/g, '%2A')
    .replace(/%20/g, '+');
}
function comprobador(element, min=0, max=255)
{
	if(document.getElementById( 'txt'+element))
	{
		if($('#txt'+element).val().length>min && $('#txt'+element).val().length<max && document.getElementById( 'txt'+element).value.indexOf("_-_")<0)
		{
			if ( document.getElementById( 'img'+element))
			{
				document.getElementById('img'+element).src = urlbase+"imagenes/UI/correcto.png";
			}
			return true;
		}
		else
		{
			document.getElementById('img'+element).src = urlbase+"imagenes/UI/incorrecto.png";
			document.getElementById('txt'+element).focus();
			return false;
		}
	}
	else
	{
		return false;
	}
}

function agregarEmpresa()
{
	var mensaje="";
	
	var elements = ["Rut", "Nombre", "Descripcion", "Telefono", 
	"Email"];
	if ( document.getElementById( 'txtEstado'))
	{
		if(!comprobador('Estado'))
		{
			mensaje="error con la Estado";
		}
	}
	if ( document.getElementById( 'txtFecha'))
	{
		if(!comprobadorFecha('Fecha'))
		{
			mensaje="error con la Fecha";
		}
	}
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"agregarEmpresa" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.history.back();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function agregarPais()
{
	var mensaje="";
	var elements = ["Nombre"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"agregarPais" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/posicionamiento/paises";
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function modificarPais()
{
	var mensaje="";
	var elements = ["Code", "Nombre"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error  con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"modificarPais" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/posicionamiento/paises";
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function listarRegiones()
{
	var pais=$("#txtPais").val();
	$("#txtRegion").html("<option disabled selected>...cargando</option>");
	$("#txtProvincia").html("<option disabled selected></option>");
	$("#txtComuna").html("<option disabled selected></option>");
	$.ajax({
			data:  
				{
					"listarRegiones" : "txtPais="+pais
				},
			url:   urlbase+'script/ajax.php',
			type:  'post',
			success:  function (response) {
				$("#txtRegion").html("<option disabled selected></option>"+response);
			}
	});
}
function listarSubcategoria()
{
	var cat=$("#txtCategoria").val();
	$("#txtSubcategoria").html("<option disabled selected>...cargando</option>");
	$.ajax({
			data:  
				{
					"listarSubcategoria" : "txtCategoria="+cat
				},
			url:   urlbase+'script/ajax.php',
			type:  'post',
			success:  function (response) {
				$("#txtSubcategoria").html("<option disabled selected></option>"+response);
			}
	});
}
function listarServicios()
{
	var ent=$("#txtEmpresa").val();
	$("#txtServicio").html("<option disabled selected>...cargando</option>");
	$.ajax({
			data:  
				{
					"listarServicios" : "txtEmpresa="+ent
				},
			url:   urlbase+'script/ajax.php',
			type:  'post',
			success:  function (response) {
				$("#txtServicio").html("<option disabled selected></option>"+response);
			}
	});
}
function seleccionarEmpresa()
{
	var empresa=$("#ddlEmpresa").val();
	$.ajax({
			data:  
				{
					"seleccionarEmpresa" : "txtEmpresa="+empresa
				},
			url:   urlbase+'script/ajax.php',
			type:  'post',
			success:  function (response) 
			{
				if(response=="Exito")
				{
					location.reload();
				}
				else
				{
					alerta(response);
				}
			}
	});
}
function listarProvincias()
{
	var reg=$("#txtRegion").val();
	$("#txtProvincia").html("<option disabled selected>...cargando</option>");
	$("#txtComuna").html("<option disabled selected></option>");
	$.ajax({
			data:  
				{
					"listarProvincias" : "txtRegion="+reg
				},
			url:   urlbase+'script/ajax.php',
			type:  'post',
			success:  function (response) {
				$("#txtProvincia").html("<option disabled selected></option>"+response);
			}
	});
}
function listarComunas()
{
	var prov=$("#txtProvincia").val();
	$("#txtComuna").html("<option disabled selected>...cargando</option>");
	$.ajax({
			data:  
				{
					"listarComunas" : "txtProvincia="+prov
				},
			url:   urlbase+'script/ajax.php',
			type:  'post',
			success:  function (response) {
				$("#txtComuna").html("<option disabled selected></option>"+response);
			}
	});
}



function modificarRegion()
{
	var mensaje="";
	var elements = ["Code", "Nombre", "Pais"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"modificarRegion" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/posicionamiento/regiones";
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function agregarRegion()
{
	var mensaje="";
	var elements = ["Nombre", "Pais"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"agregarRegion" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/posicionamiento/regiones";
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function agregarProvincia()
{
	var mensaje="";
	var elements = ["Nombre", "Pais", "Region"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"agregarProvincia" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/posicionamiento/provincias";
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function modificarProvincia()
{
	var mensaje="";
	var elements = ["Code", "Nombre", "Pais", "Region"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"modificarProvincia" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/posicionamiento/provincias";
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function agregarComuna()
{
	var mensaje="";
	var elements = ["Nombre", "Pais", "Region", "Provincia"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"agregarComuna" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/posicionamiento/comunas";
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function modificarComuna()
{
	var mensaje="";
	var elements = ["Code", "Nombre", "Pais", "Region", "Provincia"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error  con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"modificarComuna" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/posicionamiento/comunas";
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function agregarCategoria()
{
	var mensaje="";
	var elements = ["Nombre"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"agregarCategoria" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/Repertorio/categorias";
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function agregarSubcategoria()
{
	var mensaje="";
	var elements = ["Nombre", "Categoria"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"agregarSubcategoria" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/Repertorio/subcategorias";
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}
function alerta(mensaje)
{
	document.getElementById("contenido").innerHTML = '<div class="mensaje alerta"><em></em><p>'+mensaje+'</p><a onclick="this.parentNode.remove()">X</a></div>'+document.getElementById("contenido").innerHTML;
}
function agregarServicio()
{
	var mensaje="";
	var serv="";
	var elements = ["Nombre", "Categoria", "Subcategoria", "TipoServicio"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
		else
		{
			if(serv!="")
			{
				serv+="&&";
			}
			serv+="txt"+elements[i]+"="+document.getElementById("txt"+elements[i]).value;
		}
	}
	if ( document.getElementById( 'txtEmpresa'))
	{
		if(!comprobador('Empresa'))
		{
			mensaje="error con la empresa";
		}
		else
		{
			serv+="&&txtEmpresa="+document.getElementById("txtEmpresa").value;
		}
	}
	if ( document.getElementById( 'txtEstado'))
	{
		if(!comprobador('Estado'))
		{
			mensaje="error con la Estado";
		}
		else
		{
			serv+="&&txtEstado="+document.getElementById("txtEstado").value;
		}
	}
	if ( document.getElementById( 'txtDescripcion'))
	{
		//document.getElementById('txtDescripcion').innerHTML = document.getElementById('editor').innerHTML;
		if(!comprobador('Descripcion', 0, 1000))
		{
			mensaje="error con la Descripcion";
		}
		else
		{
			serv+="&&txtDescripcion="+urlencode(document.getElementById("txtDescripcion").value);
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						//"agregarServicio" : $('.formulario').serialize()
						"agregarServicio" : serv
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						if ( document.getElementById( 'txtEmpresa'))
						{
							window.location=urlbase+"administracion/Repertorio/servicios";
						}
						else
						{
							window.location=urlbase+"administracion/servicios";
						}
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function desconectarse()
{
	vaciarCarro();
	vaciarComparacion();
	$.ajax({
			data:  
				{
					"desconectarse" : 1
				},
			url:   urlbase+'script/ajax.php',
			type:  'post',
			success:  function (response) {
				if(response=="Exito")
				{
					window.location=urlbase;
				}
				else
				{
					alerta(response);
				}
			}
	});
}

function agregarEscalacal()
{
	var mensaje="";
	var elements = ["Nombre"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"agregarEscalacal" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/posicionamiento/comunas";
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function agregarEstado()
{
	var mensaje="";
	var elements = ["Nombre"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"agregarEstado" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/posicionamiento/comunas";
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function agregarTipocal()
{
	var mensaje="";
	var elements = ["Nombre"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"agregarTipocal" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/posicionamiento/comunas";
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function agregarTipodoc()
{
	var mensaje="";
	var elements = ["Nombre"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"agregarTipodoc" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/contenido/tipodocumento";
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function modificarTipodoc()
{
	var mensaje="";
	var elements = ["Code", "Nombre"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"modificarTipodoc" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/contenido/tipodocumento";
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function agregarTipomedia()
{
	var mensaje="";
	var elements = ["Nombre"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"agregarTipomedia" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/contenido/tipomultimedia";
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function modificarTipomedia()
{
	var mensaje="";
	var elements = ["Code", "Nombre"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"modificarTipomedia" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/contenido/tipomultimedia";
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function agregarTipopag()
{
	var mensaje="";
	var elements = ["Nombre"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"agregarTipopag" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/contenido/tipopagina";
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function modificarTipopag()
{
	var mensaje="";
	var elements = ["Code", "Nombre"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"modificarTipopag" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/contenido/tipopagina";
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function agregarTiposerv()
{
	var mensaje="";
	var elements = ["Nombre"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"agregarTiposerv" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/Repertorio/tiposervicios";
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function agregarTipousuario()
{
	var mensaje="";
	var elements = ["Nombre"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"agregarTipousuario" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/seguridad/tipousuario";
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function modificarTipousuario()
{
	var mensaje="";
	var elements = ["Code", "Nombre"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"modificarTipousuario" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/seguridad/tipousuario";
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function agregarPermiso()
{
	var mensaje="";
	var elements = ["TipoUsuario", "Pagina"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
		data: 
			{
				"validarPermisos" : $('.formulario').serialize()
			},
		url:   urlbase+'script/ajax.php',
		type:  'post',
		success:  function (response) {
			if(response=='0')
			{
				
				$.ajax({
						data:  
							{
								"agregarPermiso" : $('.formulario').serialize()
							},
						url:   urlbase+'script/ajax.php',
						type:  'post',
						success:  function (response) {
							if(response=="Exito")
							{
								window.location=urlbase+"administracion/seguridad/permiso";
							}
							else
							{
								alerta(response);
							}
						}
				});
			}
			else
			{
				alert("Ya existe el permiso registrado");
			}
		}
		});
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function agregarDocumento()
{
	var mensaje="";
	var elements = ["Nombre", "Url", "Tipodoc"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if ( document.getElementById( 'txtEmpresa'))
	{
		if(!comprobador('Empresa'))
		{
			mensaje="error con la empresa";
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"agregarDocumento" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/contenido/documento";
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function modificarDocumento()
{
	var mensaje="";
	var elements = ["Code", "Nombre", "Url", "Tipodoc"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if ( document.getElementById( 'txtEmpresa'))
	{
		if(!comprobador('Empresa'))
		{
			mensaje="error con la empresa";
		}
	}
	if(mensaje=="")
	{
		if ( document.getElementById( 'txtEmpresa'))
		{
			$.ajax({
					data:  
						{
							"modificarDocumento" : $('.formulario').serialize()
						},
					url:   urlbase+'script/ajax.php',
					type:  'post',
					success:  function (response) {
						if(response=="Exito")
						{
							window.location=urlbase+"administracion/contenido/documento";
						}
						else
						{
							alerta(response);
						}
					}
			});
		}
		else
		{
			$.ajax({
					data:  
						{
							"modificarDocumento" : $('.formulario').serialize()
						},
					url:   urlbase+'script/ajax.php',
					type:  'post',
					success:  function (response) {
						if(response=="Exito")
						{
							window.location=urlbase+"administracion/documentos";
						}
						else
						{
							alerta(response);
						}
					}
			});
		}
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function agregarPagina()
{
	var mensaje="";
	var elements = ["Nombre", "Tp", "UrlFicticio", "UrlReal", "Descripcion"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"agregarPagina" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/contenido/pagina";
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function modificarPagina()
{
	var mensaje="";
	var elements = ["Code", "Nombre", "Tp", "UrlFicticio", "UrlReal", "Descripcion"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"modificarPagina" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/contenido/pagina";
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function multimedia(id)
{
	$('#frmModificar').attr("action",urlbase+"administracion/contenido/multimedia");
	modificar(id);
}
/*
function agregarAlCarro(id, nombre,empresa, enlace)
{
	if (typeof(Storage) != "undefined") 
	{
    // Store  => localStorage.setItem("lastname"[1], "Smith");
    // Retrieve =>  document.getElementById("result").innerHTML = localStorage.getItem("lastname"[1]);
		var servicio = JSON.stringify({cod: id, nom: nombre, emp: empresa, link: enlace});
		var carro = localStorage.getItem("Carro");
		if(carro.indexOf(servicio)<0)
		{
			localStorage.setItem("Carro", carro + servicio);
		}
	}
	else 
	{
		console.log("Sorry, your browser does not support Web Storage...");
		alert("Sorry, your browser does not support Web Storage...");
	}
}

function vaciarCarro()
{
	if (typeof(Storage) != "undefined") 
	{
		localStorage.removeItem("Carro");
	}
	else 
	{
		console.log("Sorry, your browser does not support Web Storage...");
		alert("Sorry, your browser does not support Web Storage...");
	}
}

function eliminarCarro(id, nombre,empresa, enlace)
{
	var servicio = JSON.stringify({cod: id, nom: nombre, emp: empresa, link: enlace});
	var carro = localStorage.getItem("Carro");
	if(carro.indexOf(servicio)>=0)
	{
		localStorage.setItem("Carro", carro.replace(servicio, ""));
	}
}
*/
function agregarAlCarro(id)
{
	if (typeof(Storage) != "undefined") 
	{
		var carro = JSON.parse(localStorage.getItem("Carro"));
		if(carro===null)
		{
			carro=[];
		}
		if(carro.indexOf(id)<0)
		{
			carro[carro.length]=id;
			localStorage.setItem("Carro", JSON.stringify(carro));
			$.ajax({
                data:  
					{
						"actualizarCarro" : JSON.parse(localStorage.getItem("Carro"))
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response!="Exito")
					{
						alerta(response);
					}
                }
			});
		}
	}
	else 
	{
		console.log("Sorry, your browser does not support Web Storage...");
		alert("Sorry, your browser does not support Web Storage...");
	}
}
function eliminarCarro(id)
{
	if (typeof(Storage) != "undefined") 
	{
		var carro = JSON.parse(localStorage.getItem("Carro"));
		if(carro===null)
		{
			carro=[];
		}
		var index=carro.indexOf(id);
		if(index>=0)
		{
			carro.splice(index, 1);
			localStorage.setItem("Carro", JSON.stringify(carro));
			$.ajax({
                data:  
					{
						"actualizarCarro" : JSON.parse(localStorage.getItem("Carro"))
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response!="Exito")
					{
						alerta(response);
					}
                }
			});
		}
	}
	else 
	{
		console.log("Sorry, your browser does not support Web Storage...");
		alert("Sorry, your browser does not support Web Storage...");
	}
}
function vaciarCarro()
{
	if (typeof(Storage) != "undefined") 
	{
		localStorage.removeItem("Carro");
		$.ajax({
                data:  
					{
						"actualizarCarro" : JSON.parse(localStorage.getItem("Carro"))
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response!="Exito")
					{
						alerta(response);
					}
                }
			});
	}
	else 
	{
		console.log("Sorry, your browser does not support Web Storage...");
		alert("Sorry, your browser does not support Web Storage...");
	}
}
function agregarAComparacion(id)
{
	if (typeof(Storage) != "undefined") 
	{
		var carro = JSON.parse(localStorage.getItem("Comparacion"));
		if(carro===null)
		{
			carro=[];
		}
		if(carro.indexOf(id)<0)
		{
			carro[carro.length]=id;
			localStorage.setItem("Comparacion", JSON.stringify(carro));
			$.ajax({
                data:  
					{
						"actualizarComp" : JSON.parse(localStorage.getItem("Carro"))
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response!="Exito")
					{
						alerta(response);
					}
                }
			});
		}
	}
	else 
	{
		console.log("Sorry, your browser does not support Web Storage...");
		alert("Sorry, your browser does not support Web Storage...");
	}
}
function eliminarComparacion(id)
{
	if (typeof(Storage) != "undefined") 
	{
		var carro = JSON.parse(localStorage.getItem("Comparacion"));
		var index=carro.indexOf(id);
		if(index>=0)
		{
			carro.splice(index, 1);
			localStorage.setItem("Comparacion", JSON.stringify(carro));
			$.ajax({
                data:  
					{
						"actualizarComp" : JSON.parse(localStorage.getItem("Carro"))
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response!="Exito")
					{
						alerta(response);
					}
                }
			});
		}
	}
	else 
	{
		console.log("Sorry, your browser does not support Web Storage...");
		alert("Sorry, your browser does not support Web Storage...");
	}
}
function vaciarComparacion()
{
	if (typeof(Storage) != "undefined") 
	{
		localStorage.removeItem("Comparacion");
		$.ajax({
                data:  
					{
						"actualizarComp" : JSON.parse(localStorage.getItem("Carro"))
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response!="Exito")
					{
						alerta(response);
					}
                }
			});
	}
	else 
	{
		console.log("Sorry, your browser does not support Web Storage...");
		alert("Sorry, your browser does not support Web Storage...");
	}
}
/*
function secretForm(id, destino)
{
	var contenido='<form id="secretForm" action="destino"><input type="hidden" name="txtCode" value="'+id+'"></form>';
	$("body").append(contenido);
	$("#secretForm").submit();
}
function modificarServicio(id)
{
	var destino=urlbase+"administracion/servicios/modificar"
	secretForm(id, destino);
}*/
//usar $("ol").append("<li>Appended item</li>");
//para añadir un form y a ese crear el update de txtCode 

//url usuarios
//administracion/servicios/nom_serv/agregar
//administracion/servicios/nom_serv/modificar
//administracion/servicios/nom_serv/multimedia
//administracion/servicios/nom_serv/multimedia/agregar
//administracion/servicios/nom_serv/multimedia/modificar

function agregarMultimedia()
{
	var mensaje="";
	var elements = ["Nombre", "Servicio", "TipoMultimedia", "Url"];
	if(document.getElementById( 'txtEmpresa'))
	{
		elements.push('Empresa');
	}
	if(document.getElementById( 'txtServicio'))
	{
		elements.push('Servicio');
	}
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	var tm=$('#txtTipoMultimedia').val();
	switch(parseInt(tm))
	{
		case 1:
			/*//audio
			//alert("case audio");
			$('#lblUrl1').html('Enlace Audio MP3');
			$('#lblUrl2').html('Enlace Audio Ogg/Vorbis');
			$('#lblUrl3').html('Enlace Audio WebM');*/
			var str = $('#txtUrl1').val();
			var n = str.indexOf(".mp3"); 
			if(n==-1)
			{
				mensaje="Error, en enlace no es un archivo mpeg(mp3) valido";
			}
			var str = $('#txtUrl2').val();
			var n = str.indexOf(".ogg"); 
			if(n==-1)
			{
				mensaje="Error, en enlace no es un archivo ogg valido";
			}
			var str = $('#txtUrl3').val();
			var n = str.indexOf(".wav"); 
			if(n==-1)
			{
				mensaje="Error, en enlace no es un archivo wav valido";
			}
			break;
		case 2:
			/*//video
			//lert("case video");
			$('#lblUrl1').html('Enlace video MP4');
			$('#lblUrl2').html('Enlace video Ogg/Vorbis');
			$('#lblUrl3').html('Enlace video WebM');*/
			var str = $('#txtUrl1').val();
			var n = str.indexOf(".mp4"); 
			if(n==-1)
			{
				mensaje="Error, en enlace no es un archivo MP4 valido";
			}
			var str = $('#txtUrl2').val();
			var n = str.indexOf(".ogg"); 
			if(n==-1)
			{
				mensaje="Error, en enlace no es un archivo Ogg/Vorbis valido";
			}
			var str = $('#txtUrl3').val();
			var n = str.indexOf(".webm"); 
			if(n==-1)
			{
				mensaje="Error, en enlace no es un archivo WebM valido";
			}
			break;
		case 3:
			/*//imagen
			$('#lblUrl1').html('Enlace');
			$('#url1').show();*/
			break;
		case 4:
			//pdf
			/*$('#lblUrl1').html('Enlace');*/
			var str = $('#txtUrl').val();
			var n = str.indexOf(".pdf"); 
			if(n==-1)
			{
				mensaje="Error, en enlace no es un archivo pdf valido";
			}
			break;
		case 5:
			//youtube
			/*$('#lblUrl1').html('Enlace');*/
			var str = $('#txtUrl').val();
			var n = str.indexOf("youtu.be"); 
			var m = str.indexOf("youtube.com"); 
			if(n==-1 && m==-1)
			{
				mensaje="Error, en enlace no es un archivo pdf valido";
			}
			break;
		default:
			/*//otro
			$('#lblUrl1').html('Codigo o enlace');
			$('#url1').show();*/
			break;
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"agregarMultimedia" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						if(document.getElementById( 'txtServicio'))
						{
							window.location=urlbase+"administracion/contenido/multimedia";
						}
						else
						{
							window.location=urlbase+"administracion/multimedia";
						}
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}
function modificarMultimedia()
{
	var mensaje="";
	var elements = ["Code", "Nombre", "Servicio", "TipoMultimedia", "Url"];
	if(document.getElementById( 'txtServicio'))
	{
		elements.push('Servicio');
	}
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	var tm=$('#txtTipoMultimedia').val();
	switch(parseInt(tm))
	{
		case 1:
			/*//audio
			//alert("case audio");
			$('#lblUrl1').html('Enlace Audio MP3');
			$('#lblUrl2').html('Enlace Audio Ogg/Vorbis');
			$('#lblUrl3').html('Enlace Audio WebM');*/
			var str = $('#txtUrl1').val();
			var n = str.indexOf(".mp3"); 
			if(n==-1)
			{
				mensaje="Error, en enlace no es un archivo mpeg(mp3) valido";
			}
			var str = $('#txtUrl2').val();
			var n = str.indexOf(".ogg"); 
			if(n==-1)
			{
				mensaje="Error, en enlace no es un archivo ogg valido";
			}
			var str = $('#txtUrl3').val();
			var n = str.indexOf(".wav"); 
			if(n==-1)
			{
				mensaje="Error, en enlace no es un archivo wav valido";
			}
			break;
		case 2:
			/*//video
			//lert("case video");
			$('#lblUrl1').html('Enlace video MP4');
			$('#lblUrl2').html('Enlace video Ogg/Vorbis');
			$('#lblUrl3').html('Enlace video WebM');*/
			var str = $('#txtUrl1').val();
			var n = str.indexOf(".mp4"); 
			if(n==-1)
			{
				mensaje="Error, en enlace no es un archivo MP4 valido";
			}
			var str = $('#txtUrl2').val();
			var n = str.indexOf(".ogg"); 
			if(n==-1)
			{
				mensaje="Error, en enlace no es un archivo Ogg/Vorbis valido";
			}
			var str = $('#txtUrl3').val();
			var n = str.indexOf(".webm"); 
			if(n==-1)
			{
				mensaje="Error, en enlace no es un archivo WebM valido";
			}
			break;
		case 3:
			/*//imagen
			$('#lblUrl1').html('Enlace');
			$('#url1').show();*/
			break;
		case 4:
			//pdf
			/*$('#lblUrl1').html('Enlace');*/
			var str = $('#txtUrl').val();
			var n = str.indexOf(".pdf"); 
			if(n==-1)
			{
				mensaje="Error, en enlace no es un archivo pdf valido";
			}
			break;
		case 5:
			//youtube
			/*$('#lblUrl1').html('Enlace');*/
			var str = $('#txtUrl').val();
			var n = str.indexOf("youtu.be"); 
			var m = str.indexOf("youtube.com"); 
			if(n==-1 && m==-1)
			{
				mensaje="Error, en enlace no es un archivo pdf valido";
			}
			break;
		default:
			/*//otro
			$('#lblUrl1').html('Codigo o enlace');
			$('#url1').show();*/
			break;
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"modificarMultimedia" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
				async: false,
                success:  function (response) {
                    if(response=="Exito")
					{
						if(document.getElementById( 'txtServicio'))
						{
							window.location=urlbase+"administracion/contenido/multimedia";
						}
						else
						{
							window.location=urlbase+"administracion/multimedia";
						}
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function comprobadorFecha(element)
{
	if(document.getElementById( 'txt'+element))
	{
		var input=$('#txt'+element).val();
		if(input.length>0 && input.length<255 && input.match(/\d{1,2}\/\d{1,2}\/\d{4}/g))
		{
			if ( document.getElementById( 'img'+element))
			{
				document.getElementById('img'+element).src = urlbase+"imagenes/UI/correcto.png";
			}
			return true;
		}
		else
		{
			document.getElementById('img'+element).src = urlbase+"imagenes/UI/incorrecto.png";
			document.getElementById('txt'+element).focus();
			return false;
		}
	}
	else
	{
		return false;
	}
}

function comprobadorEmail(element)
{
	if(document.getElementById( 'txt'+element))
	{
		var input=$('#txt'+element).val();
		if(input.length>0 && input.length<255 && input.match(/[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/))
		{
			if ( document.getElementById( 'img'+element))
			{
				document.getElementById('img'+element).src = urlbase+"imagenes/UI/correcto.png";
			}
			return true;
		}
		else
		{
			document.getElementById('img'+element).src = urlbase+"imagenes/UI/incorrecto.png";
			document.getElementById('txt'+element).focus();
			return false;
		}
	}
	else
	{
		return false;
	}
}

function comprobadorRut(element)
{
	if(document.getElementById( 'txt'+element))
	{ 
		var input=$('#txt'+element).val();
		/*if(input.match(/0*(\d{1,3}(\.?\d{3})*)\-?([\dkK])/g)!="")
		{
			console.log("paso el rut");
		}
		if(input.length>0)
		{
			console.log("paso el min length");
		}
		if(input.length<255)
		{
			console.log("paso el max length");
		}*/
		if(input.length>0 && input.length<255 && input.match(/0*(\d{1,3}(\.?\d{3})*)\-?([\dkK])/g)!="")
		{
			if ( document.getElementById( 'img'+element))
			{
				document.getElementById('img'+element).src = urlbase+"imagenes/UI/correcto.png";
			}
			return true;
		}
		else
		{
			document.getElementById('img'+element).src = urlbase+"imagenes/UI/incorrecto.png";
			document.getElementById('txt'+element).focus();
			return false;
		}
	}
	else
	{
		return false;
	}
}

function agregarUsuario()
{
	var mensaje="";
	var elements = ["Rut", "Nombre", "Apellido", "Telefono", "Comuna", "Direccion", "Password", "Captcha", "Email"];
	if(document.getElementById( 'txtTipo'))
	{
		elements.push('Tipo');
	}
	if(document.getElementById( 'txtEstado'))
	{
		elements.push('Estado');
	}
	for (i = 0; i < elements.length; i++)
	{
		if(comprobador(elements[i])==false)
		{
			mensaje="error con el "+elements[i];
			alerta("error:"+elements[i]);
			return false;
		}
	}
	if(!comprobadorFecha("Fecha"))
	{
		mensaje="error con el formato de fecha";
	}
	if(!comprobadorRut("Rut"))
	{
		mensaje="error con el formato del rut";
	}
	if(document.getElementById( 'txtRepassword'))
	{
		if($('#txtPassword').val()!=$('#txtRepassword').val())
		{
			mensaje="Las constraseñas no coinciden";
			document.getElementById('imgRepassword').src = urlbase+"imagenes/UI/incorrecto.png";
		}
	}
	else
	{
		mensaje="error con la contraseña";
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"agregarUsuario" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
				async: false,
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/seguridad/usuario";
					}
					else
					{
						alerta(response);
						d = new Date();
						$('#captcha').attr("src", urlbase+"script/captcha/captcha.php?"+d.getTime());
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function modificarUsuario()
{
	var mensaje="";
	var elements = ["Nombre", "Apellido", "Telefono", "Pais", "Region", "Provincia", "Comuna", 
	"Direccion", "Estado", "Tipo", "Email", "Fecha"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(!comprobadorFecha("Fecha"))
	{
		mensaje="error con el formato de fecha";
	}
	if(!comprobadorRut("Rut"))
	{
		mensaje="error con el formato del rut";
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"modificarUsuario" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
				async: false,
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/seguridad/usuario";
					}
					else
					{
						alert(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function registrarse()
{
	var mensaje="";
	var elements = ["ReEmail", "Captcha"];
	if(!comprobadorEmail("Email"))
	{
		mensaje="error con el formato del correo";
	}
	if($('#Email').val()!=$('#ReEmail').val())
	{
		mensaje="Los email no coinciden";
		document.getElementById('imgReEmail').src = urlbase+"imagenes/UI/incorrecto.png";
		document.getElementById('txtReEmail').focus();
	}
	if(mensaje=="")
	{
		var email=$('#txtEmail').val();
		$.ajax({
                data:  
					{
						"registrarse" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						//alert('tamos pal exito');
						$('#contenido').html('<form class="formulario" onsubmit="return verificarCodigo()" action="'+urlbase+'registrar-paso3"   method="post"><h1 class="titulo2">Registro paso 2</h1><p>Se envio un correo a '+email+' ingrese el codigo o acceda al enlace enviado</p><div><label>Ingrese el Codigo</label><input type="text" required x-moz-errormessage="Debe ingresar el codigo" id="txtCode" name="txtCode"><img src="'+urlbase+'imagenes/none.png" id="imgCode"></div><div><input type="submit" value="Verificar"></div></form>');
					}
					else
					{
						alerta(response);
						d = new Date();
						$('#captcha').attr("src", urlbase+"script/captcha/captcha.php?"+d.getTime());
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function verificarCodigo()
{
	var mensaje="";
	if(!comprobador("Code"))
	{
		mensaje="el codigo no es valido";
	}
	if(mensaje=="")
	{
		var estado="";
		var email=$('#txtEmail').val();
		$.ajax({
                data:  
					{
						"verificarCodigo" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
				async: false,
                success:  function (response) {
                    if(response=="Exito")
					{
						estado="Exito";
					}
					else
					{
						alerta(response);
					}
                }
        });
		//console.log('mi estado es '+estado);
		if(estado=="Exito")
		{
			return true;
		}
		return false;
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function actualizarCanasta(id)
{
	var mensaje="";
	if(document.getElementById(id))
	{
		$('#'+id).html('Actualizando Canasta...');
		if (typeof(Storage) != "undefined") 
		{
			var carro = JSON.parse(localStorage.getItem("Carro"));
			if(carro===null)
			{
				$('#'+id).html('No tienes ningun articulo en la canasta');
			}
			else
			{
				$.ajax({
						data:  
							{
								"actualizarCanasta" : carro
							},
						url:   urlbase+'script/ajax.php',
						type:  'post',
						async: false,
						success:  function (response) 
						{
								$('#'+id).html(response);
						}
				});
			}
		}
		else 
		{
			console.log("Sorry, your browser does not support Web Storage...");
			alert("Sorry, your browser does not support Web Storage...");
		}
	}
	else
	{
		alerta("El bloque no existe");
	}
}

function actualizarComparacion(id)
{
	var mensaje="";
	if(document.getElementById(id))
	{
		$('#'+id).html('Cargando Comparacion...');
		if (typeof(Storage) != "undefined") 
		{
			var carro = JSON.parse(localStorage.getItem("Comparacion"));
			if(carro===null)
			{
				$('#'+id).html('No tienes ningun articulo en la canasta');
			}
			else
			{
				var datos="";
				$.ajax({
						data:  
							{
								"actualizarComparacion" : carro
							},
						url:   urlbase+'script/ajax.php',
						type:  'post',
						async: false,
						success:  function (response) 
						{
							if(response!="error")
							{
								datos=response;
							}
						}
				});
				//$('#'+id).html(datos);
				//$('#tablacomparacion').html(datos);
				document.getElementById('table').tBodies[0].innerHTML = datos;
				$('#'+id).html('');
			}
		}
		else 
		{
			console.log("Sorry, your browser does not support Web Storage...");
			alert("Sorry, your browser does not support Web Storage...");
		}
	}
	else
	{
		alerta("El bloque no existe");
	}
}

function cargarDatos(id)
{
	var mensaje="";
	if(document.getElementById(id))
	{
		$('#'+id).html('Cargando Comparacion...');
		if (typeof(Storage) != "undefined") 
		{
			var carro = JSON.parse(localStorage.getItem("Comparacion"));
			if(carro===null)
			{
				$('#'+id).html('No tienes ningun articulo en la canasta');
			}
			else
			{
				var datos="";
				$.ajax({
						data:  
							{
								"actualizarComparacion" : carro
							},
						url:   urlbase+'script/ajax.php',
						type:  'post',
						async: false,
						success:  function (response) 
						{
							if(response!="error")
							{
								datos=JSON.parse(response);
								//datos=response;
							}
						}
				});
				//$('#'+id).html(datos);
				return datos;
			}
		}
		else 
		{
			return false;
		}
	}
	else
	{
		alerta("El bloque no existe");
		return false;
	}
	return false;
}
function contratar()
{
	var mensaje="";
	if (typeof(Storage) != "undefined") 
	{
		var carro = JSON.parse(localStorage.getItem("Carro"));
		if(carro===null)
		{
			console.log("No tienes ningun articulo en la canasta...");
			alerta("No tienes ningun articulo en la canasta...");
		}
		else
		{
			$('#contenido').html(
				'<form class="formulario" onsubmit="return confirmarContrato()">'+
				'<div id="error"></div>'+
				'<div><img title="Captcha" id="Captcha" src="'+urlbase+'script/captcha/captcha.php" /></div>'+
				'<div><label>Ingrese el texto de la imagen:</label><input required x-moz-errormessage="Debe ingresar el texto de la imagen" type="text" size="16" id="txtCaptcha" name="txtCaptcha"  maxlength="255" title="Ingrese el texto de la imagen." placeholder="Ingrese el texto de la imagen." /><br><img src="'+urlbase+'imagenes/none.png" id="imgCaptcha"></div>'+
				'<div><label style="width: 400px;" for="txtCondicion">Estoy de acuerdo con los <a  href="'+urlbase+'terminos_y_condiciones">Terminos y Condiciones</a></label></br><input id="txtCondicion" type="checkbox" required x-moz-errormessage="Debe aceptar los terminos y condiciones" /></div>'+
				'<div><input type="submit" value="Confirmar Contrato"></div>'+
				'</form>'
			);
		}
	}
	else 
	{
		console.log("Sorry, your browser does not support Web Storage...");
		alert("Sorry, your browser does not support Web Storage...");
	}
}
function confirmarContrato()
{
	var mensaje="";
	if (typeof(Storage) != "undefined") 
	{
		var carro = JSON.parse(localStorage.getItem("Carro"));
		if(carro===null)
		{
			console.log("No tienes ningun articulo en la canasta...");
			alerta("No tienes ningun articulo en la canasta...");
		}
		else
		{
			if(comprobador('Captcha'))
			{
				$.ajax({
						data:  
							{
								"contratar" : carro
							},
						url:   urlbase+'script/ajax.php',
						type:  'post',
						async: false,
						success:  function (response) 
						{
							if(response=='Exito')
							{
								vaciarCarro();
								$('#seccion').html('Contrato realizado con exito');
							}
							else
							{
								alerta(response);
							}
						}
				});
			}
			else
			{
				alerta("Debes ingresar el texto de la imagen");
			}
		}
	}
	else 
	{
		console.log("Sorry, your browser does not support Web Storage...");
		alert("Sorry, your browser does not support Web Storage...");
	}
}
function modificarContacto()
{
	var mensaje="";
	var elements = ["Code", "Usuario", "Empresa", "Fecha", "Estado"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error";
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"modificarContacto" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.history.back();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	return false;
}
function modificarTiposerv()
{
	var mensaje="";
	var elements = ["Code", "Nombre"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error";
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"modificarTiposerv" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.history.back();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}
function modificarSubcategoria()
{
	var mensaje="";
	var elements = ["Code", "Nombre", "Categoria"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error";
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"modificarSubcategoria" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.history.back();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}
function modificarCategoria()
{
	var mensaje="";
	var elements = ["Code", "Nombre"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error";
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"modificarCategoria" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.history.back();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}
function agregarMensaje()
{
	var mensaje="";
	var elements = ["Code", "Mensaje"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error";
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"agregarMensaje" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload()();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}

function modificarMensaje()
{
	var mensaje="";
	var elements = ["Code", "Mensaje"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error";
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"agregarMensaje" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.history.back();
					}
					else
					{
						alerta(response);
					}
                }
        });
	} 
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}
function verMensajes(id)
{
	$('#txtCode').val(id.toString());
	document.frmModificar.action=urlbase+"administracion/contratos/mensajes";
	document.frmModificar.submit();
}
function agregarPregunta()
{
	var mensaje="";
	var elements = ["Nombre", "Descripcion"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error";
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"agregarPregunta" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.history.back();
					}
					else
					{
						alerta(response);
					}
                }
        });
	} 
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}
function modificarPregunta()
{
	var mensaje="";
	var elements = ["Code", "Nombre", "Descripcion"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error";
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"modificarPregunta" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.history.back();
					}
					else
					{
						alerta(response);
					}
                }
        });
	} 
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}
function agregarMetrica()
{
	var mensaje="";
	var elements = ["Nombre", "Valor"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error";
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"agregarMetrica" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.history.back();
					}
					else
					{
						alerta(response);
					}
                }
        });
	} 
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}
function modificarMetrica()
{
	var mensaje="";
	var elements = ["Code", "Nombre", "Valor"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error";
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"modificarMetrica" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.history.back();
					}
					else
					{
						alerta(response);
					}
                }
        });
	} 
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}
function eliminarPregunta(id, nombre)
{
	if(confirm('Desea eliminar la pregunta '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarPregunta" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function eliminarMetrica(id, nombre)
{
	if(confirm('Desea eliminar la pregunta '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarMetrica" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function modificarServicio()
{
	var mensaje="";
	var elements = ["Code", "Nombre", "Categoria", "Subcategoria", "TipoServicio", "Descripcion"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if ( document.getElementById( 'txtEmpresa'))
	{
		if(!comprobador('Empresa'))
		{
			mensaje="error con la empresa";
		}
	}
	if ( document.getElementById( 'txtEstado'))
	{
		if(!comprobador('Estado'))
		{
			mensaje="error con la Estado";
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"modificarServicio" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						if ( document.getElementById( 'txtEmpresa'))
						{
							window.location=urlbase+"administracion/Repertorio/servicios";
						}
						else
						{
							window.location=urlbase+"administracion/servicios";
						}
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}
function agregarAutoridad()
{
	var mensaje="";
	var elements = ["Empresa", "Persona"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
		data: 
			{
				"validarAutoridad" : $('.formulario').serialize()
			},
		url:   urlbase+'script/ajax.php',
		type:  'post',
		success:  function (response) {
			if(response=='0')
			{
				
				$.ajax({
						data:  
							{
								"agregarAutoridad" : $('.formulario').serialize()
							},
						url:   urlbase+'script/ajax.php',
						type:  'post',
						success:  function (response) {
							if(response=="Exito")
							{
								window.location=urlbase+"administracion/seguridad/autoridades";
							}
							else
							{
								alerta(response);
							}
						}
				});
			}
			else
			{
				alert("Ya existe la autoridad registrado");
			}
		}
		});
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}
function eliminarAutoridad(id, nombre)
{
	if(confirm('Desea eliminar la autoridad de '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarAutoridad" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function agregarMenu()
{
	var mensaje="";
	var elements = ["Nombre", "Descripcion", "Tipo"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error";
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"agregarMenu" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.history.back();
					}
					else
					{
						alerta(response);
					}
                }
        });
	} 
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}
function modificarMenu()
{
	var mensaje="";
	var elements = ["Code", "Nombre", "Descripcion", "Tipo"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error";
		}
	}
	if(mensaje=="")
	{
		$.ajax({
                data:  
					{
						"modificarMenu" : $('.formulario').serialize()
					},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						window.history.back();
					}
					else
					{
						alerta(response);
					}
                }
        });
	} 
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}
function eliminarMenu(id, nombre)
{
	if(confirm('Desea eliminar la menu de '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarMenu" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function agregarItem()
{
	var mensaje="";
	var elements = ["Menu", "Pagina"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
		data: 
			{
				"validarItem" : $('.formulario').serialize()
			},
		url:   urlbase+'script/ajax.php',
		type:  'post',
		success:  function (response) {
			if(response=='0')
			{
				
				$.ajax({
						data:  
							{
								"agregarItem" : $('.formulario').serialize()
							},
						url:   urlbase+'script/ajax.php',
						type:  'post',
						success:  function (response) {
							if(response=="Exito")
							{
								window.location=urlbase+"administracion/Repertorio/item";
							}
							else
							{
								alerta(response);
							}
						}
				});
			}
			else
			{
				alert("Ya existe el permiso registrado");
			}
		}
		});
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}
function eliminarItem(id, nombre)
{
	if(confirm('Desea eliminar el item'+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarItem" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function recuperarContrasena()
{
	var mensaje="";
	var elements = ["Rut", "Email", "Captcha"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(!comprobadorEmail("Email"))
	{
		mensaje="error con el Email";
	}
	if(mensaje=="")
	{
		$.ajax({
			data:  
				{
					"recuperarContrasena" : $('.formulario').serialize()
				},
			url:   urlbase+'script/ajax.php',
			type:  'post',
			success:  function (response) {
				if(response=="Exito")
				{
					$('#contenido').html('<form class="formulario" onsubmit="return modificarContrasena()" method="post"><p>Se envio un correo su email e ingrese el codigo o acceda al enlace enviado</p><div><label>Ingrese el Codigo</label><input type="text" required x-moz-errormessage="Debe ingresar el codigo" id="txtCode" name="txtCode"><img src="'+urlbase+'imagenes/none.png" id="imgCode"></div><div><label>Nueva Contraseña:</label><input required x-moz-errormessage="Ingrese una contraseña" type="password" maxlength="255"  id="txtNewPassword" name="txtNewPassword"><img src="'+urlbase+'imagenes/none.png" id="imgNewPassword"></div><div><label>Nueva RE-Contraseña:</label><input required x-moz-errormessage="Ingrese nuevamente la contraseña" maxlength="255"  type="password" id="txtNewRePassword" name="txtNewRePassword"><img src="'+urlbase+'imagenes/none.png" id="imgNewRePassword"></div><div><img title="Captcha" src="<?php echo WEB_BASE; ?>script/captcha/captcha.php" id="captcha" /></div><div><label>Captcha:</label><input required x-moz-errormessage="Ingrese el texto de la imagen." type="text" maxlength="255"  size="16" id="txtCaptcha"  name="captcha" title="Ingrese el texto de la imagen." placeholder="Ingrese el texto de la imagen." /><img src="'+urlbase+'imagenes/none.png" id="imgCaptcha"></div><div><input type="submit" value="Cambiar"></div></form>');
				}
				else
				{
					alerta(response);
					d = new Date();
					$('#captcha').attr("src", urlbase+"script/captcha/captcha.php?"+d.getTime());
				}
			}
		});
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}
function finalizarContacto(id)
{
	if(confirm('Desea finalizar este contrato?'))
	{
		$.ajax({
                data:  {"finalizarContacto" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function verContacto(id)
{
	$('#frmModificar').attr("action",urlbase+"administracion/contratos/detalle");
	modificar(id);
}
function calificarContacto(id)
{
	$('#frmModificar').attr("action",urlbase+"administracion/contratos/calificar");
	modificar(id);
}
function calificarCon()
{
	if(confirm('Termino de calificar los servicios?'))
	{
		$.ajax({
                data:  {"calificarContrato" : $('.formulario').serialize()},
                url:   urlbase+'script/ajax.php',
                type:  'post',
				async: false,
                success:  function (response) {
                    if(response=="Exito")
					{
						window.location=urlbase+"administracion/contratos";
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
	return false;
}
function borrarContacto(id)
{
	if(confirm('Desea borrar este contrato?'))
	{
		$.ajax({
                data:  {"borrarContacto" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function eliminarContacto(id)
{
	if(confirm('Desea borrar este contrato?'))
	{
		$.ajax({
                data:  {"eliminarContacto" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}

//formulario de compra de dias subscripcion
function cambiarPlan(valor, nombre)
{
	document.getElementById('amount').value=parseInt(valor);
	document.getElementById('item_id').value=parseInt(valor);
	document.getElementById('setupFee').value=Math.round(parseInt(valor)*0.19);
}

//formulario web config
function modificarConfiguracion()
{
	var mensaje="";
	var elements = ["Pagina", "Url", "Login", "Servicio", "Usuario", "Empresa", "Max", "Min", "Captcha"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		if(confirm('Desea cambiar la configuracion?'))
		{
			
			$.ajax({
					data:  {"modificarConfiguracion" : $('.formulario').serialize()},
					url:   urlbase+'script/ajax.php',
					type:  'post',
					success:  function (response) {
						if(response=="Exito")
						{
							location.reload();
						}
						else
						{
							alerta(response);
							d = new Date();
							$('#captcha').attr("src", urlbase+"script/captcha/captcha.php?"+d.getTime());
						}
					}
			});
		}
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
	
}
function agregarPlan()
{
	var mensaje="";
	var elements = ["Nombre", "Valor", "Dias", "Estado"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
			data:  
				{
					"agregarPlan" : $('.formulario').serialize()
				},
			url:   urlbase+'script/ajax.php',
			type:  'post',
			success:  function (response) {
				if(response=="Exito")
				{
					window.location=urlbase+"administracion/subscriptores/planes";
				}
				else
				{
					alerta(response);
				}
			}
		});
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}
function agregarBoleta()
{
	var mensaje="";
	var elements = ["Empresa", "Monto", "Estado", "Plan"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(document.getElementById('txtFecha'))
	{
		if(!comprobadorFecha('Fecha'))
		{
			mensaje="error con la fecha";
		}
	}
	if(mensaje=="")
	{
		$.ajax({
			data:  
				{
					"agregarBoleta" : $('.formulario').serialize()
				},
			url:   urlbase+'script/ajax.php',
			type:  'post',
			success:  function (response) {
				if(response=="Exito")
				{
					window.location=urlbase+"administracion/subscriptores/boletas";
				}
				else
				{
					alerta(response);
				}
			}
		});
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}
function agregarBoletas()
{
	var mensaje="";
	$.ajax({
			data:  
				{
					"agregarBoleta" : $('.formulario').serialize()
				},
			url:   urlbase+'script/ajax.php',
			async: false,
			type:  'post',
			success:  function (response) {
				$('#merchant_transaction_id').val(response);
				alerta(response);
				//alert(response);
			}
		});
		//alert(mensaje);
		if(mensaje!="")
		{
			return true;
		}
	return false;
}
function modificarPlan()
{
	var mensaje="";
	var elements = ["Code", "Nombre", "Valor", "Dias", "Estado"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
			data:  
				{
					"modificarPlan" : $('.formulario').serialize()
				},
			url:   urlbase+'script/ajax.php',
			type:  'post',
			success:  function (response) {
				if(response=="Exito")
				{
					window.location=urlbase+"administracion/subscriptores/planes";
				}
				else
				{
					alerta(response);
				}
			}
		});
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}
function modificarBoleta()
{
	var mensaje="";
	var elements = ["Code", "Empresa", "Monto", "Estado", "Plan"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
			data:  
				{
					"modificarBoleta" : $('.formulario').serialize()
				},
			url:   urlbase+'script/ajax.php',
			type:  'post',
			success:  function (response) {
				if(response=="Exito")
				{
					window.location=urlbase+"administracion/subscriptores/boletas";
				}
				else
				{
					alerta(response);
				}
			}
		});
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}
function ocultarMedia()
{
	$('#txtUrl').val('');
	$('#txtUrl1').val('');
	$('#txtUrl2').val('');
	$('#txtUrl3').val('');
	$('#url1').hide();
	$('#url2').hide();
	$('#url3').hide();
}
function cambiarMedia()
{
	ocultarMedia();
	var tm=$('#txtTipoMultimedia').val();
	switch(parseInt(tm))
	{
		case 1:
			//audio
			//alert("case audio");
			$('#lblUrl1').html('Enlace Audio mp3');
			$('#lblUrl2').html('Enlace Audio ogg');
			$('#lblUrl3').html('Enlace Audio wav');
			$('#url1').show();
			$('#url2').show();
			$('#url3').show();
			break;
		case 2:
			//video
			//lert("case video");
			$('#lblUrl1').html('Enlace video MP4');
			$('#lblUrl2').html('Enlace video Ogg/Vorbis');
			$('#lblUrl3').html('Enlace video WebM');
			$('#url1').show();
			$('#url2').show();
			$('#url3').show();
			break;
		case 3:
			//imagen
			$('#lblUrl1').html('Enlace');
			$('#url1').show();
			break;
		case 4:
			//pdf
			$('#lblUrl1').html('Enlace');
			$('#url1').show();
			break;
		case 5:
			//youtube
			$('#lblUrl1').html('Enlace');
			$('#url1').show();
			break;
		default:
			//otro
			$('#lblUrl1').html('Codigo o enlace');
			$('#url1').show();
			break;
	}
}
function actualizarMedia()
{
	$('#txtUrl').val($('#txtUrl1').val()+";"+$('#txtUrl2').val()+";"+$('#txtUrl3').val());
}
function enviarCorreo()
{
	var mensaje="";
	var elements = ["Nombre", "Email", "Mensaje", "Captcha"];
	for (i = 0; i < elements.length; i++)
	{
		if(!comprobador(elements[i]))
		{
			mensaje="error con el "+elements[i];
		}
	}
	if(mensaje=="")
	{
		$.ajax({
			data:  
				{
					"enviarCorreo" : $('.formulario').serialize()
				},
			url:   urlbase+'script/ajax.php',
			type:  'post',
			success:  function (response) {
				if(response=="Exito")
				{
					$('#contenido').html('<h1 class="titulo2">Mensaje enviado satisfactoriamente</h1><p>Sera respondido a la brevedad.</p>');
				}
				else
				{
					alerta(response);
					d = new Date();
					$('#captcha').attr("src", urlbase+"script/captcha/captcha.php?"+d.getTime());
				}
			}
		});
	}
	else
	{
		alerta("Revise el formulario, "+mensaje);
	}
	return false;
}
function eliminarPlan(id, nombre)
{
	if(confirm('Desea eliminar el plan '+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarPlan" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}
function eliminarBoleta(id, nombre)
{
	if(confirm('Desea eliminar la boleta de codigo #'+nombre+'?'))
	{
		$.ajax({
                data:  {"eliminarBoleta" : id},
                url:   urlbase+'script/ajax.php',
                type:  'post',
                success:  function (response) {
                    if(response=="Exito")
					{
						location.reload();
					}
					else
					{
						alerta(response);
					}
                }
        });
	}
}