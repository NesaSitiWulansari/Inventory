<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set("Asia/Jakarta");

class Master extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('M_Admin');
		$this->load->model('M_Suplier');
		$this->load->model('M_Barang');
		$this->load->model('M_Transaksi');
        $this->load->library('unit_test');
		is_logged_in();
	}

	// Data Barang Stok

	public function index()
	{
		$data = [
			'title' => 'Data Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];

		$data['barang'] = $this->M_Barang->getbarang1()->result_array();
		$data['kategori'] = $this->M_Barang->getkategori();
		$data['suplier'] = $this->M_Barang->getsuplier();

			$this->load->view('Template/Tampilan_Header', $data);
			$this->load->view('Barang/barang_view', $data);
			$this->load->view('Template/Tampilan_Footer');
		
	}

	public function tambah()
	{
		$data = [
			'title' => 'Data Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];

		$id = $this->uri->segment(3);
		$data['barang'] = $this->M_Barang->getbarang1()->result_array();
		$data['kategori'] = $this->M_Barang->getkategori();
		$data['kategori1'] = $this->M_Barang->getkategori1($id);
		$data['suplier'] = $this->M_Barang->getsuplier();

		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|trim');
		$this->form_validation->set_rules('nama_satuan', 'Satuan', 'required|trim');
		$this->form_validation->set_rules('stok', 'Stok', 'required|trim');
		$this->form_validation->set_rules('harga_satuan', 'Harga Satuan', 'required|trim');

		if($this->form_validation->run() == false){
			$this->load->view('Template/Tampilan_Header', $data);
			$this->load->view('Barang/tambahbarang', $data);
			$this->load->view('Template/Tampilan_Footer');
		} else {

			$this->M_Barang->Tambahbarang();
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data Barang Berhasil Ditambahkan!</div>');
                    redirect('Master');
		}
	}

    public function barang_ubah($id)
	{
		$data = [
			'title' => 'Data Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];

		$data['barang'] = $this->M_Barang->getbarang1()->result_array();
		$data['kategori'] = $this->M_Barang->getkategori();

		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|trim');
		$this->form_validation->set_rules('nama_satuan', 'Satuan', 'required|trim');
		$this->form_validation->set_rules('stok', 'Stok', 'required|trim');
		$this->form_validation->set_rules('harga_satuan', 'Harga Satuan', 'required|trim');

		if($this->form_validation->run() == false){
			$this->load->view('Template/Tampilan_Header', $data);
			$this->load->view('Barang/barang_view', $data);
			$this->load->view('Template/Tampilan_Footer');
		} else {
			$data = [
				'id_barang' => $id,
				'id_kategori' => $this->input->post('id_kategori'),
				'nama_barang' => $this->input->post('nama_barang'),
				'stok' => $this->input->post('stok'),
				'nama_satuan' => $this->input->post('nama_satuan'),
				'harga_satuan' => $this->input->post('harga_satuan')
			];

			$this->M_Barang->Ubahbarang($data, 'data_barang');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data Barang Berhasil Diubah!</div>');
                    redirect('Master');
		}
	}

	public function barang_hapus($id) {
		$where = array('id_barang' => $id);

		$this->M_Barang->Hapusbarang($where, 'data_barang');
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Data Barang Berhasil Dihapus!</div>');
		redirect('Master');
	}


	// Data Kategori Barang

	public function katbar()
	{
		$data = [
			'title' => 'Kategori Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];

		$data['kategori'] = $this->M_Barang->getkategori();

		$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|trim');

		if($this->form_validation->run() == false){
			$this->load->view('Template/Tampilan_Header', $data);
			$this->load->view('Barang/katbar_view', $data);
			$this->load->view('Template/Tampilan_Footer');
		} else {

			$this->M_Barang->Tambahdatakatbar();
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data Kategori Berhasil Ditambahkan!</div>');
                    redirect('Master/katbar');
		}
	}

	public function katbar_ubah($id)
	{
		$data = [
			'title' => 'Kategori Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];

		$data['kategori'] = $this->M_Barang->getkategori();

		$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|trim');

		if($this->form_validation->run() == false){
			$this->load->view('Template/Tampilan_Header', $data);
			$this->load->view('Barang/katbar_view', $data);
			$this->load->view('Template/Tampilan_Footer');
		} else {
			$data = [
				'id_kategori' => $id,
				'nama_kategori' => $this->input->post('nama_kategori')
			];

			$this->M_Barang->Ubahkatbar($data, 'kategori_barang');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data Kategori Berhasil Diubah!</div>');
                    redirect('Master/katbar');
		}
	}

	public function katbar_hapus($id) {
		$where = array('id_kategori' => $id);

		$this->M_Barang->Hapuskatbar($where, 'kategori_barang');
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Data Kategori Berhasil Dihapus!</div>');
		redirect('Master/katbar');
	}

	// Suplier
	public function Suplier()
	{
        $data = [
			'title' => 'Data Suplier',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];

        $data['suplier'] = $this->M_Suplier->getsuplier();

        $this->form_validation->set_rules('nama_sup', 'Nama Suplier', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'No Hp', 'required|trim');
        $this->form_validation->set_rules('nama_rekening', 'Atas Nama', 'required|trim');
        $this->form_validation->set_rules('no_rekening', 'No Rekening', 'required|trim');
        
        if ($this->form_validation->run() == false) {
            $this->load->view('Template/Tampilan_Header', $data);
            $this->load->view('Suplier/suplier_view', $data);
            $this->load->view('Template/Tampilan_Footer');
        } else {
            $this->M_Suplier->tambahsup();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data Supplier Berhasil Ditambahkan!</div>');
                    redirect('Master/Suplier');
        }
    }

	public function suplier_edit($id)
	{
        $data = [
			'title' => 'Data Suplier',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];

        $data['suplier'] = $this->M_Suplier->getsuplier();

        $this->form_validation->set_rules('nama_sup', 'Nama Suplier', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'No Hp', 'required|trim');
        
        if ($this->form_validation->run() == false) {
            $this->load->view('Template/Tampilan_Header', $data);
            $this->load->view('Suplier/suplier_view', $data);
            $this->load->view('Template/Tampilan_Footer');
        } else {
            $data = [
                'id_suplier' => $id,
                'nama_sup' => $this->input->post('nama_sup'),
                'alamat' => $this->input->post('alamat'),
                'no_hp' => $this->input->post('no_hp')
            ];

            $this->M_Suplier->ubahsup($data, 'suplier');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data Supplier Berhasil Diubah!</div>');
                    redirect('Master/Suplier');
        }
    }

    public function suplier_delete($id) {
		$where = array('id_suplier' => $id);

		$this->M_Suplier->hapussup($where, 'suplier');
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Data Supplier Berhasil Dihapus!</div>');
		redirect('Master/Suplier');
	}


}
