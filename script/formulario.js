var urlbase="http://127.0.0.1/";
var serviciosComparados="";
var chat="";
var actualizarChat;//actualiza los chats abierto cada 10 segundos preguntando si hay mas
var actualizarCotnratos;//actualiza la alerta de mensajes de todos lso contratos cada hora
var intervaloTiempo=[5,10];
var intervaloChat=new Array();

//funciones del diseño
function desplegarContratos()
{
    if ($("#divContratos").hasClass('activo')){
		//actualizarChat=setInterval(actualizarChat(), 10000);
        document.getElementById("divContratos").className="inactivo";
		//console.log("header era: activo");
    }else{
        document.getElementById("divContratos").className="activo";
		//console.log("header era: inactivo");
    }
}
function abrirChat(id,nombre)
{
	/*if (!document.getElementById('divMensajes'+id))
	{
		document.getElementById("divChat").innerHTML += 
			'<div id="divMensajes'+id+'" class="activo"><div class="cabecera"><label onclick="minimizarChat(\'divMensajes'+
			id+'\')">nombre de usuario </label><img onclick="cerrarChat(divMensajes'+id
			+')" src="'+urlbase+'imagenes/UI/incorrecto.png"></div><div class="historial"><p class="a">primer mensaje</p><p class="b">segundo mensaje</p><p class="a">tercer mensaje</p><p class="a">cuarto mensaje</p><p class="b">quinto mensaje</p></div><div class="escribir"><input type="text"></div></div>';
	}*/
	//revisar localstorage y cargar chat si lo tiene
	if (!document.getElementById('divMensajes'+id))
	{
		document.getElementById("divChat").innerHTML +='<div id="divMensajes'+id+'" class="activo"><div class="cabecera"><label onclick="minimizarChat(\'divMensajes'+id+'\')">'+nombre+'</label><img onclick="cerrarChat(divMensajes'+id+')" src="'+urlbase+'imagenes/UI/incorrecto.png"></div><div class="historial" id="historial'+id+'"></div><div class="escribir"><input type="text"></div></div>';
		document.getElementById("historial"+id).innerHTML = "Cargando...";
		/*if (typeof(Storage) != "undefined") 
		{
			var chat = JSON.parse(localStorage.getItem("Comparacion"));
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
							$('#error').html(response);
						}
					}
				});
			}
		}
		else 
		{
			console.log("Sorry, your browser does not support Web Storage...");
			alert("Sorry, your browser does not support Web Storage...");
		}*/
		if (typeof(Storage) != "undefined") 
		{
			var chat = JSON.parse(localStorage.getItem("chat"));
			if(chat===null)
			{
				chat=[];
			}
			if(chat.indexOf(id)<0)
			{
				chat[chat.length]=id;
				localStorage.setItem("chat", JSON.stringify(chat));
			}
		}
		else 
		{
			console.log("Sorry, your browser does not support Web Storage...");
			alert("Sorry, your browser does not support Web Storage...");
		}
		$.ajax({
			data:  {"abrirChat" : id},
			url:   urlbase+'script/ajax.php',
			type:  'post',
			success:  function (response) {
				var mensaje = $.parseJSON(response);
				document.getElementById("historial"+id).innerHTML = mensaje[id];
			}
        });
	}
}
function actualizarChat()
{
	console.log("Actualizando Chat:");
	var lista=document.getElementById("divChat");
	var chatActivos = new Array;
	for(var i=0;i<lista.childNodes.length;i++)
	{
		var idChat = lista.childNodes[i].id;
		console.log(idChat.substring(11));
		chatActivos[chatActivos.length][0]=idChat.substring(11);
		var listab = document.getElementById(idChat).childNodes;
		console.log(listab.childNodes[listab.childNodes.length].id.substring(3));
		chatActivos[chatActivos.length][1]=listab.childNodes[listab.childNodes.length].id.substring(3);
	}
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
function escribirChat(id)
{
	/*if (!document.getElementById('divMensajes'+id))
	{
		document.getElementById("divChat").innerHTML += 
			'<div id="divMensajes'+id+'" class="activo"><div class="cabecera"><label onclick="minimizarChat(\'divMensajes'+
			id+'\')">nombre de usuario </label><img onclick="cerrarChat(divMensajes'+id
			+')" src="'+urlbase+'imagenes/UI/incorrecto.png"></div><div class="historial"><p class="a">primer mensaje</p><p class="b">segundo mensaje</p><p class="a">tercer mensaje</p><p class="a">cuarto mensaje</p><p class="b">quinto mensaje</p></div><div class="escribir"><input type="text"></div></div>';
	}*/
	//revisar localstorage y cargar chat si lo tiene
	if (!document.getElementById('divMensajes'+id))
	{
		document.getElementById("divChat").innerHTML +='<div id="divMensajes'+id+'" class="activo"><div class="cabecera"><label onclick="minimizarChat(\'divMensajes'+id+'\')">'+nombre+'</label><img onclick="cerrarChat(divMensajes'+id+')" src="'+urlbase+'imagenes/UI/incorrecto.png"></div><div id="historial'+id+'"></div><div class="escribir"><input type="text"></div></div>';
		document.getElementById("historial"+id).innerHTML = "Cargando...";
		/*if (typeof(Storage) != "undefined") 
		{
			var chat = JSON.parse(localStorage.getItem("Comparacion"));
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
							$('#error').html(response);
						}
					}
				});
			}
		}
		else 
		{
			console.log("Sorry, your browser does not support Web Storage...");
			alert("Sorry, your browser does not support Web Storage...");
		}*/
		$.ajax({
			data:  {"id_con" : id},
			url:   urlbase+'script/ajax.php',
			type:  'post',
			success:  function (response) {
				$('#historial'+id).html(response);
				console.log(response);
			}
        });
	}
}
function minimizarChat(id)
{
	console.log("minimizarChat("+id+") : ");
	if ($('#'+id).hasClass('activo')){
        document.getElementById(id).className="inactivo";
		//console.log("inactivo");
    }else{
        document.getElementById(id).className="activo";
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
/*function desplegarFooter()
{
	if(footer==true)
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
}*/
//funciones del sitio
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
						$('#error').html(response);
					}
				}
			});
		}
	}
	else
	{
		$('#error').html("ha ocurrido un error inesperado, recargue la pagina");
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
						$('#error').html(response);
					}
				}
			});
		}
	}
	else
	{
		$('#error').html("ha ocurrido un error inesperado, recargue la pagina");
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
			$('#error').html('Error:'+elements[i]);
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
						//$('#error').html(response);
					}
					else
					{
						mensaje="Revise el formulario, "+response;
						$('#error').html(response);
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
		//$('#error').html("Revise el formulario, "+mensaje);
		$('#error').html(mensaje);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
						d = new Date();
						$('#captcha').attr("src", urlbase+"script/captcha/captcha.php?"+d.getTime());
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html('Revise el formulario');
	}
	return false;
}

