<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
	function __construct(){
		parent::__construct();

	}
	function ingresar($username,$password){
		$this->db->where('usuario',$username);
		$this->db->where('pass',$password);
		$query = $this->db->get('usuario');
		if($query->num_rows() == 1)
		{
			return $query->row();
		}else{
			return '';
		}
	}
}
?>