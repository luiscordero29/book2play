<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Administradores extends CI_Controller {

	/**
	 * Administradores.
	 *
	 * autor: Ing. Luis Cordero
	 * site: http://www.luiscordero29.com
	 * mail: info@luiscordero29.com
	 *
	 **/

	public $controller = "administradores";

	public function __construct()
	{
		parent::__construct();		
		$this->load->model('Administradores_model','',TRUE); 
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
		$data['table'] 			= $this->Administradores_model->table($table_page*$table_limit,$table_limit,$data['search']);
		$data['table_rows'] 	= $this->Administradores_model->table_rows($data['search']);
		$data['table_page'] 	= $table_page;
		$data['table_limit'] 	= $table_limit;

		$this->load->view($this->controller.'/index',$data);			
		
	}



	public function create()
	{          
			
		$this->form_validation->set_rules('rus_usuario', 'Usuario', 'trim|required|is_unique[usuarios.rus_usuario]|min_length[6]|max_length[15]|alpha_numeric');
		$this->form_validation->set_rules('rus_clave', 'Clave', 'required');
		$this->form_validation->set_rules('rus_correo', 'Correo', 'trim|valid_email|is_unique[usuarios.rus_correo]');		
		$this->form_validation->set_rules('rus_activo', 'Activo', 'required');

		if($this->form_validation->run() == FALSE)
		{
				
			$this->load->view($this->controller.'/create');		

		}else{

			$this->Administradores_model->create();
				
			$data['alert']['success'] = 
			array( 
				'Registrado Correctamente',				
			);

			$this->load->view($this->controller.'/create',$data);
		}			
	}

	public function view($rus_id=false)
	{			
			
		$data['row'] = $this->Administradores_model->read($rus_id);
		
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

	public function update($rus_id=false)
	{			
			
		$this->form_validation->set_rules('rus_usuario', 'Usuario', 'trim|required|min_length[6]|max_length[15]|alpha_numeric|callback_check_usuario');
		$this->form_validation->set_rules('rus_activo', 'Activo', 'required');
		$this->form_validation->set_rules('rus_correo', 'Correo', 'trim|valid_email|callback_check_correo');					

		$this->form_validation->set_message('check_usuario', 'El campo Usuario ingresado ya se encuentra ocupado.');
		$this->form_validation->set_message('check_correo', 'El campo Correo ingresado ya se encuentra ocupado.');
			

		if($this->form_validation->run() == FALSE)
		{
			$data['row'] = $this->Administradores_model->read($rus_id);
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
				
			$this->Administradores_model->update();
			$data['row'] = $this->Administradores_model->read($rus_id);

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

	public function password($rus_id=false)
	{						

		$this->form_validation->set_rules('pass', 'Contraseña', 'trim|required');
		$this->form_validation->set_rules('veryfi', 'Confirmar Contraseña', 'trim|required|matches[pass]');
			
		if($this->form_validation->run() == FALSE)
		{
			$data['row'] = $this->Administradores_model->read($rus_id);
			if(empty($data['row']))
			{
				$data['alert']['danger'] = 
					array( 
						'No exite registro ó No puede ser eliminado',				
					);

				$this->load->view($this->controller.'/message',$data);
			}else{

				$this->load->view($this->controller.'/password',$data);			
			
			}
		}else{
				
			$this->Administradores_model->password();
			$data['row'] = $this->Administradores_model->read($rus_id);

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
						'Se cambio la clave',				
					);

				$this->load->view($this->controller.'/password',$data);			
			
			}

		}			
	}

	public function delete($rus_id=false)
	{

        if($rus_id===FALSE)
		{
			$data['alert']['danger'] = 
				array( 
					'No exite registro ó No puede ser eliminado',				
				);

			$this->load->view($this->controller.'/delete',$data);			
		}else{
			
			$check = $this->Administradores_model->delete($rus_id);
			
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

	public function check_usuario()
  	{
      	return $this->Administradores_model->check_usuario();
  	}

  	public function check_correo()
  	{
      	return $this->Administradores_model->check_correo();
  	}

}