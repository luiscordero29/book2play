<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Panel_model extends CI_MODEL
{
	public function __construct()
	{
		parent::__construct();
	}	

	function contar_usuarios()
	{			    
	    $sql = "SELECT count(*) as cantidad FROM usuarios  
		    	WHERE  tipo = 'USUARIO'";

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
   
    function contar_comunidades()
	{			    
	    
	    $sql = "SELECT count(*) as cantidad FROM comunidades";


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

	function contar_instalaciones()
	{			    
	    
	    $sql = "SELECT count(*) as cantidad FROM instalaciones";

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

	function admin_comunidad()
	{
		$rus_id = $this->session->userdata('rus_id');
		$query = $this->db->get_where('comunidades', array('rus_id' => $rus_id));	    

	    if($query->num_rows() > 0)
	    {	      
	      	return true;
	    }
	    else
	    {
	      	return false;
	    }
	}		


}

