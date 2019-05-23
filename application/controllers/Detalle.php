<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detalle extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library(array('session','form_validation'));
		$this->load->model('boletas_model');
		$this->load->model('vigencias_model');
		$this->load->model('usuario_model');
		$this->load->helper('form');
		$this->load->database('default');
		$this->load->library('encrypt');
	}
	public function index()
	{	
		if (!$this->session->userdata('is_logued_in'))
			redirect('inicio/login','refresh');
		$data = array(
			'boletas' => $this->boletas_model->getBoletas(),
			'tipo'=>0
		);
		$this->load->view('common/header');
		$this->load->view('common/sidebar');
		$this->load->view('admin/listado',$data);
		$this->load->view('common/footer');
	}
	public function listado()
	{	
		if (!$this->session->userdata('is_logued_in'))
			redirect('inicio/login','refresh');
		$data = array(
			'boletas' => $this->boletas_model->getBoletas(),
			'tipo'=>$this->uri->segment(3)
		);
		$this->load->view('common/header');
		$this->load->view('common/sidebar');
		$this->load->view('admin/listado',$data);
		$this->load->view('common/footer');
	}
	public function boleta()
	{	
		if (!$this->session->userdata('is_logued_in'))
			redirect('inicio/login','refresh');
		$data = array(
			'boleta' => $this->boletas_model->getBoleta($this->uri->segment(3)),
			'vigencia' => $this->vigencias_model->getVigencia2($this->uri->segment(3)),
		);
		$this->load->view('common/header');
		$this->load->view('common/sidebar');
		$this->load->view('admin/listado_detalle',$data);
		$this->load->view('common/footer');
	}
	public function formulario()
	{
		if (!$this->session->userdata('is_logued_in'))
			redirect('inicio/login','refresh');
		if ($this->uri->segment(3)) {
			$data = array(
				'boleta' => $this->boletas_model->getBoleta($this->uri->segment(3)),
				'vigencia' => $this->vigencias_model->getVigencia($this->uri->segment(3)),
			);
			$data['tipo'] ='upd';
		}
		else{
			$data['tipo'] ='reg';
		}
		$this->load->view('common/header');
		$this->load->view('common/sidebar');
		$this->load->view('admin/form_boletas', $data);
		$this->load->view('common/footer', $data);
	}
	public function add_boleta(){
		$valores = array(
			'afianzado'=>$this->input->post('afi'),
			'empresa'=>$this->input->post('emp'),
			'ent_financiera'=>$this->input->post('enf'),
			'poliza'=>$this->input->post('npl'),
			'bs'=>$this->input->post('bs'),
			'us'=>$this->input->post('us'),
			'objeto'=>$this->input->post('obj'),
			'obs'=>$this->input->post('obs')
		);
		$resultado = $this->boletas_model->addBoleta($valores);
		if($resultado!=''){
			$valores2 = array(
				'fecha_inicio'=>$this->input->post('ini'),
				'fecha_fin'=>$this->input->post('fin'),
				'id_boleta'=>$resultado,
			);
			$resultado2 = $this->vigencias_model->addVigencia($valores2);
			if ($resultado2!='') {
				redirect(base_url('boleta/formulario/').$resultado,'refresh');
			}
		}
		else
			$this->index();
	}
	public function upd_boleta(){
		$valores = array(
			'id'=>$this->input->post('id_b'),
			'afianzado'=>$this->input->post('afi'),
			'empresa'=>$this->input->post('emp'),
			'ent_financiera'=>$this->input->post('enf'),
			'poliza'=>$this->input->post('npl'),
			'bs'=>$this->input->post('bs'),
			'us'=>$this->input->post('us'),
			'objeto'=>$this->input->post('obj'),
			'obs'=>$this->input->post('obs')
		);
		$resultado = $this->boletas_model->updBoleta($valores);
		if($resultado!=''){
			redirect(base_url('boleta/formulario/').$resultado,'refresh');
		}
		else
			$this->index();
	}
	public function add_vigencia(){
		$valores2 = array(
			'fecha_inicio'=>$this->input->post('ini'),
			'fecha_fin'=>$this->input->post('fin'),
			'id_boleta'=>$this->input->post('id_v'),
		);
		$resultado2 = $this->vigencias_model->addVigencia($valores2);
		if ($resultado2!='') {
			redirect(base_url('boleta/formulario/').$valores2['id_boleta'],'refresh');
		}
	}
	public function upd_vigencia(){
		$valores2 = array(
			'fecha_inicio'=>$this->input->post('iniu'),
			'fecha_fin'=>$this->input->post('finu'),
			'id'=>$this->input->post('id_vu'),
		);
		$resultado2 = $this->vigencias_model->updVigencia($valores2);
		redirect(base_url('boleta/formulario/').$this->input->post('id_bu'),'refresh');
	}
	public function del_vigencia(){
		$valores2 = array(
			'id'=>$this->input->post('id_vue'),
		);
		$resultado2 = $this->vigencias_model->delVigencia($valores2);
		redirect(base_url('boleta/formulario/').$this->input->post('id_bue'),'refresh');
	}
}
