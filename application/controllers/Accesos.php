<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accesos extends CI_Controller {

	/**
	 * Accesos.
	 *
	 * autor: Ing. Luis Cordero
	 * site: http://www.luiscordero29.com
	 * mail: info@luiscordero29.com
	 *
	 **/
	
	public $controller = "accesos";

	public function __construct()
	{
		parent::__construct();		
		$this->load->model('Accesos_model');

		if($this->session->has_userdata('rus_id'))
   		{     						
		    //If no session, redirect to login page
		    redirect('panel', 'refresh');
	
		}
	}

	public function index()
	{
		// rules
		$this->form_validation->set_rules('usuario', 'Usuario', 'required');
		$this->form_validation->set_rules('clave', 'Contraseña', 'required|callback_check_activo|callback_check_usuario|callback_check_clave|callback_check_session');
		// message
		$this->form_validation->set_message('check_activo', 'Sin acceso');
		$this->form_validation->set_message('check_usuario', 'El usuario no existe');
		$this->form_validation->set_message('check_clave', 'Contraseña invalida');
		$this->form_validation->set_message('check_session', 'No tiene acceso temporalmente');
		// views
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view($this->controller.'/index');	
		}
		else
		{			
	        redirect('panel', 'refresh');	     
		}
	}

	public function check_activo()
	{
	    return $this->Accesos_model->check_activo();
	}

	public function check_usuario()
	{
	    return $this->Accesos_model->check_usuario();
	}

	public function check_clave()
	{
	    return $this->Accesos_model->check_clave();
	}

	public function check_session()
	{
	     
	    $result = $this->Accesos_model->check_session();

	    if($result)
	    { 
		    $sess_array = array(
		        'rus_id' 		=> $result['rus_id'],
		        'rus_tipo' 		=> $result['rus_tipo'],	
		    );
		    
	        $this->session->set_userdata($sess_array);
	      	return true;
	    }else{
	      	return false;
	    }
	}
}
