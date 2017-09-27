<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reservas extends CI_Controller {

	/**
	 * Reservas.
	 *
	 * autor: Ing. Luis Cordero
	 * site: http://www.luiscordero29.com
	 * mail: info@luiscordero29.com
	 *
	 **/

	public $controller = "reservas";

	public function __construct()
	{
		parent::__construct();		
		$this->load->model('Reservas_model','',TRUE); 
		// Control Sessión
		if(!$this->session->has_userdata('rus_id'))
   		{     						
		    //If no session, redirect to login page
		    redirect('cuenta/salir');

		}
		// Control de Acceso
		if(!($this->session->userdata('rus_tipo')=='USUARIO'))
   		{     						
		    //If no session, redirect to login page
		    redirect('cuenta/salir');		    
		}
	}

	public function index()
	{			
			
		$this->form_validation->set_rules('rin_id', 'Elegir Instalación', 'trim|required');	
		$this->form_validation->set_rules('fecha', 'Elegir Fecha', 'trim|required|callback_check_fecha');	
		$this->form_validation->set_message('check_fecha', 'No existe disponibilidad para esta fecha');

		$data['res_instalaciones_table'] = $this->Reservas_model->res_instalaciones_table();
		
		if($this->form_validation->run() == FALSE)
		{
			#Validar el primer Registro 
			if (!empty($res_instalaciones_table)) {
				# Seleccionar el Primer Registro 
				foreach ($data['res_instalaciones_table'] as $instalacion) {
					$data['rin_id'] = $instalacion['rin_id'];
					$data['rin_numero'] = $instalacion['rin_numero'];
					$data['rco_id'] = $instalacion['rco_id'];
					break;
				}
			}else{
				# Redireccionar 
				redirect('reservas/error_instalaciones');	
			}
			# Indicar Fecha Actual
			$data['hoy'] = date("Y-m-d");
			# vista
			$this->load->view($this->controller.'/index',$data);

		}else{
				
			$data['row'] = $this->Reservas_model->read();
			$data['hoy'] = $this->Reservas_model->date_to_2($this->input->post('fecha'));
			if(empty($data['row']))
			{
				$data['alert']['danger'] = 
					array( 
						'No exite registro ó No puede ser eliminado',				
					);

				$this->load->view($this->controller.'/message',$data);
			}else{

				$this->load->view($this->controller.'/reservar_listar',$data);			
			
			}

		}			
	}

	public function reservar_listar()
	{			
		
		$data['fecha'] = $this->input->post('hoy');

		$this->form_validation->set_rules('hoy', '', 'required|callback_check_seleccion_fechas_1|callback_check_seleccion_fechas_2|callback_check_seleccion_fechas_3|callback_check_seleccion_fechas_4');	
		$this->form_validation->set_message('check_seleccion_fechas_1', 'Debe escoger un bloque de horario');
		$this->form_validation->set_message('check_seleccion_fechas_2', 'Ha superado el numero de reservas por día');
		$this->form_validation->set_message('check_seleccion_fechas_3', 'Error en fecha, debes reservar con de antealción');
		$this->form_validation->set_message('check_seleccion_fechas_4', 'La fecha de reservación debe ser inferior o igual a: '.$this->Reservas_model->check_seleccion_fechas_4_fecha());
		$data['res_instalaciones_table'] = $this->Reservas_model->res_instalaciones_table();
		$data['row'] = $this->Reservas_model->read();
		$data['hoy'] = $this->Reservas_model->date_to_2($this->input->post('fecha'));

		
		if($this->form_validation->run() == FALSE)
		{
			if(empty($data['row']))
			{
				$data['alert']['danger'] = 
					array( 
						'No exite registro ó No puede ser eliminado',				
					);

				$this->load->view($this->controller.'/message',$data);
			}else{
				
				if (empty($data['fecha'])) {
					redirect('reservas/index');
				}
				$this->load->view($this->controller.'/reservar_listar_form',$data);			
			
			}
		}else{
				
			if(empty($data['row']))
			{
				$data['alert']['danger'] = 
					array( 
						'No exite registro ó No puede ser eliminado',				
					);

				$this->load->view($this->controller.'/message',$data);
			}else{
				
				if (empty($data['fecha'])) {
					redirect('reservas/index');
				}

				$this->Reservas_model->reservar();
				
				$data['alert']['success'] = 
				array( 
					'Registrado Correctamente',				
				);

				$this->load->view($this->controller.'/reservar_listar_form',$data);			
			
			}

		}			
	}

	public function error_instalaciones(){
		$data['alert']['danger'] = 
			array( 
				'No exite ninguna instalación para realizar reservaciones',				
			);
		$this->load->view($this->controller.'/message',$data);			
	}

	public function check_fecha()
  	{
      	return $this->Reservas_model->check_fecha();
  	}

  	public function check_seleccion_fechas_1()
  	{
      	return $this->Reservas_model->check_seleccion_fechas_1();
  	}

  	public function check_seleccion_fechas_2()
  	{
      	return $this->Reservas_model->check_seleccion_fechas_2();
  	}

  	public function check_seleccion_fechas_3()
  	{
      	return $this->Reservas_model->check_seleccion_fechas_3();
  	}

  	public function check_seleccion_fechas_4()
  	{
      	return $this->Reservas_model->check_seleccion_fechas_4();
  	}

}