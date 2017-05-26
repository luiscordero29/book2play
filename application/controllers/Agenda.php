<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Agenda extends CI_Controller {

	/**
	 * Agenda.
	 *
	 * autor: Ing. Luis Cordero
	 * site: http://www.luiscordero29.com
	 * mail: info@luiscordero29.com
	 *
	 **/

	public $controller = "agenda";

	public function __construct()
	{
		parent::__construct();		
		$this->load->model('Agenda_model','',TRUE); 
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
		$data['table'] 			= $this->Agenda_model->table($table_page*$table_limit,$table_limit,$data['search']);
		$data['table_rows'] 	= $this->Agenda_model->table_rows($data['search']);
		$data['table_page'] 	= $table_page;
		$data['table_limit'] 	= $table_limit;

		$this->load->view($this->controller.'/index',$data);			
		
	}

	public function delete($rre_id=false,$fecha=false,$hora=false)
	{

        if($rre_id===FALSE)
		{
			$data['alert']['danger'] = 
				array( 
					'No exite registro ó No puede ser eliminado',				
				);

			$this->load->view($this->controller.'/delete',$data);			
		}else{
			
			$check = $this->Agenda_model->delete($rre_id);
			
			if($check)
		    {
		        $data['alert']['success'] = 
				array( 
					'Reserva Eliminado Correctamente',				
				);
		    }
		    else
		    {         
		        $data['alert']['danger'] = 
				array( 
					'No puede Anular esta reserva',				
				);
		    }
				
			$this->load->view($this->controller.'/delete',$data);
		}			
			
	}

	function fechas(){
		$ahora = date('Y-m-d H:i:s');
		echo $ahora.'-----';
		$datetime1 = new DateTime('2017-04-27 19:15:15');
		$datetime2 = new DateTime($ahora);
		//echo $datetime2;
		$interval = $datetime1->diff($datetime2);
		echo $interval->format('%r%a%h Dias');
	}

}