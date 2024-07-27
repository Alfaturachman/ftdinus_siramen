<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_auth extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Function to validate login credentials
    public function validate_login($username, $password)
    {
        $this->db->select('srm_lgn.usr_lgn, srm_lgn.psw_lgn, srm_lvl.nma_lvl');
        $this->db->from('srm_lgn');
        $this->db->join('srm_lvl', 'srm_lgn.lvl_lgn = srm_lvl.idx_lvl', 'left');
        $this->db->where('srm_lgn.usr_lgn', $username);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $user = $query->row();

            // Log password hash comparison
            $_enc_psw = sha1('jksdhf832746aiH{}{()&(*&(*' . MD5($password) . 'HdfevgyDDw{}{}{;;*766&*&*');
            error_log("Password from database (MD5): " . $user->psw_lgn);
            error_log("Password sent (MD5): " . $_enc_psw);

            // Verify password using MD5
            if ($_enc_psw === $user->psw_lgn) {
                return [
                    'username' => $user->usr_lgn,
                    'level_name' => $user->nma_lvl
                ];
            }
        }

        return false;
    }
}
