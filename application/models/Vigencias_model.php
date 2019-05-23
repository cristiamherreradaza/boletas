<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vigencias_model extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->model('boletas_model');
	}
	function addVigencia($value){
		$bol = $this->boletas_model->getBoleta($value['id_boleta']);
		foreach ($bol as $row) {
			$t=$row->tipo;
			$c=$row->categoria;
		}
		$dato = array(
			'tipo'=>$t,
			'categoria'=>$c,
			'afianzado'=>$value['afianzado'],
			'empresa'=>$value['empresa'],
			'ent_financiera'=>$value['ent_financiera'],
			'codigo'=>$value['codigo'],
			'monto'=>$value['monto'],
			'moneda'=>$value['moneda'],
			'objeto'=>$value['objeto'],
			'obs'=>$value['obs'],
			'inicio'=>$value['inicio'],
			'fin'=>$value['fin'],
			'respaldo'=>$value['respaldo'],
			'id_boleta'=>$value['id_boleta']
		);
		$this->db->insert('vigencia',$dato);
		return $value['id_boleta'];
	}
	function updVigencia($value){
		$dato = array(
			'afianzado'=>$value['afianzado'],
			'empresa'=>$value['empresa'],
			'ent_financiera'=>$value['ent_financiera'],
			'codigo'=>$value['codigo'],
			'monto'=>$value['monto'],
			'moneda'=>$value['moneda'],
			'objeto'=>$value['objeto'],
			'obs'=>$value['obs'],
			'inicio'=>$value['inicio'],
			'fin'=>$value['fin'],
		);
		if($value['respaldo']!=''){
			$dato['respaldo'] = $value['respaldo'];
		}
		$this->db->where('id',$value['id']);
		$this->db->update('vigencia',$dato);
		return $value['id'];
	}
	function delVigencia($value){
		$this->db->where('id',$value['id']);
		$this->db->delete('vigencia');
	}
	function getVigencia($id){
		$r = $this->db->query("SELECT * FROM vigencia WHERE id=$id" );
		return $r->result();
	}
	function getVigencia2($id){
		$r = $this->db->query("SELECT * FROM vigencia WHERE id_boleta=$id ORDER BY fin desc, inicio desc" );
		return $r->result();
	}
}
?>