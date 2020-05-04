<?php 
class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('m_admin');
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
        return $post_string == '0'? FALSE : TRUE;
    }
    public function list_user()
    {
        $data['user'] = $this->m_admin->get_user();
        $this->load->view('include/navbar');
        $this->load->view('user/index', $data);
        $this->load->view('include/footer');
    }

    public function view_user()
    {
        $id = $this->uri->segment('3');
        $data['detail'] = $this->m_admin->get_user_by_kode($id);
        $this->load->view('user/view_user', $data);
    }

    public function tambah_user()
    {
        if ($_POST) 
        {
            $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tbl_user.username]');
            $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('level', 'Level', 'required|callback_cek_level');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('password1', 'Re-Password', 'required|matches[password]');
            $this->form_validation->set_message('is_unique', '%s sudah ada!');
            $this->form_validation->set_message('required', '%s harus diisi!');
            $this->form_validation->set_message('cek_level', '%s harus diisi!');
            $this->form_validation->set_message('matches', 'Password tidak sama!');
            if ($this->form_validation->run() == true) {
                $username = htmlspecialchars($this->input->post('username'));
                $nama = htmlspecialchars($this->input->post('nama'));
                $level = htmlspecialchars($this->input->post('level'));
                $email = htmlspecialchars($this->input->post('email'));
                $nohp = htmlspecialchars($this->input->post('nohp'));
                $password = htmlspecialchars($this->input->post('password1'));

                $dt = array(
                    'username' => $username,
                    'nama' => $nama,
                    'level' => $level,
                    'email' => $email,
                    'no_hp' => $nohp,
                    'password' => password_hash($password, PASSWORD_DEFAULT)
                );
                $tambahUser = $this->m_admin->insert_user($dt);
                if ($tambahUser) {                    
                    $pesan = "User Telah dibuat";
                    echo json_encode(array('status' => 1, 'pesan' => "User berhasil dibuat !"));
                }
            } else {
                $this->input_error();
            }
        }
        else{
            $this->load->view('include/navbar');
            $this->load->view('user/tambah_user');
            $this->load->view('include/footer');
        }
    }

    public function delete_user($id)
    {
        $hapus = $this->m_admin->delete_user($id);
        if ($hapus) {
            redirect('admin/list_user');
        }
    }
}
