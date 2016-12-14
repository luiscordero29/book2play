<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Instalaciones_model extends CI_MODEL
{
	public function __construct()
	{
		parent::__construct();
	}		

	function table($limit,$start,$search)
	{
		$rco_id = $this->rco_id();

	    $sql = 
	    "SELECT * FROM res_instalaciones i
	     LEFT JOIN res_comunidades c ON i.rco_id = c.rco_id
	     WHERE (c.rco_id = ".$rco_id.") AND (
	     	rin_nombre LIKE '%".$search."%' ESCAPE '!' 
	     	OR rin_activo LIKE '%".$search."%' ESCAPE '!'
	     	OR rin_numero LIKE '%".$search."%' ESCAPE '!' 
	     	OR rin_tipo LIKE '%".$search."%' ESCAPE '!' 
	     	OR rin_duracion LIKE '%".$search."%' ESCAPE '!' 
	     	OR rin_hora_inicio LIKE '%".$search."%' ESCAPE '!'
	     	OR rin_hora_fin LIKE '%".$search."%' ESCAPE '!'
	     	OR rin_antelacion LIKE '%".$search."%' ESCAPE '!'
	     	OR rin_anulacion LIKE '%".$search."%' 
	     	)
	     ORDER BY i.rin_id DESC
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
	    "SELECT * FROM res_instalaciones i
	     LEFT JOIN res_comunidades c ON i.rco_id = c.rco_id
	     WHERE (c.rco_id = ".$rco_id.") AND (
	     	rin_nombre LIKE '%".$search."%' ESCAPE '!' 
	     	OR rin_activo LIKE '%".$search."%' ESCAPE '!'
	     	OR rin_numero LIKE '%".$search."%' ESCAPE '!' 
	     	OR rin_tipo LIKE '%".$search."%' ESCAPE '!' 
	     	OR rin_duracion LIKE '%".$search."%' ESCAPE '!' 
	     	OR rin_hora_inicio LIKE '%".$search."%' ESCAPE '!'
	     	OR rin_hora_fin LIKE '%".$search."%' ESCAPE '!'
	     	OR rin_antelacion LIKE '%".$search."%' ESCAPE '!'
	     	OR rin_anulacion LIKE '%".$search."%' 
	     	)
	     ORDER BY i.rin_id DESC
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
	   
	   	$rin_nombre 		= $this->input->post('rin_nombre');
	   	$rin_activo 		= $this->input->post('rin_activo');
	   	$rin_numero 		= $this->input->post('rin_numero');
	   	$rin_tipo 			= $this->input->post('rin_tipo');	 
	   	$rin_duracion 		= $this->input->post('rin_duracion');	  
	   	$rin_hora_inicio 	= date('H:i:s', strtotime ($this->input->post('rin_hora_inicio')));	  
	   	$rin_hora_fin 		= date('H:i:s', strtotime ($this->input->post('rin_hora_fin')));	  
	   	$rin_antelacion 	= $this->input->post('rin_antelacion');	     	
	   	$rin_anulacion 		= $this->input->post('rin_anulacion');	     	

	   	$rco_id = $this->rco_id();

	   	$data = array(
		   'rin_nombre' 		=> $rin_nombre,
		   'rin_activo' 		=> $rin_activo,
		   'rin_numero' 		=> $rin_numero,
		   'rin_tipo' 			=> $rin_tipo,
		   'rin_duracion' 		=> $rin_duracion,
		   'rin_hora_inicio' 	=> $rin_hora_inicio,
		   'rin_hora_fin' 		=> $rin_hora_fin,
		   'rin_antelacion' 	=> $rin_antelacion,
		   'rin_anulacion' 		=> $rin_anulacion,
		   'rco_id' 			=> $rco_id,
		);

		$this->db->insert('instalaciones', $data); 

		$rin_id = $this->db->insert_id();

		switch ($rin_tipo) {
	    	case 'DIA':
	    		# Registro por Dia
	    		$data = array(				   
				   'rop_hora_inicio' 	=> $rin_hora_inicio,
				   'rop_hora_fin' 		=> $rin_hora_fin,				   
				   'rin_id' 			=> $rin_id,
				);
				$this->db->insert('opciones', $data);	    		
	    		break;
	    	case 'HORAS':
	    		$minutos = intval($rin_duracion*60);
				$hora_inicio = $rin_hora_inicio;
				$hora_fin = date('H:i:s', strtotime ( "+$minutos minute" , strtotime ( $hora_inicio ) ) );
				while (strtotime($hora_inicio) < strtotime($rin_hora_fin)){				   	
				   	$data = array(				   
					   'rop_hora_inicio' 	=> $hora_inicio,
					   'rop_hora_fin' 		=> $hora_fin,				   
					   'rin_id' 			=> $rin_id,
					);
					$this->db->insert('opciones', $data);					
					$hora_inicio = date('H:i:s', strtotime ( "+$minutos minute" , strtotime ( $hora_inicio ) ) );
				   	$hora_fin = date('H:i:s', strtotime ( "+$minutos minute" , strtotime ( $hora_fin ) ) ) ;
				} 
	    		break;
	    	case 'MINUTOS':
	    		$minutos = intval($rin_duracion);
				$hora_inicio = $rin_hora_inicio;
				$hora_fin = date('H:i:s', strtotime ( "+$minutos minute" , strtotime ( $hora_inicio ) ) );
				while (strtotime($hora_inicio) < strtotime($rin_hora_fin)){				   	
				   	$data = array(				   
					   'rop_hora_inicio' 	=> $hora_inicio,
					   'rop_hora_fin' 		=> $hora_fin,				   
					   'rin_id' 			=> $rin_id,
					);
					$this->db->insert('opciones', $data);					
					$hora_inicio = date('H:i:s', strtotime ( "+$minutos minute" , strtotime ( $hora_inicio ) ) );
				   	$hora_fin = date('H:i:s', strtotime ( "+$minutos minute" , strtotime ( $hora_fin ) ) );
				} 
	    		break;
	    }
		
	    return true;

	} 

	function read($rin_id)
	{			    
	    
	    $rco_id = $this->rco_id();

		$this->db->join('comunidades','comunidades.rco_id=instalaciones.rco_id','inner');
	    $query = $this->db->get_where('instalaciones', array('instalaciones.rin_id' => $rin_id, 'comunidades.rco_id' => $rco_id));	    

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
	    
	    $rin_id = $this->input->post('rin_id');
	    
		$query = $this->db->get_where('instalaciones', array('rin_id' => $rin_id));	    

	    if($query->num_rows() > 0)
	    {	      	      	

	    	$rin_nombre 		= $this->input->post('rin_nombre');
		   	$rin_activo 		= $this->input->post('rin_activo');
		   	$rin_numero 		= $this->input->post('rin_numero');
		   	$rin_antelacion 	= $this->input->post('rin_antelacion');
		   	$rin_anulacion 		= $this->input->post('rin_anulacion');

		   	$data = array(
			   'rin_nombre' 		=> $rin_nombre,
			   'rin_activo' 		=> $rin_activo,
			   'rin_numero' 		=> $rin_numero,
			   'rin_antelacion' 	=> $rin_antelacion,
			   'rin_anulacion' 		=> $rin_anulacion,
			);
			
	      	$this->db->where('rin_id', $rin_id);
			$this->db->update('instalaciones', $data); 

	      	return true;

	    }
	    else
	    {
	      	return false;
	    }
	} 

	function clock()
	{
	    
	    $rin_id = $this->input->post('rin_id');
	    
		$query = $this->db->get_where('instalaciones', array('rin_id' => $rin_id));	    

	    if($query->num_rows() > 0)
	    {	      	      	

	    	$rin_tipo 			= $this->input->post('rin_tipo');
		   	$rin_duracion 		= $this->input->post('rin_duracion');
		   	$rin_hora_inicio 	= $this->input->post('rin_hora_inicio');
		   	$rin_hora_fin 		= $this->input->post('rin_hora_fin');

		   	$data = array(
			   'rin_tipo' 			=> $rin_tipo,
			   'rin_duracion' 		=> $rin_duracion,
			   'rin_hora_inicio' 	=> $rin_hora_inicio,
			   'rin_hora_fin' 		=> $rin_hora_fin,
			);
			
	      	$this->db->where('rin_id', $rin_id);
			$this->db->update('instalaciones', $data); 

			# delete horario
			$this->db->where('rin_id', $rin_id);
			$this->db->delete('opciones'); 

			# create horario
	      	switch ($rin_tipo) {
		    	case 'DIA':
		    		# Registro por Dia
		    		$data = array(				   
					   'rop_hora_inicio' 	=> $rin_hora_inicio,
					   'rop_hora_fin' 		=> $rin_hora_fin,				   
					   'rin_id' 			=> $rin_id,
					);
					$this->db->insert('opciones', $data);	    		
		    		break;
		    	case 'HORAS':
		    		$minutos = intval($rin_duracion*60);
					$hora_inicio = $rin_hora_inicio;
					$hora_fin = date('H:i:s', strtotime ( "+$minutos minute" , strtotime ( $hora_inicio ) ) );
					while (strtotime($hora_inicio) < strtotime($rin_hora_fin)){				   	
					   	$data = array(				   
						   'rop_hora_inicio' 	=> $hora_inicio,
						   'rop_hora_fin' 		=> $hora_fin,				   
						   'rin_id' 			=> $rin_id,
						);
						$this->db->insert('opciones', $data);					
						$hora_inicio = date('H:i:s', strtotime ( "+$minutos minute" , strtotime ( $hora_inicio ) ) );
					   	$hora_fin = date('H:i:s', strtotime ( "+$minutos minute" , strtotime ( $hora_fin ) ) ) ;
					} 
		    		break;
		    	case 'MINUTOS':
		    		$minutos = intval($rin_duracion);
					$hora_inicio = $rin_hora_inicio;
					$hora_fin = date('H:i:s', strtotime ( "+$minutos minute" , strtotime ( $hora_inicio ) ) );
					while (strtotime($hora_inicio) < strtotime($rin_hora_fin)){				   	
					   	$data = array(				   
						   'rop_hora_inicio' 	=> $hora_inicio,
						   'rop_hora_fin' 		=> $hora_fin,				   
						   'rin_id' 			=> $rin_id,
						);
						$this->db->insert('opciones', $data);					
						$hora_inicio = date('H:i:s', strtotime ( "+$minutos minute" , strtotime ( $hora_inicio ) ) );
					   	$hora_fin = date('H:i:s', strtotime ( "+$minutos minute" , strtotime ( $hora_fin ) ) );
					} 
		    		break;
		    }

	      	return true;
	    }
	    else
	    {
	      	return false;
	    }
	} 


	function delete($rin_id)
	{
	   	$rco_id = $this->rco_id();

	   	$query = $this->db->get_where('instalaciones', array('rin_id' => $rin_id, 'rco_id' => $rco_id));	
	   	
	    // eliminar
	    if($query->num_rows() > 0)
	    {	      
	    	$this->db->where('rin_id', $rin_id);
			$this->db->delete('instalaciones'); 

	      	return true;
	    }
	    else
	    {
	      	return false;
	    }
	}	

	function res_instalaciones($rin_id)
	{		
	    $this->db->order_by('rop_hora_inicio', 'ASC');
	    $this->db->where('rin_id', $rin_id);
		$query = $this->db->get('opciones');
	    
	    if($query->num_rows() > 0)
	    {	      
	      	return $query->result_array();
	    }
	    else
	    {
	      	return true;
	    }
	}

	function check_hora()
	{		
	    $rin_hora_inicio 		= date('H:i:s', strtotime ($this->input->post('rin_hora_inicio')));
	    $rin_hora_fin 			= date('H:i:s', strtotime ($this->input->post('rin_hora_fin')));
	    
	    if(strtotime($rin_hora_inicio) < strtotime($rin_hora_fin)){	      
	      	return true;
	    }else{
	      	return true;
	    }
	}

	function check_duracion()
	{		
	    $rin_tipo 		= $this->input->post('rin_tipo');
	    $rin_duracion 	= $this->input->post('rin_duracion');

	    switch ($rin_tipo) {
	    	case 'DIA':
	    		if ($rin_duracion<=1) {
	    			$flag = true;
	    		}else{
	    			$flag = false;
	    		}
	    		break;
	    	case 'HORAS':
	    		if ($rin_duracion<24) {
	    			$flag = true;
	    		}else{
	    			$flag = false;
	    		}
	    		break;
	    	case 'MINUTOS':
	    		if ($rin_duracion>14 and $rin_duracion<1440) {
	    			$flag = true;
	    		}else{
	    			$flag = false;
	    		}
	    		break;
	    }
	    
	    return $flag;
	}


	function rco_id()
	{
		$session_rus_id = $this->session->userdata('rus_id');
		$query = $this->db->get_where('comunidades', array('rus_id' => $session_rus_id));
		$data = $query->row_array();
		return $data['rco_id'];
	}

	function hora($date)
	{
		$date = new DateTime($date);
        $date = $date->format('H:i');
		return $date;
	}

	
}