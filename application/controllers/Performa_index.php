<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Performa_index extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_pi');
    }

    // Tampilkan daftar cpl
    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            $data['performa_index'] = $this->Mod_pi->get_performa_index();
            $data['ina_cpl'] = $this->Mod_pi->get_ina_cpl();

            $this->load->view('admin/performa_index/pi_view', $data);
        } else {
            redirect('auth');
        }
    }

    // Tambah cpl
    public function add()
    {
        date_default_timezone_set('Asia/Jakarta');
        if ($this->session->userdata('logged_in')) {
            // Load form validation library
            $this->load->library('form_validation');

            // Set validation rules for CPL fields
            $this->form_validation->set_rules('cpl_pin', 'ID CPL', 'required|integer');
            $this->form_validation->set_rules('ina_pin', 'Deskripsi PI Indonesia', 'required');
            $this->form_validation->set_rules('eng_pin', 'Deskripsi PI Inggris', 'required');
            $this->form_validation->set_rules('nmr_pin', 'Nomor', 'required|integer');

            if ($this->form_validation->run() === FALSE) {
                $errors = validation_errors();
                $this->output
                    ->set_status_header(400)
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('error' => $errors)));
            } else {
                // Validation passed, prepare data for insertion
                $data = array(
                    'cpl_pin' => $this->input->post('cpl_pin', true),
                    'ina_pin' => $this->input->post('ina_pin', true),
                    'eng_pin' => $this->input->post('eng_pin', true),
                    'nmr_pin' => $this->input->post('nmr_pin', true),
                    'ins_pin' => date('Y-m-d H:i:s')
                );

                // Insert data into the database
                if ($this->Mod_pi->add_pi($data)) {
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('success' => 'CPL berhasil ditambahkan')));
                } else {
                    $this->output
                        ->set_status_header(500)
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('error' => 'Gagal menambahkan CPL')));
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

    // Edit cpl
    public function edit($id)
    {
        if ($this->session->userdata('logged_in')) {
            $data = $this->Mod_pi->get_performa_index($id);

            if ($data) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($data));
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

    // Update cpl
    public function update()
    {
        if ($this->session->userdata('logged_in')) {
            $this->load->library('form_validation');

            // Set validation rules
            $this->form_validation->set_rules('cpl_pin', 'Program Studi', 'required');
            $this->form_validation->set_rules('ina_pin', 'Deskripsi Indonesia', 'required');
            $this->form_validation->set_rules('eng_pin', 'Deskripsi Inggris', 'required');
            $this->form_validation->set_rules('nmr_pin', 'Nomor', 'required|integer');

            if ($this->form_validation->run() === FALSE) {
                $errors = validation_errors();
                $this->output
                    ->set_status_header(400)
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('error' => $errors)));
            } else {
                $id = $this->input->post('idx_pin');
                $data = array(
                    'cpl_pin' => $this->input->post('cpl_pin', true),
                    'ina_pin' => $this->input->post('ina_pin', true),
                    'eng_pin' => $this->input->post('eng_pin', true),
                    'nmr_pin' => $this->input->post('nmr_pin', true)
                );

                if ($this->Mod_pi->update_pi($id, $data)) {
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('success' => 'PI berhasil diperbarui')));
                } else {
                    $this->output
                        ->set_status_header(500)
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('error' => 'Gagal memperbarui CPL')));
                }
            }
        } else {
            $this->output
                ->set_status_header(403)
                ->set_content_type('application/json')
                ->set_output(json_encode(array('error' => 'User tidak terautentikasi')));
        }
    }

    // Hapus Soft cpl
    public function delete($id)
    {
        if ($this->session->userdata('logged_in')) {
            $this->Mod_pi->delete_cpl($id);
            redirect('cpl');
        } else {
            redirect('auth');
        }
    }
}
