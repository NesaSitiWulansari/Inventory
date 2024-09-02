<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('M_Admin');
		is_logged_in();
	}

	public function index()
	{
		$data = [
			'title' => 'Dashboard',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];

        $data['Klogin'] = $this->M_Admin->getlogin();
        $data['role'] = $this->M_Admin->getrole();

        $data_barang = $this->db->query("SELECT * FROM data_barang");
        $data['Dbarang'] = $data_barang->num_rows();
        $login = $this->db->query("SELECT * FROM login");
        $data['Dlogin'] = $login->num_rows();
        $pinjam = $this->db->query("SELECT * FROM peminjaman");
        $data['pinjam'] = $pinjam->num_rows();
        $barkel = $this->db->query("SELECT * FROM barangkeluar");
        $data['barkel'] = $barkel->num_rows();
        $beli = $this->db->query("SELECT * FROM pembelian");
        $data['beli'] = $beli->num_rows();
        $jual = $this->db->query("SELECT * FROM penjualan");
        $data['jual'] = $jual->num_rows();

        $this->load->view('Template/Tampilan_Header', $data);
        $this->load->view('Admin/admin_view', $data);
        $this->load->view('Template/Tampilan_Footer');
    }

	public function role()
	{
		$data = [
			'title' => 'Role',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];

		$data['role'] = $this->M_Admin->getrole();

        $this->load->view('Template/Tampilan_Header', $data);
        $this->load->view('Admin/role_view', $data);
        $this->load->view('Template/Tampilan_Footer');
    }

	public function tambahrole()
	{
		$data = [
			'title' => 'Role',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];

		$data['role'] = $this->M_Admin->getrole();

        $this->form_validation->set_rules('role', 'Role', 'required|trim');

        if($this->form_validation->run() == false){
            $this->load->view('Template/Tampilan_Header', $data);
            $this->load->view('Admin/role_view', $data);
            $this->load->view('Template/Tampilan_Footer');
        } else {
            $this->M_Admin->Tambahrole();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Role Berhasil Ditambahkan</div>');
            redirect('Admin/role');
        }
    }

    public function role_edit($id)
	{
        $data = [
			'title' => 'Role',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];
        
        $data['role'] = $this->M_Admin->getrole();

        $this->form_validation->set_rules('role', 'Role', 'required');

        if($this->form_validation->run() == false)
        {
            $this->load->view('Template/Tampilan_Header', $data);
            $this->load->view('Admin/role_view', $data);
            $this->load->view('Template/Tampilan_Footer');
        } else {
            $data = [
                'id' => $id,
                'role' => $this->input->post('role')
            ];
            $this->M_Admin->update_role($data, 'login_role');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Role Berhasil Diubah!</div>');
            redirect('Admin/role');
        }
	}

    public function role_delete($id) {
		$where = array('id' => $id);

		$this->M_Admin->delete_role($where, 'login_role');
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Data Role Berhasil Dihapus!</div>');
		redirect('Admin/role');
	}

	public function roleAccess($role_id)
	{
        $data = [
			'title' => 'Role',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];
        
        $data['role'] = $this->db->get_where('login_role', ['id' => $role_id])->row_array();
        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('tmenu')->result_array();
        
        $this->load->view('Template/Tampilan_Header', $data);
        $this->load->view('Admin/roleAccess_view', $data);
        $this->load->view('Template/Tampilan_Footer');
	}

	public function changeAccess()
    {

        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('access_menu', $data);

        if($result->num_rows() < 1){
            $this->db->insert('access_menu', $data);
        } else {
            $this->db->delete('access_menu', $data);
        }
        
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Akses Diubah!</div>');
    }

	public function KelLog()
	{
        $data = [
			'title' => 'Data Login',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];
        
        $data['Klogin'] = $this->M_Admin->getlogin();
        $data['role'] = $this->M_Admin->getrole();

        $this->load->view('Template/Tampilan_Header', $data);
        $this->load->view('Admin/datalogin_view', $data);
        $this->load->view('Template/Tampilan_Footer');
	}

	public function log_edit($log_id)
	{
        $data['title'] = 'Data Login';
        $data['login'] = $this->db->get_where('login', ['email' => 
            $this->session->userdata('email')])->row_array();
        
        $data['Klogin'] = $this->db->get_where('login', ['id' => $log_id])->row_array();
        $data['role'] = $this->M_Admin->getrole();

            $this->M_Admin->update_log();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Berhasil Diubah!</div>');
            redirect('Admin/kelLog');
    }

	public function pass_edit()
	{
        $data['title'] = 'Data Login';
        $data['login'] = $this->db->get_where('login', ['email' => 
            $this->session->userdata('email')])->row_array();
         
        $data['Klogin'] = $this->M_Admin->getlogin();
        $data['role'] = $this->M_Admin->getrole();

        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'New Password', 'required|trim');

        if($this->form_validation->run() == false){
            $this->load->view('Template/Tampilan_Header', $data);
            $this->load->view('Admin/datalogin_view', $data);
            $this->load->view('Template/Tampilan_Footer');
        } else {
            $this->M_Admin->update_pass();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Password Berhasil Diubah!</div>');
            redirect('Admin/KelLog');

        }
    }

    public function log_delete($id) {
		$where = array('id' => $id);

		$this->M_Admin->delete_log($where, 'login');
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Data Login Berhasil Dihapus!</div>');
		redirect('Admin/KelLog');
	}

}
