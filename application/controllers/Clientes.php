<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Clientes extends CI_Controller {

	/**
	 * Clientes.
	 *
	 * autor: Ing. Luis Cordero
	 * site: http://www.luiscordero29.com
	 * mail: info@luiscordero29.com
	 *
	 **/

	public $controller = "clientes";

	public function __construct()
	{
		parent::__construct();		
		$this->load->model('Clientes_model','',TRUE); 
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
		$data['table'] 			= $this->Clientes_model->table($table_page*$table_limit,$table_limit,$data['search']);
		$data['table_rows'] 	= $this->Clientes_model->table_rows($data['search']);
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
		$this->form_validation->set_rules('rcl_dni', 'DNI', 'trim|required|is_unique[clientes.rcl_dni]|callback_vdni',
				array('is_unique' => 'El DNI introducido ya está registrado')
			);
		$this->form_validation->set_rules('rcl_apellidos', 'Apellidos', 'trim|required');
		$this->form_validation->set_rules('rcl_nombres', 'Nombres', 'trim|required');
		$this->form_validation->set_rules('rcl_movil', 'Móvil', 'trim');
		$this->form_validation->set_rules('rcl_bloque', 'Bloque', 'trim');
		$this->form_validation->set_rules('rcl_portal', 'Portal', 'trim');
		$this->form_validation->set_rules('rcl_piso', 'Piso', 'trim');
		$this->form_validation->set_rules('rcl_letra', 'Letra', 'trim');
		# messages
		$this->form_validation->set_message('vdni', 'DNI No Valido');


		if($this->form_validation->run() == FALSE)
		{
				
			$this->load->view($this->controller.'/create');		

		}else{

			$this->Clientes_model->create();
				
			$data['alert']['success'] = 
			array( 
				'Registrado Correctamente',				
			);

			$this->load->view($this->controller.'/create',$data);
		}			
	}

	public function view($rco_id=false)
	{			
			
		$data['row'] = $this->Clientes_model->read($rco_id);
		
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
			
		$this->form_validation->set_rules('rus_usuario', 'Usuario', 'trim|required|min_length[6]|max_length[15]|alpha_numeric|callback_check_usuario');
		$this->form_validation->set_rules('rus_clave', 'Clave', 'required');
		$this->form_validation->set_rules('rus_activo', 'Activo', 'required');
		$this->form_validation->set_rules('rus_correo', 'Correo', 'trim|valid_email|callback_check_correo');					
		$this->form_validation->set_rules('rcl_dni', 'DNI', 'trim|required|callback_check_dni|callback_vdni');
		$this->form_validation->set_rules('rcl_apellidos', 'Apellidos', 'trim|required');
		$this->form_validation->set_rules('rcl_nombres', 'Nombres', 'trim|required');
		$this->form_validation->set_rules('rcl_movil', 'Móvil', 'trim');
		$this->form_validation->set_rules('rcl_bloque', 'Bloque', 'trim');
		$this->form_validation->set_rules('rcl_portal', 'Portal', 'trim');
		$this->form_validation->set_rules('rcl_piso', 'Piso', 'trim');
		$this->form_validation->set_rules('rcl_letra', 'Letra', 'trim');
		# messages
		$this->form_validation->set_message('vdni', 'DNI No Valido');
		$this->form_validation->set_message('check_dni', 'El DNI introducido ya está registrado');
		$this->form_validation->set_message('check_usuario', 'El campo Usuario ingresado ya se encuentra ocupado.');
		$this->form_validation->set_message('check_correo', 'El campo Correo ingresado ya se encuentra ocupado.');
			

		if($this->form_validation->run() == FALSE)
		{
			$data['row'] = $this->Clientes_model->read($rco_id);
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
				
			$this->Clientes_model->update();
			$data['row'] = $this->Clientes_model->read($rco_id);

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
			
			$check = $this->Clientes_model->delete($rus_id);
			
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
      	return $this->Clientes_model->check_usuario();
  	}

  	public function check_dni()
  	{
      	return $this->Clientes_model->check_dni();
  	}

  	public function check_correo()
  	{
      	return $this->Clientes_model->check_correo();
  	}

  	public function vdni()
	{
	    return $this->Clientes_model->dni();
	}

}