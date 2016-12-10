<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuenta extends CI_Controller {

	/**
	 * Account.
	 *
	 * autor: Ing. Luis Cordero
	 * site: http://www.luiscordero29.com
	 * mail: info@luiscordero29.com
	 *
	 **/
	
	public $controller = "cuenta";

	public function __construct()
	{
		parent::__construct();		
		$this->load->model('Cuenta_model');
		// Control Sessión
		if(!$this->session->has_userdata('rus_id'))
   		{     						
		    //If no session, redirect to login page
		    redirect('cuenta/salir');

		}
	}

	public function index()
	{
		
	    $data['row'] = $this->Cuenta_model->read();
		$this->load->view($this->controller.'/index',$data);	

	}

	public function update()
	{
		
		$this->form_validation->set_rules('usuario', 'Usuario', 'trim|required|callback_check_usuario');
		$this->form_validation->set_rules('correo', 'Correo', 'trim|required|callback_check_correo|valid_email');

		// message
		$this->form_validation->set_message('check_usuario', 'Usuario Duplicado');
		$this->form_validation->set_message('check_correo', 'Correo Duplicado');
		
		if($this->form_validation->run() == FALSE)
		{
			$data['row'] = $this->Cuenta_model->read();
			$this->load->view($this->controller.'/update',$data);		

		}else{
			$this->Cuenta_model->update();
			$data['alert']['success'] = 
				array( 
					'Guardado Exitosamente',				
				);
			$data['row'] = $this->Cuenta_model->read();    
			$this->load->view($this->controller.'/update',$data);
		}	

	}

	public function password()
	{

		$this->form_validation->set_rules('pass', 'Contraseña', 'trim|required');
		$this->form_validation->set_rules('veryfi', 'Confirmar Contraseña', 'trim|required|matches[pass]');

		if($this->form_validation->run() == FALSE)
		{
			$data['row'] = $this->Cuenta_model->read();
			$this->load->view($this->controller.'/password',$data);		

		}else{
			$this->Cuenta_model->read();
			$data['alert']['success'] = 
				array( 
					'Guardado Exitosamente',				
				);
			$data['row'] = $this->Cuenta_model->password();    
			$this->load->view($this->controller.'/password',$data);
		}	

	}

	public function check_usuario()
  	{
      	return $this->Cuenta_model->check_usuario();
  	}

  	public function check_correo()
  	{
      	return $this->Cuenta_model->check_correo();
  	}

	public function salir()
 	{
	   	$sess_array = array(
		    'rus_id' 		=> '',
		    'rus_tipo' 		=> '',          	
		);

		$this->session->unset_userdata($sess_array);
	   	$this->session->sess_destroy();
	   	
	   	redirect('accesos/index');
 	}

}
