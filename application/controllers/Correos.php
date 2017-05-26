<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Correos extends CI_Controller {

	/**
	 * Correos.
	 *
	 * autor: Ing. Luis Cordero
	 * site: http://www.luiscordero29.com
	 * mail: info@luiscordero29.com
	 *
	 **/

	function protocol_mail (){
		# REQUERIMIENTOS
		$this->load->library('email');
		$this->load->helper('email');
		#CONFIGURACION
		$config['protocol'] = 'mail';
		$config['useragent'] = 'book2play';
		$config['priority'] = '1';
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		#ENVIO
		$this->email->to('miguel@webactual.com');
		$this->email->bcc('miguel@webactual.com ');
		$this->email->bcc('info@luiscordero29.com ');
		$this->email->from('info@book2play.es');
		$this->email->subject('TEST MAIL');
		$this->email->message('TEST FOR CONTENT');
		$this->email->send();
		echo $this->email->print_debugger();
	}

	function protocol_sendmail (){
		# REQUERIMIENTOS
		$this->load->library('email');
		$this->load->helper('email');
		#CONFIGURACION
		$config['protocol'] = 'sendmail';
		$config['useragent'] = 'book2play';
		$config['priority'] = '1';
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		#ENVIO
		$this->email->to('miguel@webactual.com');
		$this->email->bcc('miguel@webactual.com ');
		$this->email->bcc('info@luiscordero29.com ');
		$this->email->from('info@book2play.es');
		$this->email->subject('TEST SENDMAIL');
		$this->email->message('TEST FOR CONTENT');
		$this->email->send();
		echo $this->email->print_debugger();
	}

	function protocol_smtp (){
		# REQUERIMIENTOS
		$this->load->library('email');
		$this->load->helper('email');
		#CONFIGURACION
		$config['protocol'] = 'smtp';
		$config['useragent'] = 'book2play';
		$config['priority'] = '1';
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$config['smtp_host'] = 'euro1.ahwebhost.com';
		$config['smtp_user'] = 'info@book2play.es';
		$config['smtp_pass'] = 'dJgw#x=R&!]p?b)=5q';
		$config['smtp_port'] = '465';
		$config['smtp_timeout'] = '5';
		$config['smtp_keepalive'] = 'true';
		$config['smtp_crypto'] = 'ssl'; //tls or ssl
		$this->email->initialize($config);
		#ENVIO
		$this->email->to('miguel@webactual.com');
		$this->email->bcc('miguel@webactual.com ');
		$this->email->bcc('info@luiscordero29.com ');
		$this->email->from('info@book2play.es', 'www.book2play.es');
		//$this->email->reply_to('you@example.com', 'Your Name');
		$this->email->subject('TEST SMTP');
		$this->email->message('TEST FOR CONTENT');
		$this->email->send();
		echo $this->email->print_debugger();
	}



}
