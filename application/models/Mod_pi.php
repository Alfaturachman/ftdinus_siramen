<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_pi extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Ambil semua data cpl
    public function get_performa_index($id = null)
    {
        $this->db->select('
        srm_pin.cpl_pin,
        srm_pin.ina_pin,
        srm_pin.eng_pin,
        srm_pin.nmr_pin,
        srm_pin.idx_pin,
        srm_cpl.skf_cpl,
        srm_cpl.ina_cpl,
        srm_cpl.nmr_cpl,
        srm_cpl.idx_cpl,
        srm_skf.sfk_skf,
        srm_skf.jr2_skf,
        srm_skf.jjg_skf,
        srm_skf.kde_skf,
        srm_skf.idx_skf
    ');
        $this->db->from('srm_pin');
        $this->db->join('srm_cpl', 'srm_pin.cpl_pin = srm_cpl.idx_cpl', 'left');
        $this->db->join('srm_skf', 'srm_cpl.skf_cpl = srm_skf.idx_skf', 'left');

        // Jika ID diberikan, tambahkan kondisi WHERE
        if ($id !== null) {
            $this->db->where('srm_pin.cpl_pin', $id);
        }

        $query = $this->db->get();
        return $id !== null ? $query->row_array() : $query->result_array();
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
        $this->db->where('skf_cpl', $id);
        return $this->db->update('srm_cpl', $data);
    }

    // Hapus data cpl
    public function delete_cpl($id)
    {
        return $this->db->delete('srm_cpl', array('idx_skf' => $id));
    }
}
