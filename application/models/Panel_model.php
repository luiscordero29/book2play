<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Panel_model extends CI_MODEL
{
	public function __construct()
	{
		parent::__construct();
	}	
   
    function contar_comunidades()
	{			    
	    $sql = "SELECT count(*) as cantidad FROM res_comunidades";
	    $query = $this->db->query($sql);
	    if($query->num_rows() > 0){	      
	      	$data = $query->row_array();
	    	return $data['cantidad'];
	    }else{
	      	return 0;
	    }
	}

	function contar_gestores()
	{			    
	    $sql = "SELECT count(*) as cantidad FROM res_usuarios WHERE rus_tipo = 'ADMIN_COMUNIDAD'";
	    $query = $this->db->query($sql);
	    if($query->num_rows() > 0){	      
	      	$data = $query->row_array();
	    	return $data['cantidad'];
	    }else{
	      	return 0;
	    }
	}

	function contar_administradores()
	{			    
	    $sql = "SELECT count(*) as cantidad FROM res_usuarios WHERE rus_tipo = 'ADMIN_GLOBAL'";
	    $query = $this->db->query($sql);
	    if($query->num_rows() > 0){	      
	      	$data = $query->row_array();
	    	return $data['cantidad'];
	    }else{
	      	return 0;
	    }
	}

	function contar_instalaciones()
	{
		$rco_id = $this->rco_id();

	    $sql = 
	    "SELECT * FROM res_instalaciones i
	     LEFT JOIN res_comunidades c ON i.rco_id = c.rco_id
	     WHERE (c.rco_id = ".$rco_id.")
	    ";

	    $query = $this->db->query($sql);

	    if($query->num_rows() > 0)
	    {
	      	return $query->num_rows();
	    }
	    else
	    {
	      	return 0;
	    }
	}

	function contar_clientes()
	{
	    $rco_id = $this->rco_id();

	    $sql = 
	    "SELECT * FROM res_clientes c
	     LEFT JOIN res_usuarios u ON u.rus_id = c.rus_id 
	     LEFT JOIN res_comunidades m ON m.rco_id = c.rco_id
	     WHERE (m.rco_id = ".$rco_id.") AND (rus_tipo = 'USUARIO') 
	    ";

	    $query = $this->db->query($sql);

	    if($query->num_rows() > 0){
	      	return $query->num_rows();
	    }else{
	      	return 0;
	    }
	}

	function admin_comunidad()
	{
		$session_rus_id = $this->session->userdata('rus_id');
		$query = $this->db->get_where('comunidades', array('rus_id' => $session_rus_id));
		if($query->num_rows() > 0){	      
	      	return true;
	    }else{
	      	return false;
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

