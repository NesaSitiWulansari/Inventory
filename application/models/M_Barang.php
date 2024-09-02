<?php

class M_Barang extends CI_Model {
	

	// Data Barang Stok

	public function getbarang1()
	{
		$this->db->select('*');
		$this->db->from('data_barang');
		$this->db->join('kategori_barang','data_barang.id_kategori = kategori_barang.id_kategori');
		$this->db->order_by('data_barang.id_barang');
		$query = $this->db->get();
		return $query;
	}

	public function getbarang()
	{
		$query = "SELECT * from data_barang";
		return $this->db->query($query)->result_array();
	}

	public function Tambahbarang()
    {
		$data = [
			'id_kategori' => $this->input->post('id_kategori'),
			'nama_barang' => $this->input->post('nama_barang'),
			'stok' => $this->input->post('stok'),
			'nama_satuan' => $this->input->post('nama_satuan'),
			'harga_satuan' => $this->input->post('harga_satuan')
		];
		return $this->db->insert('data_barang', $data);
    }

	public function Ubahbarang($data, $table) {
		$this->db->where('id_barang', $data['id_barang']);
		$this->db->update($table, $data);
	}

	public function Hapusbarang($where, $table) {
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function getkategori(){
		$query = "SELECT * from kategori_barang";
		return $this->db->query($query)->result_array();
	}

	public function getkategori1($id){
		$this->db->select('*');
		$this->db->from('kategori_barang');
		$this->db->where('id_kategori', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function Tambahdatakatbar()
    {
		$data = [
			'nama_kategori' => $this->input->post('nama_kategori')
		];
		return $this->db->insert('kategori_barang', $data);
    }

	public function Ubahkatbar($data, $table) {
		$this->db->where('id_kategori', $data['id_kategori']);
		$this->db->update($table, $data);
	}

	public function Hapuskatbar($where, $table) {
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function Hapuspinjam($where, $table) {
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function getsuplier(){
		$query = "SELECT * from suplier";
		return $this->db->query($query)->result_array();
	}

	public function getbarkel()
	{
		$this->db->select('*');
		$this->db->from('barangkeluar');
		$this->db->join('data_barang','data_barang.id_barang = barangkeluar.id_barang');
		$this->db->join('kategori_barang','barangkeluar.id_kategori = kategori_barang.id_kategori');
		$this->db->order_by('id_bk');
		$query = $this->db->get();
		return $query;
	}

	public function getbarkel1($id)
	{
		$this->db->select('*');
		$this->db->from('barangkeluar');
		$this->db->join('data_barang','data_barang.id_barang = barangkeluar.id_barang');
		$this->db->join('kategori_barang','barangkeluar.id_kategori = kategori_barang.id_kategori');
		$this->db->where('id_bk', $id);
		$query = $this->db->get();
		return $query;
	}

	public function Tambahbarkel()
    {
		$data = [
			'nama' => $this->input->post('nama'),
			'id_barang' => $this->input->post('id_barang'),
			'id_kategori' => $this->input->post('id_kategori'),
			'jumlah' => $this->input->post('jumlah'),
			'tgl_bk' => $this->input->post('tgl_bk'),
			'status' => $this->input->post('status'),
			'keterangan' => $this->input->post('keterangan')
		];
		return $this->db->insert('barangkeluar', $data);
    }

	public function Ubahbarkel($data, $table) {
		$this->db->where('id_bk', $data['id_bk']);
		$this->db->update($table, $data);
	}

}