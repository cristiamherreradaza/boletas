<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {
	function __construct(){
		parent::__construct();

	}
	function addUser($value){
		$dato = array(
			'usuario'=>$value['user'],
			'nombre'=>$value['nom'],
			'pass'=>$value['pass'],
		);
		$this->db->insert('usuario',$dato);
		return $this->db->insert_id();
	}
	function getUser(){
		$this->db->select('a.*');
        $this->db->from('usuario a');
		$r = $this->db->get();
		return $r->result();
	}
	function getU($id){
		$r = $this->db->query("SELECT * FROM usuario WHERE id=$id");
		return $r->result();
	}
	function updUser($value){
		$dato = array(
			'usuario'=>$value['user'],
			'nombre'=>$value['nom'],
		);
		if ($value['pass']!='1') {
			$dato['pass']=$value['pass'];
		}
		$this->db->where('id',$value['id']);
		$this->db->update('usuario',$dato);
		return $value['id'];
	}
	function eliminar($value){
		$this->db->where('id',$value['id']);
		$this->db->delete('usuario');
	}
}
?>