<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_log extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // Load database library jika belum diload di autoload.php
        $this->load->database();
    }

    // Fungsi untuk menyimpan data log
    public function log_act()
    {
        // Mengumpulkan data untuk disimpan ke log
        $data = array(
            'nte_log' => 'Contoh catatan log',  // Catatan atau deskripsi log
            'ipa_log' => $this->input->ip_address(),  // Alamat IP pengguna
            'uag_log' => $this->input->user_agent(),  // User agent string
            'usr_log' => $this->session->userdata('user_id') ? $this->session->userdata('user_id') : 'guest',  // Kode user, atau 'guest' jika tidak login
            'uri_log' => current_url(),  // URI yang diakses
            'get_log' => json_encode($this->input->get()),  // Data GET dalam format JSON
            'pos_log' => json_encode($this->input->post()),  // Data POST dalam format JSON
            'fle_log' => !empty($_FILES) ? json_encode($_FILES) : '',  // Informasi file yang diunggah, jika ada
            'ses_log' => json_encode($this->session->userdata()),  // Data sesi pengguna
            'env_log' => ENVIRONMENT,  // Lingkungan aplikasi (development, production, dll.)
            'civ_log' => CI_VERSION,  // Versi CodeIgniter
            'cki_log' => json_encode($_COOKIE)  // Data cookie dalam format JSON
        );

        // Memasukkan data ke tabel srm_log
        $this->db->insert('srm_log', $data);
    }
}
