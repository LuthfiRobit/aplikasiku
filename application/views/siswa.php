<div class="main-content-inner">
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <?php if ($this->session->flashdata('info')) {
                ?>
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <strong><?php echo $this->session->flashdata('info'); ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>
                        </button>
                    </div>
                <?php
                } ?>
                <?php echo anchor('Admin/tambah_siswa', ' Tambah Data Siswa', array('class' => 'btn btn-danger mb-3 fa fa-database')); ?>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-hover progress-table text-center" id="tabel_siswa">
                            <thead class="text-uppercase">
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">Tahun Pelajaran</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($sw->num_rows() > 0) {
                                    $no = 1;
                                    foreach ($sw->result_object() as $s) {
                                ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $s->tahun_pelajaran ?></td>
                                            <td><?= $s->nama_siswa ?></td>
                                            <td>
                                                <?php
                                                if ($s->jk_siswa == 'L') {
                                                    $jk = "Laki-laki";
                                                } else {
                                                    $jk = "Perempuasn";
                                                }
                                                echo $jk;
                                                ?></td>
                                            <td>
                                                <?php
                                                if (!$s->foto) {
                                                ?>
                                                    <img src="<?= base_url('assets/img_siswa/fotokosong.gif') ?>" alt="" width="100">
                                                <?php
                                                } else {
                                                ?>
                                                    <img src="<?= base_url('assets/img_siswa/' . $s->foto) ?>" alt="" width="100">
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><a href="<?= base_url('Admin/formedit_siswa/' . $s->id_siswa) ?>" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                    <li><a href="<?= base_url('Admin/hapus_siswa/' . $s->id_siswa) ?>" class="text-danger" onclick="return confirm('Apakah Data Ini Akan Dihapus ?')"><i class="ti-trash"></i></a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                    <?php
                                        $no++;
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <th colspan="3" align="center"> DATA TIDAK ADA </th>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>