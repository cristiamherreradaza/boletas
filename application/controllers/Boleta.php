<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//verificar cambios
class Boleta extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library(array('session','form_validation'));
		$this->load->model('boletas_model');
		$this->load->model('vigencias_model');
		$this->load->model('usuario_model');
		$this->load->helper('form');
		$this->load->database('default');
		$this->load->library('encrypt');
		$this->load->library('user_agent');
		$this->load->helper('vayes_helper');
	}
	public function index(){
		if (!$this->session->userdata('is_logued_in'))
			redirect('inicio/login','refresh');
		$data =array(
			'tipo'=>'reg'
		);
		$this->load->view('common/header');
		$this->load->view('common/sidebar');
		$this->load->view('admin/form_boletas', $data);
		$this->load->view('common/footer', $data);
	}
	public function formulario(){
		if (!$this->session->userdata('is_logued_in'))
			redirect('inicio/login','refresh');
		if ($this->uri->segment(3)) {
			if($this->uri->segment(4)!='no'){
				$data = array(
					'boleta' => $this->boletas_model->getBoleta($this->uri->segment(3)),
					'vigencia' => $this->vigencias_model->getVigencia2($this->uri->segment(3)),
				);
			}
			else{
				$data = array(
					'boleta' => $this->vigencias_model->getVigencia($this->uri->segment(3)),
					'vigencia' => 'no',
				);	
			}
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
		$pdf = '';
		$conf_file = array(
			'upload_path' => './assets/respaldo',
			'allowed_types'	=> 'pdf',
			'encrypt_name' => true
		);
		$this->load->library('upload',$conf_file);
		if($this->upload->do_upload("res")){
			$data = array('upload_data' => $this->upload->data());
			$pdf = $data['upload_data']['file_name'];
		}
		$valores = array(
			'tipo'=>$this->input->post('tipo'),
			'categoria'=>$this->input->post('cat'),
			'afianzado'=>$this->input->post('afi'),
			'empresa'=>$this->input->post('emp'),
			'ent_financiera'=>$this->input->post('enf'),
			'codigo'=>$this->input->post('npl'),
			'monto'=>$this->input->post('bs'),
			'moneda'=>$this->input->post('moneda'),
			'objeto'=>$this->input->post('obj'),
			'obs'=>$this->input->post('obs'),
			'inicio'=>$this->input->post('ini'),
			'respaldo'=> $pdf,
			'fin'=>$this->input->post('fin')
		);
		if($this->input->post('id')=='no'){
			$resultado = $this->boletas_model->addBoleta($valores);
			if($resultado!=''){
				redirect(base_url('boleta/formulario/').$resultado,'refresh');
			}
		}
		else{
			$valores['id_boleta']=$this->input->post('id');
			$resultado = $this->vigencias_model->addVigencia($valores);
			if($resultado!='')
				redirect(base_url('boleta/formulario/').$resultado,'refresh');
		}
		if($resultado!=''){
			if ($resultado2!='') {
				redirect(base_url('boleta/formulario/').$resultado,'refresh');
			}
		}
		else
			$this->index();
	}
	public function upd_boleta(){
		$pdf = '';
		$conf_file = array(
			'upload_path' => './assets/respaldo',
			'allowed_types'	=> 'pdf',
			'encrypt_name' => true
		);
		$this->load->library('upload',$conf_file);
		if($this->upload->do_upload("res")){
			$data = array('upload_data' => $this->upload->data());
			$pdf = $data['upload_data']['file_name'];
		}
		$valores = array(
			'id'=>$this->input->post('id_b'),
			'tipo'=>$this->input->post('tipo'),
			'categoria'=>$this->input->post('cat'),
			'afianzado'=>$this->input->post('afi'),
			'empresa'=>$this->input->post('emp'),
			'ent_financiera'=>$this->input->post('enf'),
			'codigo'=>$this->input->post('npl'),
			'monto'=>$this->input->post('bs'),
			'moneda'=>$this->input->post('moneda'),
			'objeto'=>$this->input->post('obj'),
			'obs'=>$this->input->post('obs'),
			'inicio'=>$this->input->post('ini'),
			'respaldo'=>$pdf,
			'fin'=>$this->input->post('fin')
		);
		$resultado = $this->boletas_model->updBoleta($valores);
		if($resultado!=''){
			redirect(base_url('boleta/formulario/').$resultado,'refresh');
		}
		else
			$this->index();
	}
	public function del_boleta(){
		$resultado = $this->boletas_model->delBoleta($this->uri->segment(3));
		redirect($this->agent->referrer());
	}
	public function lib_boleta(){
		$resultado = $this->boletas_model->libBoleta($this->uri->segment(3));
		redirect($this->agent->referrer());
	}
	public function add_vigencia(){
		if (!$this->session->userdata('is_logued_in'))
			redirect('inicio/login','refresh');
		$data =array(
			'tipo'=>'reg',
			'id'=>$this->input->post('id_v'),
			'boleta' => $this->boletas_model->getBoleta($this->input->post('id_v')),
		);
		$this->load->view('common/header');
		$this->load->view('common/sidebar');
		$this->load->view('admin/form_boletas', $data);
		$this->load->view('common/footer', $data);
	}
	public function add_vigencia1(){
		$valores2 = array(
			'fecha_inicio'=>$this->input->post('ini'),
			'fecha_fin'=>$this->input->post('fin'),
			'id_boleta'=>$this->input->post('id_v'),
		);
		$resultado2 = $this->vigencias_model->addVigencia($valores2);
		if ($resultado2!='') {
			redirect(base_url('detalle'),'refresh');
		}
	}
	public function upd_vigencia(){
		$pdf = '';
		$conf_file = array(
			'upload_path' => './assets/respaldo',
			'allowed_types'	=> 'pdf',
			'encrypt_name' => true
		);
		$this->load->library('upload',$conf_file);
		if($this->upload->do_upload("res")){
			$data = array('upload_data' => $this->upload->data());
			$pdf = $data['upload_data']['file_name'];
		}
		$valores2 = array(
			'id'=>$this->input->post('id_b'),
			'tipo'=>$this->input->post('tipo'),
			'categoria'=>$this->input->post('cat'),
			'afianzado'=>$this->input->post('afi'),
			'empresa'=>$this->input->post('emp'),
			'ent_financiera'=>$this->input->post('enf'),
			'codigo'=>$this->input->post('npl'),
			'monto'=>$this->input->post('bs'),
			'moneda'=>$this->input->post('moneda'),
			'objeto'=>$this->input->post('obj'),
			'obs'=>$this->input->post('obs'),
			'inicio'=>$this->input->post('ini'),
			'respald'=>$pdf,
			'fin'=>$this->input->post('fin')
		);
		$resultado2 = $this->vigencias_model->updVigencia($valores2);
		redirect(base_url('boleta/formulario/').$resultado2.'/no','refresh');
	}
	public function del_vigencia(){
		$valores2 = array(
			'id'=>$this->input->post('id_vue'),
		);
		$resultado2 = $this->vigencias_model->delVigencia($valores2);
		redirect(base_url('boleta/formulario/').$this->input->post('id_bue'),'refresh');
	}

	public function holas(){
		echo 'Holas desde code';
	}

	protected function envia(){

		$this->load->library("phpmailer_library");
		$mail = $this->phpmailer_library->load();

		date_default_timezone_set('Etc/UTC');
		$mail->isSMTP();
		$mail->SMTPDebug = 0;
		$mail->Debugoutput = 'html';
		$mail->Host = "mail.oopp.gob.bo";
		$mail->Port = 25;
		$mail->SMTPAuth = true;
		$mail->Username = "cristiam.herrera@oopp.gob.bo";
		$mail->Password = "450748";
		$mail->setFrom('cristiam.herrera@oopp.gob.bo', 'Cristiam Demo');
		$mail->addAddress('cristiam.herrera@oopp.gob.bo', 'Crt');
		$mail->Subject = 'Esta es la prueba de que envia';
		$mail->Body = 'Este es el cuerpo de muestra';
		$mail->AltBody = 'Este es el mensaje';
		// if (!$mail->send()) {
		// 	echo "Mailer Error: " . $mail->ErrorInfo;
		// } else {
		// 	echo "Mensaje enviado!";
		// }

		//$this->load->library('PHPMailerAutoload');
	}

	public function envia_correos(){

	if (!$this->session->userdata('is_logued_in')) {
		redirect('inicio/login', 'refresh');
	}

	$vencidos = array('boletas' => $this->boletas_model->getBoletas());	
	// vdebug($vencidos['boletas'], false, false, true);\
	foreach ($vencidos['boletas'] as $v) {

		// vdebug($v, false, false, true);
		if ($v->dif2 == 15 || $v->dif1 == 15) {
			echo 'hay';
		}elseif($v->dif2 == 10 || $v->dif1 == 10) {
			echo 'no';
		}elseif($v->dif2 == 5 || $v->dif1 == 5){
			echo 'maso';
		}
	}
	
	die();

	// $this->load->view('common/header');
	// $this->load->view('common/sidebar');
	// $this->load->view('admin/listado', $data);
	// $this->load->view('common/footer');

	}
}
