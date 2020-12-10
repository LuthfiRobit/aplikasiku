<?php
class Admin_model extends CI_Model
{
    public function tampildata($tabel, $id)
    {
        return $this->db->from($tabel)->order_by($id, 'DESC')->get('');
    }
    public function simpandata($tabel, $data)
    {
        return $this->db->insert($tabel, $data);
    }
    public function hapusdata($tabel, $id, $primary)
    {
        return $this->db->delete($tabel, array($primary => $id));
    }
    public function formedit($tabel, $primary, $id)
    {
        return $this->db->get_where($tabel, array($primary => $id))->row();
    }
    public function editdata($tabel, $primary, $id, $data)
    {
        return $this->db->where($primary, $id)->update($tabel, $data);
    }
    public function joinsiswa()
    {
        $query = $this->db->select('*')
            ->from('siswa')
            ->join('tahun_pelajaran', 'siswa.id_tahun_pelajaran=tahun_pelajaran.id_tahun_pelajaran', 'left')
            ->order_by('id_siswa', 'DESC')
            ->get();
        return $query;
    }
    public function comboboxdinamis()
    {
        $query = $this->db->get('tahun_pelajaran');
        $tambah[set_value('id_tahun_pelajaran')] = "--Isi Tahun Pelajaran--";
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $tambah[$row->id_tahun_pelajaran] = $row->tahun_pelajaran;
            }
        }
        return $tambah;
    }
}
