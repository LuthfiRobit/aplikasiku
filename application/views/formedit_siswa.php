<div class="main-content-inner">
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Edit Data Siswa</h4>
                <?php echo form_open_multipart('Admin/edit_siswa'); ?>
                <?php echo form_hidden('id_siswa', $es->id_siswa) ?>
                <?php echo form_hidden('foto', $es->foto) ?>
                <div class="form-group">
                    <label for="th">Tahun Pelajaran</label>
                    <?php echo form_dropdown("th", $combo, $es->id_tahun_pelajaran, array('class' => 'form-control', 'id' => 'th')); ?>
                    <small class="text-danger"><?php echo form_error('th', ' '); ?></small>
                </div>
                <div class="form-group">
                    <label for="nis">NIS</label>
                    <?php echo form_input("nis", $es->nisn, array('class' => 'form-control', 'id' => 'nis', 'placeholder' => 'Isi NIS')); ?>
                    <small class="text-danger"><?php echo form_error('nis', ' '); ?></small>
                </div>
                <div class="form-group">
                    <label for="ns">Nama Siswa</label>
                    <?php echo form_input("nama_siswa", $es->nama_siswa, array('class' => 'form-control', 'id' => 'ns', 'placeholder' => 'Isi Nama Siswa')); ?>
                    <small class="text-danger"><?php echo form_error('nama_siswa', ' '); ?></small>
                </div>
                <div class="form-group">
                    <label for="ng">Jenis Kelamin</label>
                    <?php
                    if ($es->jk_siswa == "L") {
                        $l = TRUE;
                        $p = FALSE;
                    } else {
                        $l = FALSE;
                        $p = TRUE;
                    }
                    echo form_radio('jk', 'L', $l) ?>Laki-laki
                    <?php echo form_radio('jk', 'P', $p) ?>Perempuan
                    <br />
                    <small class="text-danger"><?php echo form_error('jk', ' '); ?></small>
                </div>
                <div class="form-group">
                    <label for="as">Alamat Siswa</label>
                    <?php echo form_textarea('alamat_siswa', $es->almt_siswa, array('class' => 'form-control', 'placeholder' => 'Isi Alamat')) ?>
                    <small class="text-danger"><?php echo form_error('alamat_siswa', ' ') ?></small>
                </div>
                <div class="form-group">
                    <label for="fs">Foto Siswa Lama</label>
                    <?php
                    if (!$es->foto) {
                    ?>
                        <img src="<?= base_url('assets/img_siswa/fotokosong.gif') ?>" alt="" width="100">
                    <?php
                    } else {
                    ?>
                        <img src="<?= base_url('assets/img_siswa/' . $es->foto) ?>" alt="" width="200">
                    <?php
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="fs">Foto Siswa Baru *)</label>
                    <?php echo form_upload('foto', '', array('class' => 'form-control')) ?>
                    <small class="text-danger"><?php echo $error; ?></small>
                </div>
                <div><label for="pemberitahuan">*) Kosongi Jika Tidak Ada Perubahan</label></div>
                <?php echo form_submit('edit', 'EDIT', array('class' => 'btn btn-primary mt-4 pr-4 pl-4')) ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>