<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tiket extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }


    public function index()
    {

        $data['tiket'] = $this->M_tiket->get_tiket();
        $data['no_tiket'] = $this->M_tiket->no_tiket();
        $data['tiket_user'] = $this->M_tiket->tiket_user();

        $this->template->load('back/template', 'back/tiket/tiket', $data);
    }

    function add_tiket()
    {
    }

    function save_tiket()
    {
        $this->form_validation->set_rules('judul_tiket', 'Judul Tiket', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Tiket', 'trim|required');

        $this->form_validation->set_message('required', '{field} Harus di isi');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');


        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            if ($_FILES['gambar_tiket']['error'] <> 4) {

                $config['upload_path'] = './assets/images/tiket/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '2048';
                $nama_file = $this->input->post('no_tiket') . date('Ymdhis');
                $config['file_name'] = $nama_file;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('gambar_tiket')) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">' . $error['error'] . '</div>');
                    $this->index();
                } else {
                    $gambar_tiket = $this->upload->data();

                    $data = array(
                        'no_tiket'       => $this->input->post('no_tiket'),
                        'judul_tiket'    => $this->input->post('judul_tiket'),
                        'deskripsi'      => $this->input->post('deskripsi'),
                        'status_tiket'   => 0,
                        'users_id'        => $this->session->userdata('id_users'),
                        'gambar_tiket'   => $this->upload->data('file_name'),
                        'tgl_daftar'     => date('Y-m-d H:i:s'),

                    );

                    $this->M_tiket->insert($data);
                    $this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data Berhasil di simpan</div>');
                    redirect('tiket', 'refresh');
                }
            } else {
                $data = array(
                    'no_tiket'       => $this->input->post('no_tiket'),
                    'judul_tiket'    => $this->input->post('judul_tiket'),
                    'deskripsi'      => $this->input->post('deskripsi'),
                    'status_tiket'   => 0,
                    'users_id'        => $this->session->userdata('id_users'),
                    //        'gambar_tiket'   => $this->upload->data('file_name'),
                    'tgl_daftar'     => date('Y-m-d H:i:s'),

                );

                $this->M_tiket->insert($data);
                $this->session->set_flashdata('message', '<div class="alert alert-info"> Data Berhasil di simpan</div>');
                redirect('tiket', 'refresh');
            }
        }
    }

    function save_tanggapan()
    {
        $this->form_validation->set_rules('tanggapan', 'Tanggapan Tiket', 'trim|required');

        $this->form_validation->set_message('required', '{field} Harus di isi');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');


        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            if ($_FILES['gambar_tanggapan']['error'] <> 4) {

                $config['upload_path']   = './assets/images/tanggapan/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '2048';
                $nama_file               = $this->input->post('tiket_id') . date('Ymdhis');
                $config['file_name']     = $nama_file;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('gambar_tanggapan')) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">' . $error['error'] . '</div>');
                    $this->index();
                } else {

                    if ($this->input->post('id_tiket')) {
                        $data = array(
                            'status_tiket' => 2,
                        );

                        $this->M_tiket->update($this->input->post('id_tiket'), $data);
                    }


                    $gambar_tanggapan = $this->upload->data();

                    $data = array(
                        'tiket_id'          => $this->input->post('id_tiket'),
                        'tanggapan'         => $this->input->post('tanggapan'),
                        'gambar_tanggapan'  => $this->upload->data('file_name'),
                        'waktu_tanggapan'   => date('Y-m-d'),

                    );

                    $this->M_tiket->insert_tanggapan($data);
                    $this->session->set_flashdata('message', '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data Berhasil di simpan</div>');
                    redirect('tiket', 'refresh');
                }
            } else {

                if ($this->input->post('id_tiket')) {
                    $data = array(
                        'status_tiket' => 2,
                    );

                    $this->M_tiket->update($this->input->post('id_tiket'), $data);
                }


                $data = array(
                    'tiket_id'          => $this->input->post('tiket_id'),
                    'tanggapan'         => $this->input->post('tanggapan'),
                    'waktu_tanggapan'   => date('Y-m-d'),
                );

                $this->M_tiket->insert_tanggapan($data);
                $this->session->set_flashdata('message', '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data Berhasil di simpan</div>');
                redirect('tiket', 'refresh');
            }
        }
    }


    function save_tiket_waiting()
    {
        $this->form_validation->set_rules('status_tiket', 'Status Tiket', 'trim|required');

        $this->form_validation->set_message('required', '{field} Harus di isi');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = array(
                'status_tiket' => $this->input->post('status_tiket'),
            );

            $this->M_tiket->update($this->input->post('id_tiket'), $data);
            $this->session->set_flashdata('message', '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Status tiket berhasil di update</div>');
            redirect('tiket', 'refresh');
        }
    }

    function save_close_tiket()
    {
        $this->form_validation->set_rules('status_tiket', 'Status Tiket', 'trim|required');

        $this->form_validation->set_message('required', '{field} Harus di isi');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = array(
                'status_tiket' => $this->input->post('status_tiket'),
            );

            $this->M_tiket->update($this->input->post('id_tiket'), $data);
            $this->session->set_flashdata('message', '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Status tiket berhasil di close</div>');
            redirect('tiket', 'refresh');
        }
    }

    function detail_tiket($no_tiket)
    {
        $data['tiket'] = $this->M_tiket->get_no_tiket($no_tiket);
        if ($data['tiket']) {
            $data['title'] = 'Detail Tiket' . $data['tiket']->no_tiket;
            $this->template->load('back/template', 'back/tiket/detail_tiket', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-info">Data Tiket tidak ada</div>');
            redirect('tiket', 'refresh');
        }
    }

    function delete_tiket($id)
    {
        $delete = $this->M_tiket->get_id_tiket($id);
        if ($delete) {
            $this->M_tiket->delete($id);
            $this->session->set_flashdata('message', '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil dihapus</div>');
            redirect('tiket', 'refresh');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Data tidak ada</div>');
            redirect('tiket', 'refresh');
        }
    }
}
