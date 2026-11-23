<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch_timezone {

    public function apply()
    {
        $CI =& get_instance();
        if (!isset($CI->session) || !isset($CI->db)) {
            return;
        }

        $branch_id = $CI->session->userdata('branch_id');
        if (empty($branch_id)) {
            return;
        }

        $query = $CI->db->select('timezone')
            ->from('customer_branches')
            ->where('branch_id', (int) $branch_id)
            ->limit(1)
            ->get();
        if ($query === FALSE) {
            return;
        }

        $row = $query->row();
        $allowed = array_keys((array) $CI->config->item('au_timezones'));
        if ($row && in_array($row->timezone, $allowed, TRUE)) {
            date_default_timezone_set($row->timezone);
        }
    }
}
