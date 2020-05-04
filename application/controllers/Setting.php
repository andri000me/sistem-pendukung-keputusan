<?php
class Setting extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('m_setting');
        $this->load->library('form_validation');
    }
    function input_error()
    {
        $json['status'] = 0;
        $json['pesan']     = validation_errors();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }
    function cek_level($post_string)
    {
        return $post_string == '0' ? FALSE : TRUE;
    }

    public function index()
    {
        $id = $this->session->userdata('id_user');
        $data['user'] = $this->m_setting->get_user($id);
        $this->load->view('include/navbar');
        $this->load->view('setting/index', $data);
        $this->load->view('include/footer');
    }

    public function ubah_password()
    {
        if ($_POST) {
            $this->form_validation->set_rules('passwordlama', 'Password Lama', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('password1', 'Re-Password', 'required|matches[password]');
            $this->form_validation->set_message('required', '%s harus diisi!');
            $this->form_validation->set_message('matches', 'Password tidak sama!');
            if ($this->form_validation->run() == true) {
                $passwordlama = htmlspecialchars($this->input->post('passwordlama'));
                $password = htmlspecialchars($this->input->post('password1'));
                $id_user = htmlspecialchars($this->input->post('id_user'));
                $pass = password_hash($password, PASSWORD_DEFAULT);

                
                $editPassword = $this->m_setting->edit_password($id_user, $passwordlama, $pass);
                if ($editPassword) {
                    $pesan = "Password";
                    echo json_encode(array('status' => 1, 'pesan' => "Password Telah diubah !"));
                }
                else {
                    $pesan = "Password h";
                    echo json_encode(array('status' => 0, 'pesan' => "Password lama salah !"));
                }
            } else {
                $this->input_error();
            }
        } 
    }

    public function edit_profile()
    {
        if ($_POST) {
            $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('level', 'Level', 'required|callback_cek_level');
            $this->form_validation->set_message('required', '%s harus diisi!');
            $this->form_validation->set_message('cek_level', '%s harus diisi!');
            if ($this->form_validation->run() == true) {
                $username = htmlspecialchars($this->input->post('username'));
                $nama = htmlspecialchars($this->input->post('nama'));
                $level = htmlspecialchars($this->input->post('level'));
                $email = htmlspecialchars($this->input->post('email'));
                $nohp = htmlspecialchars($this->input->post('nohp'));

                $dt = array(
                    'nama' => $nama,
                    'level' => $level,
                    'email' => $email,
                    'no_hp' => $nohp
                );
                $editProfile = $this->m_setting->edit_profile($username, $dt);
                if ($editProfile) {
                    $pesan = "Profile";
                    echo json_encode(array('status' => 1, 'pesan' => "Profile berhasil diedit !"));
                }
            } else {
                $this->input_error();
            }
        }
    }
    
}
