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

            // Memuat view dengan data yang sudah dikumpulkan
            $this->load->view('admin/performa_index/pi_view', $data);
        } else {
            redirect('auth');
        }
    }

    // Tambah cpl
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
                if ($this->Mod_pi->add_cpl($data)) {
                    // Data inserted successfully
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('success' => 'cpl berhasil ditambahkan')));
                } else {
                    // Insert failed
                    $this->output
                        ->set_status_header(500)
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('error' => 'Gagal menambahkan cpl')));
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
            $cpl = $this->Mod_pi->get_cpl($id);

            if ($cpl) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($cpl));
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
            $id = $this->input->post('id');
            $data = array(
                'skf_cpl' => $this->input->post('skf_cpl'),
                'ina_cpl' => $this->input->post('ina_cpl'),
                'eng_cpl' => $this->input->post('eng_cpl'),
                'nmr_cpl' => $this->input->post('nmr_cpl')
            );

            $updated = $this->Mod_pi->update_cpl($id, $data);

            if ($updated) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('success' => true)));
            } else {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('success' => false)));
            }
        } else {
            redirect('auth');
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
