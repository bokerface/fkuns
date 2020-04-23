<?php
	class Ilmiah_model extends CI_Model{
		public function add_ilmiah($data){
			$this->db->insert('ilmiah', $data);
			return true;
		}
	}
