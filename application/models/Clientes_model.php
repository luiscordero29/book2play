<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Clientes_model extends CI_MODEL
{
	public function __construct()
	{
		parent::__construct();
	}		

	function table($limit,$start,$search)
	{

		$rco_id = $this->rco_id();

	    $sql = 
	    "SELECT * FROM res_clientes c
	     LEFT JOIN res_usuarios u ON u.rus_id = c.rus_id 
	     LEFT JOIN res_comunidades m ON m.rco_id = c.rco_id
	     WHERE (m.rco_id = ".$rco_id.") AND (rus_tipo = 'USUARIO') 
	     AND (
	     	rus_usuario LIKE '%".$search."%' ESCAPE '!' 
	     	OR rus_correo LIKE '%".$search."%' ESCAPE '!'
	     	OR rus_activo LIKE '%".$search."%' ESCAPE '!' 
	     	OR rcl_dni LIKE '%".$search."%' ESCAPE '!' 
	     	OR rcl_apellidos LIKE '%".$search."%' ESCAPE '!' 
	     	OR rcl_nombres LIKE '%".$search."%' ESCAPE '!'
	     	OR rcl_movil LIKE '%".$search."%' ESCAPE '!'
	     	OR rcl_bloque LIKE '%".$search."%' ESCAPE '!'
	     	OR rcl_portal LIKE '%".$search."%' ESCAPE '!'
	     	OR rcl_piso LIKE '%".$search."%' ESCAPE '!'
	     	OR rcl_letra LIKE '%".$search."%' 
	     	)
	     ORDER BY u.rus_id DESC
	     LIMIT  ".$limit.",".$start."
	    ";

	    $query = $this->db->query($sql);

	    if($query->num_rows() > 0)
	    {
	      	return $query->result_array();
	    }
	    else
	    {
	      	return false;
	    }
	}

	function table_rows($search)
	{
	    $rco_id = $this->rco_id();

	    $sql = 
	    "SELECT * FROM res_clientes c
	     LEFT JOIN res_usuarios u ON u.rus_id = c.rus_id 
	     LEFT JOIN res_comunidades m ON m.rco_id = c.rco_id
	     WHERE (m.rco_id = ".$rco_id.") AND (rus_tipo = 'USUARIO') 
	     AND (
	     	rus_usuario LIKE '%".$search."%' ESCAPE '!' 
	     	OR rus_correo LIKE '%".$search."%' ESCAPE '!'
	     	OR rus_activo LIKE '%".$search."%' ESCAPE '!' 
	     	OR rcl_dni LIKE '%".$search."%' ESCAPE '!' 
	     	OR rcl_apellidos LIKE '%".$search."%' ESCAPE '!' 
	     	OR rcl_nombres LIKE '%".$search."%' ESCAPE '!'
	     	OR rcl_movil LIKE '%".$search."%' ESCAPE '!'
	     	OR rcl_bloque LIKE '%".$search."%' ESCAPE '!'
	     	OR rcl_portal LIKE '%".$search."%' ESCAPE '!'
	     	OR rcl_piso LIKE '%".$search."%' ESCAPE '!'
	     	OR rcl_letra LIKE '%".$search."%' 
	     	)
	     ORDER BY u.rus_id DESC
	    ";

	    $query = $this->db->query($sql);

	    if($query->num_rows() > 0)
	    {
	      	return $query->num_rows();
	    }
	    else
	    {
	      	return false;
	    }
	}

	function create()
	{
	   
	   	$rus_usuario 	= $this->input->post('rus_usuario');
	   	$rus_clave 		= MD5($this->input->post('rus_clave'));
	   	$rus_activo 	= $this->input->post('rus_activo');
	   	$rus_correo 	= $this->input->post('rus_correo');	 
	   	$rus_tipo 		= $this->input->post('rus_tipo');	     	

	   	$data = array(
		   'rus_usuario' 	=> $rus_usuario,
		   'rus_clave' 		=> $rus_clave,
		   'rus_activo' 	=> $rus_activo,
		   'rus_correo' 	=> $rus_correo,
		   'rus_tipo' 		=> $rus_tipo,
		);

		$this->db->insert('usuarios', $data); 

		$rus_id = $this->db->insert_id();
		$rco_id = $this->rco_id();

		$rcl_dni 		= $this->input->post('rcl_dni');
	   	$rcl_apellidos 	= $this->input->post('rcl_apellidos');
	   	$rcl_nombres 	= $this->input->post('rcl_nombres');
	   	$rcl_movil 		= $this->input->post('rcl_movil');
	   	$rcl_bloque 	= $this->input->post('rcl_bloque');
	   	$rcl_portal 	= $this->input->post('rcl_portal');
	   	$rcl_piso 		= $this->input->post('rcl_piso');
	   	$rcl_letra 		= $this->input->post('rcl_letra');	 
	   	
	   	$data = array(
		   'rcl_dni' 		=> $rcl_dni,
		   'rcl_apellidos' 	=> $rcl_apellidos,
		   'rcl_nombres' 	=> $rcl_nombres,
		   'rcl_movil' 		=> $rcl_movil,
		   'rcl_bloque' 	=> $rcl_bloque,
		   'rcl_portal' 	=> $rcl_portal,
		   'rcl_piso' 		=> $rcl_piso,
		   'rcl_letra' 		=> $rcl_letra,
		   'rus_id' 		=> $rus_id,
		   'rco_id' 		=> $rco_id,
		);

	   	$this->db->insert('clientes', $data); 
	    
	    return true;

	} 

	function read($rco_id)
	{			    
	    $this->db->select('*, usuarios.rus_id as rus_id');
	    $this->db->join('usuarios','usuarios.rus_id=clientes.rus_id','inner');
	    $this->db->join('comunidades','comunidades.rco_id=clientes.rco_id','inner');
	    $query = $this->db->get_where('clientes', array('rus_tipo' => 'USUARIO', 'clientes.rco_id' => $rco_id));	    

	    if($query->num_rows() > 0)
	    {	      
	      	return $query->row_array();
	    }
	    else
	    {
	      	return false;
	    }

	}

	function update()
	{
	    
	    $rus_id = $this->input->post('rus_id');
	    $rcl_id = $this->input->post('rcl_id');
	    
		$query = $this->db->get_where('usuarios', array('rus_tipo' => 'USUARIO', 'rus_id' => $rus_id));	    

	    if($query->num_rows() > 0)
	    {	      	      	

	    	$rus_usuario 	= $this->input->post('rus_usuario');
		   	$rus_clave 		= MD5($this->input->post('rus_clave'));
		   	$rus_activo 	= $this->input->post('rus_activo');
		   	$rus_correo 	= $this->input->post('rus_correo');	 
		   	$rus_tipo 		= $this->input->post('rus_tipo');	     	

		   	$data = array(
			   'rus_usuario' 	=> $rus_usuario,
			   'rus_clave' 		=> $rus_clave,
			   'rus_activo' 	=> $rus_activo,
			   'rus_correo' 	=> $rus_correo,
			   'rus_tipo' 		=> $rus_tipo,
			);

	      	$this->db->where('rus_id', $rus_id);
			$this->db->update('usuarios', $data); 

			$rco_id = $this->rco_id();

			$rcl_dni 		= $this->input->post('rcl_dni');
		   	$rcl_apellidos 	= $this->input->post('rcl_apellidos');
		   	$rcl_nombres 	= $this->input->post('rcl_nombres');
		   	$rcl_movil 		= $this->input->post('rcl_movil');
		   	$rcl_bloque 	= $this->input->post('rcl_bloque');
		   	$rcl_portal 	= $this->input->post('rcl_portal');
		   	$rcl_piso 		= $this->input->post('rcl_piso');
		   	$rcl_letra 		= $this->input->post('rcl_letra');	 
		   	
		   	$data = array(
			   'rcl_dni' 		=> $rcl_dni,
			   'rcl_apellidos' 	=> $rcl_apellidos,
			   'rcl_nombres' 	=> $rcl_nombres,
			   'rcl_movil' 		=> $rcl_movil,
			   'rcl_bloque' 	=> $rcl_bloque,
			   'rcl_portal' 	=> $rcl_portal,
			   'rcl_piso' 		=> $rcl_piso,
			   'rcl_letra' 		=> $rcl_letra,
			   'rus_id' 		=> $rus_id,
			   'rco_id' 		=> $rco_id,
			);

			$this->db->where('rcl_id', $rcl_id);
			$this->db->update('clientes', $data);


	      	return true;
	    }
	    else
	    {
	      	return false;
	    }
	} 

	function password()
	{
	    $rus_id 		= $this->input->post('rus_id');
	    $clave 			= md5($this->input->post('pass'));

	    $data = array(
			'rus_clave' 	=> $clave  
		);
	    
	    $query = $this->db->get_where('usuarios', array('rus_id' => $rus_id));

	    if($query->num_rows() > 0)
	    {	      
	      	$this->db->where('rus_id', $rus_id);
			$this->db->update('usuarios', $data); 
	      	return true;
	    }
	    else
	    {
	      	return false;
	    }
	}

	function delete($rus_id)
	{
	   
	   	$query = $this->db->get_where('usuarios', array('rus_tipo' => 'ADMIN_COMUNIDAD', 'rus_id' => $rus_id));	
	   	
	    // eliminar
	    if($query->num_rows() > 0)
	    {	      
	    	$this->db->where('rus_id', $rus_id);
			$this->db->delete('usuarios'); 

			$this->db->where('rus_id', $rus_id);
			$this->db->delete('clientes'); 

	      	return true;
	    }
	    else
	    {
	      	return false;
	    }
	}	


	function check_usuario()
	{		
	    $rus_id 		= $this->input->post('rus_id');
	    $rus_usuario 	= $this->input->post('rus_usuario');

	    $this->db->where('rus_id !=', $rus_id);
	    $this->db->where('rus_usuario', $rus_usuario);
		$query = $this->db->get('usuarios');
	    
	    if($query->num_rows() > 0)
	    {	      
	      	return false;
	    }
	    else
	    {
	      	return true;
	    }
	}

	function check_dni()
	{		
	    $rcl_id 		= $this->input->post('rcl_id');
	    $rcl_dni 		= $this->input->post('rcl_dni');

	    $this->db->where('rcl_id !=', $rcl_id);
	    $this->db->where('rcl_dni', $rcl_dni);
		$query = $this->db->get('clientes');
	    
	    if($query->num_rows() > 0)
	    {	      
	      	return false;
	    }
	    else
	    {
	      	return true;
	    }
	}

	function check_correo()
	{		
	    $rus_id 		= $this->input->post('rus_id');
	    $rus_correo 	= $this->input->post('rus_correo');

	    $this->db->where('rus_id!=', $rus_id);
	    $this->db->where('rus_correo', $rus_correo);
		$query = $this->db->get('usuarios');
	    
	    if($query->num_rows() > 0)
	    {	      
	      	return false;
	    }
	    else
	    {
	      	return true;
	    }
	}

	function dni() {
		
		$dni = $this->input->post('rcl_dni'); 
		
		if(strlen($dni)<9) {
			return false;
		}
	 
		$dni = strtoupper($dni);
	 
		$letra = substr($dni, -1, 1);
		$numero = substr($dni, 0, 8);
	 
		// Si es un NIE hay que cambiar la primera letra por 0, 1 ó 2 dependiendo de si es X, Y o Z.
		$numero = str_replace(array('X', 'Y', 'Z'), array(0, 1, 2), $numero);	
	 
		$modulo = $numero % 23;
		$letras_validas = "TRWAGMYFPDXBNJZSQVHLCKE";
		$letra_correcta = substr($letras_validas, $modulo, 1);
	 
		if($letra_correcta!=$letra) {
			return false;
		}
		else {
			return true;
		}
	}

	function rco_id()
	{
		$session_rus_id = $this->session->userdata('rus_id');
		$query = $this->db->get_where('comunidades', array('rus_id' => $session_rus_id));
		$data = $query->row_array();
		return $data['rco_id'];
	}

}