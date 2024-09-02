<?php

class M_Admin extends CI_Model {

    public function getlogin() 
	{
        $query = "SELECT login.*, login_role.role
					FROM login INNER JOIN login_role
					ON login.role_id = login_role.id
				";
		return $this->db->query($query)->result_array();
	}

    public function getlog($id) 
	{
        $this->db->select('*');
		$this->db->from('login');
		$this->db->join('login_role','login_role.id = login.role_id');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function tambahlogin()
    {
		
		$data = [
			'name' => htmlspecialchars($this->input->post('name')),
			'email' => htmlspecialchars($this->input->post('email')),
			'image' => 'default.png',
			'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
			'role_id' => 2,
			'is_active' => 0,
			'date_created' => time()
		];
		return $this->db->insert('login',$data);
    }

    public function getrole()
	{
		$query = "SELECT * from login_role";
		return $this->db->query($query)->result_array();
	}

	public function Tambahrole()
    {
		$data = [
			'role' => $this->input->post('role')
		];
		return $this->db->insert('login_role',$data);
    }
	
	public function update_role($data, $table) {
		$this->db->where('id', $data['id']);
		$this->db->update($table, $data);
	}

	public function delete_role($where, $table) {
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function update_log() {
		$name = $this->input->post('name');
        $email = $this->input->post('email');

        $data = [
        	'role_id' => $this->input->post('role'),
            'is_active' => $this->input->post('is_active')
        ];
            
        $this->db->set('name', $name);
        $this->db->where('email', $email);
        $this->db->update('login', $data);
	}

	public function update_pass() {
		$email = $this->input->post('email');
		$id = $this->input->post('id');
        $pass = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		$data = [
			'id' => $id,
		];
            
        $this->db->set('password', $pass);
        $this->db->where('email', $email);
    	$this->db->update('login', $data);
	}

	public function delete_log($where, $table) {
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function ubah_log($data) {
			$name = $this->input->post('name');
            $email = $this->input->post('email');
            $jenkel = $this->input->post('jenkel');
            $alamat = $this->input->post('alamat');
            $no_hp = $this->input->post('no_hp');
            
			$data = [
                'jenkel' => $jenkel,
                'alamat' => $alamat,
                'no_hp' => $no_hp,
            ];

			$upload_image = $_FILES['image'];

            if($upload_image){
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '5048'; 
                $config['upload_path'] = './assets/img/';
                
                $this->load->library('upload', $config);

                    if($this->upload->do_upload('image')){
                        $new_image = $this->upload->data('file_name');
                        $this->db->set('image', $new_image);
                    } else {
                        echo $this->upload->display_errors();
                    }
				$this->db->set('name', $name);
				$this->db->where('email', $email);
				$this->db->update('login', $data);
			}
		}

	public function update_password($data) {
		$current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if(!password_verify($current_password, $data['login']['password'])){
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Password Saat Ini Salah!</div>');
                    redirect('User/change');
            } else {
                if($current_password == $new_password){
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Password Baru sama dengan Password Saat Ini!</div>');
                    redirect('User/change');
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('login');
				}
			}
	}

}