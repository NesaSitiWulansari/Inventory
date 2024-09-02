<?php

class M_Menu extends CI_Model {

	public function getSubMenu() 
	{
		$query = "SELECT sub_menu.*, tmenu.menu
					FROM sub_menu INNER JOIN tmenu
					ON sub_menu.menu_id = tmenu.id
				";
		return $this->db->query($query)->result_array();
	}

	public function TambahSubMenu()
    {
		$data = [
			'title' => $this->input->post('title'),
			'menu_id' => $this->input->post('menu_id'),
			'url' => $this->input->post('url'),
			'icon' => $this->input->post('icon'),
			'is_active' => $this->input->post('is_active')
		];

		return $this->db->insert('sub_menu',$data);
    }

	public function update_datasub($data, $table) {
		$this->db->where('id', $data['id']);
		$this->db->update($table, $data);
	}

	public function delete_datasub($where, $table) {
		$this->db->where($where);
		$this->db->delete($table);
	}
	
	public function getMenu() 
	{
		
		$query = "SELECT * from tmenu";
		return $this->db->query($query)->result_array();
	}

	public function TambahMenu()
    {
		$data = [
			'menu' => $this->input->post('menu')
		];
		return $this->db->insert('tmenu',$data);
    }
	public function update_menu($data, $table) {
		$this->db->where('id', $data['id']);
		$this->db->update($table, $data);
	}

	public function delete_Menu($where, $table) {
		$this->db->where($where);
		$this->db->delete($table);
	}
}