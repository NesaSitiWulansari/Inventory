<?php

class M_Transaksi extends CI_Model {
	

	// Data Barang Stok

	public function getjual($id)
	{
		$this->db->select('*');
		$this->db->from('penjualan');
		$this->db->join('login', 'login.id = penjualan.id_user');
		$this->db->where('id_jual', $id);
		$query = $this->db->get();
		return $query->result_array();
    }

	public function getjual1()
	{
		$this->db->select('*');
		$this->db->from('penjualan');
		$this->db->join('login', 'login.id = penjualan.id_user');
		$query = $this->db->get();
		return $query->result_array();
    }

    public function Tambahtrans()
    {
		$nama = $this->input->post("nama");
		$id_user = $this->input->post("id_user");
		$id_kategori = $this->input->post("id_kategori", TRUE);
		$id_barang = $this->input->post("id_barang", TRUE);
		$jumlah = $this->input->post("jumlah", TRUE);
		$harga_satuan = $this->input->post("harga_satuan", TRUE);
		$tgl_jual = $this->input->post("tgl_jual");
		$status = $this->input->post("status");

		$data = array(
			'id_user' => $id_user,
			'nama' => $nama,
			'tgl_jual' => $tgl_jual,
			'status' => $status
		);

		$this->db->insert('penjualan', $data);
		$insert_id = $this->db->insert_id();
		

		for($total=0; $total < count($id_barang); $total++){
			$data2 = array(
				'id_jual' => $insert_id,
				'id_kategori' => $id_kategori[$total],
				'id_barang' => $id_barang[$total],
				'jumlah' => $jumlah[$total],
				'harga_satuan' => $harga_satuan[$total],
			);

			$this->db->insert('detail_penjualan', $data2);

		}

		return ($this->db->affected_rows() != 1) ? false : true;
    }

	public function Ubahjual($data, $table) {
		$this->db->where('id_jual', $data['id_jual']);
		$this->db->update($table, $data);
	}

	public function Hapustrans($where, $table) {
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function getdetail($id)
	{
        $this->db->select('*');
		$this->db->from('detail_penjualan');
		$this->db->join('data_barang','data_barang.id_barang = detail_penjualan.id_barang');
		$this->db->join('kategori_barang','kategori_barang.id_kategori = detail_penjualan.id_kategori');
		$this->db->join('penjualan','penjualan.id_jual = detail_penjualan.id_jual');
		$this->db->where('penjualan.id_jual', $id);
		$this->db->order_by('detail_penjualan.id_penjualan', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function Tambahdetailjual()
    {
 
		$id_jual = $this->input->post("id_jual");
		$id_kategori = $this->input->post("id_kategori", TRUE);
		$id_barang = $this->input->post("id_barang", TRUE);
		$jumlah = $this->input->post("jumlah", TRUE);
		$harga_satuan = $this->input->post("harga_satuan", TRUE);


		for($total=0; $total < count($id_barang); $total++){
			$data = array(
				'id_jual' => $id_jual,
				'id_kategori' => $id_kategori[$total],
				'id_barang' => $id_barang[$total],
				'jumlah' => $jumlah[$total],
				'harga_satuan' => $harga_satuan[$total],
			);

			$this->db->insert('detail_penjualan', $data);

		}
		return ($this->db->affected_rows() != 1) ? false : true;
    }

	public function Ubahdetailjual($data, $table) {
		$this->db->where('id_penjualan', $data['id_penjualan']);
		$this->db->update($table, $data);
	}

	public function Hapusdetailjual($where, $table) {
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function getbarang($id_kategori)
	{
		$query = $this->db->get_where('data_barang', ['id_kategori' => $id_kategori]);
		return $query->result_array();
	}


}