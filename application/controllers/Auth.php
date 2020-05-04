<?php
class Auth extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        
    }

    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('login/index');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('tbl_user', ['username' => $username])->row_array();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $dataSession = [
                    'username' => $user['username'],
                    'nama'=> $user['nama'],
                    'email' => $user['email'],
                    'id_user' => $user['id_user'],
                    'role' => $user['level']
                ];
                $this->session->set_userdata($dataSession);

                redirect('auth/beranda');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
               <span>Password Salah</span>
              </div>');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            <span>Username Tidak Ditemukan</span>
          </div>');
            redirect('Auth');
        }
    }

    public function logout()
    {
    	$this->session->sess_destroy();
    	redirect('auth');
    }
    public function beranda()
    {	
    	$this->load->view('include/navbar');
    	$this->load->view('beranda');
    	$this->load->view('include/footer');
    }
}
