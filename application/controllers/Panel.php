<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends CI_Controller {

	/**
	 * Panel.
	 *
	 * autor: Ing. Luis Cordero
	 * site: http://www.luiscordero29.com
	 * mail: info@luiscordero29.com
	 *
	 **/
	
	public $controller = "panel";

	public function __construct()
	{
		parent::__construct();		
		$this->load->model('Panel_model','',TRUE); 
		// Control Sessión
		if(!$this->session->has_userdata('rus_id'))
   		{     						
		    //If no session, redirect to login page
		    redirect('cuenta/salir');
	
		}

		# ADMIN COMUNIDAD
		if ($this->session->userdata('rus_tipo') == 'ADMIN_COMUNIDAD') {
			if (!$this->Panel_model->admin_comunidad()) {
				redirect('cuenta/salir');
			}
		}
	}

	public function index()
	{
		$data['breadcrumbs'] = 
			array(
	            '<i class="fa fa-fw fa-home"></i> Tablero Principal'			=> 'dashboard/index',
	            'Panel de Control'		=> '',        	
	        );
        /*$data['usuarios'] = $this->Dashboard_model->contar_usuarios();
	    $data['comunidades'] = $this->Dashboard_model->contar_comunidades();
	    $data['instalaciones'] = $this->Dashboard_model->contar_instalaciones();*/

		$this->load->view($this->controller.'/index',$data);	

	}

	public function backup()
	{
		if($this->session->userdata('tipo')==='ADMIN_GLOBAL')
   		{

   			$prefs = array(
                'format'      => 'txt',             // gzip, zip, txt
                'filename'    => 'backup-'.date("Y-m-d_H-m-s").'.sql',    // File name - NEEDED ONLY WITH ZIP FILES
                'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
                'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
                'newline'     => "\n"               // Newline character used in backup file
              );

   			$this->load->dbutil();

   			// Backup your entire database and assign it to a variable
			$backup =& $this->dbutil->backup($prefs);

			// Load the file helper and write the file to your server
			$this->load->helper('file');
			write_file('./assets/uploads/backup/backup-'.date("Y-m-d_H-m-s").'.sql', $backup);

			// Load the download helper and send the file to your desktop
			$this->load->helper('download');
			force_download('backup-'.date("Y-m-d_H-m-s").'.sql', $backup);         
	        
	    }
	   	else
	   	{
	     	//If no session, redirect to login page
	     	redirect('login', 'refresh');
	   	}

	}

}
