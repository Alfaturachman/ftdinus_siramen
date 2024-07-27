<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Program_studi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_skf');
    }

    // Tampilkan daftar program studi
    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            $data['program_studi'] = $this->Mod_skf->get_program_studi();
            $this->load->view('admin/program_studi/skf_view', $data);
        } else {
            redirect('auth');
        }
    }

    // Tambah program studi
    public function add()
    {
        if ($this->session->userdata('logged_in')) {
            // Load form validation library
            $this->load->library('form_validation');

            // Set validation rules
            $this->form_validation->set_rules('idx_sfk', 'ID Fakultas', 'required|integer');
            $this->form_validation->set_rules('kde_skf', 'Kode Program Studi', 'required');
            $this->form_validation->set_rules('jr2_skf', 'Nama Program Studi', 'required');
            $this->form_validation->set_rules('jjg_skf', 'Jenjang Program Studi', 'required');

            if ($this->form_validation->run() === FALSE) {
                // Validation failed, return errors
                $errors = validation_errors();
                $this->output
                    ->set_status_header(400)
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('error' => $errors)));
            } else {
                // Validation passed, prepare data for insertion
                $data = array(
                    'idx_sfk' => $this->input->post('idx_sfk', true),
                    'kde_skf' => $this->input->post('kde_skf', true),
                    'jr2_skf' => $this->input->post('jr2_skf', true),
                    'jjg_skf' => $this->input->post('jjg_skf', true)
                );

                // Insert data into the database
                if ($this->Mod_skf->add_program_studi($data)) {
                    // Data inserted successfully
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('success' => 'Program studi berhasil ditambahkan')));
                } else {
                    // Insert failed
                    $this->output
                        ->set_status_header(500)
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('error' => 'Gagal menambahkan program studi')));
                }
            }
        } else {
            // User not logged in, return error
            $this->output
                ->set_status_header(403)
                ->set_content_type('application/json')
                ->set_output(json_encode(array('error' => 'User tidak terautentikasi')));
        }
    }

    // Edit program studi
    public function edit($id)
    {
        if ($this->session->userdata('logged_in')) {
            $program_studi = $this->Mod_skf->get_program_studi($id);

            if ($program_studi) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($program_studi));
            } else {
                $this->output
                    ->set_status_header(404)
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('error' => 'Data not found')));
            }
        } else {
            redirect('auth');
        }
    }

    // Update program studi
    public function update()
    {
        if ($this->session->userdata('logged_in')) {
            $id = $this->input->post('idx_skf');
            $data = array(
                'kde_skf' => $this->input->post('kde_skf'),
                'jr2_skf' => $this->input->post('jr2_skf'),
                'jjg_skf' => $this->input->post('jjg_skf')
            );

            if ($this->Mod_skf->update_program_studi($id, $data)) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('status' => 'success')));
            } else {
                $this->output
                    ->set_status_header(500)
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('status' => 'error')));
            }
        } else {
            redirect('auth');
        }
    }

    // Hapus program studi
    public function delete($id)
    {
        if ($this->session->userdata('logged_in')) {
            $this->Mod_skf->delete_program_studi($id);
            redirect('program_studi');
        } else {
            redirect('auth');
        }
    }
}
