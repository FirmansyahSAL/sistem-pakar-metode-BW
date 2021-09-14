<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
    }

    function login()
    {
        $this->load->view('back/login');
    }


    function register()
    {
        $this->load->view('back/register');
    }

    function proses_register()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'valid_email|is_unique[users.email]|required');
        $this->form_validation->set_rules('password', 'password', 'trim|min_length[5]required');
        $this->form_validation->set_rules('confirm_password', 'confirm password', 'trim|matches[password]|required');

        $this->form_validation->set_message('required', '{field} Harus di isi');
        $this->form_validation->set_message('valid_email', '{field} anda harus valid');
        $this->form_validation->set_message('min_length', '{field} anda minimal 5 karakter');
        $this->form_validation->set_message('matches', '{field} anda tidak sama');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'nik' => $this->input->post('nik'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'status_user' => 1,
                'level_user' => 1,
                // 'image_user'   => $this->upload->data('file_name'),
            );
            //var_dump($data);

            $this->M_auth->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data Berhasil disimpan</div>');
            redirect('auth/login', 'refresh');
        } else {
            $this->load->view('back/register');
        }
    }


    function proses_login()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        $this->form_validation->set_message('required', '{field} Harus di isi');
        $this->form_validation->set_message('valid_email', '{field} anda harus valid');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');


        if ($this->form_validation->run() == TRUE) {
            $user = $this->M_auth->get_email_user($this->input->post('email'));
            if (!$user) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Email tidak ditemukan </div>');
                redirect('auth/login', 'refresh');
            } else if ($user->status_user == '0') {
                $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> User tidak aktif, silahkan hubungi admin</div>');
                redirect('auth/login', 'refresh');
            } else if (!password_verify($this->input->post('password'), $user->password)) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> password anda salah</div>');
                redirect('auth/login', 'refresh');
            } else {
                $session = array(
                    'id_users'    => $user->id_users,
                    'username'    => $user->username,
                    'email'       => $user->email,
                    'level_user'  => $user->level_user,
                    'image_user'  => $user->image_user,
                );
                $this->session->set_userdata($session);
                redirect('dashboard');
            }
        } else {
            $data['title'] = 'Login pages';
            $this->load->view('back/login', $data);
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('message', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Anda berhasil Logout </div>');

        redirect('auth/login');
    }
}
