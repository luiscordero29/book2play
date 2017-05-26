<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Comunidades_model extends CI_MODEL
{
	public function __construct()
	{
		parent::__construct();
	}		

	function table($limit,$start,$search)
	{

	    $sql = 
	    "SELECT * FROM res_comunidades c
	     LEFT JOIN res_usuarios u ON u.rus_id = c.rus_id
	     LEFT JOIN res_administradores a ON a.rus_id = u.rus_id 
	     WHERE (
	     	rus_usuario LIKE '%".$search."%' ESCAPE '!' 
	     	OR rus_correo LIKE '%".$search."%' ESCAPE '!'
	     	OR rus_activo LIKE '%".$search."%' ESCAPE '!' 
	     	OR rad_dni LIKE '%".$search."%' ESCAPE '!' 
	     	OR rad_apellidos LIKE '%".$search."%' ESCAPE '!' 
	     	OR rad_nombres LIKE '%".$search."%' ESCAPE '!'
	     	OR rco_nombre  LIKE '%".$search."%' ESCAPE '!'
	     	OR rco_direccion  LIKE '%".$search."%' ESCAPE '!'
	     	OR rco_contacto LIKE '%".$search."%' ESCAPE '!'
	     	OR rco_movil LIKE '%".$search."%' ESCAPE '!'
	     	OR rco_correo LIKE '%".$search."%' ESCAPE '!'
	     	OR rco_vecinos LIKE '%".$search."%' 
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
	    "SELECT * FROM res_comunidades c
	     LEFT JOIN res_usuarios u ON u.rus_id = c.rus_id
	     LEFT JOIN res_administradores a ON a.rus_id = u.rus_id 
	     WHERE (
	     	rus_usuario LIKE '%".$search."%' ESCAPE '!' 
	     	OR rus_correo LIKE '%".$search."%' ESCAPE '!'
	     	OR rus_activo LIKE '%".$search."%' ESCAPE '!' 
	     	OR rad_dni LIKE '%".$search."%' ESCAPE '!' 
	     	OR rad_apellidos LIKE '%".$search."%' ESCAPE '!' 
	     	OR rad_nombres LIKE '%".$search."%' ESCAPE '!'
	     	OR rco_nombre  LIKE '%".$search."%' ESCAPE '!'
	     	OR rco_direccion  LIKE '%".$search."%' ESCAPE '!'
	     	OR rco_contacto LIKE '%".$search."%' ESCAPE '!'
	     	OR rco_movil LIKE '%".$search."%' ESCAPE '!'
	     	OR rco_correo LIKE '%".$search."%' ESCAPE '!'
	     	OR rco_vecinos LIKE '%".$search."%' 
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

	function data()
	{
		$rco_nombre 	= $this->input->post('rco_nombre');
	   	$rco_direccion 	= $this->input->post('rco_direccion');
	   	$rco_contacto 	= $this->input->post('rco_contacto');
	   	$rco_movil 		= $this->input->post('rco_movil');	 
	   	$rco_correo 	= $this->input->post('rco_correo');	
	   	$rco_vecinos 	= $this->input->post('rco_vecinos');
	   	$rus_id 		= $this->input->post('rus_id');     	

	   	$data = array(
		   'rco_nombre' 	=> $rco_nombre,
		   'rco_direccion' 	=> $rco_direccion,
		   'rco_contacto' 	=> $rco_contacto,
		   'rco_movil' 		=> $rco_movil,
		   'rco_correo' 	=> $rco_correo,
		   'rco_vecinos' 	=> $rco_vecinos,
		   'rus_id' 		=> $rus_id,
		);

		return $data;
	}

	function create()
	{
	   
	   	$data = $this->data();

		$this->db->insert('comunidades', $data);  
	    
	    return true;

	} 

	function read($rco_id)
	{			    
	    
	    $this->db->join('usuarios','usuarios.rus_id=comunidades.rus_id','left');
	    $this->db->join('administradores','administradores.rus_id=usuarios.rus_id','left');
	    $query = $this->db->get_where('comunidades', array('rco_id' => $rco_id));	    

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
	    
	    $rco_id = $this->input->post('rco_id');
	    
		$query = $this->db->get_where('comunidades', array('rco_id' => $rco_id));	    

	    if($query->num_rows() > 0)
	    {	      	      	

	    	$data = $this->data();

	      	$this->db->where('rco_id', $rco_id);
			$this->db->update('comunidades', $data); 

	      	return true;
	    }
	    else
	    {
	      	return false;
	    }
	} 

	function delete($rco_id)
	{
	   
	   	$query = $this->db->get_where('comunidades', array('rco_id' => $rco_id));	
	   	
	    // eliminar
	    if($query->num_rows() > 0)
	    {	      
	    	$this->db->where('rco_id', $rco_id);
			$this->db->delete('comunidades'); 

	      	return true;
	    }
	    else
	    {
	      	return false;
	    }
	}	

	function res_administradores()
	{

	    $sql = 
	    "SELECT * FROM res_usuarios u
	     INNER JOIN res_administradores a ON a.rus_id = u.rus_id 
	     WHERE (rus_tipo = 'ADMIN_COMUNIDAD') AND
	     (u.rus_id NOT IN (SELECT rus_id FROM res_comunidades))
	     ORDER BY u.rus_id DESC
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

}