<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set("Asia/Jakarta");

class Web extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('M_Admin');
	}

    public function index(){
        $this->load->view('welcome_message');
    }

	public function login()
	{
        if($this->session->userdata('email')){
            redirect('User');
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if($this->form_validation->run() == false){
            
            $data['title'] = 'Login Page';
            $this->load->view('Template/Auth_Header', $data);
            $this->load->view('v_login');
            $this->load->view('Template/Auth_Footer');

        } else {
            
            $email = $this->input->post('email');
            $password = $this->input->post('password');
    
            $user = $this->db->get_where('login', ['email' => $email])->row_array();
            
            if($user){
                if($user['is_active'] == 1){
                    if(password_verify($password, $user['password'])){
                        $data = [
                            'id' => $user['id'],
                            'email' => $user['email'],
                            'role_id' => $user['role_id'] 
                        ];
                        $this->session->set_userdata($data);
                        if($user['role_id'] == 1){
                            redirect('Admin');
                        } else {
                            redirect('User');
                        }
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        Password Salah!</div>');
                        redirect('Web/login'); 
                    }
    
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Email Anda Belum Diaktivasi</div>');
                    redirect('Web/login');    
                }
    
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Email Salah!</div>');
                redirect('Web/login');
            }     
        }
	}


    public function registration(){

        if($this->session->userdata('email')){
            redirect('User');
        }
        
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[login.email]',[
            'is_unique' => 'email ini sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password tidak sama',
            'min_length' => 'Password terlalu pendek'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        
        if($this->form_validation->run() == false){
            $data['title'] = 'Registration Page';
            $this->load->view('Template/Auth_Header', $data);
            $this->load->view('v_regis');
            $this->load->view('Template/Auth_Footer');
        } else {

            $this->M_Admin->tambahlogin();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Behasil!<br>Silahkan Hubungi Admin Sekolah untuk mengaktivasi Email anda!</div>');
            redirect('Web/login');
        }
    }

	public function logout(){
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Anda Telah Berhasil Logout!</div>');
            redirect('Web/login');
    }

    public function bloked(){
        $this->load->view('Template/404');
    }

}
