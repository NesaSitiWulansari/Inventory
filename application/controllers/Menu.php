<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('M_Menu');
		is_logged_in();
	}

	public function index()
	{
        $data = [
			'title' => 'Menu Management',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];

        $data['menu'] = $this->M_Menu->getMenu();

        $this->form_validation->set_rules('menu', 'Menu', 'required|trim');
        
        if($this->form_validation->run() == false){
            $this->load->view('Template/Tampilan_Header', $data);
            $this->load->view('Menu/menu_view', $data);
            $this->load->view('Template/Tampilan_Footer');
        } else {
            $this->M_Menu->TambahMenu();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Menu Berhasil Ditambahkan</div>');
            redirect('Menu');
        }
    }

    public function menu_edit($id)
	{
        
        $data['menu'] = $this->M_Menu->getMenu();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if($this->form_validation->run() == false)
        {
            $this->load->view('Template/Header_Admin', $data);
            $this->load->view('Menu/v_menu', $data);
            $this->load->view('Template/Footer_Admin');
        } else {
            $data = [
                'id' => $id,
                'menu' => $this->input->post('menu')
            ];
            $this->M_Menu->update_menu($data, 'tmenu');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Menu Berhasil Diubah!</div>');
            redirect('Menu');
        }
	}

    public function menu_delete($id) {
		$where = array('id' => $id);

		$this->M_Menu->delete_datasub($where, 'tmenu');
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Data Menu Berhasil Dihapus!</div>');
		redirect('Menu');
	}

    public function submenu()
    {
        $data = [
			'title' => 'Sub Menu Management',
			'login' => $this->db->get_where('login', ['email' => 
            		$this->session->userdata('email')])->row_array()
		];

        $data['submenu'] = $this->M_Menu->getSubMenu();
        $data['menu'] = $this->M_Menu->getMenu();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if($this->form_validation->run() == false)
        {
            $this->load->view('Template/Tampilan_Header', $data);
            $this->load->view('Menu/submenu_view', $data);
            $this->load->view('Template/Tampilan_Footer');
        } else {
            $this->M_Menu->TambahSubMenu();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Sub Menu Sudah Ditambahkan!</div>');
            redirect('Menu/submenu');
        }
    }

    public function sub_edit($id)
	{

        $data['submenu'] = $this->M_Menu->getSubMenu();
        $data['menu'] = $this->M_Menu->getMenu();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if($this->form_validation->run() == false)
        {
            $this->load->view('Template/Tampilan_Header', $data);
            $this->load->view('Menu/submenu_view', $data);
            $this->load->view('Template/Tampilan_Footer');
        } else {
            $data = [
                'id' => $id,
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->M_Menu->update_datasub($data, 'sub_menu');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Sub Menu Berhasil Diubah!</div>');
            redirect('Menu/submenu');
        }
	}

    public function sub_delete($id) {
		$where = array('id' => $id);

		$this->M_Menu->delete_datasub($where, 'sub_menu');
        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Data Sub Menu Berhasil Dihapus!</div>');
		redirect('Menu/submenu');
	}

}
