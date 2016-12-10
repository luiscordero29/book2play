<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Gestores_model extends CI_MODEL
{
	public function __construct()
	{
		parent::__construct();
	}		

	function table($limit,$start,$search)
	{

	    $sql = 
	    "SELECT * FROM res_usuarios u
	     INNER JOIN res_administradores a ON a.rus_id = u.rus_id 
	     WHERE (rus_tipo = 'ADMIN_COMUNIDAD') 
	     AND (
	     	rus_usuario LIKE '%".$search."%' ESCAPE '!' 
	     	OR rus_correo LIKE '%".$search."%' ESCAPE '!'
	     	OR rus_activo LIKE '%".$search."%' ESCAPE '!' 
	     	OR rad_dni LIKE '%".$search."%' ESCAPE '!' 
	     	OR rad_apellidos LIKE '%".$search."%' ESCAPE '!' 
	     	OR rad_nombres LIKE '%".$search."%' 
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
	    
	    $sql = 
	    "SELECT * FROM res_usuarios u
	     INNER JOIN res_administradores a ON a.rus_id = u.rus_id 
	     WHERE (rus_tipo = 'ADMIN_COMUNIDAD') 
	     AND (
	     	rus_usuario LIKE '%".$search."%' ESCAPE '!' 
	     	OR rus_correo LIKE '%".$search."%' ESCAPE '!'
	     	OR rus_activo LIKE '%".$search."%' ESCAPE '!' 
	     	OR rad_dni LIKE '%".$search."%' ESCAPE '!' 
	     	OR rad_apellidos LIKE '%".$search."%' ESCAPE '!' 
	     	OR rad_nombres LIKE '%".$search."%' 
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

		$rad_dni 		= $this->input->post('rad_dni');
	   	$rad_apellidos 	= $this->input->post('rad_apellidos');
	   	$rad_nombres 	= $this->input->post('rad_nombres');	 
	   	
	   	$data = array(
		   'rad_dni' 		=> $rad_dni,
		   'rad_apellidos' 	=> $rad_apellidos,
		   'rad_nombres' 	=> $rad_nombres,
		   'rus_id' 		=> $rus_id,
		);

	   	$this->db->insert('administradores', $data); 
	    
	    return true;

	} 

	function read($rus_id)
	{			    
	    
	    $this->db->join('administradores','administradores.rus_id=usuarios.rus_id','left');
	    $query = $this->db->get_where('usuarios', array('rus_tipo' => 'ADMIN_COMUNIDAD', 'usuarios.rus_id' => $rus_id));	    

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
	    $rad_id = $this->input->post('rad_id');
	    
		$query = $this->db->get_where('usuarios', array('rus_tipo' => 'ADMIN_COMUNIDAD', 'rus_id' => $rus_id));	    

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

			$rad_dni 		= $this->input->post('rad_dni');
		   	$rad_apellidos 	= $this->input->post('rad_apellidos');
		   	$rad_nombres 	= $this->input->post('rad_nombres');	 
		   	
		   	$data = array(
			   'rad_dni' 		=> $rad_dni,
			   'rad_apellidos' 	=> $rad_apellidos,
			   'rad_nombres' 	=> $rad_nombres,
			);

			$this->db->where('rad_id', $rad_id);
			$this->db->update('administradores', $data);


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
			$this->db->delete('administradores'); 

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
	    $rad_id 		= $this->input->post('rad_id');
	    $rad_dni 		= $this->input->post('rad_dni');

	    $this->db->where('rad_id !=', $rad_id);
	    $this->db->where('rad_dni', $rad_dni);
		$query = $this->db->get('administradores');
	    
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
		
		$dni = $this->input->post('rad_dni'); 
		
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

}