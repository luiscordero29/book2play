<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Reservas_model extends CI_MODEL
{
	public function __construct()
	{
		parent::__construct();
	}		

	function reservar()
	{
		$rop_id = $this->input->post('rop_id');
		$rre_fecha 	= $this->input->post('hoy');
	    $rcl_id = $this->rcl_id();

		$data = array(				   
			'rre_fecha' => $rre_fecha,
			'rcl_id' 	=> $rcl_id,				   
			'rop_id' 	=> $rop_id,
		);
		
		$this->db->insert('reservas', $data);

	    $query 	= $this->db->get_where('opciones', array('rop_id' => $rop_id));	    
	    $opcion = $query->row_array();
		
		$query 	= $this->db->get_where('instalaciones', array('rin_id' => $opcion['rin_id']));	    
	    $instalacion = $query->row_array();

	    $query 	= $this->db->get_where('clientes', array('rcl_id' => $rcl_id));	    
	    $cliente = $query->row_array();

	    $query 	= $this->db->get_where('usuarios', array('rus_id' => $cliente['rus_id']));	    
	    $usuario = $query->row_array();	

	    $dia 	= $this->date_to_1($rre_fecha);
	    $hora 	= $this->hora($opcion['rop_hora_inicio']).' - '.$this->hora($opcion['rop_hora_fin']);
      

		# ENVIO DE CORREO
		# REQUERIMIENTOS
		$this->load->library('email');
		$this->load->helper('email');
		#ENVIO
		$text = '<h2>DATOS DE LA RESERVA</h2>';
		$text .= '<p><b>Instalación:</b> '.$instalacion['rin_nombre'].'</p>';
		$text .= '<p><b>Día:</b> '.$dia.'</p>';
		$text .= '<p><b>Hora:</b> '.$hora.'</p>';
		$this->email->to($usuario['rus_correo']);
		$this->email->cc('miguel@webactual.com ');
		$this->email->cc('info@luiscordero29.com ');
		$this->email->from('info@book2play.es');
		$this->email->subject('REGISTRO DE RESERVA');
		$this->email->message($text);
		$this->email->send();	
		
		return true;
	}

	function read()
	{			    
	    $rin_id = $this->input->post('rin_id');
	    $rco_id = $this->rco_id();

		$this->db->join('comunidades','comunidades.rco_id=instalaciones.rco_id','left');
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

	function read_get($rin_id)
	{			    

	    $rco_id = $this->rco_id();

		$this->db->join('comunidades','comunidades.rco_id=instalaciones.rco_id','left');
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

	function dias_transcurridos($fecha_i,$fecha_f)
	{
		$dias = (strtotime($fecha_i)-strtotime($fecha_f))/86400;
		$dias = abs($dias); $dias = floor($dias);
		return $dias;
	}

	function disponible($rop_id,$rop_fecha)
	{
	    $this->db->where('rre_fecha', $rop_fecha);
	    $this->db->where('rop_id', $rop_id);
		$query = $this->db->get('reservas');
	    
	    if($query->num_rows() > 0)
	    {	      
	      	return false;
	    }
	    else
	    {
	      	return true;
	    }
	}

	function disponible_usuario($rop_id,$rop_fecha)
	{
	    $rcl_id = $this->rcl_id();

	    $this->db->where('rcl_id', $rcl_id);
	    $this->db->where('rre_fecha', $rop_fecha);
	    $this->db->where('rop_id', $rop_id);
		$query = $this->db->get('reservas');
	    
	    if($query->num_rows() > 0){	      
	      	return true;
	    }else{
	      	return false;
	    }
	}

	function cliente($rop_id , $rre_fecha )
	{
		
	    $this->db->where('reservas.rop_id', $rop_id);
	    $this->db->where('reservas.rre_fecha', $rre_fecha);
	    $this->db->join('clientes','clientes.rcl_id=reservas.rcl_id','left');
		$query = $this->db->get('reservas');
	    $data = $query->row_array();
	    return $data['rcl_apellidos'] .' '.$data['rcl_nombres'];
	    
	}

	function check_fecha()
	{		
	    $rin_id = $this->input->post('rin_id');

	    $this->db->where('rin_id',$rin_id);
	    $query = $this->db->get('res_instalaciones');
	    $data = $query->row_array();

	    $rin_antelacion = $data['rin_antelacion'];	    

		$fecha = $this->input->post('hoy');

	    $hoy = date('Y-m-d');

	    $dias = $this->dias_transcurridos($hoy,$fecha);

	    if($rin_antelacion < $dias){	      
	      	return true;
	    }else{
	      	return false;
	    }
	}

	function check_seleccion_fechas_1()
	{
		$rop_id = $this->input->post('rop_id');
		
		if (empty($rop_id)) {
			return false;
		}else{
			return true;
		}
	}

	function check_seleccion_fechas_2()
	{
		$rin_id = $this->input->post('rin_id');
		$rop_id = $this->input->post('rop_id');
		$rop_fecha = $this->input->post('hoy');
		$rcl_id = $this->rcl_id();
		
		$row = $this->read_get($rin_id);
		$rin_numero = $row['rin_numero'];
		if (empty($rop_id)) {
			return false;
		}else{

			$date_array = explode('/',$rop_fecha);
			$date_array = array_reverse($date_array);		
			$rop_fecha 	= date(implode('-', $date_array));

		    $this->db->where('reservas.rre_fecha', $rop_fecha);
		    $this->db->where('reservas.rcl_id', $rcl_id);
		    $this->db->where('reservas.rcl_id', $rcl_id);
		    $this->db->where('opciones.rin_id', $rin_id);
		    $this->db->join('opciones','opciones.rop_id=reservas.rop_id','left');
			$query = $this->db->get('reservas');
		    $item = $query->num_rows();

			if ($item < $rin_numero) {
				return true;
			}else{
				return false;
			}
		}
	}

	function check_seleccion_fechas_3()
	{
		$rop_fecha = $this->input->post('hoy');
		$hoy = date("Y-m-d");

		if (date($hoy) <= date($rop_fecha)) {
			return true;
		}else{
			return false;
		}
	}

	function check_seleccion_fechas_4()
	{
		$hoy = $this->date_to_2($this->input->post('hoy'));
		$rin_id = $this->input->post('rin_id');
		
		$row = $this->read_get($rin_id);
		$date = date('Y-m-d');

		if ($row) {
			$date = new DateTime($date);
	        $date->modify('+'.$row['rin_antelacion'].' day');
	        $date = $date->format('Y-m-d');
		}

		if (date($hoy) <= date($date)) {
			return true;
		}else{
			return false;
		}
	}


	function check_seleccion_fechas_4_fecha()
	{
		$rin_id = $this->input->post('rin_id');
		
		$row = $this->read_get($rin_id);
		
		$date = date('Y-m-d');
		
		if ($row) {
			$date = new DateTime($date);
	        $date->modify('+'.$row['rin_antelacion'].' day');
	        $date = $date->format('d/m/Y');
	    }
		
		return $date;
	}

	function disponibilidad_fechas($hoy,$rin_id,$rop_hora_inicio)
	{		
		$row = $this->read_get($rin_id);
		$date = date('Y-m-d');
		$date_hoy = date('Y-m-d');
		$time = date('H:i:s');	

		if ($row) {
			$date = new DateTime($date);
	        $date->modify('+'.$row['rin_antelacion'].' day');
	        $date = $date->format('Y-m-d');
		}

		if ( (date($hoy) <= date($date)) and (date($hoy) >= date($date_hoy)) ) {
			$date = date('Y-m-d');
			if (date($hoy) <> date($date)) {				
				return true;
			}else{
				# se verifica si esta disponible para reservar
				if (date($time) <= date($rop_hora_inicio)) {
					return true;
				}else{
					return false;
				}
			}
		}else{
			return false;
		}
	}

	function res_instalaciones_table()
	{
		$rco_id = $this->rco_id();
	    $this->db->where('rco_id',$rco_id);
	    $this->db->where('rin_activo','SI');
	    $query = $this->db->get('res_instalaciones');

	    if($query->num_rows() > 0)
	    {
	      	return $query->result_array();
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

	function tomorrow($date)
	{
		$date = new DateTime($date);
        $date->modify('+1 day');
        $date = $date->format('Y-m-d');
		return $date;
	}

	function hora($date)
	{
		$date = new DateTime($date);
        $date = $date->format('H:i');
		return $date;
	}

	function semana($date)
	{
		$date = new DateTime($date);
        $date = $date->format('l');
        switch ($date) {
        	case 'Monday':
        		$date = 'Lunes';
        		break;
        	case 'Tuesday':
        		$date = 'Martes';
        		break;
        	case 'Wednesday':
        		$date = 'Miercoles';
        		break;
        	case 'Thursday':
        		$date = 'Jueves';
        		break;
        	case 'Friday':
        		$date = 'Viernes';
        		break;
        	case 'Saturday':
        		$date = 'Sabado';
        		break;
        	case 'Sunday':
        		$date = 'Domingo';
        		break;
        }
		return $date;
	}

	
}