function comprobador(element)
{
	if(document.getElementById( 'txt'+element))
	{
		if($('#txt'+element).val().length>0 && $('#txt'+element).val().length<255 && document.getElementById( 'txt'+element).value.indexOf("_-_")<0)
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
					$('#error').html(response);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
	}
	return false;
}

function agregarServicio()
{
	var mensaje="";
	var elements = ["Nombre", "Categoria", "Subcategoria", "TipoServicio", "Descripcion"];
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
						"agregarServicio" : $('.formulario').serialize()
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
					$('#error').html(response);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
								$('#error').html(response);
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
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
							$('#error').html(response);
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
							$('#error').html(response);
						}
					}
			});
		}
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
			$('#error').html("error:"+elements[i]);
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
						$('#error').html(response);
						d = new Date();
						$('#captcha').attr("src", urlbase+"script/captcha/captcha.php?"+d.getTime());
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
						d = new Date();
						$('#captcha').attr("src", urlbase+"script/captcha/captcha.php?"+d.getTime());
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
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
		$('#error').html("Revise el formulario, "+mensaje);
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
		$('#error').html("El bloque no existe");
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
		$('#error').html("El bloque no existe");
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
		$('#error').html("El bloque no existe");
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
			$('#error').html("No tienes ningun articulo en la canasta...");
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
			$('#error').html("No tienes ningun articulo en la canasta...");
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
								$('#error').html(response);
							}
						}
				});
			}
			else
			{
				$('#error').html("Debes ingresar el texto de la imagen");
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
						$('#error').html(response);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	} 
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	} 
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	} 
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	} 
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	} 
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
					}
                }
        });
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
								$('#error').html(response);
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
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
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
						$('#error').html(response);
					}
                }
        });
	} 
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
					}
                }
        });
	} 
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
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
								$('#error').html(response);
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
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
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
					$('#error').html(response);
					d = new Date();
					$('#captcha').attr("src", urlbase+"script/captcha/captcha.php?"+d.getTime());
				}
			}
		});
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
						$('#error').html(response);
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
							$('#error').html(response);
							d = new Date();
							$('#captcha').attr("src", urlbase+"script/captcha/captcha.php?"+d.getTime());
						}
					}
			});
		}
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
					$('#error').html(response);
				}
			}
		});
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
					$('#error').html(response);
				}
			}
		});
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
				$('#error').html(response);
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
					$('#error').html(response);
				}
			}
		});
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
					$('#error').html(response);
				}
			}
		});
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
function verMenu()
{
	if($('#menu1').css('display')=='none')
	{
		$('#menu1').css('display', 'inline');
		$('#menu2').css('display', 'none');
		$('#contenido').css('display', 'inline');
	}
	else
	{
		$('#menu1').css('display', 'none');
		$('#menu2').css('display', 'inline');
		$('#contenido').css('display', 'none');
	}
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
					$('#error').html(response);
					d = new Date();
					$('#captcha').attr("src", urlbase+"script/captcha/captcha.php?"+d.getTime());
				}
			}
		});
	}
	else
	{
		$('#error').html("Revise el formulario, "+mensaje);
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
						$('#error').html(response);
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
						$('#error').html(response);
					}
                }
        });
	}
}