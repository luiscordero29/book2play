<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Administradores_model extends CI_MODEL
{
	public function __construct()
	{
		parent::__construct();
	}		

	function table($limit,$start,$search)
	{

	    $sql = 
	    "SELECT * FROM res_usuarios 
	     WHERE (rus_tipo = 'ADMIN_GLOBAL') 
	     AND (
	     	rus_usuario LIKE '%".$search."%' ESCAPE '!' 
	     	OR rus_correo LIKE '%".$search."%' ESCAPE '!'
	     	OR rus_activo LIKE '%".$search."%'  
	     	)
	     ORDER BY rus_id DESC
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
	    "SELECT * FROM res_usuarios 
	     WHERE (rus_tipo = 'ADMIN_GLOBAL') 
	     AND (
	     	rus_usuario LIKE '%".$search."%' ESCAPE '!' 
	     	OR rus_correo LIKE '%".$search."%' ESCAPE '!'
	     	OR rus_activo LIKE '%".$search."%'  
	     	)
	     ORDER BY rus_id DESC
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

	function data()
	{
	   
	   	$rus_usuario 	= $this->input->post('rus_usuario');
	   	$rus_clave 		= MD5($this->input->post('rus_clave'));
	   	$rus_activo 	= $this->input->post('rus_activo');
	   	$rus_correo 	= $this->input->post('rus_correo');	 
	   	$rus_tipo 		= $this->input->post('rus_tipo');	     	

	   	$data = array(
		   'rus_usuario' 	=> $rus_usuario,
		   'rus_activo' 	=> $rus_activo,
		   'rus_clave' 		=> $rus_clave,
		   'rus_correo' 	=> $rus_correo,
		   'rus_tipo' 		=> $rus_tipo,
		);
	    
	    return $data;

	} 

	function create()
	{
	   
	   	$data = $this->data();

		$this->db->insert('usuarios', $data); 
	    
	    return true;

	} 

	function read($rus_id)
	{			    
	    
	    $query = $this->db->get_where('usuarios', array('rus_tipo' => 'ADMIN_GLOBAL', 'rus_id' => $rus_id));	    

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

	    $data = $this->data();
	    
		$query = $this->db->get_where('usuarios', array('rus_tipo' => 'ADMIN_GLOBAL', 'rus_id' => $rus_id));	    

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
	   
	   	$query = $this->db->get_where('usuarios', array('rus_tipo' => 'ADMIN_GLOBAL', 'rus_id' => $rus_id));	
	   	
	    // eliminar
	    if($query->num_rows() > 0)
	    {	      
	      	$data = $query->row_array();

		    /*// conceptos
			$query1 = $this->db->get_where('conceptos', array('usuario' => $data['usuario']));		    		
			if($query1->num_rows() > 0)
		    {	      	      	
		      	return false;
		    }
		    */

	    	$this->db->where('rus_id', $rus_id);
			$this->db->delete('usuarios'); 
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

	function check_correo()
	{		
	    $rus_id 		= $this->input->post('rus_id');
	    $rus_correo 	= $this->input->post('rus_correo');

	    $this->db->where('rus_id !=', $rus_id);
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

}