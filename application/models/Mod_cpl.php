<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_cpl extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Ambil semua data cpl
    public function get_cpl($id = null)
    {
        $this->db->select('srm_cpl.*, srm_skf.jr2_skf, srm_skf.jjg_skf, srm_skf.kde_skf, srm_sfk.nma_sfk, srm_sfk.kde_sfk, srm_ipt.nma_ipt');
        $this->db->from('srm_cpl');
        $this->db->join('srm_skf', 'srm_cpl.skf_cpl = srm_skf.idx_skf', 'left');
        $this->db->join('srm_sfk', 'srm_skf.sfk_skf = srm_sfk.idx_sfk', 'left');
        $this->db->join('srm_ipt', 'srm_sfk.ipt_sfk = srm_ipt.idx_ipt', 'left');

        // Jika ID diberikan, tambahkan kondisi WHERE
        if ($id !== null) {
            $this->db->where('srm_cpl.idx_cpl', $id);
        }

        $query = $this->db->get();
        return $id !== null ? $query->row_array() : $query->result_array();
    }

    public function get_program_studi()
    {
        $this->db->select('srm_sfk.idx_sfk, srm_sfk.nma_sfk, srm_skf.sfk_skf, srm_skf.jr2_skf, srm_skf.jjg_skf, srm_skf.kde_skf, srm_skf.idx_skf');
        $this->db->from('srm_skf');
        $this->db->join('srm_sfk', 'srm_sfk.idx_sfk = srm_skf.sfk_skf', 'left');
        $this->db->join('srm_ipt', 'srm_ipt.idx_ipt = srm_sfk.ipt_sfk', 'left');

        $query = $this->db->get();
        return $query->result_array();
    }

    // Tambah data cpl
    public function add_cpl($data)
    {
        $data = array(
            'skf_cpl' => $data['skf_cpl'],
            'ina_cpl' => $data['ina_cpl'],
            'eng_cpl' => $data['eng_cpl'],
            'nmr_cpl' => $data['nmr_cpl']
        );

        return $this->db->insert('srm_cpl', $data);
    }

    // Update data cpl
    public function update_cpl($id, $data)
    {
        $this->db->where('idx_cpl', $id);
        return $this->db->update('srm_cpl', $data);
    }

    // Hapus data cpl
    public function delete_cpl($id)
    {
        return $this->db->delete('srm_cpl', array('idx_skf' => $id));
    }
}
