<?php

class Login_model extends CI_Model
{
    public function akses_login($user, $pass)
    {
        $u = htmlspecialchars($user);
        $p = md5($pass);
        $us = $this->db->escape_str($u);
        $ps = $this->db->escape_str($p);
        $query = $this->db->select('*')
            ->from('users')
            ->where('username', $us)
            ->where('password', $ps)
            ->limit(1)
            ->get();
        if ($query->num_rows() == 1) {
            return $query->result_object();
        } else {
            return false;
        }
    }
}
