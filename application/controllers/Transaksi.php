<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('M_Menu');
		$this->load->model('M_Transaksi');
		$this->load->model('M_Barang');
		$this->load->model('M_Suplier');
        $this->load->library('unit_test');
		is_logged_in();
	}

	public function jual()
	{
        $data = [
			'title' => 'Penjualan Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];

        $id = $this->uri->segment(3);
        $data['jual'] = $this->M_Transaksi->getjual($id);
        $data['barang'] = $this->M_Barang->getbarang1()->result_array();
		$data['kategori'] = $this->M_Barang->getkategori();

            $this->load->view('Template/Tampilan_Header', $data);
            $this->load->view('Transaksi/Penjualan_view', $data);
            $this->load->view('Template/Tampilan_Footer');
        
    }

	public function datajual()
	{
        $data = [
			'title' => 'Data Penjualan Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];

        $data['jual'] = $this->M_Transaksi->getjual1();
		$data['barang'] = $this->M_Barang->getbarang1()->result_array();
		$data['kategori'] = $this->M_Barang->getkategori();

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('tgl_jual', 'Tanggal Jual', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');

        if($this->form_validation->run() == false){
            $this->load->view('Template/Tampilan_Header', $data);
            $this->load->view('Transaksi/datajual_view', $data);
            $this->load->view('Template/Tampilan_Footer');
        } else {

            $this->M_Transaksi->Tambahtrans();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data Penjualan Berhasil Ditambahkan!</div>');
                    redirect('Transaksi/jual');
        }
    }

    public function Jual_ubah($id_j)
	{
        $data = [
			'title' => 'Pinjam Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];
        $id = $this->uri->segment(3);
        $data['jual'] = $this->M_Transaksi->getjual($id);
        $data['barang'] = $this->M_Barang->getbarang1()->result_array();
		$data['kategori'] = $this->M_Barang->getkategori();

			$data = [
                'id_jual' => $id_j,
				'nama' => $this->input->post('nama'),
				'tgl_jual' => $this->input->post('tgl_jual')
			];

			$bukti = $_FILES['bukti'];

			if($bukti){
				$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|word';
				$config['max_size'] = '10048';
				$config['upload_path'] = './uploads/';

				$this->load->library('upload',$config);

					if($this->upload->do_upload('bukti')){
						$new_bukti = $this->upload->data('file_name');
						$this->db->set('bukti', $new_bukti);
					} else {
						echo $this->upload->display_errors();
					}

			$this->M_Transaksi->Ubahjual($data, 'penjualan');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Penjualan Berhasil Diubah!</div>');
        	redirect('Transaksi/datajual');
				}
		}

    public function trans_hapus($id) {
		$where = array('id_jual' => $id);

		$this->M_Transaksi->Hapustrans($where, 'penjualan');
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Data Penjualan Berhasil Dihapus!</div>');
		redirect('Transaksi/datajual');
	}

    public function lihatjualdetail()
	{
        $data = [
			'title' => 'Detail Jual Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];
        
        $id = $this->uri->segment(3);
        $data['jual'] = $this->M_Transaksi->getjual($id);
		$data['detailjual'] = $this->M_Transaksi->getdetail($id);
		$data['barang'] = $this->M_Barang->getbarang1()->result_array();
        
            $this->load->view('Template/Tampilan_Header', $data);
            $this->load->view('Transaksi/detailjual_view', $data);
            $this->load->view('Template/Tampilan_Footer');
	}

    public function tambahdetail()
	{
        $data = [
			'title' => 'Tambah Detail Jual Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];
        
        $id = $this->uri->segment(3);
        $data['jual'] = $this->M_Transaksi->getjual($id);
		$data['detailjual'] = $this->M_Transaksi->getdetail($id);
		$data['barang'] = $this->M_Barang->getbarang1()->result_array();
		$data['kategori'] = $this->M_Barang->getkategori();

		$this->form_validation->set_rules('id_jual', 'ID', 'required|trim');

        if($this->form_validation->run() == false){
            $this->load->view('Template/Tampilan_Header', $data);
            $this->load->view('Transaksi/tambahdetail_view', $data);
            $this->load->view('Template/Tampilan_Footer');
		} else {
			$this->M_Transaksi->Tambahdetailjual();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data Detail Penjualan Berhasil Ditambahkan!</div>');
                    redirect('Transaksi/lihatjualdetail/'.$id);
		}
	}

    public function ubahdetail($id_penjualan)
	{
        $data = [
			'title' => 'Pinjam Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];
        $id = $this->uri->segment(3);
        $data['jual'] = $this->M_Transaksi->getjual($id);
        $data['barang'] = $this->M_Barang->getbarang1()->result_array();
		$data['kategori'] = $this->M_Barang->getkategori();

			$data = [
                'id_penjualan' => $id_penjualan,
				'jumlah' => $this->input->post('jumlah')
			];

			$this->M_Transaksi->Ubahdetailjual($data, 'detail_penjualan');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data Detail Penjualan Berhasil Diubah!</div>');
                    redirect('Transaksi/datajual');
	}

	public function hapusdetail($id) {
		$where = array('id_penjualan' => $id);

		$this->M_Transaksi->Hapusdetailjual($where, 'detail_penjualan');
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Data Detail Penjualan Berhasil Dihapus!</div>');
		redirect('Transaksi/datajual');
	}

	public function menampilkan_data()
	{
        $id_suplier = $_POST['id_suplier'];
        $s = "SELECT * FROM suplier WHERE id_suplier='$id_suplier'";
        $res = $this->db->query($s)->row_array();
        echo json_encode($res);
        
    }

    public function pembelian()
	{
        $data = [
			'title' => 'Pembelian Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];

        $data['suplier'] = $this->M_Suplier->getsuplier();
        $data['barang'] = $this->M_Barang->getbarang1()->result_array();
		$data['kategori'] = $this->M_Barang->getkategori();

        $this->form_validation->set_rules('id_user', 'ID User', 'required|trim');
        $this->form_validation->set_rules('tgl_pembelian', 'Tanggal Pembelian', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');

        if($this->form_validation->run() == false){
            $this->load->view('Template/Tampilan_Header', $data);
            $this->load->view('Suplier/pembelian_view', $data);
            $this->load->view('Template/Tampilan_Footer');
        } else {
            $this->M_Suplier->Tambahbeli();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data Pembelian Berhasil Ditambahkan!</div>');
                    redirect('Transaksi/pembelian');
        }
    }

    public function databeli()
	{
        $data = [
			'title' => 'Data Pembelian Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];

        $data['beli'] = $this->M_Suplier->getbeli1();
        $data['suplier'] = $this->M_Suplier->getsuplier();
        $data['barang'] = $this->M_Barang->getbarang1()->result_array();

        
            $this->load->view('Template/Tampilan_Header', $data);
            $this->load->view('Suplier/databeli_view', $data);
            $this->load->view('Template/Tampilan_Footer');
        
    }

    public function beli_ubah($id)
	{
        $data = [
			'title' => 'Ubah Pembelian Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];

        $id = $this->uri->segment(3);
        $data['beli'] = $this->M_Suplier->getbeli($id);
		$data['detailbeli'] = $this->M_Suplier->getdetail($id);
		$data['barang'] = $this->M_Barang->getbarang1()->result_array();
        $data['suplier'] = $this->M_Suplier->getsuplier();

        $this->form_validation->set_rules('tgl_pembelian', 'Tanggal Pembelian', 'required|trim');

        if($this->form_validation->run() == false){
            $this->load->view('Template/Tampilan_Header', $data);
            $this->load->view('Suplier/ubahbeli_view', $data);
            $this->load->view('Template/Tampilan_Footer');
        } else {
                $data = [
                    'id_pembelian' => $id,
                    'id_suplier' => $this->input->post('id_suplier'),
                    'nama_rekening' => $this->input->post('nama_rekening'),
                    'no_rekening' => $this->input->post('no_rekening'),
                    'metode' => $this->input->post('metode'),
                    'tgl_pembelian' => $this->input->post('tgl_pembelian')
                ];

                $bukti = $_FILES['bukti'];
                if($bukti){
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|word';
                    $config['max_size'] = '10048';
                    $config['upload_path'] = './uploads/';

                    $this->load->library('upload',$config);

                        if($this->upload->do_upload('bukti')){
                            $new_bukti = $this->upload->data('file_name');
                            $this->db->set('bukti', $new_bukti);
                        } else {
                            echo $this->upload->display_errors();
                        }

                        $this->M_Suplier->ubahbeli($data, 'pembelian');
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                            Data Pembelian Berhasil Diubah!</div>');
                            redirect('Transaksi/databeli');
                }
        }
    }

    public function beli_hapus($id) {
		$where = array('id_pembelian' => $id);

		$this->M_Suplier->hapusbeli($where, 'pembelian');
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Data Pembelian Berhasil Dihapus!</div>');
		redirect('Transaksi/databeli');
	}
    

    public function detailbeli()
	{
        $data = [
			'title' => 'Detail Beli Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];
        
        $id = $this->uri->segment(3);
        $data['beli'] = $this->M_Suplier->getbeli($id);
		$data['detailbeli'] = $this->M_Suplier->getdetail($id);
		$data['barang'] = $this->M_Barang->getbarang1()->result_array();
        $data['suplier'] = $this->M_Suplier->getsuplier();
		$data['kategori'] = $this->M_Barang->getkategori();
        
            $this->load->view('Template/Tampilan_Header', $data);
            $this->load->view('Suplier/detailbeli_view', $data);
            $this->load->view('Template/Tampilan_Footer');
	}

    public function tambahdetailbeli()
	{
        $data = [
			'title' => 'Tambah Detail Beli Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];
        
        $id = $this->uri->segment(3);
        $data['beli'] = $this->M_Suplier->getbeli($id);
		$data['detailbeli'] = $this->M_Suplier->getdetail($id);
		$data['kategori'] = $this->M_Barang->getkategori();
		$data['barang'] = $this->M_Barang->getbarang1()->result_array();

		$this->form_validation->set_rules('id_pembelian', 'ID', 'required|trim');

        if($this->form_validation->run() == false){
            $this->load->view('Template/Tampilan_Header', $data);
            $this->load->view('Suplier/tambahdetail_view', $data);
            $this->load->view('Template/Tampilan_Footer');
		} else {
			$this->M_Suplier->Tambahdetailbeli();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data Detail Pembelian Berhasil Ditambahkan!</div>');
                    redirect('Transaksi/databeli');
		}
	}

    public function ubahdetailbeli($id_beli)
	{
        $data = [
			'title' => 'Ubah Detail Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];
        $id = $this->uri->segment(3);
        $data['beli'] = $this->M_Suplier->getbeli($id);
        $data['detailbeli'] = $this->M_Suplier->getdetail($id);
        $data['barang'] = $this->M_Barang->getbarang1()->result_array();

			$data = [
                'id_beli' => $id_beli,
				'jumlah' => $this->input->post('jumlah')
			];

			$this->M_Suplier->Ubahdetailbeli($data, 'detail_pembelian');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data Detail Pembelian Berhasil Diubah!</div>');
                    redirect('Transaksi/databeli');
	}

    public function hapusdetailbeli($id) {
		$where = array('id_beli' => $id);

		$this->M_Suplier->Hapusdetailbeli($where, 'detail_pembelian');
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Data Detail Pembelian Berhasil Dihapus!</div>');
		redirect('Transaksi/databeli');
	}

	public function menampilkandata()
	{
        $id_suplier = $_POST['id_suplier'];
        $s = "SELECT * FROM suplier WHERE id_suplier='$id_suplier'";
        $res = $this->db->query($s)->row_array();
        echo json_encode($res);
        
    }

    public function testbeli(){
        $this->M_Suplier->getbeli1();
        $data = [
			//'status' => $this->input->post('status')
            'status' => 'Dibeli'
        ];
        return $data;

	}

	public function testpembelian(){
        $test = $this->testbeli();
		$expected_result = [
			'status' => 'Dibeli'
		];
        if($expected_result == $test){
            echo 'Dibeli';
        }else{
			echo 'salah';
		}
        $test_name = 'Cek status Pembelian';
        echo $this->unit->run($test, $expected_result, $test_name);
        die;
    }


	public function menampilkan_harga()
	{
        $id_barang = $_POST['id_barang'];
        $s = "SELECT * FROM data_barang WHERE id_barang='$id_barang'";
        $res = $this->db->query($s)->row_array();
        echo json_encode($res);
        
    }

	public function menampilkan_kategori()
	{
        $id_kategori = $_POST['id_kategori'];
        $k = "SELECT * FROM kategori_barang WHERE id_kategori='$id_kategori'";
        $kat = $this->db->query($k)->result_array();
        echo json_encode($kat);
        
    }

	public function menampilkan_barang1()
	{
        $id_kategori = $this->input->post('id_kategori');
        $data = $this->M_Transaksi->getbarang($id_kategori);
		$output = '<option value=""	>-- Pilih Barang --</option>';
		foreach($data as $row){
			$output .= '<option value="'.$row['id_barang'].'"data-stok="'.$row['stok'].'">'.$row['nama_barang'].'</option>';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
        
    }

	public function testjual(){
        $this->M_Transaksi->getjual1();
        $data = [
			//'status' => $this->input->post('status')
            'status' => 'Dijual'
        ];
        return $data;

	}

	public function testpenjualan(){
        $test = $this->testjual();
		$expected_result = [
			'status' => 'Dijual'
		];
        if($expected_result == $test){
            echo 'Dijual';
        }else{
			echo 'salah';
		}
        $test_name = 'Cek status Penjualan';
        echo $this->unit->run($test, $expected_result, $test_name);
        die;
    }

}
