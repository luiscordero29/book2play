<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Instalaciones extends CI_Controller {

	/**
	 * Instalaciones.
	 *
	 * autor: Ing. Luis Cordero
	 * site: http://www.luiscordero29.com
	 * mail: info@luiscordero29.com
	 *
	 **/

	public $controller = "instalaciones";

	public function __construct()
	{
		parent::__construct();		
		$this->load->model('Instalaciones_model','',TRUE); 
		// Control Sessión
		if(!$this->session->has_userdata('rus_id'))
   		{     						
		    //If no session, redirect to login page
		    redirect('cuenta/salir');

		}
		// Control de Acceso
		if(!($this->session->userdata('rus_tipo')=='ADMIN_COMUNIDAD'))
   		{     						
		    //If no session, redirect to login page
		    redirect('cuenta/salir');
		    
		}
	}
		

	public function index($table_page=null,$id=null,$search=null)
	{
						
		$table_limit = 30;
		$table_page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;		

		$s = trim($this->input->post('s'));
		$search = trim($search);
		if(!empty($s)){
			$data['search'] = $s;
			$data['search_url'] = '/'.$s;					
		}elseif(!empty($search)){
			$data['search'] = urldecode($search);
			$data['search_url'] = '/'.$search;
		}else{
			$data['search'] = $s;
			$data['search_url'] = '';
		}

		$data['controller'] 	= $this->controller;				
		$data['table'] 			= $this->Instalaciones_model->table($table_page*$table_limit,$table_limit,$data['search']);
		$data['table_rows'] 	= $this->Instalaciones_model->table_rows($data['search']);
		$data['table_page'] 	= $table_page;
		$data['table_limit'] 	= $table_limit;

		$this->load->view($this->controller.'/index',$data);			
		
	}



	public function create()
	{          
			
		$this->form_validation->set_rules('rin_nombre', 'Nombre de la Propiedad', 'trim|required');
		$this->form_validation->set_rules('rin_activo', 'Activo', 'required');
		$this->form_validation->set_rules('rin_numero', 'Número reservas al día por usuario', 'trim|required|is_natural_no_zero');		
		$this->form_validation->set_rules('rin_tipo', 'Tipo', 'required');
		$this->form_validation->set_rules('rin_duracion', 'Duración', 'trim|required|is_natural_no_zero|callback_check_duracion');
		$this->form_validation->set_rules('rin_hora_inicio', 'Hora Inicio', 'trim|required');
		$this->form_validation->set_rules('rin_hora_fin', 'Hora Fin', 'trim|required|differs[rin_hora_inicio]|callback_check_hora');
		$this->form_validation->set_rules('rin_antelacion', 'Días de Antelación', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('rin_anulacion', 'Horas de Anulación', 'trim|required|is_natural_no_zero');
		# messages
		$this->form_validation->set_message('check_duracion', 'La duración de la reserva no es correspondiente al Tipo');
		$this->form_validation->set_message('check_hora', 'La Hora Final debe ser superior a la Hora Inicial');

		if($this->form_validation->run() == FALSE)
		{
				
			$this->load->view($this->controller.'/create');		

		}else{

			$this->Instalaciones_model->create();
				
			$data['alert']['success'] = 
			array( 
				'Registrado Correctamente',				
			);

			$this->load->view($this->controller.'/create',$data);
		}			
	}

	public function update($rin_id=false)
	{			
			
		$this->form_validation->set_rules('rin_nombre', 'Nombre de la Propiedad', 'trim|required');
		$this->form_validation->set_rules('rin_activo', 'Activo', 'required');
		$this->form_validation->set_rules('rin_numero', 'Número reservas al día por usuario', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('rin_antelacion', 'Días de Antelación', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('rin_anulacion', 'Horas de Anulación', 'trim|required|is_natural_no_zero');

		if($this->form_validation->run() == FALSE)
		{
			$data['row'] = $this->Instalaciones_model->read($rin_id);
			if(empty($data['row']))
			{
				$data['alert']['danger'] = 
					array( 
						'No exite registro ó No puede ser eliminado',				
					);

				$this->load->view($this->controller.'/message',$data);
			}else{

				$this->load->view($this->controller.'/update',$data);			
			
			}
		}else{
				
			$this->Instalaciones_model->update();
			$data['row'] = $this->Instalaciones_model->read($rin_id);

			if(empty($data['row']))
			{
				$data['alert']['danger'] = 
					array( 
						'No exite registro ó No puede ser eliminado',				
					);

				$this->load->view($this->controller.'/message',$data);
			}else{

				$data['alert']['success'] = 
					array( 
						'Registrado Correctamente',				
					);

				$this->load->view($this->controller.'/update',$data);			
			
			}

		}			
	}

	public function clock($rin_id=false)
	{			
			
		$this->form_validation->set_rules('rin_tipo', 'Tipo', 'required');
		$this->form_validation->set_rules('rin_duracion', 'Duración', 'trim|required|is_natural_no_zero|callback_check_duracion');
		$this->form_validation->set_rules('rin_hora_inicio', 'Hora Inicio', 'trim|required');
		$this->form_validation->set_rules('rin_hora_fin', 'Hora Fin', 'trim|required|differs[rin_hora_inicio]|callback_check_hora');
		# messages
		$this->form_validation->set_message('check_duracion', 'La duración de la reserva no es correspondiente al Tipo');
		$this->form_validation->set_message('check_hora', 'La Hora Final debe ser superior a la Hora Inicial');

		$data['alert']['info'] = 
			array( 
				'Al cambiar el horario se perderan las reservaciones anteriores',				
			);
			
		if($this->form_validation->run() == FALSE)
		{
			$data['row'] = $this->Instalaciones_model->read($rin_id);
			if(empty($data['row']))
			{
				$data['alert']['danger'] = 
					array( 
						'No exite registro ó No puede ser eliminado',				
					);

				$this->load->view($this->controller.'/message',$data);
			}else{

				$this->load->view($this->controller.'/clock',$data);			
			
			}
		}else{
				
			$this->Instalaciones_model->clock();
			$data['row'] = $this->Instalaciones_model->read($rin_id);

			if(empty($data['row']))
			{
				$data['alert']['danger'] = 
					array( 
						'No exite registro ó No puede ser eliminado',				
					);

				$this->load->view($this->controller.'/message',$data);
			}else{

				$data['alert']['success'] = 
					array( 
						'Registrado Correctamente',				
					);

				$this->load->view($this->controller.'/clock',$data);			
			
			}

		}			
	}

	public function view($rin_id=false)
	{			
			
		$data['row'] = $this->Instalaciones_model->read($rin_id);
		
		if(empty($data['row']))
		{
			$data['alert']['danger'] = 
				array( 
					'No exite registro ó No puede ser eliminado',				
				);

			$this->load->view($this->controller.'/message',$data);
		
		}else{

			$this->load->view($this->controller.'/view',$data);
		
		}
			
	}

	public function delete($rin_id=false)
	{

        if($rin_id===FALSE)
		{
			$data['alert']['danger'] = 
				array( 
					'No exite registro ó No puede ser eliminado',				
				);

			$this->load->view($this->controller.'/delete',$data);			
		}else{
			
			$check = $this->Instalaciones_model->delete($rin_id);
			
			if($check)
		    {
		        $data['alert']['success'] = 
				array( 
					'Registro Eliminado Correctamente',				
				);
		    }
		    else
		    {         
		        $data['alert']['danger'] = 
				array( 
					'No exite registro ó No puede ser eliminado',				
				);
		    }
				
			$this->load->view($this->controller.'/delete',$data);
		}			
			
	}

	public function check_duracion()
  	{
      	return $this->Instalaciones_model->check_duracion();
  	}

  	public function check_hora()
  	{
      	return $this->Instalaciones_model->check_hora();
  	}

}