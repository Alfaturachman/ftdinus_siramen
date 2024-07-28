<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_skf extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Ambil semua data program studi
    public function get_program_studi($id = null)
    {
        $this->db->select('srm_ipt.jns_ipt, srm_ipt.nma_ipt, srm_sfk.kde_sfk, srm_sfk.idx_sfk, srm_sfk.nma_sfk, srm_skf.*');
        $this->db->from('srm_skf');
        $this->db->join('srm_sfk', 'srm_sfk.idx_sfk = srm_skf.sfk_skf', 'left');
        $this->db->join('srm_ipt', 'srm_ipt.idx_ipt = srm_sfk.ipt_sfk', 'left');

        // Jika ID disediakan, filter berdasarkan ID program studi
        if ($id !== null) {
            $this->db->where('srm_skf.idx_skf', $id);
        }

        // Jalankan query dan ambil hasilnya
        $query = $this->db->get();

        // Kembalikan hasil sebagai array
        return $id === null ? $query->result_array() : $query->row_array();
    }

    // Tambah data program studi
    public function add_program_studi($data)
    {
        $data = array(
            'sfk_skf' => $data['idx_sfk'],
            'kde_skf' => $data['kde_skf'],
            'jr2_skf' => $data['jr2_skf'],
            'jjg_skf' => $data['jjg_skf']
        );

        return $this->db->insert('srm_skf', $data);
    }

    // Update data program studi
    public function update_program_studi($id, $data)
    {
        $this->db->where('idx_skf', $id);
        return $this->db->update('srm_skf', $data);
    }

    // Hapus data program studi
    public function delete_program_studi($id)
    {
        return $this->db->delete('srm_skf', array('idx_skf' => $id));
    }
}
