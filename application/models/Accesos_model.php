<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Accesos_model extends CI_MODEL
{
	public function __construct()
	{
		parent::__construct();
	}

	public function check_restaurar()
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
		$this->load->library('email');
		$this->load->helper('email');
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'mail.book2play.es';
		$config['smtp_user'] = 'info@book2play.es';
		$config['smtp_pass'] = 'dJgw#x=R&!]p?b)=5q';
		$config['smtp_port'] = '25';
		$config['charset'] = 'iso-8859-1';
		$config['mailtype'] = 'html';
		$this->email->initialize($config);

		// sent mail 
		$text = '<h2>DATOS DE ACCESO</h2>';
		$text .= '<p><b>USUARIO:</b> '.$row['rus_usuario'].'</p>';
		$text .= '<p><b>CLAVE:</b> '.$pass.'</p>';

		$this->email->to($rus_correo);
		$this->email->bcc('miguel@webactual.com ');
		$this->email->bcc('info@luiscordero29.com ');
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