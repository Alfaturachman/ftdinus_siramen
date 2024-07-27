<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_pi extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

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

        if ($id !== null) {
            $this->db->where('srm_pin.idx_pin', $id);
        }

        $query = $this->db->get();
        return $id !== null ? $query->row_array() : $query->result_array();
    }

    // Ambil data ina cpl
    public function get_ina_cpl()
    {
        $this->db->select('
        srm_cpl.idx_cpl,
        srm_cpl.ina_cpl,
        srm_cpl.nmr_cpl');
        $this->db->from('srm_cpl');

        // Ensure only unique CPL are selected
        $this->db->group_by('srm_cpl.idx_cpl');

        $query = $this->db->get();
        return $query->result_array();
    }

    // Tambah data pin
    public function add_pi($data)
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = array(
            'cpl_pin' => $data['cpl_pin'],
            'ina_pin' => $data['ina_pin'],
            'eng_pin' => $data['eng_pin'],
            'nmr_pin' => $data['nmr_pin'],
            'ins_pin' => date('Y-m-d H:i:s')
        );

        return $this->db->insert('srm_pin', $data);
    }

    // Update data performa index
    public function update_pi($id, $data)
    {
        $this->db->where('idx_pin', $id);
        return $this->db->update('srm_pin', $data);
    }

    // Hapus data performa index
    public function delete_pi($id)
    {
        return $this->db->delete('srm_pin', array('idx_skf' => $id));
    }
}
