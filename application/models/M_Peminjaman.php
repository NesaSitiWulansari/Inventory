<?php

class M_Peminjaman extends CI_Model {
	

	// Data Barang Stok
	

	public function getpeminjaman($id)
	{
		
        $this->db->select('*');
		$this->db->from('peminjaman');
		$this->db->join('login','login.id = peminjaman.id_user');
		$this->db->where('id_user', $id);
		$this->db->order_by('id_p');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getpinjam($id)
	{
		
        $this->db->select('*');
		$this->db->from('peminjaman');
		$this->db->join('login','login.id = peminjaman.id_user');
		$this->db->where('id_p', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getpeminjaman1()
	{
		
        $this->db->select('*');
		$this->db->from('peminjaman');
		$this->db->join('login','login.id = peminjaman.id_user');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function Tambahpinjam()
    {
		$id_user = $this->input->post("id_user");
		$id_barang = $this->input->post("id_barang", TRUE);
		$id_kategori = $this->input->post("id_kategori", TRUE);
		$jumlah = $this->input->post("jumlah", TRUE);
		$tgl_pinjam = $this->input->post("tgl_pinjam", TRUE);
		$tgl_kembali = $this->input->post("tgl_kembali",TRUE);
		$status = $this->input->post("status",TRUE);
		$keterangan = $this->input->post("keterangan");

		$data = array(
			'id_user' => $id_user,
			'tgl_pinjam' => $tgl_pinjam,
			'tgl_kembali' => $tgl_kembali,
			'status' => $status,
			'keterangan' => $keterangan
		);

		$this->db->insert('peminjaman', $data);
		$insert_id = $this->db->insert_id();
		

		for($total=0; $total < count($id_barang); $total++){
			$data2 = array(
				'id_p' => $insert_id,
				'id_barang' => $id_barang[$total],
				'id_kategori' => $id_kategori[$total],
				'jumlah' => $jumlah[$total],
			);

			$this->db->insert('detail_pinjam', $data2);
		}

		return ($this->db->affected_rows() != 1) ? false : true;
    }

	public function Ubahpinjam($data, $table) {
		$this->db->where('id_p', $data['id_p']);
		$this->db->update($table, $data);
	}

	public function Hapuspinjam($where, $table) {
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function Hapusbarang($where, $table) {
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function Jumlah_stok($kode) {
		$this->db->select('stok');
		$this->db->from('data_barang');
		$this->db->where('id_barang', $kode);
		return $this->db->get()->row_array();
	}

	public function getdetail($id)
	{
        $this->db->select('*');
		$this->db->from('detail_pinjam');
		$this->db->join('data_barang','data_barang.id_barang = detail_pinjam.id_barang');
		$this->db->join('kategori_barang','kategori_barang.id_kategori = detail_pinjam.id_kategori');
		$this->db->join('peminjaman','peminjaman.id_p = detail_pinjam.id_p');
		$this->db->where('peminjaman.id_p', $id);
		$this->db->order_by('id_peminjaman');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function TBpinjam() {
		
		$id_p = $this->input->post("id_p");
		$id_barang = $this->input->post("id_barang", TRUE);
		$id_kategori = $this->input->post("id_kategori", TRUE);
		$jumlah = $this->input->post("jumlah", TRUE);
		$status_p = $this->input->post("status_p");

		for($total=0; $total < count($id_barang); $total++){
			$data2 = array(
				'id_p' => $id_p,
				'id_barang' => $id_barang[$total],
				'id_kategori' => $id_kategori[$total],
				'jumlah' => $jumlah[$total],
				'status_p' => $status_p,
			);

			$this->db->insert('detail_pinjam', $data2);

		}

		return ($this->db->affected_rows() != 1) ? false : true;
    }

	public function Ubahdetailpinjam($data, $table) {
		$this->db->where('id_peminjaman', $data['id_peminjaman']);
		$this->db->update($table, $data);
	}

	public function Hapusdetailpinjam($where, $table) {
		$this->db->where($where);
		$this->db->delete($table);
	}

}