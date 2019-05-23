<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Boletas_model extends CI_Model {
	function __construct(){
		parent::__construct();

	}
	function addBoleta($value){
		$dato = array(
			'tipo'=>$value['tipo'],
			'categoria'=>$value['categoria'],
			'afianzado'=>$value['afianzado'],
			'empresa'=>$value['empresa'],
			'ent_financiera'=>$value['ent_financiera'],
			'codigo'=>$value['codigo'],
			'monto'=>$value['monto'],
			'moneda'=>$value['moneda'],
			'objeto'=>$value['objeto'],
			'obs'=>$value['obs'],
			'inicio'=>$value['inicio'],
			'respaldo'=>$value['respaldo'],
			'fin'=>$value['fin']
		);
		$this->db->insert('boleta',$dato);
		return $this->db->insert_id();
	}
	function updBoleta($value){
		$dato = array(
			'tipo'=>$value['tipo'],
			'categoria'=>$value['categoria'],
			'afianzado'=>$value['afianzado'],
			'empresa'=>$value['empresa'],
			'ent_financiera'=>$value['ent_financiera'],
			'codigo'=>$value['codigo'],
			'monto'=>$value['monto'],
			'moneda'=>$value['moneda'],
			'objeto'=>$value['objeto'],
			'obs'=>$value['obs'],
			'inicio'=>$value['inicio'],
			'fin'=>$value['fin']
		);
		$dato2 = array(
			'tipo'=>$value['tipo'],
			'categoria'=>$value['categoria'],
		);
		if($value['respaldo']!=''){
			$dato['respaldo'] = $value['respaldo'];
		}
		$this->db->where('id',$value['id']);
		$this->db->update('boleta',$dato);
		$this->db->where('id_boleta',$value['id']);
		$this->db->update('vigencia',$dato2);
		return $value['id'];
	}	
	function delBoleta($value){
		$this->db->where('id',$value);
		$this->db->delete('boleta');
		$this->db->where('id_boleta',$value);
		$this->db->delete('vigencia');
	}
	function libBoleta($value){
		$dato = array(
			'estado'=>'2',
		);
		$this->db->where('id',$value);
		$this->db->update('boleta',$dato);
	}
	function getBoleta($id){
		$r = $this->db->query("
				SELECT a.*, a.inicio as ini, a.fin as fn , 
				(
					SELECT b.inicio
					FROM vigencia b
					WHERE b.id_boleta = a.id
					ORDER BY b.fin DESC, b.inicio DESC
					LIMIT 1
				) as inicio, 
				(
					SELECT b.fin
					FROM vigencia b
					WHERE b.id_boleta = a.id
					ORDER BY b.fin DESC, b.inicio DESC
					LIMIT 1
				) as fin,
				(
					SELECT DATEDIFF(DATE(b.fin), CURDATE())
					FROM vigencia b
					WHERE b.id_boleta = a.id
					ORDER BY b.fin DESC, b.inicio DESC
					LIMIT 1
				) as dif2,
				DATEDIFF(DATE(a.fin), CURDATE()) as dif1
				FROM boleta a 
				WHERE a.id=$id
			");
		return $r->result();
	}
	function getBoletas(){
		$r = $this->db->query("
				SELECT a.*, a.inicio as ini, a.fin as fn , 
				(
					SELECT b.inicio
					FROM vigencia b
					WHERE b.id_boleta = a.id
					ORDER BY b.fin DESC, b.inicio DESC
					LIMIT 1
				) as inicio, 
				(
					SELECT b.fin
					FROM vigencia b
					WHERE b.id_boleta = a.id
					ORDER BY b.fin DESC, b.inicio DESC
					LIMIT 1
				) as fin,
				(
					SELECT DATEDIFF(DATE(b.fin), CURDATE())
					FROM vigencia b
					WHERE b.id_boleta = a.id
					ORDER BY b.fin DESC, b.inicio DESC
					LIMIT 1
				) as dif2,
				DATEDIFF(DATE(a.fin), CURDATE()) as dif1
				FROM boleta a 
			");
		return $r->result();
	}
}
?>