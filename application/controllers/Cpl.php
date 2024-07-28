<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cpl extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_skf');
        $this->load->model('Mod_cpl');
    }

    // Tampilkan daftar cpl
    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            $data['cpl'] = $this->Mod_cpl->get_cpl();
            $data['program_studi'] = $this->Mod_cpl->get_program_studi();

            // Memuat view dengan data yang sudah dikumpulkan
            $this->load->view('admin/cpl/cpl_view', $data);
        } else {
            redirect('auth');
        }
    }

    // Tambah cpl
    public function add()
    {
        if ($this->session->userdata('logged_in')) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('skf_cpl', 'ID Program Studi', 'required|integer');
            $this->form_validation->set_rules('ina_cpl', 'Deskripsi Indonesia', 'required');
            $this->form_validation->set_rules('eng_cpl', 'Deskripsi Inggris', 'required');
            $this->form_validation->set_rules('nmr_cpl', 'Nomor', 'required|integer');

            if ($this->form_validation->run() === FALSE) {
                $errors = validation_errors();
                $this->output
                    ->set_status_header(400)
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('error' => $errors)));
            } else {
                $data = array(
                    'skf_cpl' => $this->input->post('skf_cpl', true),
                    'ina_cpl' => $this->input->post('ina_cpl', true),
                    'eng_cpl' => $this->input->post('eng_cpl', true),
                    'nmr_cpl' => $this->input->post('nmr_cpl', true)
                );

                if ($this->Mod_cpl->add_cpl($data)) {
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
            $cpl = $this->Mod_cpl->get_cpl($id);
            if ($cpl) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($cpl));
            } else {
                $this->output
                    ->set_status_header(404)
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['error' => 'Data tidak ditemukan']));
            }
        } else {
            redirect('auth');
        }
    }

    public function update()
    {
        if ($this->session->userdata('logged_in')) {
            $id = $this->input->post('id');
            $data = [
                'skf_cpl' => $this->input->post('skf_cpl'),
                'ina_cpl' => $this->input->post('ina_cpl'),
                'eng_cpl' => $this->input->post('eng_cpl'),
                'nmr_cpl' => $this->input->post('nmr_cpl')
            ];

            $updated = $this->Mod_cpl->update_cpl($id, $data);
            $response = ['success' => $updated];
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        } else {
            redirect('auth');
        }
    }

    // Hapus Soft cpl
    public function delete($id)
    {
        if ($this->session->userdata('logged_in')) {
            $this->Mod_skf->delete_cpl($id);
            redirect('cpl');
        } else {
            redirect('auth');
        }
    }
}
