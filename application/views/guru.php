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
                <?php echo anchor('Admin/tambah_guru', ' Tambah Data Guru', array('class' => 'btn btn-danger mb-3 fa fa-database')); ?>
                <div class="single-table">
                    <div class="table-responsive">
                        <!-- <table id="tabel_guru" class="table table-striped table-bordered" style="width:100%"> -->
                        <table id="tabel_guru" class="table table-hover progress-table text-center">
                            <thead class="text-uppercase">
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">NIP</th>
                                    <th scope="col">Nama Guru</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($tg->num_rows() > 0) {
                                    $no = 1;
                                    foreach ($tg->result_object() as $g) {
                                ?>
                                        <tr>
                                            <th scope="row"><?= $no ?></th>
                                            <td><?= $g->nip ?></td>
                                            <td><?= $g->nama_guru ?></td>
                                            <td>
                                                <?php
                                                if ($g->jk_guru == 'L') {
                                                    $jk = "Laki-laki";
                                                } else {
                                                    $jk = "Perempuasn";
                                                }
                                                echo $jk;
                                                ?></td>
                                            <td>
                                                <?php
                                                if (!$g->foto_guru) {
                                                ?>
                                                    <img src="<?= base_url('assets/img_guru/fotokosong.gif') ?>" alt="" width="100">
                                                <?php
                                                } else {
                                                ?>
                                                    <img src="<?= base_url('assets/img_guru/' . $g->foto_guru) ?>" alt="" width="100">
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><a href="<?= base_url('Admin/formedit_guru/' . $g->id_guru) ?>" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                    <li><a href="<?= base_url('Admin/hapus_guru/' . $g->id_guru) ?>" class="text-danger" onclick="return confirm('Apakah Data Ini Akan Dihapus ?')"><i class="ti-trash"></i></a></li>
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