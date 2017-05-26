<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Accesos_model extends CI_MODEL
{
	public function __construct()
	{
		parent::__construct();
	}

	public function restaurar()
 	{
	    $rus_correo = $this->input->post('email');
	    $query = $this->db->get_where('usuarios', array('rus_correo' => $rus_correo));
	    $row = $query->row_array();
	    $pass = rand(1000, 9999);

	    $data = array(
		 	'rus_clave' 		=> md5($pass),  
		);
			
		$this->db->where('rus_correo', $rus_correo);
		$this->db->update('usuarios', $data);

		# ENVIO DE CORREO
		# REQUERIMIENTOS
		$this->load->library('email');
		$this->load->helper('email');
		#CONFIGURACION
		$config['protocol'] = 'smtp';
		$config['useragent'] = 'book2play';
		$config['priority'] = '1';
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$config['smtp_host'] = '';
		$config['smtp_user'] = '';
		$config['smtp_pass'] = '';
		$config['smtp_port'] = '465';
		$config['smtp_timeout'] = '5';
		$config['smtp_keepalive'] = 'true';
		$config['smtp_crypto'] = 'ssl';
		$this->email->initialize($config);
		#ENVIO
		$text = '<h2>DATOS DE ACCESO</h2>';
		$text .= '<p><b>USUARIO:</b> '.$row['rus_usuario'].'</p>';
		$text .= '<p><b>CLAVE:</b> '.$pass.'</p>';
		$this->email->to($rus_correo);
		$this->email->bcc('miguel@webactual.com ');
		$this->email->from('info@book2play.es');
		$this->email->subject('RESTAURAR USUARIO');
		$this->email->message($text);
		$this->email->send();
			
		return true;
 	}

	public function check_mail()
 	{
	    $rus_correo = $this->input->post('email');
	    $query = $this->db->get_where('usuarios', array('rus_correo' => $rus_correo));

	    if($query->num_rows() > 0)
	    {
	    	return true;
	    }
	    else
	    {
	    	return false;
	    }
 	}

	public function check_clave()
 	{
	    $usuario = $this->input->post('usuario');
	    $clave = md5($this->input->post('clave'));
	    $this->db->select('rus_id');
	    $query = $this->db->get_where('usuarios', array('rus_usuario' => $usuario,'rus_clave' => $clave));

	    if($query->num_rows() > 0)
	    {
	    	return true;
	    }
	    else
	    {
	    	return false;
	    }
 	}

 	public function check_usuario()
 	{
	    $usuario = $this->input->post('usuario');
	    $this->db->select('rus_id');
	    $query = $this->db->get_where('usuarios', array('rus_usuario' => $usuario));

	    if($query->num_rows() > 0)
	    {
	    	return true;
	    }
	    else
	    {
	    	return false;
	    }
 	}

 	public function check_activo()
 	{
	    $usuario = $this->input->post('usuario');
	    $this->db->select('rus_id');
	    $query = $this->db->get_where('usuarios', array('rus_usuario' => $usuario, 'rus_activo' => 'SI'));

	    if($query->num_rows() > 0)
	    {
	    	return true;
	    }
	    else
	    {
	    	return false;
	    }
 	}

 	public function check_session()
 	{
	    
	    $usuario = $this->input->post('usuario');
	    $clave = md5($this->input->post('clave'));
	    $this->db->select('rus_id, rus_tipo');
	    $query = $this->db->get_where('usuarios', array('rus_usuario' => $usuario,'rus_clave' => $clave));

	    if($query->num_rows() > 0)
	    {
	    	return $query->row_array();
	    }
	    else
	    {
	    	return false;
	    }
 	}

}