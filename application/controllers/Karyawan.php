<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_karyawan');
    }

    public function index()
    {
        $data['karyawan'] = $this->M_karyawan->get_karyawan();
        $data['avatar'] = $this->M_karyawan->get_data_gambar('users', $this->session->userdata('username'));
        $this->template->load('back/template', 'back/karyawan/data_karyawan', $data);
    }

    function add_tiket()
    {
    }

    public function save_tiket()
    {
        $config =  array(
            'upload_path'     => "./assets/images/profile/",
            'allowed_types'   => "gif|jpg|png|jpeg",
            'encrypt_name'    => False, //
            'max_size'        => "50000",  // ukuran file gambar
            'max_height'      => "9680",
            'max_width'       => "9024"
        );
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('image_user')) {
            $this->session->set_flashdata('message', $this->upload->display_errors());
            $this->load->view('karyawan/profile/' . $this->session->id_users);
        } else {
            $upload_data = $this->upload->data();
            $image_user = $upload_data['file_name'];

            //resize img + thumb Img -- Optional
            $config['image_library']     = 'gd2';
            $config['source_image']      = $upload_data['full_path'];
            $config['create_thumb']      = FALSE;
            $config['maintain_ratio']    = TRUE;
            $config['width']             = 150;
            $config['height']            = 150;

            $this->load->library('image_lib', $config);
            $this->image_lib->initialize($config);
            if (!$this->image_lib->resize()) {
                $data['pesan_error'] = $this->image_lib->display_errors();
                $this->load->view('karyawan/profile/' . $this->session->id_users);
            }

            $where = array(
                'username' => $this->session->userdata('username')
            );

            $data = array(
                'image_user' => $image_user

            );

            $this->M_karyawan->update_gambar('users', $data, $where);
            $this->session->set_flashdata('message', 'Gambar Berhasil Di Upload');
            redirect(base_url('karyawan/profile/' . $this->session->id_users));
        }
    }

    function add_karyawan()
    {
        $data['jabatan'] = $this->M_jabatan->get_jabatan();
        $data['divisi'] = $this->M_divisi->get_divisi();
        $this->template->load('back/template', 'back/karyawan/formkaryawan', $data);
    }

    function save_karyawan()
    {
        $this->form_validation->set_rules('nik', 'Nik', 'trim|is_unique[users.nik]|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|is_unique[users.email]|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[5]|required');
        $this->form_validation->set_rules('confirm_password', 'Confirm password', 'trim|matches[password]|required');

        $this->form_validation->set_message('required', '{field} Harus di isi');
        $this->form_validation->set_message('valid_email', '{field} anda harus valid');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            if ($_FILES['image_user']['error'] <> 4) {

                $config['upload_path'] = './assets/images/profile/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '2048';
                $nama_file = $this->input->post('id_users') . date('Ymdhis');
                $config['file_name'] = $nama_file;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('image_user')) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">' . $error['error'] . '</div>');
                    $this->index();
                } else {
                    $image_user = $this->upload->data();

                    $data = array(
                        'nik' => $this->input->post('nik'),
                        'username' => $this->input->post('username'),
                        'email' => $this->input->post('email'),
                        'jabatan_id' => $this->input->post('jabatan_id'),
                        'divisi_id' => $this->input->post('divisi_id'),
                        'status_user' => 1,
                        'level_user' => 1,
                        'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                        'image_user'   => $this->upload->data('file_name'),


                    );

                    $this->M_karyawan->insert($data);
                    $this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data Berhasil di simpan</div>');
                    redirect('karyawan/profile/' . $this->session->id_users);
                }
            } else {
                $data = array(
                    'nik' => $this->input->post('nik'),
                    'username' => $this->input->post('username'),
                    'email' => $this->input->post('email'),
                    'jabatan_id' => $this->input->post('jabatan_id'),
                    'divisi_id' => $this->input->post('divisi_id'),
                    'status_user' => 1,
                    'level_user' => 1,
                    'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),


                );

                $this->M_karyawan->insert($data);
                $this->session->set_flashdata('message', '<div class="alert alert-info"> Data Berhasil di simpan</div>');
                redirect('karyawan/profile/' . $this->session->id_users);
            }
        }
    }

    function edit_karyawan($id)
    {
        $data['users'] = $this->M_karyawan->get_id_user($id);
        if ($data['users']) {
            $data['jabatan'] = $this->M_jabatan->get_jabatan();
            $data['divisi'] = $this->M_divisi->get_divisi();
            $this->template->load('back/template', 'back/karyawan/edit_karyawan', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"> Data tidak ada</div>');
            redirect('karyawan', 'refresh');
        }
    }

    function update_karyawan()
    {

        $this->form_validation->set_rules('username', 'Username', 'trim|required');

        $this->form_validation->set_message('required', '{field} Harus di isi');

        $this->form_validation->set_message('valid_email', '{field} anda harus valid');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'nik'          => $this->input->post('nik'),
                'username'     => $this->input->post('username'),
                'email'        => $this->input->post('email'),
                'jabatan_id'   => $this->input->post('jabatan_id'),
                'divisi_id'    => $this->input->post('divisi_id'),

                'password'     => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'status_user'  => 1,
                'level_user'   => 1,
            );

            $this->M_karyawan->update($this->input->post('id_users'), $data);
            $this->session->set_flashdata('message', '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data Berhasil diupdate </div>');

            redirect('karyawan', 'refresh');
        } else {

            $this->add_karyawan();
        }
    }

    function delete_karyawan($id)
    {
        $delete = $this->M_karyawan->get_id_karyawan($id);
        if ($delete) {
            $this->M_karyawan->delete($id);
            $this->session->set_flashdata('message', '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data Berhasil dihapus</div>');
            redirect('karyawan', 'refresh');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-info"> Data Tidak ada</div>');
            redirect('karyawan', 'refresh');
        }
    }

    function profile($id)
    {
        $data['karyawan'] = $this->M_karyawan->get_id_karyawan($id);

        if ($data['karyawan']) {
            $data['title'] = 'Profile User';
            $data['jabatan'] = $this->M_jabatan->get_jabatan();
            $data['divisi'] = $this->M_divisi->get_divisi();

            $this->template->load('back/template', 'back/profile', $data);
        } else {
            redirect('dashboard', 'refresh');
        }
    }

    function update_profile()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');

        $this->form_validation->set_message('required', '{field} Harus di isi');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'nik'          => $this->input->post('nik'),
                'username'     => $this->input->post('username'),
                'jabatan_id'   => $this->input->post('jabatan_id'),
                'divisi_id'    => $this->input->post('divisi_id'),
            );

            $this->M_karyawan->update($this->input->post('id_users'), $data);
            $this->session->set_flashdata('message', '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data Berhasil diupdate </div>');

            redirect('karyawan/profile/' . $this->session->id_users);
        } else {

            $this->add_karyawan();
        }
    }

    private function hash_password($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }


    function proses_new_password()
    {
        $this->form_validation->set_rules('new_password', 'New Password', 'required');
        $this->form_validation->set_rules('confirm_new_password', 'Confirm New Password', 'required|matches[new_password]');

        if ($this->form_validation->run() == TRUE) {
            if ($this->session->userdata('id_users') === $this->input->post('id_users')) {
                $username = $this->input->post('username');
                $new_password = $this->input->post('new_password');

                $data = array(
                    'password' => $this->hash_password($new_password),
                );

                $where = array(
                    'id_users' => $this->session->userdata('id_users')
                );

                $this->M_karyawan->update_password('users', $where, $data);

                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Password Berhasil di update </div>');
                redirect('karyawan/profile/' . $this->session->id_users);
            }
        } else {
            $this->add_karyawan();
        }
    }
}
