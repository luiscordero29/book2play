<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Agenda_model extends CI_MODEL
{
	public function __construct()
	{
		parent::__construct();
	}		

	function table($limit,$start,$search)
	{
		$rco_id = $this->rco_id();
		$rcl_id = $this->rcl_id();
		$hoy = date("Y-m-d");
	    $sql = 
	    "SELECT * FROM res_reservas r
	     LEFT JOIN res_opciones o ON o.rop_id = r.rop_id
	     LEFT JOIN res_instalaciones i ON i.rin_id = o.rin_id
	     LEFT JOIN res_comunidades c ON c.rco_id = i.rco_id
	     WHERE (r.rre_fecha >= date('".$hoy."')) AND (c.rco_id = ".$rco_id.") AND (r.rcl_id = ".$rcl_id.") AND (
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
	     ORDER BY r.rre_fecha ASC, o.rop_hora_inicio ASC
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
		$rcl_id = $this->rcl_id();

	    $sql = 
	    "SELECT * FROM res_reservas r
	     LEFT JOIN res_opciones o ON o.rop_id = r.rop_id
	     LEFT JOIN res_instalaciones i ON i.rin_id = o.rin_id
	     LEFT JOIN res_comunidades c ON c.rco_id = i.rco_id
	     WHERE (c.rco_id = ".$rco_id.") AND (r.rcl_id = ".$rcl_id.") AND (
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
	     ORDER BY r.rre_fecha ASC, o.rop_hora_inicio ASC
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

	function delete($rre_id)
	{
	   	
	   	$rco_id = $this->rco_id();
		$rcl_id = $this->rcl_id();

		$sql = 
	    "SELECT * FROM res_reservas r
	     LEFT JOIN res_opciones o ON o.rop_id = r.rop_id
	     LEFT JOIN res_instalaciones i ON i.rin_id = o.rin_id
	     LEFT JOIN res_comunidades c ON c.rco_id = i.rco_id
	     WHERE (r.rre_id = ".$rre_id.") AND (r.rcl_id = ".$rcl_id.")
	    ";

	    $query = $this->db->query($sql);

	   	///$query = $this->db->get_where('reservas', array('rre_id' => $rre_id,'rcl_id' => $rcl_id));	
	   	
	    // eliminar
	    if($query->num_rows() > 0)
	    {	      
	    	// comparar fecha 

	    	# operacion
		    $r = $query->row_array();	    
		    $ahora = date('Y-m-d H:i:s');
		    $datetime2 = new DateTime($r['rre_fecha'].' '.$r['rop_hora_inicio']);
			$datetime1 = new DateTime($ahora);
			$interval = $datetime1->diff($datetime2);
			# variables 
			$dias = $interval->format('%r%a');
			$horas = $interval->format('%r%h');
			if ($dias>0) {
				$total_horas = $dias*24+$horas;
			}else{
				$total_horas = $horas;
			}
			# eliminar 
			if ( $total_horas>$r['rin_anulacion'] ) {
				# code...
				$this->db->where('rre_id', $rre_id);
				$this->db->delete('reservas'); 
		      	return true;
			}else{
				return false;
			}

			/*
		    $minutos = ceil((strtotime(date('H:i:s')) - strtotime($data['rop_hora_inicio']) / 60));

		    if ($minutos>$data['rin_anulacion']*60) {
		    	
		    	$this->db->where('rre_id', $rre_id);
				$this->db->delete('reservas'); 

		      	return true;
		    }else{
		    	return false;
		    }*/
	    }
	    else
	    {
	      	return false;
	    }
	}	

	function rco_id()
	{
		$session_rus_id = $this->session->userdata('rus_id');
		$query = $this->db->get_where('clientes', array('rus_id' => $session_rus_id));
		$data = $query->row_array();
		return $data['rco_id'];
	}

	function rcl_id()
	{
		$session_rus_id = $this->session->userdata('rus_id');
		$query = $this->db->get_where('clientes', array('rus_id' => $session_rus_id));
		$data = $query->row_array();
		return $data['rcl_id'];
	}
	
	function hora($date)
	{
		$date = new DateTime($date);
        $date = $date->format('H:i');
		return $date;
	}

	function date_to_1($date)
	{
		$date_array = explode('-',$date);
        $date_array = array_reverse($date_array);   
        $date    = date(implode('/', $date_array));
		return $date;
	}

	function date_to_2($date)
	{
		$date_array = explode('/',$date);
        $date_array = array_reverse($date_array);   
        $date    = date(implode('-', $date_array));
		return $date;
	}

}