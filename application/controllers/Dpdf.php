<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dpdf extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library(array('session','form_validation'));
		$this->load->model('boletas_model');
		$this->load->model('vigencias_model');
		$this->load->helper('form');
		$this->load->database('default');
		$this->load->library('encrypt');
	}
	public function index() {	
		if (!$this->session->userdata('is_logued_in'))
			redirect('inicio/login','refresh');
		$data = array(
			'boletas' => $this->boletas_model->getBoletas(),
		);
		$this->load->view('pdf/pdf',$data);
		// Get output html
		/**/
		$html = $this->output->get_output();
		$this->load->library('dompdf_gen');
		$this->dompdf->load_html($html);
		$this->dompdf->set_paper('letter','landscape');
		$this->dompdf->render();
		$now = new DateTime('now'); 
		$this->dompdf->stream($now->format('d_m_Y'),array("Attachment"=>0));
		
	}
	public function pdf() {	
		if (!$this->session->userdata('is_logued_in'))
			redirect('inicio/login','refresh');
		$data = array(
			'boletas' => $this->boletas_model->getBoletas(),
		);
		$this->load->view('pdf/pdf',$data);
	}
	public function detalle() {	
		if (!$this->session->userdata('is_logued_in'))
			redirect('inicio/login','refresh');
		$data = array(
			'boleta' => $this->boletas_model->getBoleta($this->uri->segment(3)),
			'vigencia' => $this->vigencias_model->getVigencia($this->uri->segment(3)),
		);
		$this->load->view('pdf/lista_detalle',$data);
		$html = $this->output->get_output();
		// Load library
		$this->load->library('dompdf_gen');
		$this->dompdf->load_html($html);
		$this->dompdf->set_paper('letter','portrait');
		$this->dompdf->render();
		$now = new DateTime('now'); 
		$this->dompdf->stream($now->format('d_m_Y'),array("Attachment"=>0));
	}
}
