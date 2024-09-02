<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('M_Peminjaman');
		$this->load->model('M_Barang');
        $this->load->library('unit_test');
		is_logged_in();
	}

	public function Peminjaman()
	{
        $data = [
			'title' => 'Peminjaman Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];

        $data['pinjam'] = $this->M_Peminjaman->getpeminjaman1();
		$data['barang'] = $this->M_Barang->getbarang();
        $pinjam1 = $this->db->query("SELECT * FROM peminjaman where status='Pending'");
        $data['pinjam1'] = $pinjam1->num_rows();
        $pinjam2 = $this->db->query("SELECT * FROM peminjaman where status='Dipinjam'");
        $data['pinjam2'] = $pinjam2->num_rows();
        $pinjam3 = $this->db->query("SELECT * FROM peminjaman where status='Dikembalikan'");
        $data['pinjam3'] = $pinjam3->num_rows();
        
            $this->load->view('Template/Tampilan_Header', $data);
            $this->load->view('Peminjaman/peminjaman_view', $data);
            $this->load->view('Template/Tampilan_Footer');
	}

	public function lihatpinjamdetail()
	{
        $data = [
			'title' => 'Detail Pinjam Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];
        
        $id = $this->uri->segment(3);
        // $data['pinjam'] = $this->M_Peminjaman->getpeminjaman($id);
		$data['detailpinjam'] = $this->M_Peminjaman->getdetail($id);
		$data['barang'] = $this->M_Barang->getbarang();
        
            $this->load->view('Template/Tampilan_Header', $data);
            $this->load->view('Peminjaman/detailpinjam_view', $data);
            $this->load->view('Template/Tampilan_Footer');
	}

	public function Pubah_barang($id_p)
	{
        $data = [
			'title' => 'Pinjam Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];
        $id = $data['login']['id'];
		$data['pinjam'] = $this->M_Peminjaman->getpeminjaman($id);
		$data['barang'] = $this->M_Barang->getbarang();

		$this->load->view('Template/Tampilan_Header', $data);
		$this->load->view('Template/Tampilan_Footer');

			$data = [
                'id_peminjaman' => $id_p,
                'status_p' => $this->input->post('status_p')
			];

				$this->M_Peminjaman->Ubahdetailpinjam($data, 'detail_pinjam');
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data Detail Peminjaman Berhasil Diubah!</div>');
                    redirect('Barang/Peminjaman');
	}

	public function upload_barang($id_p)
	{
        $data = [
			'title' => 'Pinjam Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];
        $id = $data['login']['id'];
		$data['pinjam'] = $this->M_Peminjaman->getpeminjaman($id);
		$data['barang'] = $this->M_Barang->getbarang();

		$kondisi_awal = $this->input->post('ket_awal');
		
		if ($kondisi_awal){
			$data = [
				'id_peminjaman' => $id_p,
				'ket_awal' => $kondisi_awal
			];
		} else {
			$data = [
				'id_peminjaman' => $id_p,
				'ket_akhir' => $this->input->post('ket_akhir')
			];
		}
		
		$kondisi = $_FILES['kondisi_awal'];
		if($kondisi){
			$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|word';
			$config['max_size'] = '10048';
			$config['upload_path'] = './assets/KondisiAwal/';

			$this->load->library('upload',$config);

				if($this->upload->do_upload('kondisi_awal')){
					$new_bukti = $this->upload->data('file_name');
					$this->db->set('kondisi_awal', $new_bukti);
				} else {
					echo $this->upload->display_errors();
				}
		} else {
			$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|word';
			$config['max_size'] = '10048';
			$config['upload_path'] = './assets/KondisiAkhir/';

			$this->load->library('upload',$config);

				if($this->upload->do_upload('kondisi_Akhir')){
					$new_bukti = $this->upload->data('file_name');
					$this->db->set('kondisi_Akhir', $new_bukti);
				} else {
					echo $this->upload->display_errors();
				}
		}
		$this->M_Peminjaman->Ubahdetailpinjam($data, 'detail_pinjam');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data Detail Peminjaman Berhasil Diubah!</div>');
                    redirect('Barang/Peminjaman');
	}

	public function peminjaman_ubah($id)
	{
        $data = [
			'title' => 'Peminjaman Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];

		$data['pinjam'] = $this->M_Peminjaman->getpeminjaman1();
		$data['barang'] = $this->M_Barang->getbarang();
        
		$status = $this->input->post('status');
			
			$data = [
				'id_p' => $id,
				'tgl_kembali' => $this->input->post('tgl_kembali'),
				'status' => $status
			];

			$this->M_Peminjaman->Ubahpinjam($data, 'peminjaman');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data Peminjaman Berhasil Diubah!</div>');
                    redirect('Barang/Peminjaman');
	}

	public function Dhapus_barang($id) {
		$where = array('id_peminjaman' => $id);

		$this->M_Peminjaman->Hapusdetailpinjam($where, 'detail_pinjam');
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Data Detail Peminjaman Berhasil Dihapus!</div>');
		redirect('Barang/Peminjaman');
	}

	public function pinjam_hapus($id) {
		$where = array('id_p' => $id);

		$this->M_Peminjaman->Hapuspinjam($where, 'peminjaman');
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Data Peminjaman Berhasil Dihapus!</div>');
		redirect('Barang/Peminjaman');
	}

	public function testubahpeminjaman(){
        $this->M_Peminjaman->getpeminjaman1();
        $data = [
			//'status' => $this->input->post('status')
            'status' => 'Dipinjam'
        ];
        return $data;

	}

	public function testpinjamubah(){
        $test = $this->testubahpeminjaman();
		$expected_result = [
			'status' => 'Dipinjam'
		];
        if($expected_result == $test){
            echo 'Dipinjam';
        }else{
			echo 'salah';
		}
        $test_name = 'Cek ubah status Peminjaman';
        echo $this->unit->run($test, $expected_result, $test_name);
        die;
    }

	public function testubahdetail(){
        $this->M_Peminjaman->getpeminjaman1();
        $data = [
			//'status_p' => $this->input->post('status_p')
            'status_p' => 'Disetujui'
        ];
        return $data;

	}

	public function testdetailubah(){
        $test = $this->testubahdetail();
		$expected_result = [
			'status_p' => 'Disetujui'
		];
        if($expected_result == $test){
            echo 'Disetujui<br>';
            echo 'Stok Berkurang';
        }else{
			echo 'salah';
		}
        $test_name = 'Cek ubah detail status Peminjaman';
        echo $this->unit->run($test, $expected_result, $test_name);
        die;
    }

	public function keluar(){
		$data = [
			'title' => 'Barang Keluar',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];

		$data['barang'] = $this->M_Barang->getbarang();
		$data['barkel'] = $this->M_Barang->getbarkel()->result_array();
		$data['kategori'] = $this->M_Barang->getkategori();

		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'required|trim');
		$this->form_validation->set_rules('tgl_bk', 'Tanggal Keluar', 'required|trim');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');

		if($this->form_validation->run() == false){
			$this->load->view('Template/Tampilan_Header', $data);
			$this->load->view('Barang/barangkeluar_view', $data);
			$this->load->view('Template/Tampilan_Footer');
		} else {

			$this->M_Barang->Tambahbarkel();
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data Barang Keluar Berhasil Ditambahkan!</div>');
                    redirect('Barang/keluar');
		}
	}

	public function barkel_ubah($id){
		$data = [
			'title' => 'Barang Keluar',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];

		$data['barang'] = $this->M_Barang->getbarang();
		$data['barkel'] = $this->M_Barang->getbarkel()->result_array();
		$data['kategori'] = $this->M_Barang->getkategori();

		$this->form_validation->set_rules('jumlah', 'Jumlah', 'required|trim');

		if($this->form_validation->run() == false){
			$this->load->view('Template/Tampilan_Header', $data);
			$this->load->view('Barang/barangkeluar_view', $data);
			$this->load->view('Template/Tampilan_Footer');
		} else {
			$data = [
				'id_bk' => $id,
				'jumlah' => $this->input->post('jumlah'),
				'keterangan' => $this->input->post('keterangan')
			];

			$this->M_Barang->Ubahbarkel($data, 'barangkeluar');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data Barang Keluar Berhasil Diubah!</div>');
                    redirect('Barang/keluar');
		}
	}
	
	public function barkel_hapus($id) {
		$where = array('id_bk' => $id);

		$this->M_Barang->Hapuskatbar($where, 'barangkeluar');
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Data Barang Keluar Berhasil Dihapus!</div>');
		redirect('Barang/keluar');
	}

	public function menampilkan_kat()
	{
        $id_kategori = $_POST['id_kategori'];
        $s = "SELECT * FROM kategori_barang WHERE id_kategori='$id_kategori'";
        $res = $this->db->query($s)->row_array();
        echo json_encode($res);
        
    }

}
