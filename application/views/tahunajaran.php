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
                <?php echo anchor('Admin/tambah_th', ' Tambah Data Tahun', array('class' => 'btn btn-danger mb-3 fa fa-database')); ?>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-hover progress-table text-center">
                            <thead class="text-uppercase">
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">Tahun Ajaran</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($tp->num_rows() > 0) {
                                    $no = 1;
                                    foreach ($tp->result_object() as $k) {
                                        # code...
                                        ?>
                                        <tr>
                                            <th scope="row"><?= $no ?></th>
                                            <td><?= $k->tahun_pelajaran ?></td>
                                            <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><a href="<?= base_url('Admin/formedit_th/' . $k->id_tahun_pelajaran) ?>" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                    <li><a href="<?= base_url('Admin/hapus_th/' . $k->id_tahun_pelajaran) ?>" class="text-danger" onclick="return confirm('Apakah Data Ini Akan Dihapus ?')"><i class="ti-trash"></i></a></li>
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