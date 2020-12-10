<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
        function __construct()
        {
                parent::__construct();
                $this->load->model('admin_model');
                if (empty($this->session->userdata('username')) and empty($this->session->userdata('password'))) {
                        redirect('login');
                } else {
                        $nama_lengkap = $this->session->userdata('nama_lengkap');
                }
        }

        public function index()
        {
                $judul['atas'] = "Halaman Utama Administrator";
                $judul['menuatas'] = "Beranda";
                $data['s'] = $this->db->get('siswa')->num_rows();
                $data['g'] = $this->db->get('guru')->num_rows();
                $data['k'] = $this->db->get('kelas')->num_rows();
                $this->load->view('template/header', $judul);
                $this->load->view('beranda', $data);
                $this->load->view('template/footer');
        }

        public function siswa()
        {
                $judul['atas'] = "Halaman Siswa";
                $judul['menuatas'] = "Siswa";
                $data['sw'] = $this->admin_model->joinsiswa();
                $this->load->view('template/header', $judul);
                $this->load->view('siswa', $data);
                $this->load->view('template/footer');
        }

        public function tambah_siswa()
        {
                $judul['atas'] = "Halaman Tambah Siswa";
                $judul['menuatas'] = "Form Siswa";
                $this->load->view('template/header', $judul);
                $data['combo'] = $this->admin_model->comboboxdinamis();
                $data['error'] = "";
                $this->load->view('form_siswa', $data);
                $this->load->view('template/footer');
        }

        public function simpan_siswa()
        {
                $this->form_validation->set_rules('th', '', 'required', array('required' => 'NIP Wajib Diisi'));
                $this->form_validation->set_rules('nis', '', 'required', array('required' => 'NIS Wajib Diisi'));
                $this->form_validation->set_rules('nama_siswa', '', 'required', array('required' => 'Nama Guru Wajib Diisi'));
                $this->form_validation->set_rules('jk', '', 'required', array('required' => 'Jenis Kelamin Wajib Diisi'));
                $this->form_validation->set_rules('alamat_siswa', '', 'required', array('required' => 'Alamat Wajib Diisi'));
                if ($this->form_validation->run() == FALSE) {
                        $judul['atas'] = "Halaman Tambah Siswa";
                        $judul['menuatas'] = "Form Siswa";
                        $this->load->view('template/header', $judul);
                        $this->load->view('form_siswa', array('error' => ''));
                        $this->load->view('template/footer');
                } else {
                        if ($_FILES['foto']['name']) {
                                $config['upload_path'] = './assets/img_siswa/';
                                $config['allowed_types'] = 'gif|jpg|png|JPG|jpeg';
                                $config['max_size'] = 1024;
                                // $config['max_width'] = 600;
                                // $config['max_height'] = 500;
                                $config['encrypt_name'] = True;
                                $this->load->library('upload', $config);
                                if (!$this->upload->do_upload('foto')) {
                                        $error = array('error' => $this->upload->display_errors(' '));
                                        $judul['atas'] = "Halaman Tambah Siswa";
                                        $judul['menuatas'] = "Form Siswa";
                                        $this->load->view('template/header', $judul);
                                        $this->load->view('form_siswa', $error);
                                        $this->load->view('template/footer');
                                } else {
                                        $gbr = $this->upload->data();
                                        //cropGambar
                                        $config['image_library'] = 'gd2';
                                        $config['source_image'] = './assets/img_siswa/' . $gbr['file_name'];
                                        $config['create_thumb'] = FALSE;
                                        $config['maintain_raito'] = FALSE;
                                        $config['quality'] = '50%';
                                        $config['width'] = 400;
                                        $config['height'] = 600;
                                        $config['new_image'] = './assets/img_siswa/' . $gbr['file_name'];
                                        $this->load->library('image_lib', $config);
                                        $this->image_lib->resize();
                                        //cropGambar
                                        $foto = $gbr['file_name'];
                                        //simpan
                                        $data = array(
                                                'id_tahun_pelajaran' => $this->input->post('th'),
                                                'nisn' => $this->input->post('nis'),
                                                'nama_siswa' => $this->input->post('nama_siswa'),
                                                'jk_siswa' => $this->input->post('jk'),
                                                'almt_siswa' => $this->input->post('alamat_siswa'),
                                                'foto' => $foto
                                        );
                                        $query = $this->admin_model->simpandata('siswa', $data);
                                        if ($query) {
                                                $this->session->set_flashdata('info', 'Data Siswa Berhasil Tersimpan');
                                                redirect('Admin/siswa');
                                        } else {
                                                $this->session->set_flashdata('info', 'Data Siswa Gagal Tersimpan');
                                                redirect('Admin/siswa');
                                        }
                                }
                        } else {
                                $data = array(
                                        'id_tahun_pelajaran' => $this->input->post('th'),
                                        'nisn' => $this->input->post('nis'),
                                        'nama_siswa' => $this->input->post('nama_siswa'),
                                        'jk_siswa' => $this->input->post('jk'),
                                        'almt_siswa' => $this->input->post('alamat_siswa')
                                );
                                $query = $this->admin_model->simpandata('siswa', $data);
                                if ($query) {
                                        $this->session->set_flashdata('info', 'Data Siswa Berhasil Tersimpan');
                                        redirect('Admin/siswa');
                                } else {
                                        $this->session->set_flashdata('info', 'Data Siswa Gagal Tersimpan');
                                        redirect('Admin/siswa');
                                }
                        }
                }
        }

        public function hapus_siswa($id)
        {
                $data = $this->admin_model->formedit('siswa', 'id_siswa', $id);
                $this->admin_model->hapusdata('siswa', $id, 'id_siswa');
                if ($this->db->affected_rows()) {
                        unlink("./assets/img_siswa/" . $data->foto);
                        $this->session->set_flashdata('info', 'Data Siswa Berhasil Dihapus');
                        redirect('Admin/siswa');
                } else {
                        $this->session->set_flashdate('info', 'Data Siswa Gagal Dihapus');
                        redirect('Admin/siswa');
                }
        }

        public function formedit_siswa($id)
        {
                $judul['atas'] = "Halaman Edit Siswa";
                $judul['menuatas'] = "Form Edit Siswa";
                $data['es'] = $this->admin_model->formedit('siswa', 'id_siswa', $id);
                $data['combo'] = $this->admin_model->comboboxdinamis();
                $data['error'] = "";
                $this->load->view('template/header', $judul);
                $this->load->view('formedit_siswa', $data);
                $this->load->view('template/footer');
        }

        public function edit_siswa()
        {
                $this->form_validation->set_rules('th', '', 'required', array('required' => 'NIP Wajib Diisi'));
                $this->form_validation->set_rules('nis', '', 'required', array('required' => 'NIS Wajib Diisi'));
                $this->form_validation->set_rules('nama_siswa', '', 'required', array('required' => 'Nama Guru Wajib Diisi'));
                $this->form_validation->set_rules('jk', '', 'required', array('required' => 'Jenis Kelamin Wajib Diisi'));
                $this->form_validation->set_rules('alamat_siswa', '', 'required', array('required' => 'Alamat Wajib Diisi'));
                $id = $this->input->post('id_siswa');
                $foto = $this->input->post('foto');
                if ($this->form_validation->run() == FALSE) {
                        $judul['atas'] = "Halaman Tambah Siswa";
                        $judul['menuatas'] = "Form Siswa";
                        $this->load->view('template/header', $judul);
                        $this->load->view('form_siswa', array('error' => ''));
                        $this->load->view('template/footer');
                } else {
                        if ($_FILES['foto']['name']) {
                                $config['upload_path'] = './assets/img_siswa/';
                                $config['allowed_types'] = 'gif|jpg|png|JPG|jpeg';
                                $config['max_size'] = 1024;
                                // $config['max_width'] = 600;
                                // $config['max_height'] = 500;
                                $config['encrypt_name'] = True;
                                $this->load->library('upload', $config);
                                if (!$this->upload->do_upload('foto')) {
                                        $error = array('error' => $this->upload->display_errors(' '));
                                        $judul['atas'] = "Halaman Tambah Siswa";
                                        $judul['menuatas'] = "Form Siswa";
                                        $this->load->view('template/header', $judul);
                                        $this->load->view('form_siswa', $error);
                                        $this->load->view('template/footer');
                                } else {
                                        $gbr = $this->upload->data();
                                        unlink("./assets/img_siswa/" . $foto);
                                        //cropGambar
                                        $config['image_library'] = 'gd2';
                                        $config['source_image'] = './assets/img_siswa/' . $gbr['file_name'];
                                        $config['create_thumb'] = FALSE;
                                        $config['maintain_raito'] = FALSE;
                                        $config['quality'] = '50%';
                                        $config['width'] = 400;
                                        $config['height'] = 600;
                                        $config['new_image'] = './assets/img_siswa/' . $gbr['file_name'];
                                        $this->load->library('image_lib', $config);
                                        $this->image_lib->resize();
                                        //cropGambar
                                        $foto = $gbr['file_name'];
                                        //simpan
                                        $data = array(
                                                'id_tahun_pelajaran' => $this->input->post('th'),
                                                'nisn' => $this->input->post('nis'),
                                                'nama_siswa' => $this->input->post('nama_siswa'),
                                                'jk_siswa' => $this->input->post('jk'),
                                                'almt_siswa' => $this->input->post('alamat_siswa'),
                                                'foto' => $foto
                                        );
                                        $query = $this->admin_model->editdata('siswa', 'id_siswa', $id, $data);
                                        if ($query) {
                                                $this->session->set_flashdata('info', 'Data Siswa Berhasil Tersimpan');
                                                redirect('Admin/siswa');
                                        } else {
                                                $this->session->set_flashdata('info', 'Data Siswa Gagal Tersimpan');
                                                redirect('Admin/siswa');
                                        }
                                }
                        } else {
                                $data = array(
                                        'id_tahun_pelajaran' => $this->input->post('th'),
                                        'nisn' => $this->input->post('nis'),
                                        'nama_siswa' => $this->input->post('nama_siswa'),
                                        'jk_siswa' => $this->input->post('jk'),
                                        'almt_siswa' => $this->input->post('alamat_siswa')
                                );
                                $query = $this->admin_model->editdata('siswa', 'id_siswa', $id, $data);
                                if ($query) {
                                        $this->session->set_flashdata('info', 'Data Siswa Berhasil Tersimpan');
                                        redirect('Admin/siswa');
                                } else {
                                        $this->session->set_flashdata('info', 'Data Siswa Gagal Tersimpan');
                                        redirect('Admin/siswa');
                                }
                        }
                }
        }

        public function guru()
        {
                $judul['atas'] = "Halaman Guru";
                $judul['menuatas'] = "Guru";
                $data['tg'] = $this->admin_model->tampildata('guru', 'id_guru');
                $this->load->view('template/header', $judul);
                $this->load->view('guru', $data);
                $this->load->view('template/footer');
        }

        public function tambah_guru()
        {
                $judul['atas'] = "Halaman Tambah Guru";
                $judul['menuatas'] = "Form Guru";
                $this->load->view('template/header', $judul);
                $this->load->view('form_guru', array('error' => ''));
                $this->load->view('template/footer');
        }

        public function simpan_guru()
        {
                $this->form_validation->set_rules('nip', '', 'required', array('required' => 'NIP Wajib Diisi'));
                $this->form_validation->set_rules('nama_guru', '', 'required', array('required' => 'Nama Guru Wajib Diisi'));
                $this->form_validation->set_rules('jk', '', 'required', array('required' => 'Jenis Kelamin Wajib Diisi'));
                $this->form_validation->set_rules('alamat_guru', '', 'required', array('required' => 'Alamat Wajib Diisi'));
                $this->form_validation->set_rules('tlp_guru', '', 'required', array('required' => 'Nomor Telpon Wajib Diisi'));
                if ($this->form_validation->run() == FALSE) {
                        $judul['atas'] = "Halaman Tambah Guru";
                        $judul['menuatas'] = "Form Guru";
                        $this->load->view('template/header', $judul);
                        $this->load->view('form_guru', array('error' => ''));
                        $this->load->view('template/footer');
                } else {
                        if ($_FILES['foto']['name']) {
                                $config['upload_path'] = './assets/img_guru/';
                                $config['allowed_types'] = 'gif|jpg|png|JPG|jpeg';
                                $config['max_size'] = 1024;
                                // $config['max_width'] = 600;
                                // $config['max_height'] = 500;
                                $config['encrypt_name'] = True;
                                $this->load->library('upload', $config);
                                if (!$this->upload->do_upload('foto')) {
                                        $error = array('error' => $this->upload->display_errors(' '));
                                        $judul['atas'] = "Halaman Tambah Guru";
                                        $judul['menuatas'] = "Form Guru";
                                        $this->load->view('template/header', $judul);
                                        $this->load->view('form_guru', $error);
                                        $this->load->view('template/footer');
                                } else {
                                        $gbr = $this->upload->data();
                                        //cropGambar
                                        $config['image_library'] = 'gd2';
                                        $config['source_image'] = './assets/img_guru/' . $gbr['file_name'];
                                        $config['create_thumb'] = FALSE;
                                        $config['maintain_raito'] = FALSE;
                                        $config['quality'] = '50%';
                                        $config['width'] = 400;
                                        $config['height'] = 600;
                                        $config['new_image'] = './assets/img_guru/' . $gbr['file_name'];
                                        $this->load->library('image_lib', $config);
                                        $this->image_lib->resize();
                                        //cropGambar
                                        $foto = $gbr['file_name'];
                                        //simpan
                                        $data = array(
                                                'nip' => $this->input->post('nip'),
                                                'nama_guru' => $this->input->post('nama_guru'),
                                                'jk_guru' => $this->input->post('jk'),
                                                'almt_guru' => $this->input->post('alamat_guru'),
                                                'tlpn_guru' => $this->input->post('tlp_guru'),
                                                'foto_guru' => $foto
                                        );
                                        $query = $this->admin_model->simpandata('guru', $data);
                                        if ($query) {
                                                $this->session->set_flashdata('info', 'Data Guru Berhasil Tersimpan');
                                                redirect('Admin/guru');
                                        } else {
                                                $this->session->set_flashdata('info', 'Data Guru Gagal Tersimpan');
                                                redirect('Admin/guru');
                                        }
                                }
                        } else {
                                $data = array(
                                        'nip' => $this->input->post('nip'),
                                        'nama_guru' => $this->input->post('nama_guru'),
                                        'jk_guru' => $this->input->post('jk'),
                                        'almt_guru' => $this->input->post('alamat_guru'),
                                        'tlpn_guru' => $this->input->post('tlp_guru')
                                );
                                $query = $this->admin_model->simpandata('guru', $data);
                                if ($query) {
                                        $this->session->set_flashdata('info', 'Data Guru Berhasil Tersimpan');
                                        redirect('Admin/guru');
                                } else {
                                        $this->session->set_flashdata('info', 'Data Guru Gagal Tersimpan');
                                        redirect('Admin/guru');
                                }
                        }
                }
        }

        public function formedit_guru($id)
        {
                $judul['atas'] = "Halaman Edit Guru";
                $judul['menuatas'] = "Form Edit Guru";
                $data['eg'] = $this->admin_model->formedit('guru', 'id_guru', $id);
                $data['error'] = "";
                $this->load->view('template/header', $judul);
                $this->load->view('formedit_guru', $data);
                $this->load->view('template/footer');
        }

        public function edit_guru()
        {
                $this->form_validation->set_rules('nip', '', 'required', array('required' => 'NIP Wajib Diisi'));
                $this->form_validation->set_rules('nama_guru', '', 'required', array('required' => 'Nama Guru Wajib Diisi'));
                $this->form_validation->set_rules('jk', '', 'required', array('required' => 'Jenis Kelamin Wajib Diisi'));
                $this->form_validation->set_rules('alamat_guru', '', 'required', array('required' => 'Alamat Wajib Diisi'));
                $this->form_validation->set_rules('tlp_guru', '', 'required', array('required' => 'Nomor Telpon Wajib Diisi'));
                $id = $this->input->post('id_guru');
                $foto = $this->input->post('foto');
                if ($this->form_validation->run() == FALSE) {
                        $judul['atas'] = "Halaman Tambah Guru";
                        $judul['menuatas'] = "Form Guru";
                        $this->load->view('template/header', $judul);
                        $this->load->view('form_guru', array('error' => ''));
                        $this->load->view('template/footer');
                } else {
                        if ($_FILES['foto']['name']) {
                                $config['upload_path'] = './assets/img_guru/';
                                $config['allowed_types'] = 'gif|jpg|png|JPG|jpeg';
                                $config['max_size'] = 1024;
                                // $config['max_width'] = 600;
                                // $config['max_height'] = 500;
                                $config['encrypt_name'] = True;
                                $this->load->library('upload', $config);
                                if (!$this->upload->do_upload('foto')) {
                                        $error = array('error' => $this->upload->display_errors(' '));
                                        $judul['atas'] = "Halaman Tambah Guru";
                                        $judul['menuatas'] = "Form Guru";
                                        $this->load->view('template/header', $judul);
                                        $this->load->view('form_guru', $error);
                                        $this->load->view('template/footer');
                                } else {
                                        $gbr = $this->upload->data();
                                        unlink("./assets/img_guru/" . $foto);
                                        //cropGambar
                                        $config['image_library'] = 'gd2';
                                        $config['source_image'] = './assets/img_guru/' . $gbr['file_name'];
                                        $config['create_thumb'] = FALSE;
                                        $config['maintain_raito'] = FALSE;
                                        $config['quality'] = '50%';
                                        $config['width'] = 400;
                                        $config['height'] = 600;
                                        $config['new_image'] = './assets/img_guru/' . $gbr['file_name'];
                                        $this->load->library('image_lib', $config);
                                        $this->image_lib->resize();
                                        //cropGambar
                                        $foto = $gbr['file_name'];
                                        //simpan
                                        $data = array(
                                                'nip' => $this->input->post('nip'),
                                                'nama_guru' => $this->input->post('nama_guru'),
                                                'jk_guru' => $this->input->post('jk'),
                                                'almt_guru' => $this->input->post('alamat_guru'),
                                                'tlpn_guru' => $this->input->post('tlp_guru'),
                                                'foto_guru' => $foto
                                        );
                                        //$query = $this->admin_model->simpandata('guru', $data);
                                        $query = $this->admin_model->editdata('guru', 'id_guru', $id, $data);
                                        if ($query) {
                                                $this->session->set_flashdata('info', 'Data Guru Berhasil Tersimpan');
                                                redirect('Admin/guru');
                                        } else {
                                                $this->session->set_flashdata('info', 'Data Guru Gagal Tersimpan');
                                                redirect('Admin/guru');
                                        }
                                }
                        } else {
                                $data = array(
                                        'nip' => $this->input->post('nip'),
                                        'nama_guru' => $this->input->post('nama_guru'),
                                        'jk_guru' => $this->input->post('jk'),
                                        'almt_guru' => $this->input->post('alamat_guru'),
                                        'tlpn_guru' => $this->input->post('tlp_guru')
                                );
                                //$query = $this->admin_model->simpandata('guru', $data);
                                $query = $this->admin_model->editdata('guru', 'id_guru', $id, $data);
                                if ($query) {
                                        $this->session->set_flashdata('info', 'Data Guru Berhasil Tersimpan');
                                        redirect('Admin/guru');
                                } else {
                                        $this->session->set_flashdata('info', 'Data Guru Gagal Tersimpan');
                                        redirect('Admin/guru');
                                }
                        }
                }
        }

        public function hapus_guru($id)
        {
                $data = $this->admin_model->formedit('guru', 'id_guru', $id);
                $this->admin_model->hapusdata('guru', $id, 'id_guru');
                if ($this->db->affected_rows()) {
                        unlink("./assets/img_guru/" . $data->foto_guru);
                        $this->session->set_flashdata('info', 'Data Guru Berhasil Dihapus');
                        redirect('Admin/guru');
                } else {
                        $this->session->set_flashdate('info', 'Data Guru Gagal Dihapus');
                        redirect('Admin/guru');
                }
        }

        public function kelas()
        {
                $judul['atas'] = "Halaman Kelas";
                $judul['menuatas'] = "Kelas";
                $data['tk'] = $this->admin_model->tampildata('kelas', 'id_kelas');
                $this->load->view('template/header', $judul);
                $this->load->view('kelas', $data);
                $this->load->view('template/footer');
        }

        public function tambah_kelas()
        {
                $judul['atas'] = "Halaman Tambah Kelas";
                $judul['menuatas'] = "Form Kelas";
                $this->load->view('template/header', $judul);
                $this->load->view('form_kelas');
                $this->load->view('template/footer');
        }

        public function simpan_kelas()
        {
                $this->form_validation->set_rules('kode_kelas', '', 'required', array('required' => 'Kode Kelas Wajib Diisi'));
                $this->form_validation->set_rules('nama_kelas', '', 'required', array('required' => 'Nama Kelas Wajib Diisi'));
                if ($this->form_validation->run() == FALSE) {
                        $judul['atas'] = "Halaman Tambah Kelas";
                        $judul['menuatas'] = "Form Kelas";
                        $this->load->view('template/header', $judul);
                        $this->load->view('form_kelas');
                        $this->load->view('template/footer');
                } else {
                        $data = array('kode_kelas' => $this->input->post('kode_kelas'), 'nama_kelas' => $this->input->post('nama_kelas'));
                        $query = $this->admin_model->simpandata('kelas', $data);
                        if ($query) {
                                $this->session->set_flashdata('info', 'Data Kelas Berhasil Tersimpan');
                                redirect('Admin/kelas');
                        } else {
                                $this->session->set_flashdata('info', 'Data Kelas Gagal Tersimpan');
                                redirect('Admin/kelas');
                        }
                }
        }

        public function hapus_kelas($id)
        {
                $this->admin_model->hapusdata('kelas', $id, 'id_kelas');
                if ($this->db->affected_rows()) {
                        $this->session->set_flashdata('info', 'Data Kelas Berhasil Dihapus');
                        redirect('Admin/kelas');
                } else {
                        $this->session->set_flashdata('info', 'Data Kelas Gagal Dihapus');
                        redirect('Admin/kelas');
                }
        }

        public function formedit_kelas($id)
        {
                $judul['atas'] = "Halaman Edit Kelas";
                $judul['menuatas'] = "Form Edit Kelas";
                $data['ek'] = $this->admin_model->formedit('kelas', 'id_kelas', $id);
                $this->load->view('template/header', $judul);
                $this->load->view('formedit_kelas', $data);
                $this->load->view('template/footer');
        }

        public function edit_kelas()
        {
                $id = $this->input->post('id');
                $data = array(
                        'kode_kelas' => $this->input->post('kode_kelas'),
                        'nama_kelas' => $this->input->post('nama_kelas')
                );
                $query = $this->admin_model->editdata('kelas', 'id_kelas', $id, $data);
                if ($query) {
                        $this->session->set_flashdata('info', 'Data Kelas Berhasil Diedit');
                        redirect('Admin/kelas');
                } else {
                        $this->session->set_flashdata('info', 'Data Kelas Gagal Diedit');
                        redirect('Admin/kelas');
                }
        }

        public function tahunajaran()
        {
                $judul['atas'] = "Halaman Tahun Ajaran";
                $judul['menuatas'] = "Tahun Ajaran";
                $data['tp'] = $this->admin_model->tampildata('tahun_pelajaran', 'id_tahun_pelajaran');
                $this->load->view('template/header', $judul);
                $this->load->view('tahunajaran', $data);
                $this->load->view('template/footer');
        }

        public function tambah_th()
        {
                $judul['atas'] = "Halaman Tambah Tahun Ajaran";
                $judul['menuatas'] = "Form Tahun Ajaran";
                $this->load->view('template/header', $judul);
                $this->load->view('form_th');
                $this->load->view('template/footer');
        }

        public function simpan_th()
        {
                $this->form_validation->set_rules('th', 'Tahun Ajaran', 'required');
                if ($this->form_validation->run() == FALSE) {
                        $judul['atas'] = "Halaman Tambah Tahun Ajaran";
                        $judul['menuatas'] = "Form Tahun Ajaran";
                        $this->load->view('template/header', $judul);
                        $this->load->view('form_th');
                        $this->load->view('template/footer');
                } else {
                        $data = array('tahun_pelajaran' => $this->input->post('th'));
                        $query = $this->admin_model->simpandata('tahun_pelajaran', $data);
                        if ($query) {
                                $this->session->set_flashdata('info', 'Data Tahun Pelajaran Berhasil Tersimpan');
                                redirect('Admin/tahunajaran');
                        } else {
                                $this->session->set_flashdata('info', 'Data Tahun Pelajaran Gagal Tersimpan');
                                redirect('Admin/tahunajaran');
                        }
                }
        }

        public function hapus_th($id)
        {
                $this->admin_model->hapusdata('tahun_pelajaran', $id, 'id_tahun_pelajaran');
                if ($this->db->affected_rows()) {
                        $this->session->set_flashdata('info', 'Data Tahun Pelajaran Berhasil Dihapus');
                        redirect('Admin/tahunajaran');
                } else {
                        $this->session->set_flashdata('info', 'Data Tahun Pelajaran Gagal Dihapus');
                        redirect('Admin/tahunajaran');
                }
        }

        public function formedit_th($id)
        {
                $judul['atas'] = "Halaman Edit Tahun Ajaran";
                $judul['menuatas'] = "Form Edit Tahun Ajaran";
                $data['tp'] = $this->admin_model->formedit('tahun_pelajaran', 'id_tahun_pelajaran', $id);
                $this->load->view('template/header', $judul);
                $this->load->view('formedit_th', $data);
                $this->load->view('template/footer');
        }

        public function edit_th()
        {
                $id = $this->input->post('id');
                $data = array('tahun_pelajaran' => $this->input->post('th'));
                $query = $this->admin_model->editdata('tahun_pelajaran', 'id_tahun_pelajaran', $id, $data);
                if ($query) {
                        $this->session->set_flashdata('info', 'Data Tahun Pelajaran Berhasil Diedit');
                        redirect('Admin/tahunajaran');
                } else {
                        $this->session->set_flashdata('info', 'Data Tahun Pelajaran Gagal Diedit');
                        redirect('Admin/tahunajaran');
                }
        }

        public function users()
        {
                if ($this->session->userdata('level') == 'admin') {
                        $judul['atas'] = "Halaman Users";
                        $judul['menuatas'] = "Admin";
                        $data['tu'] = $this->admin_model->tampildata('users', 'id_users');
                        $this->load->view('template/header', $judul);
                        $this->load->view('users', $data);
                        $this->load->view('template/footer');
                } else if ($this->session->userdata('level') == 'user') {
                        $id = $this->session->userdata('id_users');
                        $judul['atas'] = "Halaman Edit Users";
                        $judul['menuatas'] = "Form Edit Users";
                        $data['es'] = $this->admin_model->formedit('users', 'id_users', $id);
                        $this->load->view('template/header', $judul);
                        $this->load->view('formedit_users_session', $data);
                        $this->load->view('template/footer');
                } else {
                        echo "<h1><center>ANDA BELUM MELAKUKAN LOGIN</center></h1>";
                }
        }

        public function tambah_users()
        {
                $judul['atas'] = "Halaman Tambah Users";
                $judul['menuatas'] = "Form Users";
                $this->load->view('template/header', $judul);
                $this->load->view('form_users');
                $this->load->view('template/footer');
        }

        public function simpan_users()
        {
                $this->form_validation->set_rules('nama_lengkap', '', 'required', array('required' => 'Nama Lengkap Wajib Diisi'));
                $this->form_validation->set_rules(
                        'username',
                        '',
                        'trim|required|min_length[5]|max_length[12]',
                        array(
                                'required' => 'Username Wajib Diisi',
                                'trim' => '',
                                'min_length' => 'Minimal 5 Huruf',
                                'max_length' => 'Maksimal 12 Huruf'
                        )
                );
                $this->form_validation->set_rules(
                        'password',
                        '',
                        'trim|required|min_length[5]|max_length[12]',
                        array(
                                'required' => 'Password Wajib Diisi',
                                'trim' => '',
                                'min_length' => 'Minimal 5 Huruf',
                                'max_length' => 'Maksimal 12 Huruf'
                        )
                );
                $this->form_validation->set_rules('conpassword', '', 'required|matches[password]', array(
                        'required' => 'Password Wajib Dikonfirmasi',
                        'matches' => 'Confirmasi Password Wajib Sama'
                ));
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('level', '', 'required', array('required' => 'Level Wajib Diisi'));
                if ($this->form_validation->run() == FALSE) {
                        $judul['atas'] = "Halaman Tambah Users";
                        $judul['menuatas'] = "Form Users";
                        $this->load->view('template/header', $judul);
                        $this->load->view('form_users');
                        $this->load->view('template/footer');
                } else {
                        $data = array(
                                'nama_lengkap' => $this->input->post('nama_lengkap'),
                                'username' => $this->input->post('username'),
                                'password' => md5($this->input->post('password')),
                                'email' => $this->input->post('email'),
                                'level' => $this->input->post('level')
                        );
                        $query = $this->admin_model->simpandata('users', $data);
                        if ($query) {
                                $this->session->set_flashdata('info', 'Data Users Berhasil Tersimpan');
                                redirect('Admin/users');
                        } else {
                                $this->session->set_flashdata('info', 'Data Users Gagal Tersimpan');
                                redirect('Admin/users');
                        }
                }
        }

        public function hapus_users($id)
        {
                $this->admin_model->hapusdata('users', $id, 'id_users');
                if ($this->db->affected_rows()) {
                        $this->session->set_flashdata('info', 'Data Users Berhasil Dihapus');
                        redirect('Admin/users');
                } else {
                        $this->session->set_flashdata('info', 'Data Users Gagal Dihapus');
                        redirect('Admin/users');
                }
        }

        public function formedit_users($id)
        {
                $judul['atas'] = "Halaman Edit Users";
                $judul['menuatas'] = "Form Edit Users";
                $data['es'] = $this->admin_model->formedit('users', 'id_users', $id);
                $this->load->view('template/header', $judul);
                $this->load->view('formedit_users', $data);
                $this->load->view('template/footer');
        }

        public function edit_users()
        {
                $id = $this->input->post('id_users');
                $this->form_validation->set_rules('nama_lengkap', '', 'required', array('required' => 'Nama Lengkap Wajib Diisi'));
                $this->form_validation->set_rules(
                        'username',
                        '',
                        'trim|min_length[5]|max_length[12]',
                        array(
                                'trim' => '',
                                'min_length' => 'Minimal 5 Huruf',
                                'max_length' => 'Maksimal 12 Huruf'
                        )
                );
                $this->form_validation->set_rules(
                        'password',
                        '',
                        'trim|min_length[5]|max_length[12]',
                        array(
                                'trim' => '',
                                'min_length' => 'Minimal 5 Huruf',
                                'max_length' => 'Maksimal 12 Huruf'
                        )
                );
                $this->form_validation->set_rules('conpassword', '', 'matches[password]', array('matches' => 'Confirmasi Password Wajib Sama'));
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('level', '', 'required', array('required' => 'Level Wajib Diisi'));
                if ($this->form_validation->run() == FALSE) {
                        $judul['atas'] = "Halaman Edit Users";
                        $judul['menuatas'] = "Form Edit Users";
                        $data['es'] = $this->admin_model->formedit('users', 'id_users', $id);
                        $this->load->view('template/header', $judul);
                        $this->load->view('formedit_users', $data);
                        $this->load->view('template/footer');
                } else {
                        if ($this->input->post('password')) {
                                $data = array(
                                        'nama_lengkap' => $this->input->post('nama_lengkap'),
                                        'username' => $this->input->post('username'),
                                        'password' => md5($this->input->post('password')),
                                        'email' => $this->input->post('email'),
                                        'level' => $this->input->post('level')
                                );
                                $query = $this->admin_model->editdata('users', 'id_users', $id, $data);
                                if ($query) {
                                        $this->session->set_flashdata('info', 'Data Users Berhasil Diedit');
                                        redirect('Admin/users');
                                } else {
                                        $this->session->set_flashdata('info', 'Data Users Gagal Diedit');
                                        redirect('Admin/users');
                                }
                        } else {
                                $data = array(
                                        'nama_lengkap' => $this->input->post('nama_lengkap'),
                                        'username' => $this->input->post('username'),
                                        'email' => $this->input->post('email'),
                                        'level' => $this->input->post('level')
                                );
                                $query = $this->admin_model->editdata('users', 'id_users', $id, $data);
                                if ($query) {
                                        $this->session->set_flashdata('info', 'Data Users Berhasil Diedit');
                                        redirect('Admin/users');
                                } else {
                                        $this->session->set_flashdata('info', 'Data Users Gagal Diedit');
                                        redirect('Admin/users');
                                }
                        }
                }
        }

        public function edit_users_session()
        {
                $id = $this->input->post('id_users');
                $this->form_validation->set_rules('nama_lengkap', '', 'required', array('required' => 'Nama Lengkap Wajib Diisi'));
                $this->form_validation->set_rules(
                        'username',
                        '',
                        'trim|min_length[5]|max_length[12]',
                        array(
                                'trim' => '',
                                'min_length' => 'Minimal 5 Huruf',
                                'max_length' => 'Maksimal 12 Huruf'
                        )
                );
                $this->form_validation->set_rules(
                        'password',
                        '',
                        'trim|min_length[5]|max_length[12]',
                        array(
                                'trim' => '',
                                'min_length' => 'Minimal 5 Huruf',
                                'max_length' => 'Maksimal 12 Huruf'
                        )
                );
                $this->form_validation->set_rules('conpassword', '', 'matches[password]', array('matches' => 'Confirmasi Password Wajib Sama'));
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                if ($this->form_validation->run() == FALSE) {
                        $judul['atas'] = "Halaman Edit Users";
                        $judul['menuatas'] = "Form Edit Users";
                        $data['es'] = $this->admin_model->formedit('users', 'id_users', $id);
                        $this->load->view('template/header', $judul);
                        $this->load->view('formedit_users_session', $data);
                        $this->load->view('template/footer');
                } else {
                        if ($this->input->post('password')) {
                                $data = array(
                                        'nama_lengkap' => $this->input->post('nama_lengkap'),
                                        'username' => $this->input->post('username'),
                                        'password' => md5($this->input->post('password')),
                                        'email' => $this->input->post('email')
                                );
                                $query = $this->admin_model->editdata('users', 'id_users', $id, $data);
                                if ($query) {
                                        $this->session->set_flashdata('info', 'Data Users Berhasil Diedit');
                                        redirect('Admin/users');
                                } else {
                                        $this->session->set_flashdata('info', 'Data Users Gagal Diedit');
                                        redirect('Admin/users');
                                }
                        } else {
                                $data = array(
                                        'nama_lengkap' => $this->input->post('nama_lengkap'),
                                        'username' => $this->input->post('username'),
                                        'email' => $this->input->post('email')
                                );
                                $query = $this->admin_model->editdata('users', 'id_users', $id, $data);
                                if ($query) {
                                        $this->session->set_flashdata('info', 'Data Users Berhasil Diedit');
                                        redirect('Admin/users');
                                } else {
                                        $this->session->set_flashdata('info', 'Data Users Gagal Diedit');
                                        redirect('Admin/users');
                                }
                        }
                }
        }
}
