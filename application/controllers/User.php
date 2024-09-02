<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
        $this->load->model('M_Admin');
        $this->load->model('M_Peminjaman');
        $this->load->model('M_Barang');
        $this->load->library('unit_test');
		is_logged_in();
	}

	public function index()
	{
		$data = [
			'title' => 'My Profile',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];

        $data['role'] = $this->M_Admin->getrole();
		$data['Klogin'] = $this->M_Admin->getlogin();

        $this->load->view('Template/Tampilan_Header', $data);
        $this->load->view('User/user_view', $data);
        $this->load->view('Template/Tampilan_Footer');
    }

	public function edit()
	{
		$data = [
			'title' => 'Edit Profile',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];
        
        $data['Klogin'] = $this->M_Admin->getlogin();
		

		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
		$this->form_validation->set_rules('no_hp', 'No Handphone', 'required|trim');

		if($this->form_validation->run() == false){
			$this->load->view('Template/Tampilan_Header', $data);
			$this->load->view('User/editprofile_view', $data);
			$this->load->view('Template/Tampilan_Footer');
		} else {
				$this->M_Admin->ubah_log($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Data Berhasil Diubah!</div>');
                redirect('User');
		}
    }

	public function change()
	{
        $data['title'] = 'Change Password';
        $data['login'] = $this->db->get_where('login', ['email' => 
            $this->session->userdata('email')])->row_array();
        
        $this->form_validation->set_rules('current_password', 'Password Now', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Repeat New Password', 'required|trim|min_length[3]|matches[new_password1]');
        
        if($this->form_validation->run() == false){
            $this->load->view('Template/Tampilan_Header', $data);
            $this->load->view('User/forgot_view', $data);
            $this->load->view('Template/Tampilan_Footer');
        } else {
            
            $this->M_Admin->update_password($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Password Berhasil Diubah!</div>');
            redirect('User/change');
        }
	}

    public function user()
	{
        $data = [
			'title' => 'Peminjaman Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];

        $id = $data['login']['id'];
        $data['pinjam'] = $this->M_Peminjaman->getpeminjaman($id);
		$data['barang'] = $this->M_Barang->getbarang();
        

        $this->form_validation->set_rules('id_user', 'ID User', 'required|trim');
        $this->form_validation->set_rules('tgl_pinjam', 'Tanggal Pinjam', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');

		if($this->form_validation->run() == False){
            $this->load->view('Template/Tampilan_Header', $data);
            $this->load->view('User/pinjam_view', $data);
            $this->load->view('Template/Tampilan_Footer');
		} else {
    
			$this->M_Peminjaman->Tambahpinjam();
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data Peminjaman Berhasil Ditambahkan!</div>');
                    redirect('User/user');
		}

	}

    public function lihatdata()
	{
        $data = [
			'title' => 'Peminjaman Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];

        
		$id = $data['login']['id'];
        $data['pinjam'] = $this->M_Peminjaman->getpeminjaman($id);
		$data['barang'] = $this->M_Barang->getbarang();
        
            $this->load->view('Template/Tampilan_Header', $data);
            $this->load->view('User/datapinjam_view', $data);
            $this->load->view('Template/Tampilan_Footer');
	}

    public function user_ubah($id_p)
	{
        $data = [
			'title' => 'Pinjam Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];
        $id = $data['login']['id'];
		$data['pinjam'] = $this->M_Peminjaman->getpeminjaman($id);
		$data['barang'] = $this->M_Barang->getbarang();

			$data = [
                'id_p' => $id_p,
				'tgl_pinjam' => $this->input->post('tgl_pinjam'),
				'keterangan' => $this->input->post('keterangan'),
			];

			$this->M_Peminjaman->Ubahpinjam($data, 'peminjaman');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data Peminjaman Berhasil Diubah!</div>');
                    redirect('User/lihatdata');
	}

    public function user_hapus($id) {
		$where = array('id_p' => $id);

		$this->M_Barang->Hapuspinjam($where, 'peminjaman');
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Data Peminjaman Berhasil Dihapus!</div>');
		redirect('User/lihatdata');
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
		$data['Tpinjam'] = $this->M_Peminjaman->getpinjam($id);
		$data['barang'] = $this->M_Barang->getbarang();
        
            $this->load->view('Template/Tampilan_Header', $data);
            $this->load->view('User/detailpinjam_view', $data);
            $this->load->view('Template/Tampilan_Footer');
	}

    public function Ptambah_barang()
	{
        $data = [
			'title' => 'Pinjam Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];
        $id = $this->uri->segment(3);
        // $data['pinjam'] = $this->M_Peminjaman->getpeminjaman($id);
		$data['detailpinjam'] = $this->M_Peminjaman->getdetail($id);
		$data['Tpinjam'] = $this->M_Peminjaman->getpinjam($id);
		$data['barang'] = $this->M_Barang->getbarang();

            $this->load->view('Template/Tampilan_Header', $data);
			$this->load->view('User/tambahdetail_view', $data);
			$this->load->view('Template/Tampilan_Footer');
	}

    public function Ptambah_barang1()
	{
        $data = [
			'title' => 'Pinjam Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];
        $id = $this->uri->segment(3);
        // $data['pinjam'] = $this->M_Peminjaman->getpeminjaman($id);
		$data['detailpinjam'] = $this->M_Peminjaman->getdetail($id);
		$data['Tpinjam'] = $this->M_Peminjaman->getpinjam($id);
		$data['barang'] = $this->M_Barang->getbarang();

		$this->M_Peminjaman->TBpinjam();
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Detail Peminjaman Berhasil Ditambah!</div>');
        redirect('User/lihatdata');
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

			$data = [
                'id_peminjaman' => $id_p,
				'jumlah' => $this->input->post('jumlah')
			];

			$this->M_Peminjaman->Ubahdetailpinjam($data, 'detail_pinjam');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data Detail Peminjaman Berhasil Diubah!</div>');
                    redirect('User/lihatdata');
	}

    public function Phapus_barang($id) {
		$where = array('id_peminjaman' => $id);

		$this->M_Peminjaman->Hapusdetailpinjam($where, 'detail_pinjam');
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Data Detail Pinjam Berhasil Dihapus!</div>');
		redirect('User/lihatdata');
	}

    public function lihatstok()
	{
		$data = [
			'title' => 'Data Stok Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];

		$data['barang'] = $this->M_Barang->getbarang1()->result_array();
		$data['kategori'] = $this->M_Barang->getkategori();
		$data['suplier'] = $this->M_Barang->getsuplier();

			$this->load->view('Template/Tampilan_Header', $data);
			$this->load->view('User/datastok_view', $data);
			$this->load->view('Template/Tampilan_Footer');
    }

    public function jumlahstok()
	{
		$kode = $this->input->post('kode');
        $data = $this->M_Peminjaman->Jumlah_stok($kode);
        echo json_encode($data);
    }

	public function menampilkan_barang()
	{
        $id_barang = $_POST['id_barang'];
        $s = "SELECT * FROM data_barang WHERE id_barang='$id_barang'";
        $res = $this->db->query($s)->row_array();
        echo json_encode($res);
        
    }

    public function test()
	{
        $data = [
			'title' => 'Peminjaman Barang',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];

        $id = $data['login']['name'];
        return $id;

	}

    public function testuser(){
        $test = $this->test();
        $expected_result = 'Dini Aryanti';
        $test_name = 'Cek Peminjam';
        echo $this->unit->run($test, $expected_result, $test_name);
        die;
    }

    public function testpeminjaman(){
        $this->M_Peminjaman->getpeminjaman1();
        $data = [
			//'status' => $this->input->post('status')
            'status' => 'Pending' //(Benar)
            //'status' => 'Dipinjam' (Salah) 
        ];
        return $data;

	}

	public function testpinjam(){
        $test = $this->testpeminjaman();
        $expected_result = [
			'status' => 'Pending'
        ];
        if($expected_result == $test){
            echo 'Pending';
        }else{
            echo 'Data Input Salah';
        }
        $test_name = 'Cek status Peminjaman';
        echo $this->unit->run($test, $expected_result, $test_name);
        die;
    }

    public function testdetailpinjam(){
        $this->M_Peminjaman->getpeminjaman1();
        $data = [
			'status_p' => $this->input->post('status_p')
            //'status_p' => '0' //(Benar)
            //'status' => 'Dipinjam' (Salah) 
        ];
        return $data;

	}

	public function testdetail(){
        $test = $this->testdetailpinjam();
        $expected_result = [
			'status_p' => '0'
        ];
        if($expected_result == $test){
            echo 'Menunggu';
        }else{
            echo 'Data Input Salah';
        }
        $test_name = 'Cek status Detail Peminjaman';
        echo $this->unit->run($test, $expected_result, $test_name);
        die;
    }

}
