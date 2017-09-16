<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Comunidades extends CI_Controller {

	/**
	 * Comunidades.
	 *
	 * autor: Ing. Luis Cordero
	 * site: http://www.luiscordero29.com
	 * mail: info@luiscordero29.com
	 *
	 **/

	public $controller = "comunidades";

	public function __construct()
	{
		parent::__construct();		
		$this->load->model('Comunidades_model','',TRUE); 
		// Control Sessión
		if(!$this->session->has_userdata('rus_id'))
   		{     						
		    //If no session, redirect to login page
		    redirect('cuenta/salir');

		}
		// Control de Acceso
		if(!($this->session->userdata('rus_tipo')=='ADMIN_GLOBAL'))
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
		$data['table'] 			= $this->Comunidades_model->table($table_page*$table_limit,$table_limit,$data['search']);
		$data['table_rows'] 	= $this->Comunidades_model->table_rows($data['search']);
		$data['table_page'] 	= $table_page;
		$data['table_limit'] 	= $table_limit;

		$this->load->view($this->controller.'/index',$data);			
		
	}

	public function create()
	{          
			
		$this->form_validation->set_rules('rco_nombre', 'Nombre de la Comunidad', 'trim|required');
		$this->form_validation->set_rules('rco_direccion', 'Dirección de la Comunidad', 'trim|required');
		$this->form_validation->set_rules('rco_contacto', 'Persona de Contacto', 'trim|required');		
		$this->form_validation->set_rules('rco_movil', 'Móvil', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('rco_correo', 'Correo', 'trim|valid_email|required');
		$this->form_validation->set_rules('rco_vecinos', 'Número de Vecinos', 'trim|required');
		$this->form_validation->set_rules('rus_id', 'Gestor', 'trim|required|integer');

		$data['res_administradores'] = $this->Comunidades_model->res_administradores();
		
		if($this->form_validation->run() == FALSE)
		{
				
			$this->load->view($this->controller.'/create',$data);		

		}else{

			$this->Comunidades_model->create();
				
			$data['alert']['success'] = 
			array( 
				'Registrado Correctamente',				
			);

			$this->load->view($this->controller.'/create',$data);
		}			
	}

	public function view($rco_id=false)
	{			
			
		$data['row'] = $this->Comunidades_model->read($rco_id);
		
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

	public function update($rco_id=false)
	{			
			
		$this->form_validation->set_rules('rco_nombre', 'Nombre de la Comunidad', 'trim|required');
		$this->form_validation->set_rules('rco_direccion', 'Dirección de la Comunidad', 'trim|required');
		$this->form_validation->set_rules('rco_contacto', 'Persona de Contacto', 'trim|required');		
		$this->form_validation->set_rules('rco_movil', 'Móvil', 'trim|required|is_natural_no_zero');
		$this->form_validation->set_rules('rco_correo', 'Correo', 'trim|valid_email|required');
		$this->form_validation->set_rules('rco_vecinos', 'Número de Vecinos', 'trim|required');
		$this->form_validation->set_rules('rus_id', 'Gestor', 'trim|required|integer');
			
		
		if($this->form_validation->run() == FALSE)
		{
			$data['row'] = $this->Comunidades_model->read($rco_id);
			$data['res_administradores'] = $this->Comunidades_model->res_administradores();
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
				
			$this->Comunidades_model->update();
			$data['row'] = $this->Comunidades_model->read($rco_id);
			$data['res_administradores'] = $this->Comunidades_model->res_administradores();
			
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

	public function delete($rco_id=false)
	{

        if($rco_id===FALSE)
		{
			$data['alert']['danger'] = 
				array( 
					'No exite registro ó No puede ser eliminado',				
				);

			$this->load->view($this->controller.'/delete',$data);			
		}else{
			
			$check = $this->Comunidades_model->delete($rco_id);
			
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

}