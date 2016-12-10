<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Cuenta_model extends CI_MODEL
{
	
	public function __construct()
	{
		parent::__construct();
	}

	function read()
	{			    
	    $rus_id = $this->session->userdata('rus_id');

	    $query = $this->db->get_where('usuarios', array('rus_id' => $rus_id));	    

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
	    
	    $rus_id 		= $this->input->post('rus_id');

	    $rus_usuario 	= $this->input->post('usuario'); 	
	   	$rus_correo 	= $this->input->post('correo');
	   	   	
	   	$data = array(
			'rus_usuario' 	=> $rus_usuario,
			'rus_correo'	=> $rus_correo, 
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

	function check_usuario()
	{		
	    $rus_id 		= $this->input->post('rus_id');
	    $rus_usuario 	= $this->input->post('usuario');

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
	    $rus_correo 	= $this->input->post('correo');

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