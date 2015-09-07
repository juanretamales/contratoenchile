<?php
require_once "db.php";
require_once "dbConfig.php";
class transaccion
{
	public function conectar()
    {
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if($mysqli->connect_errno > 0){   
			die("Imposible conectarse con la base de datos [" . $mysqli->connect_error . "]");   
		}
		return $mysqli;
	}
	function consultar($query,$fetch_assoc=true, $afected=false)
	{
		require_once('db.php');
		$db=new db();
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		if($afected==true)
		{
			$resultado=$mysqli->affected_rows;
		}
		if($fetch_assoc==true)
		{
			$resultado=$resultado -> fetch_assoc();
		}
		$mysqli->close();
		return $resultado;
	}
	
	function listarBoleta($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_bol`, `id_est`, `id_ent`, `fecha_bol`, `monto`, `id_plan`  FROM `boleta`";
		$condicion=0;
		if(isset($arg['id_bol']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query." id_bol='".$arg['id_bol']."'";
			
		}
		if(isset($arg['id_est']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query." id_est='".$arg['id_est']."'";
			
		}
		if(isset($arg['id_ent']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query." id_ent='".$arg['id_ent']."'";
			
		}
		if(isset($arg['fecha_bol']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query." fecha_bol='".$arg['fecha_bol']."'";
			
		}if(isset($arg['monto']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query." monto='".$arg['monto']."'";
			
		}
		if(isset($arg['id_plan']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query." id_plan='".$arg['id_plan']."'";
			
		}
		if(isset($arg['order_by']))
		{
			$query = $query." order by `".$arg['order_by']."`";
		}
		else
		{
			$query = $query." order by `id_bol`";
		}
		$listar= array();
		$mysqli=$this->conectar();
		//echo $query;
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_bol'=>$fila['id_bol'], 
				'id_est'=>$fila['id_est'],
				'id_ent'=>$fila['id_ent'],
				'fecha_bol'=>$fila['fecha_bol'],
				'monto'=>$fila['monto'],
				'id_plan'=>$fila['id_plan']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarCalificacionclie($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_calc`, `id_con`, `id_tc`, `id_ec` FROM `calificacionclie`";
		$condicion=0;
		if(isset($arg['id_calc']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query.' id_calc='.$arg['id_calc'];
			
		}
		if(isset($arg['id_con']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query.' id_con='.$arg['id_con'];
		}
		if(isset($arg['id_tc']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query.' id_tc='.$arg['id_tc'];
		}
		if(isset($arg['id_ec']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query.' id_ec='.$arg['id_ec'];
		}
		if(isset($arg['order_by']))
		{
			$query = $query." order by `".$arg['order_by']."`";
		}
		else
		{
			$query = $query." order by `id_calc`";
		}
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_calc'=>$fila['id_calc'], 
				'id_con'=>$fila['id_con'],
				'id_tc'=>$fila['id_tc'],
				'id_ec'=>$fila['id_ec']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarCalificacionserv($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_cals`, `id_con`, `id_serv`, `id_tc`, `id_ec` FROM `calificacionserv`";
		$condicion=0;
		if(isset($arg['id_cals']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query.' id_cals='.$arg['id_cals'];
		}
		if(isset($arg['id_con']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query.' id_con='.$arg['id_con'];
		}
		if(isset($arg['id_serv']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query.' id_serv='.$arg['id_serv'];
		}
		if(isset($arg['id_tc']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query.' id_tc='.$arg['id_tc'];
			$condicion++;
		}
		if(isset($arg['id_ec']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query.' id_ec='.$arg['id_ec'];
			$condicion++;
		}
		if(isset($arg['order_by']))
		{
			$query = $query." order by `".$arg['order_by']."`";
		}
		else
		{
			$query = $query." order by `id_cals`";
		}
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_cals'=>$fila['id_cals'], 
				'id_con'=>$fila['id_con'],
				'id_serv'=>$fila['id_serv'],
				'id_tc'=>$fila['id_tc'],
				'id_ec'=>$fila['id_ec']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarPromedioCalificacionserv($arg)
	{
		require_once('db.php');
		$db=new db();
		$condicion=0;
		$query = "SELECT id_serv, tc.`desc_tc`, ec.`nom_ec`, TRUNCATE(AVG(valor),0) AS valor FROM calificacionserv cs, escalacal ec, tipocal tc WHERE ec.id_ec=cs.id_ec AND cs.`id_tc`=tc.`id_tc`";
		if(isset($arg['id_con']))
		{
			$query = $query.'and cs.id_con='.$arg['id_con'];
		}
		if(isset($arg['id_serv']))
		{
			
			$query = $query.'and cs.id_serv='.$arg['id_serv'];
		}
		$query = $query." GROUP BY tc.`id_tc`, cs.`id_serv` ORDER BY id_serv";
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_serv'=>$fila['id_serv'],
				'desc_tc'=>$fila['desc_tc'],
				'nom_ec'=>$fila['nom_ec'],
				'valor'=>$fila['valor']
			);
		}
		$mysqli->close();
		return $listar;
	}

	function listarCategorias($arg)
	{
		require_once('db.php');
		$db=new db();
		$condicion=0;
		$query = "SELECT `id_cat`, `nom_cat` FROM `categoria`";
		if(isset($arg['id_cat']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query." id_cat='".$arg['id_cat']."'";
		}
		if(isset($arg['nom_cat']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query." nom_cat='".$arg['nom_cat']."'";
		}
		if(isset($arg['order_by']))
		{
			$query = $query." order by `".$arg['order_by']."`";
		}
		else
		{
			$query = $query." order by `nom_cat`";
		}
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array ('id_cat'=>$fila['id_cat'], 'nom_cat'=>$fila['nom_cat']);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarCss($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_css`, `id_tcss`, `codigo` FROM `css`";
		$condicion=0;
		if(isset($arg['id_css']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. ' id_css='.$arg['id_css'];
		}
		if(isset($arg['id_tcss']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. ' id_tcss='.$arg['id_tcss'];
		}
		if(isset($arg['codigo']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. ' codigo='.$arg['codigo'];
		}
		$query = $query." order by `id_css`";
		//echo $query;
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_css'=>$fila['id_css'], 
				'id_tcss'=>$fila['id_tcss'],
				'codigo'=>$fila['codigo']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarCobertura($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_serv`, `id_com` FROM `cobertura`";
		$condicion=0;
		if(isset($arg['id_serv']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' id_serv='.$arg['id_serv'];
			$condicion++;
		}
		if(isset($arg['id_com']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' id_com='.$arg['id_com'];
			$condicion++;
		}
		$query = $query." order by `id_calc`";
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_calc'=>$fila['id_calc'], 
				'id_con'=>$fila['id_con'],
				'id_tc'=>$fila['id_tc'],
				'id_ec'=>$fila['id_ec']
			);
		}
		$mysqli->close();
		return $listar;
	}
	function listarCodigo($arg)
	{
		$query="SELECT `id_cod`,`id_tcod`,`id_ent`,`nom_cod`,`codigo`,`id_fc` FROM `codigo`";
		$condicion=0;
		if(isset($arg['id_cod']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. ' `id_cod`='.$arg['id_cod'];
		}
		if(isset($arg['id_tcod']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. ' `id_tcod`='.$arg['id_tcod'];
		}
		$query = $query." order by `id_cod` DESC";
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_cod'=>$fila['id_cod'], 
				'nom_tcod'=>$fila['nom_tcod'],
				'sigla'=>$fila['sigla'],
				'nom_ent'=>$fila['nom_ent'],
				'funcion'=>$fila['funcion']
			);
		}
		$mysqli->close();
		return $listar;
	}
	function listarCodigoDetalle($arg)
	{
		$query="SELECT c.`id_cod` AS id_cod, tc.`nom_tcod` AS nom_tcod, tc.sigla AS sigla, e.`nom_ent` AS nom_ent, funcodigo.`nom_fc` AS funcion FROM codigo c LEFT JOIN tipocod tc ON c.`id_tcod`=tc.`id_tcod` LEFT JOIN entidad e ON e.`id_ent`=c.`id_ent` LEFT JOIN funcodigo ON c.`id_fc`=funcodigo.`id_fc`";
		$condicion=0;
		if(isset($arg['id_cod']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. ' c.`id_cod`='.$arg['id_cod'];
		}
		if(isset($arg['id_tcod']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. ' c.`id_tcod`='.$arg['id_tcod'];
		}
		$query = $query." order by `id_cod` DESC";
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_cod'=>$fila['id_cod'], 
				'nom_tcod'=>$fila['nom_tcod'],
				'sigla'=>$fila['sigla'],
				'nom_ent'=>$fila['nom_ent'],
				'funcion'=>$fila['funcion']
			);
		}
		$mysqli->close();
		return $listar;
	}
	function listarCodigoSolo($arg)
	{
		$query="SELECT `codigo` FROM `codigo`";
		$condicion=0;
		if(isset($arg['id_cod']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. ' c.`id_cod`='.$arg['id_cod'];
		}
		if(isset($arg['id_tcod']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. ' c.`id_tcod`='.$arg['id_tcod'];
		}
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_cod'=>$fila['id_cod'], 
				'nom_tcod'=>$fila['nom_tcod'],
				'sigla'=>$fila['sigla'],
				'nom_ent'=>$fila['nom_ent'],
				'funcion'=>$fila['funcion']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarComuna($arg)
	{
		require_once('db.php');
		$db=new db();
		$condicion=0;
		$query = "SELECT `id_com`, `nom_com`, `id_prov` FROM `comuna`";
		if(isset($arg['id_com']))
		{
			$query = $query. ' where id_com='.$arg['id_com'];
		}
		if(isset($arg['id_prov']))
		{
			if(isset($arg['id_com']))
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' id_prov='.$arg['id_prov'];
		}
		$query = $query. " order by `nom_com`";
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_com'=>$fila['id_com'], 
				'nom_com'=>$fila['nom_com'],
				'id_prov'=>$fila['id_prov']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarContacto($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_con`, `rut`, `id_est`, `fecha_con` FROM `contacto`";
		$condicion=0;
		if(isset($arg['id_con']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' id_con='.$arg['id_con'];
			$condicion++;
		}
		if(isset($arg['rut']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' rut='.$arg['rut'];
			$condicion++;
		}
		if(isset($arg['id_est']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' id_est='.$arg['id_est'];
			$condicion++;
		}
		if(isset($arg['fecha_con']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' fecha_con='.$arg['fecha_con'];
			$condicion++;
		}
		$query = $query. " order by `id_con`";
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_con'=>$fila['id_con'], 
				'rut'=>$fila['rut'],
				'id_est'=>$fila['id_est'],
				'fecha_con'=>$fila['fecha_con']
			);
		}
		$mysqli->close();
		return $listar;
	}
	function listarResumenContacto($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT COUNT(DISTINCT c.`id_con`) AS Cantidad, c.`id_est` as Estado, MONTH(c.`fecha_con`) Mes FROM contacto c, servcon sc, servicio s, entidad e WHERE sc.`id_con`=c.`id_con` AND sc.`id_serv`=s.`id_serv` AND s.`id_ent`=e.`id_ent`";
		if(isset($arg['id_ent']))
		{
			$query = $query. 'and e.id_ent='.$arg['id_ent'];
		}
		if(isset($arg['fecha']))
		{
			$query = $query. ' AND (MONTH(c.`fecha_con`)>(MONTH(c.`fecha_con`)-'.$arg['fecha'].'))';
		}
		if(isset($arg['year']))
		{
			$query = $query. ' AND YEAR(CURDATE())='.$arg['year'].'))';
		}
		else
		{
			$query = $query. ' AND YEAR(CURDATE())=YEAR(c.`fecha_con`)';
		}
		$query = $query. " GROUP BY c.`id_est` ORDER BY Mes";
		//print_r($query);
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'cantidad'=>$fila['Cantidad'], 
				'estado'=>$fila['Estado'],
				'mes'=>$fila['Mes'],
			);
		}
		$mysqli->close();
		return $listar;
	}
	function listarDocumento($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_doc`, `id_ent`, `id_td`, `nom_doc`, `url_doc` FROM `documento`";
		$condicion=0;
		if(isset($arg['id_doc']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' id_doc='.$arg['id_doc'];
			$condicion++;
		}
		if(isset($arg['id_ent']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' id_ent='.$arg['id_ent'];
			$condicion++;
		}
		if(isset($arg['id_td']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' id_td='.$arg['id_td'];
			$condicion++;
		}
		if(isset($arg['nom_doc']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' nom_doc='.$arg['nom_doc'];
			$condicion++;
		}
		if(isset($arg['url_doc']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' url_doc='.$arg['url_doc'];
			$condicion++;
		}
		$query = $query. " order by `id_doc`";
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_doc'=>$fila['id_doc'], 
				'id_ent'=>$fila['id_ent'],
				'id_td'=>$fila['id_td'],
				'nom_doc'=>$fila['nom_doc'],
				'url_doc'=>$fila['url_doc']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarEntidad($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_ent`, `id_est`, `subscripcion`, `rut_sii`, `nom_ent`, `sitio`, 
		 `desc_ent`, `email_ent`, `tel_ent`, `auth_key` FROM `entidad`";
		$condicion=0;
		if(isset($arg['id_ent']))
		{
			if($condicion!=0)
			{
				$query = $query . " and";
			}
			else
			{
				$query = $query . " where ";
				$condicion++;
			}
			$query = $query. " id_ent='".$arg['id_ent']."'";
		}
		if(isset($arg['id_est']))
		{
			if($condicion!=0)
			{
				$query = $query . " and";
			}
			else
			{
				$query = $query . " where ";
				$condicion++;
			}
			$query = $query. " id_est='".$arg['id_est']."'";
		}
		if(isset($arg['subscripcion']))
		{
			if($condicion!=0)
			{
				$query = $query . " and";
			}
			else
			{
				$query = $query . " where ";
				$condicion++;
			}
			$query = $query. " subscripcion='".$arg['subscripcion']."'";
		}
		if(isset($arg['rut_sii']))
		{
			if($condicion!=0)
			{
				$query = $query . " and";
			}
			else
			{
				$query = $query . " where ";
				$condicion++;
			}
			$query = $query. " rut_sii='".$arg['rut_sii']."'";
		}
		if(isset($arg['nom_ent']))
		{
			if($condicion!=0)
			{
				$query = $query . " and";
			}
			else
			{
				$query = $query . " where ";
				$condicion++;
			}
			$query = $query. " nom_ent='".$arg['nom_ent']."'";
		}
		if(isset($arg['sitio']))
		{
			if($condicion!=0)
			{
				$query = $query . " and";
			}
			else
			{
				$query = $query . " where ";
				$condicion++;
			}
			$query = $query. " sitio='".$arg['sitio']."'";
		}
		if(isset($arg['seo_ent']))
		{
			if($condicion!=0)
			{
				$query = $query . " and";
			}
			else
			{
				$query = $query . " where ";
				$condicion++;
			}
			$query = $query. " seo_ent='".$arg['seo_ent']."'";
		}
		if(isset($arg['desc_ent']))
		{
			if($condicion!=0)
			{
				$query = $query . " and";
			}
			else
			{
				$query = $query . " where ";
				$condicion++;
			}
			$query = $query. " desc_ent='".$arg['desc_ent']."'";
		}
		if(isset($arg['email_ent']))
		{
			if($condicion!=0)
			{
				$query = $query . " and";
			}
			else
			{
				$query = $query . " where ";
				$condicion++;
			}
			$query = $query. " email_ent='".$arg['email_ent']."'";
		}
		if(isset($arg['tel_ent']))
		{
			if($condicion!=0)
			{
				$query = $query . " and";
			}
			else
			{
				$query = $query . " where ";
				$condicion++;
			}
			$query = $query. " tel_ent='".$arg['tel_ent']."'";
		}
		if(isset($arg['auth_key']))
		{
			if($condicion!=0)
			{
				$query = $query . " and";
			}
			else
			{
				$query = $query . " where ";
				$condicion++;
			}
			$query = $query. " auth_key='".$arg['auth_key']."'";
		}
		if(isset($arg['banner']))
		{
			if($condicion!=0)
			{
				$query = $query . " and";
			}
			else
			{
				$query = $query . " where ";
				$condicion++;
			}
			$query = $query. " banner='".$arg['banner']."'";
		}
		if(isset($arg['cssmenu']))
		{
			if($condicion!=0)
			{
				$query = $query . " and";
			}
			else
			{
				$query = $query . " where ";
				$condicion++;
			}
			$query = $query. " cssmenu='".$arg['cssmenu']."'";
		}
		if(isset($arg['where']))
		{
			if($condicion!=0)
			{
				$query = $query . " and";
			}
			else
			{
				$query = $query . " where ";
				$condicion++;
			}
			$query = $query.$arg['where'];
		}
		if(isset($arg['order']))
		{
			$query = $query. " order by '".$arg['order']."'";
		}
		else
		{
			$query = $query." order by id_ent";
		}
		if(isset($arg['limit']))
		{
			$query = $query. " limit '".$arg['limit']."'";
		}
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_ent'=>$fila['id_ent'], 
				'id_est'=>$fila['id_est'], 
				'subscripcion'=>$fila['subscripcion'], 
				'rut_sii'=>$fila['rut_sii'], 
				'nom_ent'=>$fila['nom_ent'], 
				'sitio'=>$fila['sitio'], 
				'desc_ent'=>$fila['desc_ent'], 
				'email_ent'=>$fila['email_ent'], 
				'tel_ent'=>$fila['tel_ent'], 
				'auth_key'=>$fila['auth_key']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarEscalacal($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_ec`, `nom_ec`, `valor` FROM `escalacal`";
		$condicion=0;
		if(isset($arg['id_ec']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' id_ec='.$arg['id_ec'];
			$condicion++;
		}
		if(isset($arg['nom_ec']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' nom_ec='.$arg['nom_ec'];
			$condicion++;
		}
		if(isset($arg['valor']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' valor='.$arg['valor'];
			$condicion++;
		}
		$query = $query. " order by `id_ec`";
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_ec'=>$fila['id_ec'], 
				'nom_ec'=>$fila['nom_ec'],
				'valor'=>$fila['valor']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarEstado($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_est`, `nom_est` FROM `estado`";
		$condicion=0;
		if(isset($arg['id_est']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' id_est='.$arg['id_est'];
			$condicion++;
		}
		if(isset($arg['nom_est']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' nom_est='.$arg['nom_est'];
			$condicion++;
		}
		if(isset($arg['nom_est']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' nom_est='.$arg['nom_est'];
			$condicion++;
		}
		$query = $query. " order by `id_est`";
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_est'=>$fila['id_est'], 
				'nom_est'=>$fila['nom_est'],
				'nom_est'=>$fila['nom_est']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarItem($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_menu`, `id_pag` FROM `item`";
		$condicion=0;
		if(isset($arg['id_menu']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " id_menu='".$arg['id_menu']."'";
		}
		if(isset($arg['id_pag']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " id_pag='".$arg['id_pag']."'";
		}
		$query = $query. " order by `id_menu`";
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_menu'=>$fila['id_menu'], 
				'id_pag'=>$fila['id_pag']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarMedia($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_med`, `id_tm`, `id_ent`, `nom_med`, `url_med` FROM `media`";
		$condicion=0;
		if(isset($arg['id_med']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' id_med='.$arg['id_med'];
			$condicion++;
		}
		if(isset($arg['id_tm']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' id_tm='.$arg['id_tm'];
			$condicion++;
		}
		if(isset($arg['id_ent']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' id_ent='.$arg['id_ent'];
			$condicion++;
		}
		$query = $query. " order by `id_med`";
		$listar= array();
		//echo $query;
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_med'=>$fila['id_med'], 
				'id_tm'=>$fila['id_tm'],
				'id_ent'=>$fila['id_ent'],
				'nom_med'=>$fila['nom_med'],
				'url_med'=>$fila['url_med']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarMensajes($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_men`, `id_con`, `fecha_men`, `emisor`, `mensaje` FROM `mensajes`";
		$condicion=0;
		if(isset($arg['id_men']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. " id_men='".$arg['id_men']."'";
			$condicion++;
		}
		if(isset($arg['id_con']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. " id_con='".$arg['id_con']."'";
			$condicion++;
		}
		if(isset($arg['fecha_men']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . " where ";
			}
			$query = $query. " fecha_men='".$arg['fecha_men']."'";
			$condicion++;
		}
		if(isset($arg['emisor']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . " where '";
			}
			$query = $query. " emisor='".$arg['emisor']."'";
			$condicion++;
		}
		if(isset($arg['mensaje']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. " mensaje='".$arg['mensaje']."'";
			$condicion++;
		}
		$query = $query. " order by `id_men`";
		//echo $query;
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_men'=>$fila['id_men'], 
				'id_con'=>$fila['id_con'],
				'fecha_men'=>$fila['fecha_men'],
				'emisor'=>$fila['emisor'],
				'mensaje'=>$fila['mensaje']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarMensajesChat($arg='nada')
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_men`,m.`id_con`, `fecha_men`, `emisor`, p.`nombre` AS 'nombreEmisor', e.`nom_ent`, `mensaje` 
				FROM `mensajes` m, persona p, entidad e, servcon sc, servicio s
				WHERE (m.`emisor`=p.`rut` AND 
					m.`id_con`=sc.`id_con` AND 
					sc.`id_serv`=s.`id_serv` AND
					s.`id_ent`=s.`id_ent`)
					";
		$condicion=0;
		if($arg!='nada')
		{
			$query = $query . ' and (m.id_men>"'.$arg['id_men'].'" and m.id_con="'.$arg['id_con'].'")';
		}
		else
		{
			$query = $query. " limit 5";
		}
		$query = $query. " GROUP BY id_men";
		//echo $query;
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		//echo $query;
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_men'=>$fila['id_men'], 
				'id_con'=>$fila['id_con'],
				'fecha_men'=>$fila['fecha_men'],
				'emisor'=>$fila['emisor'],
				'nombreEmisor'=>$fila['nombreEmisor'],
				'nom_ent'=>$fila['nom_ent'],
				'mensaje'=>$fila['mensaje']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarMenu($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_menu`, `nom_menu`, `desc_menu`, `id_tu` FROM `menu`";
		$condicion=0;
		if(isset($arg['id_menu']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " id_menu='".$arg['id_menu']."'";
		}
		if(isset($arg['nom_menu']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " nom_menu='".$arg['nom_menu']."'";
		}
		if(isset($arg['desc_menu']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " desc_menu='".$arg['desc_menu']."'";
		}
		if(isset($arg['id_tu']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " id_tu='".$arg['id_tu']."'";
		}
		$query = $query. " order by `id_menu`";
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_menu'=>$fila['id_menu'], 
				'nom_menu'=>$fila['nom_menu'],
				'desc_menu'=>$fila['desc_menu'],
				'id_tu'=>$fila['id_tu']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarPaginaEmpresa($arg)
	{
		var_dump(require_once('db.php'));
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_pe`, `id_ent`, `nom_pe`, `posicion`, `contenido` FROM `pagEnt`";
		$condicion=0;
		if(isset($arg['id_pe']))
		{
			if($condicion!=0)
			{
				$query = $query . " and";
			}
			else
			{
				$query = $query . " where ";
				$condicion++;
			}
			$query = $query. " id_pe='".$arg['id_pe']."'";
		}
		if(isset($arg['id_ent']))
		{
			if($condicion!=0)
			{
				$query = $query . " and";
			}
			else
			{
				$query = $query . " where ";
				$condicion++;
			}
			$query = $query. " id_ent='".$arg['id_ent']."'";
		}
		if(isset($arg['posicion']))
		{
			if($condicion!=0)
			{
				$query = $query . " and";
			}
			else
			{
				$query = $query . " where ";
				$condicion++;
			}
			$query = $query. " posicion='".$arg['posicion']."'";
		}
		if(isset($arg['nom_pe']))
		{
			if($condicion!=0)
			{
				$query = $query . " and";
			}
			else
			{
				$query = $query . " where ";
				$condicion++;
			}
			$query = $query. " nom_pe='".$arg['nom_pe']."'";
		}
		if(isset($arg['contenido']))
		{
			if($condicion!=0)
			{
				$query = $query . " and";
			}
			else
			{
				$query = $query . " where ";
				$condicion++;
			}
			$query = $query. " contenido='".$arg['contenido']."'";
		}
		if(isset($arg['order_by']))
		{
			$query = $query." order by `".$arg['order_by']."`";
		}
		else
		{
			$query = $query." order by `id_pe`";
		}
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_pe'=>$fila['id_pe'], 
				'id_ent'=>$fila['id_ent'], 
				'nom_pe'=>$fila['nom_pe'], 
				'posicion'=>$fila['posicion'], 
				'contenido'=>$fila['contenido']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarPagina($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT pa.`id_pag`, `desc_pag`, `id_tp`, `nom_pag`, `url_pag`, `url_real` FROM `pagina` pa";
		$condicion=0;
		if(isset($arg['id_tu']))
		{
			$query = $query . ', permisos pe WHERE pa.id_pag=pe.id_pag and pe.id_tu='.$arg['id_tu'];
			$condicion++;
		}
		if(isset($arg['id_pag']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " pa.id_pag='".$arg['id_pag']."'";
			
		}
		if(isset($arg['id_tp']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			$condicion++;
			}
			$query = $query. " id_tp='".$arg['id_tp']."'";
		}
		if(isset($arg['nom_pag']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			$condicion++;
			}
			$query = $query. " nom_pag='".$arg['nom_pag']."'";
		}
		if(isset($arg['url_pag']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			$condicion++;
			}
			$query = $query. " url_pag='".$arg['url_pag']."'";
		}
		if(isset($arg['url_real']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			$condicion++;
			}
			$query = $query. " url_real='".$arg['url_real']."'";
		}
		$query = $query. " order by `id_pag`";
		$listar= array();
		//echo $query;
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_pag'=>$fila['id_pag'], 
				'id_tp'=>$fila['id_tp'],
				'nom_pag'=>$fila['nom_pag'],
				'url_pag'=>$fila['url_pag'],
				'url_real'=>$fila['url_real'],
				'desc_pag'=>$fila['desc_pag']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarPais($arg)
	{
		require_once('db.php');
		$db=new db();
		$condicion=0;
		$query = "SELECT `id_pais`, `nom_pais` FROM `pais`  ";
		if(isset($arg['id_pais']))
		{
			$query = $query. 'where id_pais="'.$arg['id_pais'].'" ';
		}
		$query = $query. ' order by `nom_pais`';
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array ('id_pais'=>$fila['id_pais'], 'nom_pais'=>$fila['nom_pais']);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarPlan($arg)
	{
		require_once('db.php');
		$db=new db();
		$condicion=0;
		$query = "SELECT `id_plan`, `nom_plan`, `valor_plan`, `id_est`, `dias` FROM `plan`  ";
		if(isset($arg['id_plan']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " id_plan='".$arg['id_plan']."'";
		}
		if(isset($arg['nom_plan']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " nom_plan='".$arg['nom_plan']."'";
		}
		if(isset($arg['valor_plan']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " valor_plan='".$arg['valor_plan']."'";
		}
		if(isset($arg['id_est']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " id_est='".$arg['id_est']."'";
		}
		if(isset($arg['dias']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " dias='".$arg['dias']."'";
		}
		if(isset($arg['order_by']))
		{
			$query = $query." order by `".$arg['order_by']."`";
		}
		else
		{
			$query = $query." order by `id_plan`";
		}
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array (
				'id_plan'=>$fila['id_plan'], 
				'nom_plan'=>$fila['nom_plan'], 
				'valor_plan'=>$fila['valor_plan'], 
				'id_est'=>$fila['id_est'], 
				'dias'=>$fila['dias']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarAutoridad($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_ent`, `rut` FROM `per_ent`";
		$condicion=0;
		if(isset($arg['id_ent']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " id_ent='".$arg['id_ent']."'";
		}
		if(isset($arg['rut']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " rut='".$arg['rut']."'";
		}
		$query = $query. ' order by `id_ent`';
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array ('id_ent'=>$fila['id_ent'], 'rut'=>$fila['rut']);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarAutoridadDetalle($arg)
	{
		require_once('db.php');
		$db=new db();
		$condicion=0;
		$query = "SELECT e.`id_ent`, e.nom_ent, p.`rut`, p.nombre, p.apellido FROM `per_ent` pe, persona p, entidad e where pe.id_ent=e.id_ent and pe.rut=p.rut";
		if(isset($arg['id_ent']))
		{
			$query = $query. " and e.id_ent='".$arg['id_ent']."'";
		}
		if(isset($arg['rut']))
		{
			$query = $query. " and p.rut='".$arg['rut']."'";
		}
		$query = $query. ' order by `id_ent`';
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
						(
							'id_ent'=>$fila['id_ent'], 
							'nom_ent'=>$fila['nom_ent'], 
							'rut'=>$fila['rut'], 
							'nombre'=>$fila['nombre'], 
							'apellido'=>$fila['apellido']
						);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarPermisos($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_pag`, `id_tu` FROM `permisos`";
		$condicion=0;
		if(isset($arg['id_pag']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " id_pag='".$arg['id_pag']."'";
		}
		if(isset($arg['id_tu']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. " id_tu='".$arg['id_tu']."'";
			$condicion++;
		}
		$query = $query. " order by `id_pag`";
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_pag'=>$fila['id_pag'], 
				'id_tu'=>$fila['id_tu']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarPersona($arg)
	{
		require_once('db.php');
		$db=new db();
		$condicion=0;
		$query = "SELECT `rut`, `id_com`, `id_est`, `id_tu`, `nombre`, `apellido`, `direccion`, `fecha_nac`, 
		`tel_per`, `email_per`, `contrasena` FROM `persona`";
		if(isset($arg['rut']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " rut='".$arg['rut']."'";
		}
		if(isset($arg['id_com']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " id_com='".$arg['id_com']."'";
		}
		if(isset($arg['id_est']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " id_est='".$arg['id_est']."'";
		}
		if(isset($arg['id_tu']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " id_tu='".$arg['id_tu']."'";
		}
		if(isset($arg['nombre']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " nombre='".$arg['nombre']."'";
		}
		if(isset($arg['apellido']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " apellido='".$arg['apellido']."'";
		}
		if(isset($arg['direccion']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " direccion='".$arg['direccion']."'";
		}
		if(isset($arg['fecha_nac']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " fecha_nac='".$arg['fecha_nac']."'";
		}
		if(isset($arg['tel_per']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " tel_per='".$arg['tel_per']."'";
		}
		if(isset($arg['email_per']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " email_per='".$arg['email_per']."'";
		}
		if(isset($arg['contrasena']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " contrasena='".$arg['contrasena']."'";
		}
		$query = $query ." order by `rut`";
		$listar= array();
		$mysqli=$this->conectar();
		//echo $query."<br>";
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		//print_r($resultado);
		//$resultado=$mysqli->query($query);
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'rut'=>$fila['rut'],
				'id_com'=>$fila['id_com'],
				'id_est'=>$fila['id_est'],
				'id_tu'=>$fila['id_tu'],
				'nombre'=>$fila['nombre'],
				'apellido'=>$fila['apellido'],
				'direccion'=>$fila['direccion'],
				'fecha_nac'=>$fila['fecha_nac'],
				'tel_per'=>$fila['tel_per'],
				'email_per'=>$fila['email_per'],
				'contrasena'=>$fila['contrasena']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarProvincia($arg)
	{
		require_once('db.php');
		$db=new db();
		$condicion=0;
		$query = "SELECT `id_prov`, `nom_prov`, `id_reg` FROM `provincia`";
		if(isset($arg['id_prov']))
		{
			$query = $query. ' where id_prov='.$arg['id_prov'];
		}
		if(isset($arg['id_reg']))
		{
			if(isset($arg['id_prov']))
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' id_reg='.$arg['id_reg'];
		}
		$query = $query ." order by `nom_prov`";
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_prov'=>$fila['id_prov'], 
				'nom_prov'=>$fila['nom_prov'],
				'id_reg'=>$fila['id_reg']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarRegion($arg)
	{
		require_once('db.php');
		$db=new db();
		$condicion=0;
		$query = "SELECT `id_reg`, `nom_reg`, `id_pais` FROM `region`";
		if(isset($arg['id_reg']))
		{
			$query = $query. ' where id_reg='.$arg['id_reg'];
		}
		if(isset($arg['id_pais']))
		{
			if(isset($arg['id_reg']))
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' id_pais='.$arg['id_pais'];
		}
		$query = $query." order by `nom_reg`";
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_reg'=>$fila['id_reg'], 
				'nom_reg'=>$fila['nom_reg'],
				'id_pais'=>$fila['id_pais']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarServcon($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_con`, `id_serv` FROM `servcon`";
		$condicion=0;
		if(isset($arg['id_con']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. " id_con='".$arg['id_con']."'";
			$condicion++;
		}
		if(isset($arg['id_serv']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. " id_serv='".$arg['id_serv']."'";
			$condicion++;
		}
		$query = $query. " order by `id_con`";
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_con'=>$fila['id_con'], 
				'id_serv'=>$fila['id_serv']
			);
		}
		$mysqli->close();
		return $listar;
	}
	function listarCantidadServicio($arg)
	{
		require_once('db.php');
		$db=new db();
		$query="SELECT
			count(s.id_serv) as cantidad
		FROM
			servicio s,
			tiposervicio ts,
			categoria c,
			subcategoria sc,
			entidad ent,
			estado est,
			media m
		WHERE
			s.id_ent=ent.id_ent AND
			s.id_est=est.id_est AND
			s.id_ts=ts.id_ts AND
			s.id_scat=sc.id_scat AND
			sc.id_cat=c.id_cat AND
			m.`id_med`=s.`desc_img`";
		
		if(isset($arg['id_ent']))
		{
			$query = $query. " and s.id_ent='".$arg['id_ent']."'";
		}
		if(isset($arg['nom_serv']))
		{
			$query = $query. " and s.nom_serv='".$arg['nom_serv']."'";
		}
		if(isset($arg['nom_ent']))
		{
			$query = $query. " and ent.nom_ent='".$arg['nom_ent']."'";
		}
		if(isset($arg['id_serv']))
		{
			$query = $query. " and s.id_serv='".$arg['id_serv']."'";
		}
		if(isset($arg['id_est']))
		{
			$query = $query. " and s.id_est='".$arg['id_est']."'";
		}
		if(isset($arg['id_ts']))
		{
			$query = $query. " and s.id_ts='".$arg['id_ts']."'";
		}
		if(isset($arg['nom_ts']))
		{
			$query = $query. " and ts.nom_ts='".$arg['nom_ts']."'";
		}
		if(isset($arg['nom_scat']))
		{
			$query = $query. " and sc.nom_scat='".$arg['nom_scat']."'";
		}
		if(isset($arg['id_scat']))
		{
			$query = $query. " and s.id_scat='".$arg['id_scat']."'";
		}
		if(isset($arg['id_cat']))
		{
			$query = $query. " and c.id_cat='".$arg['id_cat']."'";
		}
		if(isset($arg['nom_cat']))
		{
			$query = $query. " and c.nom_cat='".$arg['nom_cat']."'";
		}
		else
		{
			$query = $query." order by puntaje";
		}
		if(isset($arg['limit']))
		{
			$query = $query. " limit '".$arg['limit']."'";
		}
		$listar= array();
		$mysqli=$this->conectar();
		//echo $query;
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'cantidad'=>$fila['cantidad']
			);
		}
		//print_r($resultado);
		$mysqli->close();
		return$listar[0]['cantidad'];
	}
	function listarServicio($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_serv`, `id_scat`, `id_ent`, `id_est`, `nom_serv`, `desc_serv`, `seo_serv`, `id_ts` FROM `servicio`";
		$condicion=0;
		if(isset($arg['id_serv']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " id_serv='".$arg['id_serv']."'";
		}
		if(isset($arg['id_scat']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " id_scat='".$arg['id_scat']."'";
		}
		if(isset($arg['id_ent']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " id_ent='".$arg['id_ent']."'";
		}
		if(isset($arg['id_est']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " id_est='".$arg['id_est']."'";
		}
		if(isset($arg['id_est']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. ' id_est='.$arg['id_est'];
		}
		if(isset($arg['nom_serv']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " nom_serv='".$arg['nom_serv']."'";
		}
		if(isset($arg['desc_serv']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " desc_serv='".$arg['desc_serv']."'";
			
		}
		if(isset($arg['seo_serv']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " seo_serv='".$arg['seo_serv']."'";
		}
		if(isset($arg['id_ts']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " id_ts='".$arg['id_ts']."'";
		}
		$query = $query. " order by `id_serv`";
		$listar= array();
		$mysqli=$this->conectar();
		//echo $query;
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		//print_r($resultado);
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_serv'=>$fila['id_serv'], 
				'id_scat'=>$fila['id_scat'], 
				'id_ent'=>$fila['id_ent'], 
				'id_est'=>$fila['id_est'], 
				'nom_serv'=>$fila['nom_serv'], 
				'desc_serv'=>$fila['desc_serv'], 
				'seo_serv'=>$fila['seo_serv'], 
				'id_ts'=>$fila['id_ts']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarSubcategorias($arg)
	{
		require_once('db.php');
		$db=new db();
		$condicion=0;
		$query = "SELECT `id_scat`, `id_cat`, `nom_scat` FROM `subcategoria`";
		if(isset($arg['id_scat']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " id_scat='".$arg['id_scat']."'";
		}
		if(isset($arg['id_cat']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " id_cat='".$arg['id_cat']."'";
		}
		if(isset($arg['nom_scat']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
				$condicion++;
			}
			$query = $query. " nom_scat='".$arg['nom_scat']."'";
		}
		$query=$query . " order by nom_scat";
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array ('id_scat'=>$fila['id_scat'], 'nom_scat'=>$fila['nom_scat'], 'id_cat'=>$fila['id_cat']);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarTipocal($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_tc`, `nom_tc`, `desc_tc` FROM `tipocal`";
		$condicion=0;
		if(isset($arg['id_tc']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. " id_tc='".$arg['id_tc']."'";
			$condicion++;
		}
		if(isset($arg['nom_tc']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. " nom_tc='".$arg['nom_tc']."'";
			$condicion++;
		}
		if(isset($arg['desc_tc']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. " desc_tc='".$arg['desc_tc']."'";
			$condicion++;
		}
		$query = $query." order by `id_tc`";
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_tc'=>$fila['id_tc'], 
				'nom_tc'=>$fila['nom_tc'], 
				'desc_tc'=>$fila['desc_tc']
			);
		}
		$mysqli->close();
		return $listar;
	}
	function listarTipoCod($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_tcod`,`nom_tcod`,`sigla`FROM `tipocod`";
		$condicion=0;
		if(isset($arg['id_tcod']))
		{
			if($condicion!=0)
			{
				$query = $query . " and";
			}
			else
			{
				$query = $query . " where ";
				$condicion++;
			}
			$query = $query. " id_tcod='".$arg['id_tcod']."'";
		}
		if(isset($arg['nom_tcod']))
		{
			if($condicion!=0)
			{
				$query = $query . " and";
			}
			else
			{
				$query = $query . " where ";
				$condicion++;
			}
			$query = $query. " nom_tcod='".$arg['nom_tcod']."'";
		}
		if(isset($arg['sigla']))
		{
			if($condicion!=0)
			{
				$query = $query . " and";
			}
			else
			{
				$query = $query . " where ";
				$condicion++;
			}
			$query = $query. " sigla='".$arg['sigla']."'";
		}
		if(isset($arg['order_by']))
		{
			$query = $query." order by `".$arg['order_by']."`";
		}
		else
		{
			$query = $query." order by `id_tcod`";
		}
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_tcod'=>$fila['id_tcod'], 
				'nom_tcod'=>$fila['nom_tcod'],
				'sigla'=>$fila['sigla']
			);
		}
		$resultado->free();
		$mysqli->close();
		return $listar;
	}
	function listarTipoCodMin($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_tcod`,`nom_tcod` FROM `tipocod`";
		$condicion=0;
		if(isset($arg['id_tcod']))
		{
			if($condicion!=0)
			{
				$query = $query . " and";
			}
			else
			{
				$query = $query . " where ";
				$condicion++;
			}
			$query = $query. " id_tcod='".$arg['id_tcod']."'";
		}
		if(isset($arg['nom_tcod']))
		{
			if($condicion!=0)
			{
				$query = $query . " and";
			}
			else
			{
				$query = $query . " where ";
				$condicion++;
			}
			$query = $query. " nom_tcod='".$arg['nom_tcod']."'";
		}
		if(isset($arg['sigla']))
		{
			if($condicion!=0)
			{
				$query = $query . " and";
			}
			else
			{
				$query = $query . " where ";
				$condicion++;
			}
			$query = $query. " sigla='".$arg['sigla']."'";
		}
		if(isset($arg['order_by']))
		{
			$query = $query." order by `".$arg['order_by']."`";
		}
		else
		{
			$query = $query." order by `id_tcod`";
		}
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_tcod'=>$fila['id_tcod'], 
				'nom_tcod'=>$fila['nom_tcod']
			);
		}
		$mysqli->close();
		return $listar;
	}
	function listarTipodoc($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_td`, `nom_td` FROM `tipodoc`";
		$condicion=0;
		if(isset($arg['id_td']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' id_td='.$arg['id_td'];
			$condicion++;
		}
		if(isset($arg['nom_td']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' nom_td='.$arg['nom_td'];
			$condicion++;
		}
		$query = $query. " order by `id_td`";
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_td'=>$fila['id_td'], 
				'nom_td'=>$fila['nom_td']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarTipomedia($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_tm`, `nom_tm` FROM `tipomedia`";
		$condicion=0;
		if(isset($arg['id_tm']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' id_tm='.$arg['id_tm'];
			$condicion++;
		}
		if(isset($arg['nom_tm']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' nom_tm='.$arg['nom_tm'];
			$condicion++;
		}
		$query = $query. " order by `id_tm`";
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_tm'=>$fila['id_tm'], 
				'nom_tm'=>$fila['nom_tm']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarTipopagina($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_tp`, `nom_tp` FROM `tipopagina`";
		$condicion=0;
		if(isset($arg['id_tp']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' id_tp='.$arg['id_tp'];
			$condicion++;
		}
		if(isset($arg['nom_tp']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' nom_tp='.$arg['nom_tp'];
			$condicion++;
		}
		$query = $query. " order by `id_tp`";
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_tp'=>$fila['id_tp'], 
				'nom_tp'=>$fila['nom_tp']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarTiposervicio($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_ts`, `nom_ts` FROM `tiposervicio`";
		$condicion=0;
		if(isset($arg['id_ts']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. " id_ts='".$arg['id_ts']."'";
			$condicion++;
		}
		if(isset($arg['nom_ts']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. " nom_ts='".$arg['nom_ts']."'";
			$condicion++;
		}
		$query = $query." order by `id_ts`";
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_ts'=>$fila['id_ts'], 
				'nom_ts'=>$fila['nom_ts']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarTipousuario($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_tu`, `nom_tu` FROM `tipousuario`";
		$condicion=0;
		if(isset($arg['id_tu']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' id_tu='.$arg['id_tu'];
			$condicion++;
		}
		if(isset($arg['nom_tu']))
		{
			if($condicion!=0)
			{
				$query = $query . ' and';
			}
			else
			{
				$query = $query . ' where ';
			}
			$query = $query. ' nom_tu='.$arg['nom_tu'];
			$condicion++;
		}
		$query = $query. " order by `id_tu`";
		$listar= array();
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_tu'=>$fila['id_tu'], 
				'nom_tu'=>$fila['nom_tu']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	//**********************
	//otros especiales
	//**********************
	
	
	function listarMenuContenido($arg)
	{
		$listar= array();
		
		require_once('db.php');
		$db=new db();
		$query="";
		$query = "select
					url_pag, nom_pag, nom_tp
				from
					item i,
					pagina p,
					tipopagina t,
					menu m
				where
					i.id_pag=p.id_pag and
					p.id_tp=t.id_tp and
					m.id_menu=i.id_menu";
		if(isset($arg['id_tu']))
		{
			$query = $query." and m.id_tu='".$arg['id_tu']."'";
		}
		if(isset($arg['nom_menu']))
		{
			$query = $query." and m.nom_menu='".$arg['nom_menu']."'";
		}
		if(isset($arg['id_menu']))
		{
			$query = $query." and m.id_menu='".$arg['id_menu']."'";
		}
		$query = $query." order by t.nom_tp, p.nom_pag";
		//echo $query."<br>";
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		//echo $resultado;
		//print_r($resultado -> fetch_assoc());
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'nom_pag'=>$fila['nom_pag'], 
				'url_pag'=>$fila['url_pag'], 
				'nom_tp'=>$fila['nom_tp']
			);
		}
		
		$mysqli->close();
		return $listar;
	}
	
	function listarEntidadPorPersona($arg)
	{
		$listar= array();
		if(isset($arg['id_est']) && isset($arg['rut']))
		{
			require_once('db.php');
			$db=new db();
			$query = "SELECT e.id_ent, subscripcion, nom_ent FROM entidad e, per_ent pe WHERE pe.id_ent=e.id_ent and e.id_est='".$arg['id_est']."' and pe.rut='".$arg['rut']."'";
			if(isset($arg['id_ent']))
			{
				$query = $query . " and e.id_ent='".$arg['id_ent']."'";
			}
			$query = $query . " order by nom_ent";
			$mysqli=$this->conectar();
			$mysqli->real_query($query);
			$resultado = $mysqli->use_result();
			//echo $query;
			while($fila = $resultado -> fetch_assoc())
			{
				$listar[] = array 
				(
					'id_ent'=>$fila['id_ent'], 
					'nom_ent'=>$fila['nom_ent'], 
					'subscripcion'=>$fila['subscripcion']
				);
			}
			$mysqli->close();
		}
		return $listar;
	}
	
	function listarServiciosSinDetalle($arg)
	{
		$listar= array();
		
		require_once('db.php');
		$db=new db();
		$query="SELECT
			s.id_serv,
			s.nom_serv,
			ent.nom_ent,
			ts.nom_ts,
			c.nom_cat,
			sc.nom_scat,
			est.nom_est,
			s.desc_serv,
			m.`url_med`,
			s.`puntaje`
		FROM
			servicio s,
			tiposervicio ts,
			categoria c,
			subcategoria sc,
			entidad ent,
			estado est,
			media m
		WHERE
			s.id_ent=ent.id_ent AND
			s.id_est=est.id_est AND
			s.id_ts=ts.id_ts AND
			s.id_scat=sc.id_scat AND
			sc.id_cat=c.id_cat AND
			m.`id_med`=s.`desc_img`";
		
		if(isset($arg['id_ent']))
		{
			$query = $query. " and s.id_ent='".$arg['id_ent']."'";
		}
		if(isset($arg['nom_serv']))
		{
			$query = $query. " and s.nom_serv='".$arg['nom_serv']."'";
		}
		if(isset($arg['nom_ent']))
		{
			$query = $query. " and ent.nom_ent='".$arg['nom_ent']."'";
		}
		if(isset($arg['id_serv']))
		{
			$query = $query. " and s.id_serv='".$arg['id_serv']."'";
		}
		if(isset($arg['id_est']))
		{
			$query = $query. " and s.id_est='".$arg['id_est']."'";
		}
		if(isset($arg['id_ts']))
		{
			$query = $query. " and s.id_ts='".$arg['id_ts']."'";
		}
		if(isset($arg['nom_ts']))
		{
			$query = $query. " and ts.nom_ts='".$arg['nom_ts']."'";
		}
		if(isset($arg['nom_scat']))
		{
			$query = $query. " and sc.nom_scat='".$arg['nom_scat']."'";
		}
		if(isset($arg['id_scat']))
		{
			$query = $query. " and s.id_scat='".$arg['id_scat']."'";
		}
		if(isset($arg['id_cat']))
		{
			$query = $query. " and c.id_cat='".$arg['id_cat']."'";
		}
		if(isset($arg['nom_cat']))
		{
			$query = $query. " and c.nom_cat='".$arg['nom_cat']."'";
		}
		if(isset($arg['order']))
		{
			$query = $query. " order by '".$arg['order']."'";
		}
		else
		{
			$query = $query." order by puntaje";
		}
		if(isset($arg['limit']))
		{
			$query = $query. " limit ".$arg['limit'];
		}
		//echo $query;
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		//print_r($resultado);
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_serv'=>$fila['id_serv'], 
				'nom_serv'=>$fila['nom_serv'], 
				'nom_ent'=>$fila['nom_ent'], 
				'nom_ts'=>$fila['nom_ts'], 
				'nom_cat'=>$fila['nom_cat'], 
				'nom_scat'=>$fila['nom_scat'], 
				'nom_est'=>$fila['nom_est'], 
				'desc_serv'=>$fila['desc_serv'],
				'desc_img'=>$fila['url_med'],
				'puntaje'=>$fila['puntaje']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarContactosSinDetalle($arg)
	{
		$listar= array();
		require_once('db.php');
		$db=new db();
		$query="SELECT 
					c.id_con, 
					e.id_ent,
					e.nom_ent, 
					s.nom_serv, 
					c.fecha_con, 
					est.id_est,
					est.nom_est,
					p.rut,
					p.nombre,
					p.apellido
				FROM 
					`contacto` c, 
					servcon sc, 
					servicio s, 
					entidad e, 
					estado est, 
					persona p
				WHERE 
					c.id_con=sc.id_con and 
					sc.id_serv=s.id_serv and 
					s.id_ent=e.id_ent and 
					c.id_est=est.id_est and 
					p.rut=c.rut";
		if(isset($arg['id_ent']))
		{
			$query = $query. " and s.id_ent='".$arg['id_ent']."'";
		}
		if(isset($arg['rut_sii']))
		{
			$query = $query. " and e.rut_sii='".$arg['rut_sii']."'";
		}
		if(isset($arg['id_serv']))
		{
			$query = $query. " and s.id_serv='".$arg['id_serv']."'";
		}
		if(isset($arg['id_con']))
		{
			$query = $query. " and c.id_con='".$arg['id_con']."'";
		}
		if(isset($arg['rut']))
		{
			$query = $query. " and c.rut='".$arg['rut']."'";
		}
		if(isset($arg['id_est']))
		{
			$query = $query. " and est.id_est='".$arg['id_est']."'";
		}
		$query = $query." group by c.id_con, s.id_serv";
		//echo $query;
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		//print_r($resultado);
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'id_con'=>$fila['id_con'], 
				'nom_ent'=>$fila['nom_ent'],
				'rut'=>$fila['rut'], 
				'id_est'=>$fila['id_est'], 
				'id_ent'=>$fila['id_ent'],				
				'nom_serv'=>$fila['nom_serv'], 
				'fecha_con'=>$fila['fecha_con'], 
				'nom_est'=>$fila['nom_est'], 
				'nombre'=>$fila['nombre'], 
				'apellido'=>$fila['apellido']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function listarContactosPorAno($arg)
	{
		$listar= array();
		require_once('db.php');
		$db=new db();
		$query="SELECT YEAR(c.`fecha_con`) AS ano, MONTH(c.`fecha_con`) AS mes, COUNT(c.id_con) AS cantidad
				FROM contacto c, servicio s, servcon sc
				WHERE c.`id_con`=sc.`id_con` AND s.`id_serv`=sc.`id_serv`";
		if(isset($arg['id_ent']))
		{
			$query = $query. " and s.id_ent='".$arg['id_ent']."'";
		}
		$query = $query." GROUP BY YEAR(c.`fecha_con`), MONTH(c.`fecha_con`), c.id_con
				ORDER BY ano, mes";
		//echo $query;
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		//print_r($resultado);
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'ano'=>$fila['ano'], 
				'mes'=>$fila['mes'], 
				'cantidad'=>$fila['cantidad']
			);
		}
		$mysqli->close();
		return $listar;
	}
	function listarContactosPorEstado($arg)
	{
		$listar= array();
		require_once('db.php');
		$db=new db();
		$query="SELECT YEAR(c.`fecha_con`) AS ano, MONTH(c.`fecha_con`) AS mes, COUNT(c.id_con) AS cantidad, e.`nom_est` AS estado
				FROM contacto c, servicio s, servcon sc, estado e
				WHERE c.`id_con`=sc.`id_con` AND s.`id_serv`=sc.`id_serv` and c.`id_est` = e.`id_est`";
		if(isset($arg['id_ent']))
		{
			$query = $query. " and s.id_ent='".$arg['id_ent']."'";
		}
		$query = $query." GROUP BY YEAR(c.`fecha_con`), MONTH(c.`fecha_con`), c.id_con, c.`id_est`
				ORDER BY ano, mes";
		//echo $query;
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		//print_r($resultado);
		while($fila = $resultado -> fetch_assoc())
		{
			$listar[] = array 
			(
				'ano'=>$fila['ano'], 
				'mes'=>$fila['mes'], 
				'cantidad'=>$fila['cantidad'], 
				'estado'=>$fila['estado']
			);
		}
		$mysqli->close();
		return $listar;
	}
	
	function contadorVisitas($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT COUNT(id_log) AS visitas FROM `log` WHERE url LIKE '%".$arg['nom_ent']."%'";
		if(!isset($arg['mes']) || !isset($arg['ano']))
		{
			$query = $query. " AND MONTH(`fecha`)=MONTH(CURDATE()) AND YEAR(CURDATE())=YEAR(`fecha`)";
		}
		if(isset($arg['mes']))
		{
			$query = $query. " AND MONTH(`fecha`)=MONTH('".$arg['mes']."')";
		}
		if(isset($arg['ano']))
		{
			$query = $query. " AND YEAR(`fecha`)=YEAR('".$arg['ano']."')";
		}
		$mysqli=$this->conectar();
		$mysqli->real_query($query);
		$resultado = $mysqli->use_result();
		$contador=0;
		while($fila = $resultado -> fetch_assoc())
		{
			$contador=$fila['visitas'];
		}
		$mysqli->close();
		return $contador;
	}
	////////////////////////////////////////
	// Insertar ////////////////////////////
	////////////////////////////////////////
	
	function insertarAutoridad($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `per_ent`(`id_ent`, `rut`) VALUES ('".$arg['id_ent']."','".$arg['rut']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		$mysqli->close();
		return $resultado;
	}
	function insertarBoleta($arg)
	{
		require_once('db.php');
		$db=new db();
		$query ="";
		if(isset($arg['fecha_bol']))
		{
			$query = "INSERT INTO `boleta`(`id_est`, `id_ent`, `fecha_bol`, `monto`, `id_plan`) VALUES ('".$arg['id_est']."','".$arg['id_ent']."','".$arg['fecha_bol']."','".$arg['monto']."','".$arg['id_plan']."')";
		}
		else
		{
			$query = "INSERT INTO `boleta`(`id_est`, `id_ent`, `monto`, `id_plan`) VALUES ('".$arg['id_est']."','".$arg['id_ent']."','".$arg['monto']."','".$arg['id_plan']."')";
		}
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['insert_id']))
		{
			$resultado=$mysqli->insert_id;
		}
		//echo $query;
		$mysqli->close();
		return $resultado;
	}
	function insertarCalificacionclie($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `calificacionclie`(`id_con`, `id_tc`, `id_ec`) VALUES ('".$arg['id_con']."','".$arg['id_tc']."','".$arg['id_ec']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		$mysqli->close();
		return $resultado;
	}
	function insertarCalificacionserv($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `calificacionserv`(`id_con`, `id_serv`, `id_tc`, `id_ec`) VALUES ('".$arg['id_con']."','".$arg['id_serv']."','".$arg['id_tc']."','".$arg['id_ec']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		$mysqli->close();
		return $resultado;
	}
	
	function insertarCalificacionservMultiple($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `calificacionserv` (id_con, id_serv, id_tc, id_ec) SELECT id_con, id_serv,'".$arg ['id_tc']."' AS id_tc,'".$arg ['id_ec']."' AS id_ec FROM servcon WHERE id_con='".$arg ['id_con']."' AND 0<(SELECT COUNT(*) FROM contacto c WHERE c.rut='".$arg ['rut']."' and c.id_con='".$arg ['id_con']."');";
		$mysqli=$this->conectar();
		//echo $query;
		$resultado = $mysqli->real_query($query);
		$mysqli->close();
		return $resultado;
	}
	function insertarCalificacionservMultipleV2($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `calificacionserv`(`id_con`, `id_serv`, `id_tc`, `id_ec`) VALUES ";
		for($i=0;$i<count($arg);$i++)
		{
			if($i!=0 && $i!=count($arg))
			{
				$query = $query . ",";
			}
			$query = $query . "('".$arg [$i] ['id_con']."','".$arg [$i] ['id_serv']."','".$arg [$i] ['id_tc']."','".$arg [$i] ['id_ec']."')";
		}
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		$mysqli->close();
		return $resultado;
	}
	function insertarCategoria($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `categoria`(`nom_cat`) VALUES 
		('".$arg['nom_cat']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		$mysqli->close();
		return $resultado;
	}
	
	function insertarCliente($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `cliente`(`rut`, `id_com`, `id_id`, `id_est`, `nombre`, `apellido`, `direccion`, `fecha_nac`, `tel_clie`, `email_clie`) 
		VALUES ('".$arg['rut']."','".$arg['id_com']."','".$arg['id_id']."',
		'".$arg['id_est']."','".$arg['nombre']."','".$arg['apellido']."',
		'".$arg['direccion']."'
		,'".$arg['fecha_nac']."','".$arg['tel_clie']."','".$arg['email_clie']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		$mysqli->close();
		return $resultado;
	}
	
	
	
	function insertarCobertura($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `cobertura`(`id_serv`, `id_com`) VALUES ('".$arg['id_serv']."', '".$arg['id_com']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		$mysqli->close();
		return $resultado;
	}
	
	function insertarComuna($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `comuna`(`nom_com`, `id_prov`) VALUES ('".$arg['nom_com']."', '".$arg['id_prov']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		$mysqli->close();
		return $resultado;
	}
	
	function insertarContacto($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `contacto`(`rut`, `id_est`) VALUES ('".$arg['rut']."', '".$arg['id_est']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		$id=$mysqli->insert_id;
		$mysqli->close();
		return $id;
	}
	function insertarCss($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "SELECT `id_tcss`, `url_css`, `codigo` FROM `css` VALUES ('".$arg['id_tcss']."', '".$arg['url_css']."', '".$arg['codigo']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		$id=$mysqli->insert_id;
		$mysqli->close();
		return $id;
	}
	function insertarDocumento($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `documento`(`id_ent`, `id_td`, `nom_doc`, `url_doc`) VALUES ('".$arg['id_ent']."', '".$arg['id_td']."', '".$arg['nom_doc']."', '".$arg['url_doc']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		$mysqli->close();
		return $resultado;
	}
	
	function insertarEntidad($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `entidad`(`id_est`, `subscripcion`, `rut_sii`, `nom_ent`, `sitio`, `seo_ent`, `desc_ent`, `email_ent`, `tel_ent`, `auth_key`) VALUES 
		(
		'".$arg['id_est']."', 
		'".$arg['subscripcion']."', 
		'".$arg['rut_sii']."', 
		'".$arg['nom_ent']."', 
		'".$arg['sitio']."', 
		'".$arg['seo_ent']."', 
		'".$arg['desc_ent']."', 
		'".$arg['email_ent']."', 
		'".$arg['tel_ent']."', 
		'".$arg['auth_key']."'
		)";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['insert_id']))
		{
			$resultado=$mysqli->insert_id;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function insertarEscalacal($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `escalacal`(`nom_ec`, `valor`) VALUES ('".$arg['nom_ec']."', '".$arg['valor']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['insert_id']))
		{
			$resultado=$mysqli->insert_id;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function insertarEstado($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `estado`(`nom_est`) VALUES ('".$arg['nom_est']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['insert_id']))
		{
			$resultado=$mysqli->insert_id;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function insertarItem($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `item`(`id_menu`, `id_pag`) VALUES ('".$arg['id_menu']."', '".$arg['id_pag']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['insert_id']))
		{
			$resultado=$mysqli->insert_id;
		}
		$mysqli->close();
		return $resultado;
	}
	function insertarLog($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `log`(`ip`, `id_pag`,  `url`, `id_tu`, `usuario`) VALUES ('".$arg['ip']."', '".$arg['id_pag']."', '".$arg['url']."','".$arg['id_tu']."', '".$arg['usuario']."')";
		$mysqli=$this->conectar();
		//echo $query;
		$resultado = $mysqli->real_query($query);
		if(isset($arg['insert_id']))
		{
			$resultado=$mysqli->insert_id;
		}
		$mysqli->close();
		return $resultado;
	}
	function insertarMedia($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `media`(`id_tm`, `id_ent`, `nom_med`, `url_med`) VALUES 
		('".$arg['id_tm']."', '".$arg['id_ent']."', '".$arg['nom_med']."', '".$arg['url_med']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['insert_id']))
		{
			$resultado=$mysqli->insert_id;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function insertarMenu($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `menu`(`nom_menu`, `desc_menu`, `id_tu`) VALUES 
		('".$arg['nom_menu']."', '".$arg['desc_menu']."', '".$arg['id_tu']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		$mysqli->close();
		return $resultado;
	}
	
	function insertarMensajes($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `mensajes`(`id_con`, `emisor`, `mensaje`) VALUES
		('".$arg['id_con']."', '".$arg['emisor']."', '".$arg['mensaje']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['insert_id']))
		{
			$resultado=$mysqli->insert_id;
		}
		$mysqli->close();
		return $resultado;
	}
	function insertarPagina($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `pagina`(`id_tp`, `nom_pag`, `url_pag`, `url_real`, `desc_pag`) VALUES 
		('".$arg['id_tp']."', '".$arg['nom_pag']."', '".$arg['url_pag']."', '".$arg['url_real']."', '".$arg['desc_pag']."')";
		$mysqli=$this->conectar();
		//echo $query;
		$resultado = $mysqli->real_query($query);
		if(isset($arg['insert_id']))
		{
			$resultado=$mysqli->insert_id;
		}
		$mysqli->close();
		return $resultado;
	}
	function insertarPaginaEmpresa($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `pagEnt`(`id_ent`, `nom_pe`, `posicion`, `contenido`) VALUES 
		('".$arg['id_ent']."', '".$arg['nom_pe']."', '".$arg['posicion']."', '".$arg['contenido']."')";
		$mysqli=$this->conectar();
		//echo $query;
		$resultado = $mysqli->real_query($query);
		if(isset($arg['insert_id']))
		{
			$resultado=$mysqli->insert_id;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function insertarPais($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `pais`(`nom_pais`) VALUES
		('".$arg['nom_pais']."')";
		$mysqli=$this->conectar();
		//echo $query;
		$resultado = $mysqli->real_query($query);
		if(isset($arg['insert_id']))
		{
			$resultado=$mysqli->insert_id;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function insertarPermisos($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `permisos`(`id_pag`, `id_tu`) VALUES
		('".$arg['id_pag']."', '".$arg['id_tu']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['insert_id']))
		{
			$resultado=$mysqli->insert_id;
		}
		$mysqli->close();
		return $resultado;
	}
	function insertarPermisosPorUsuario($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `permisos` (id_pag, id_tu) SELECT id_pag AS id_pag, '".$arg['id_tu2']."' AS id_tu FROM permisos WHERE id_tu='".$arg['id_tu1']."' GROUP BY id_pag";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['insert_id']))
		{
			$resultado=$mysqli->insert_id;
		}
		$mysqli->close();
		return $resultado;
	}
	function insertarPersona($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `persona`(`rut`, `id_com`, `id_est`, `id_tu`, `nombre`, `apellido`, `direccion`, `fecha_nac`, `tel_per`, `email_per`, `contrasena`) VALUES 
		(
			'".$arg['rut']."',
			'".$arg['id_com']."',
			'".$arg['id_est']."',
			'".$arg['id_tu']."',
			'".$arg['nombre']."',
			'".$arg['apellido']."',
			'".$arg['direccion']."',
			'".$arg['fecha_nac']."',
			'".$arg['tel_per']."',
			'".$arg['email_per']."',
			'".$arg['contrasena']."'
		)";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['insert_id']))
		{
			$resultado=$mysqli->insert_id;
		}
		$mysqli->close();
		return $resultado;
	}
	function insertarProvincia($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `provincia`(`nom_prov`, `id_reg`) VALUES
		('".$arg['nom_prov']."', '".$arg['id_reg']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['insert_id']))
		{
			$resultado=$mysqli->insert_id;
		}
		$mysqli->close();
		return $resultado;
	}
	function insertarPlan($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `plan`(`nom_plan`, `valor_plan`, `id_est`,`dias`) VALUES ('".$arg['nom_plan']."','".$arg['valor_plan']."','".$arg['id_est']."','".$arg['dias']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['insert_id']))
		{
			$resultado=$mysqli->insert_id;
		}
		$mysqli->close();
		return $resultado;
	}
	function insertarRegion($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `region`(`nom_reg`, `id_pais`) VALUES
		('".$arg['nom_reg']."', '".$arg['id_pais']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['insert_id']))
		{
			$resultado=$mysqli->insert_id;
		}
		$mysqli->close();
		return $resultado;
	}
	function insertarServcon($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `servcon`(`id_con`, `id_serv`) VALUES
		('".$arg['id_con']."', '".$arg['id_serv']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['insert_id']))
		{
			$resultado=$mysqli->insert_id;
		}
		$mysqli->close();
		return $resultado;
	}
	function insertarMultiServcon($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `servcon` VALUES ";
		$query = $query ."('".$arg['id_con']."', '".$arg['id_serv']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['insert_id']))
		{
			$resultado=$mysqli->insert_id;
		}
		$mysqli->close();
		return $resultado;
	}
	function insertarServicio($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `servicio` (`id_scat`, `id_ent`, `id_est`, `nom_serv`, `desc_serv`, `seo_serv`, `id_ts`) VALUES
		('".$arg['is_scat']."', '".$arg['id_ent']."', '".$arg['id_est']."', '".$arg['nom_serv']."', '".$arg['desc_serv']."', '".$arg['seo_serv']."', '".$arg['id_ts']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		//echo $query;
		//echo $resultado->error;
		if(isset($arg['insert_id']))
		{
			$resultado=$mysqli->insert_id;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function insertarSubcategoria($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `subcategoria`(`id_cat`, `nom_scat`) VALUES
		('".$arg['id_cat']."', '".$arg['nom_scat']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['insert_id']))
		{
			$resultado=$mysqli->insert_id;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function insertarTipocal($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `tipocal`(`nom_tc`, `desc_tc`) VALUES
		('".$arg['nom_tc']."', '".$arg['desc_tc']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['insert_id']))
		{
			$resultado=$mysqli->insert_id;
		}
		$mysqli->close();
		return $resultado;
	}
	function insertarTipoCss($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `tipoCSS`(`nom_tcss`) VALUES
		('".$arg['nom_tcss']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['insert_id']))
		{
			$resultado=$mysqli->insert_id;
		}
		$mysqli->close();
		return $resultado;
	}
	function insertarTipodoc($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `tipodoc`(`nom_td`) VALUES
		('".$arg['nom_td']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['insert_id']))
		{
			$resultado=$mysqli->insert_id;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function insertarTipomedia($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `tipomedia`(`nom_tm`) VALUES
		('".$arg['nom_tm']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['insert_id']))
		{
			$resultado=$mysqli->insert_id;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function insertarTipopagina($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `tipopagina`(`nom_tp`) VALUES
		('".$arg['nom_tp']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['insert_id']))
		{
			$resultado=$mysqli->insert_id;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function insertarTiposervicio($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `tiposervicio`(`nom_ts`) VALUES
		('".$arg['nom_ts']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['insert_id']))
		{
			$resultado=$mysqli->insert_id;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function insertarTipousuario($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "INSERT INTO `tipousuario`(`nom_tu`) VALUES
		('".$arg['nom_tu']."')";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['insert_id']))
		{
			$resultado=$mysqli->insert_id;
		}
		$mysqli->close();
		return $resultado;
	}
	////////////////////////////////////////
	// Modificar ////////////////////////////
	////////////////////////////////////////
	function modificarBoleta($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `boleta` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['id_est']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_est='".$arg['id_est']."'";
			}
			if(isset($arg['id_ent']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_ent='".$arg['id_ent']."'";
			}
			if(isset($arg['fecha_bol']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." fecha_bol='".$arg['fecha_bol']."'";
			}
			if(isset($arg['monto']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." monto='".$arg['monto']."'";
			}
			if(isset($arg['id_plan']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_plan='".$arg['id_plan']."'";
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			$mysqli=$this->conectar();
			echo $query;
			$resultado = $mysqli->real_query($query);
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	
	function modificarCalificacionclie($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `calificacionclie` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['id_con']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query.' id_con='.$arg['id_con'];
			}
			if(isset($arg['id_tc']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query.' id_tc='.$arg['id_tc'];
			}
			if(isset($arg['id_ec']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query.' id_ec='.$arg['id_ec'];
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	
	function modificarCalificacionserv($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `calificacionserv` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['id_con']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_con='".$arg['id_con']."'";
			}
			if(isset($arg['id_serv']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_serv='".$arg['id_serv']."'";
			}
			if(isset($arg['id_tc']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_tc='".$arg['id_tc']."'";
			}
			if(isset($arg['id_ec']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_ec='".$arg['id_ec']."'";
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	
	function modificarCategoria($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `categoria` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['nom_cat']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." nom_cat='".$arg['nom_cat']."'";
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	
	function modificarCobertura($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `cobertura` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['id_serv']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_serv='".$arg['id_serv']."'";
			}
			if(isset($arg['id_com']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_com='".$arg['id_com']."'";
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	
	function modificarComuna($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `comuna` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['nom_com']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." nom_com='".$arg['nom_com']."'";
			}
			if(isset($arg['id_prov']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_prov='".$arg['id_prov']."'";
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	
	function modificarContacto($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `contacto` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['rut']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." rut='".$arg['rut']."'";
			}
			if(isset($arg['id_est']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query.' id_est='.$arg['id_est'];
			}
			if(isset($arg['fecha_con']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query.' fecha_con='.$arg['fecha_con'];
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			//echo $query;
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	function modificarCss($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `css` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['id_tcss']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_tcss='".$arg['id_tcss']."'";
			}
			if(isset($arg['url_css']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query.' url_css='.$arg['url_css'];
			}
			if(isset($arg['codigo']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query.' codigo='.$arg['codigo'];
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			//echo $query;
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	function modificarDocumento($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `documento` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['id_ent']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_ent='".$arg['id_ent']."'";
			}
			if(isset($arg['id_td']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_td='".$arg['id_td']."'";
			}
			if(isset($arg['id_td']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_td='".$arg['id_td']."'";
			}
			if(isset($arg['nom_doc']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." nom_doc='".$arg['nom_doc']."'";
			}
			if(isset($arg['url_doc']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." url_doc='".$arg['url_doc']."'";
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			//echo $query;
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	
	function modificarEntidad($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `entidad` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['id_est']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_est='".$arg['id_est']."'";
			}
			if(isset($arg['subscripcion']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." subscripcion='".$arg['subscripcion']."'";
			}
			if(isset($arg['rut_sii']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." rut_sii='".$arg['rut_sii']."'";
			}
			if(isset($arg['nom_ent']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." nom_ent='".$arg['nom_ent']."'";
			}
			if(isset($arg['sitio']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." sitio='".$arg['sitio']."'";
			}
			if(isset($arg['sitio_ext']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." sitio_ext='".$arg['sitio_ext']."'";
			}
			if(isset($arg['seo_ent']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." seo_ent='".$arg['seo_ent']."'";
			}
			if(isset($arg['desc_ent']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." desc_ent='".$arg['desc_ent']."'";
			}
			if(isset($arg['email_ent']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." email_ent='".$arg['email_ent']."'";
			}
			if(isset($arg['tel_ent']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." tel_ent='".$arg['tel_ent']."'";
			}
			if(isset($arg['banner']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." banner='".$arg['banner']."'";
			}
			if(isset($arg['cssmenu']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." cssmenu='".$arg['cssmenu']."'";
			}
			if(isset($arg['csscontacto']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." csscontacto='".$arg['csscontacto']."'";
			}
			if(isset($arg['footer']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." footer='".$arg['footer']."'";
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	
	function modificarEscalacal($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `escalacal` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['nom_ec']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." nom_ec='".$arg['nom_ec']."'";
			}
			if(isset($arg['valor']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." valor='".$arg['valor']."'";
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	
	function modificarEstado($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `estado` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['nom_est']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query.' nom_est='.$arg['nom_est'];
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	
	function modificarMedia($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `media` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['id_tm']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_tm='".$arg['id_tm']."'";
			}
			if(isset($arg['id_ent']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_ent='".$arg['id_ent']."'";
			}
			if(isset($arg['nom_med']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." nom_med='".$arg['nom_med']."'";
			}
			if(isset($arg['url_med']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." url_med='".$arg['url_med']."'";
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	
	function modificarMensajes($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `mensajes` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['id_con']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query.' id_con='.$arg['id_con'];
			}
			if(isset($arg['fecha_men']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query.' fecha_men='.$arg['fecha_men'];
			}
			if(isset($arg['emisor']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query.' emisor='.$arg['emisor'];
			}
			if(isset($arg['mensaje']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query.' mensaje='.$arg['mensaje'];
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	
	function modificarMenu($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `menu` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['nom_menu']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." nom_menu='".$arg['nom_menu']."'";
			}
			if(isset($arg['desc_menu']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." desc_menu='".$arg['desc_menu']."'";
			}
			if(isset($arg['id_tu']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_tu='".$arg['id_tu']."'";
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	
	function modificarPagina($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `pagina` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['nom_pag']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." nom_pag='".$arg['nom_pag']."'";
			}
			if(isset($arg['id_tp']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_tp='".$arg['id_tp']."'";
			}
			if(isset($arg['nom_mod']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." nom_pag='".$arg['nom_pag']."'";
			}
			if(isset($arg['url_pag']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." url_pag='".$arg['url_pag']."'";
			}
			if(isset($arg['desc_pag']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." desc_pag='".$arg['desc_pag']."'";
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			//echo $query;
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	
	function modificarPais($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `pais` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['nom_pais']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." nom_pais='".$arg['nom_pais']."'";
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			//echo $query;
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	
	function modificarPermisos($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `permisos` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['id_pag']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query.' id_pag='.$arg['id_pag'];
			}
			if(isset($arg['id_tu']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query.' id_tu='.$arg['id_tu'];
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	
	function modificarPersona($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `persona` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['id_com']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_com='".$arg['id_com']."'";
			}
			if(isset($arg['id_est']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_est='".$arg['id_est']."'";
			}
			if(isset($arg['id_tu']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_tu='".$arg['id_tu']."'";
			}
			if(isset($arg['nombre']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." nombre='".$arg['nombre']."'";
			}
			if(isset($arg['apellido']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." apellido='".$arg['apellido']."'";
			}
			if(isset($arg['direccion']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." direccion='".$arg['direccion']."'";
			}
			if(isset($arg['fecha_nac']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." fecha_nac='".$arg['fecha_nac']."'";
			}
			if(isset($arg['tel_per']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." tel_per='".$arg['tel_per']."'";
			}
			if(isset($arg['email_per']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." email_per='".$arg['email_per']."'";
			}
			if(isset($arg['contrasena']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." contrasena='".$arg['contrasena']."'";
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			echo $query;
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	function modificarPlan($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `plan` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['nom_plan']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." nom_plan='".$arg['nom_plan']."'";
			}
			if(isset($arg['valor_plan']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." valor_plan='".$arg['valor_plan']."'";
			}
			if(isset($arg['dias']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." dias='".$arg['dias']."'";
			}
			if(isset($arg['id_est']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_est='".$arg['id_est']."'";
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			//echo $query;
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	function modificarProvincia($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `provincia` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['nom_prov']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." nom_prov='".$arg['nom_prov']."'";
			}
			if(isset($arg['id_reg']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_reg='".$arg['id_reg']."'";
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	
	function modificarRegion($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `region` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['nom_reg']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." nom_reg='".$arg['nom_reg']."'";
			}
			if(isset($arg['id_pais']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_pais='".$arg['id_pais']."'";
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	
	function modificarServcon($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `servcon` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['id_con']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query.' id_con='.$arg['id_con'];
			}
			if(isset($arg['id_serv']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query.' id_serv='.$arg['id_serv'];
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	
	function modificarServicio($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `servicio` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['id_scat']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_scat='".$arg['id_scat']."'";
			}
			if(isset($arg['id_ent']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_ent='".$arg['id_ent']."'";
			}
			if(isset($arg['id_est']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_est='".$arg['id_est']."'";
			}
			if(isset($arg['nom_serv']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." nom_serv='".$arg['nom_serv']."'";
			}
			if(isset($arg['desc_serv']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." desc_serv='".$arg['desc_serv']."'";
			}
			if(isset($arg['seo_serv']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." seo_serv='".$arg['seo_serv']."'";
			}
			if(isset($arg['id_ts']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_ts='".$arg['id_ts']."'";
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	
	function modificarSubcategoria($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `subcategoria` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['id_cat']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." id_cat='".$arg['id_cat']."'";
			}
			if(isset($arg['nom_scat']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." nom_scat='".$arg['nom_scat']."'";
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			$mysqli=$this->conectar();
			//echo $query;
			$resultado = $mysqli->real_query($query);
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	
	function modificarTipocal($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `tipocal` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['nom_tc']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." nom_tc='".$arg['nom_tc']."'";
			}
			if(isset($arg['desc_tc']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." desc_tc='".$arg['desc_tc']."'";
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	
	function modificarTipodoc($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `tipodoc` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['nom_td']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." nom_td='".$arg['nom_td']."'";
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	
	function modificarTipomedia($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `tipomedia` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['nom_tm']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." nom_tm='".$arg['nom_tm']."'";
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	
	function modificarTipopagina($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `tipopagina` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['nom_tp']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." nom_tp='".$arg['nom_tp']."'";
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	
	function modificarTiposervicio($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `tiposervicio` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['nom_ts']))
			{
				if($condicion==0)
				{
					$condicion++;
				}
				else
				{
					$query = $query . ',';
				}
				$query = $query." nom_ts='".$arg['nom_ts']."'";
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	
	function modificarTipousuario($arg)
	{
		if((isset($arg['condition']) && isset($arg['data'])) || isset($arg['clause']))
		{
			$query="UPDATE `tipousuario` SET ";
			require_once('db.php');
			$db=new db();
			$condicion=0;
			if(isset($arg['nom_tu']))
			{
				$query = $query." nom_tu='".$arg['nom_tu']."'";
			}
			if(isset($arg['clause']))
			{
				$query=$query . " WHERE ".$arg['clause'];
			}
			else
			{
				$query=$query . " WHERE `".$arg['condition']."`='".$arg['data']."'";
			}
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	////////////////////////////////////////
	// Eliminar ////////////////////////////
	////////////////////////////////////////
	function eliminarAutoridad($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `per_ent` WHERE `id_ent`='".$arg['id_ent']."' and `rut`='".$arg['rut']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	function eliminarBoleta($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `boleta` WHERE `id_bol`='".$arg['id_bol']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	function eliminarCalificacionclie($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `calificacionclie` WHERE `id_calc`='".$arg['id_calc']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	function eliminarCalificacionserv($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `calificacionserv` WHERE `id_cals`='".$arg['id_cals']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	function eliminarCategoria($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `categoria` WHERE `id_cat`='".$arg['id_cat']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function eliminarCobertura($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `cobertura` WHERE `id_serv`='".$arg['id_serv']."' and `id_com`='".$arg['id_com']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function eliminarComuna($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `comuna` WHERE `id_com`='".$arg['id_com']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function eliminarContacto($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `contacto` WHERE `id_con`='".$arg['id_con']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	function eliminarCss($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `css` WHERE `id_css`='".$arg['id_css']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function eliminarDocumento($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `documento` WHERE `id_doc`='".$arg['id_doc']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function eliminarEntidad($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `entidad` WHERE `id_ent`='".$arg['id_ent']."'";
		$mysqli=$this->conectar();
		echo $query;
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function eliminarEscalacal($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `escalacal` WHERE `id_ec`='".$arg['id_ec']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function eliminarEstado($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `estado` WHERE `id_est`='".$arg['id_est']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function eliminarItem($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `item` WHERE `id_menu`='".$arg['id_menu']."' and `id_pag`='".$arg['id_pag']."'";
		$mysqli=$this->conectar();
		//echo $query;
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function eliminarMedia($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `media` WHERE `id_med`='".$arg['id_med']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function eliminarMensajes($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `mensajes` WHERE `id_men`='".$arg['id_men']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function eliminarMenu($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `menu` WHERE `id_menu`='".$arg['id_menu']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function eliminarPagina($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `pagina` WHERE `id_pag`='".$arg['id_pag']."'";
		//echo $query;
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function eliminarPaginaEmpresa($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `pagEnt` WHERE `id_pe`='".$arg['id_pe']."'";
		//echo $query;
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function eliminarPais($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `pais` WHERE `id_pais`='".$arg['id_pais']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	
	
	function eliminarPermisos($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `permisos` WHERE `id_pag`='".$arg['id_pag']."' and `id_tu`='".$arg['id_tu']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function eliminarPersona($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `persona` WHERE `rut`='".$arg['rut']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function eliminarPersonaEntidad($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `per_ent` WHERE `rut`='".$arg['rut']."' and `id_ent`='".$arg['id_ent']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	function eliminarPlan($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `plan` WHERE `id_plan`='".$arg['id_plan']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	function eliminarProvincia($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `provincia` WHERE `id_prov`='".$arg['id_prov']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function eliminarRegion($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `region` WHERE `id_reg`='".$arg['id_reg']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function eliminarServcon($arg)
	{
		if(isset($arg['id_con']) || isset($arg['id_serv']))
		{
			require_once('db.php');
			$db=new db();
			$query = "DELETE FROM `servcon` WHERE";
			if(isset($arg['id_con']))
			{
				$query = $query." id_con='".$arg['id_con']."'";
			}
			if(isset($arg['id_serv']))
			{
				if(isset($arg['id_con']))
				{
					$query = $query." and '";
				}
				$query = $query." id_serv='".$arg['id_serv']."'";
			}
			$mysqli=$this->conectar();
			$resultado = $mysqli->real_query($query);
			if(isset($arg['affected']))
			{
				$resultado=$mysqli->affected_rows;
			}
			$mysqli->close();
			return $resultado;
		}
		return false;
	}
	
	function eliminarServicio($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `servicio` WHERE `id_serv`='".$arg['id_serv']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function eliminarSubcategoria($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `subcategoria` WHERE `id_scat`='".$arg['id_scat']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function eliminarTipocal($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `tipocal` WHERE `id_tc`='".$arg['id_tc']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	function eliminarTipoCss($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `tipoCSS` WHERE `id_tcss`='".$arg['id_tcss']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	function eliminarTipodoc($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `tipodoc` WHERE `id_td`='".$arg['id_td']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function eliminarTipomedia($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `tipomedia` WHERE `id_tm`='".$arg['id_tm']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function eliminarTipopagina($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `tipopagina` WHERE `id_tp`='".$arg['id_tp']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function eliminarTiposervicio($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `tiposervicio` WHERE `id_ts`='".$arg['id_ts']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	
	function eliminarTipousuario($arg)
	{
		require_once('db.php');
		$db=new db();
		$query = "DELETE FROM `tipousuario` WHERE `id_tu`='".$arg['id_tu']."'";
		$mysqli=$this->conectar();
		$resultado = $mysqli->real_query($query);
		if(isset($arg['affected']))
		{
			$resultado=$mysqli->affected_rows;
		}
		$mysqli->close();
		return $resultado;
	}
	
}
?>