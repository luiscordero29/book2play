<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Accesos_model extends CI_MODEL
{
	public function __construct()
	{
		parent::__construct();
	}

	public function check_clave()
 	{
	    $usuario = $this->input->post('usuario');
	    $clave = md5($this->input->post('clave'));
	    $this->db->select('rus_id');
	    $query = $this->db->get_where('usuarios', array('rus_usuario' => $usuario,'rus_clave' => $clave));

	    if($query->num_rows() > 0)
	    {
	    	return true;
	    }
	    else
	    {
	    	return false;
	    }
 	}

 	public function check_usuario()
 	{
	    $usuario = $this->input->post('usuario');
	    $this->db->select('rus_id');
	    $query = $this->db->get_where('usuarios', array('rus_usuario' => $usuario));

	    if($query->num_rows() > 0)
	    {
	    	return true;
	    }
	    else
	    {
	    	return false;
	    }
 	}

 	public function check_activo()
 	{
	    $usuario = $this->input->post('usuario');
	    $this->db->select('rus_id');
	    $query = $this->db->get_where('usuarios', array('rus_usuario' => $usuario, 'rus_activo' => 'SI'));

	    if($query->num_rows() > 0)
	    {
	    	return true;
	    }
	    else
	    {
	    	return false;
	    }
 	}

 	public function check_session()
 	{
	    
	    $usuario = $this->input->post('usuario');
	    $clave = md5($this->input->post('clave'));
	    $this->db->select('rus_id, rus_tipo');
	    $query = $this->db->get_where('usuarios', array('rus_usuario' => $usuario,'rus_clave' => $clave));

	    if($query->num_rows() > 0)
	    {
	    	return $query->row_array();
	    }
	    else
	    {
	    	return false;
	    }
 	}

}