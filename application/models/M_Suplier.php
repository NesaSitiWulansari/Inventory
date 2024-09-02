<?php

class M_Suplier extends CI_Model {

	// Suplier
    
    public function getSuplier()
    {
		$this->db->select('*');
		$this->db->from('suplier');
		$this->db->order_by('suplier.id_suplier');
		$query = $this->db->get();
		return $query->result_array();
    }

	public function tambahsup()
    {
		$data = [
			'nama_sup' => $this->input->post('nama_sup'),
			'alamat' => $this->input->post('alamat'),
			'no_hp' => $this->input->post('no_hp'),
			'nama_rekening' => $this->input->post('nama_rekening'),
			'no_rekening' => $this->input->post('no_rekening')
		];

		return $this->db->insert('suplier',$data);
    }

	public function ubahsup($data, $table)
    {
		$this->db->where('id_suplier', $data['id_suplier']);
		$this->db->update($table, $data);
    }

    public function hapussup($where, $table) {
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function getbeli($id)
    {
		$this->db->select('*');
		$this->db->from('pembelian');
		$this->db->join('suplier', 'suplier.id_suplier = pembelian.id_suplier');
		$this->db->join('login', 'login.id = pembelian.id_user');
		$this->db->where('id_pembelian', $id);
		$query = $this->db->get();
		return $query->result_array();
    }
	public function getbeli1()
    {
		$this->db->select('*');
		$this->db->from('pembelian');
		$this->db->join('suplier', 'suplier.id_suplier = pembelian.id_suplier');
		$this->db->join('login', 'login.id = pembelian.id_user');
		$this->db->order_by('id_pembelian');
		$query = $this->db->get();
		return $query->result_array();
    }

	public function Tambahbeli()
    {
		$id_user = $this->input->post("id_user");
		$id_suplier = $this->input->post("id_suplier");
		$id_barang = $this->input->post("id_barang", TRUE);
		$id_kategori = $this->input->post("id_kategori", TRUE);
		$jum = $this->input->post("jumlah", TRUE);
		$harga_sat = $this->input->post("harga_satuan", TRUE);
		$tgl_pembelian = $this->input->post("tgl_pembelian");
		$status = $this->input->post("status");
		$metode = $this->input->post("metode");
		$nama_rekening = $this->input->post("nama_rekening");
		$no_rekening = $this->input->post("no_rekening");

		if($metode == 'Tunai'){

		$data = array(
			'id_user' => $id_user,
			'id_suplier' => $id_suplier,
			'tgl_pembelian' => $tgl_pembelian,
			'metode' => $metode,
			'status' => $status
		);

		} else {
			$data = array(
				'id_user' => $id_user,
				'id_suplier' => $id_suplier,
				'tgl_pembelian' => $tgl_pembelian,
				'metode' => $metode,
				'nama_rekening' => $nama_rekening,
				'no_rekening' => $no_rekening,
				'status' => $status
			);
	
		}

		$this->db->insert('pembelian', $data);
			$insert_id = $this->db->insert_id();

		for($total=0; $total < count($id_barang); $total++){
			$data2 = array(
				'id_pembelian' => $insert_id,
				'id_barang' => $id_barang[$total],
				'id_kategori' => $id_kategori[$total],
				'harga_satuan' => $harga_sat[$total],
				'jumlah' => $jum[$total],
			);

			$this->db->insert('detail_pembelian', $data2);
		}

		return ($this->db->affected_rows() != 1) ? false : true;
    }

	public function ubahbeli($data, $table)
    {
		$this->db->where('id_pembelian', $data['id_pembelian']);
		$this->db->update($table, $data);
    }

	public function hapusbeli($where, $table) {
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function getdetail($id)
	{
        $this->db->select('*');
		$this->db->from('detail_pembelian');
		$this->db->join('data_barang','data_barang.id_barang = detail_pembelian.id_barang');
		$this->db->join('kategori_barang','kategori_barang.id_kategori = detail_pembelian.id_kategori');
		$this->db->join('pembelian','pembelian.id_pembelian = detail_pembelian.id_pembelian');
		$this->db->where('pembelian.id_pembelian', $id);
		$this->db->order_by('detail_pembelian.id_beli');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getdetail1($id)
	{
        $this->db->select('*');
		$this->db->from('detail_pembelian');
		$this->db->join('data_barang','data_barang.id_barang = detail_pembelian.id_barang');
		$this->db->join('kategori_barang','kategori_barang.id_kategori = detail_pembelian.id_kategori');
		$this->db->join('pembelian','pembelian.id_pembelian = detail_pembelian.id_pembelian');
		$this->db->where('pembelian.id_pembelian', $id);
		$this->db->order_by('detail_pembelian.id_beli');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function Tambahdetailbeli()
    {
		$id_pembelian = $this->input->post("id_pembelian");
		$id_barang = $this->input->post("id_barang", TRUE);
		$id_kategori = $this->input->post("id_kategori", TRUE);
		$jumlah = $this->input->post("jumlah", TRUE);
		$harga_satuan = $this->input->post("harga_satuan", TRUE);


		for($total=0; $total < count($id_barang); $total++){
			$data = array(
				'id_pembelian' => $id_pembelian,
				'id_barang' => $id_barang[$total],
				'id_kategori' => $id_kategori[$total],
				'jumlah' => $jumlah[$total],
				'harga_satuan' => $harga_satuan[$total],
			);

			$this->db->insert('detail_pembelian', $data);

		}

		return ($this->db->affected_rows() != 1) ? false : true;
    }

	public function ubahdetailbeli($data, $table)
    {
		$this->db->where('id_beli', $data['id_beli']);
		$this->db->update($table, $data);
    }

	public function hapusdetailbeli($where, $table) {
		$this->db->where($where);
		$this->db->delete($table);
	}

}