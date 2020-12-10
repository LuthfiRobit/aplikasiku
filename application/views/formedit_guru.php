<div class="main-content-inner">
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Form Edit Guru</h4>
                <?php echo form_open_multipart('Admin/edit_guru'); ?>
                <?php echo form_hidden('id_guru', $eg->id_guru) ?>
                <?php echo form_hidden('foto', $eg->foto_guru) ?>
                <div class="form-group">
                    <label for="nip">NIP</label>
                    <?php echo form_input("nip", $eg->nip, array('class' => 'form-control', 'id' => 'nip', 'placeholder' => 'Isi NIP')); ?>
                    <small class="text-danger"><?php echo form_error('nip', ' '); ?></small>
                </div>
                <div class="form-group">
                    <label for="ng">Nama Guru</label>
                    <?php echo form_input("nama_guru", $eg->nama_guru, array('class' => 'form-control', 'id' => 'ng', 'placeholder' => 'Isi Nama Guru')); ?>
                    <small class="text-danger"><?php echo form_error('nama_guru', ' '); ?></small>
                </div>
                <div class="form-group">
                    <label for="ng">Jenis Kelamin</label>
                    <?php
                    if ($eg->jk_guru == "L") {
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
                    <label for="ng">Alamat Guru</label>
                    <?php echo form_textarea('alamat_guru', $eg->almt_guru, array('class' => 'form-control', 'placeholder' => 'Isi Alamat')) ?>
                    <small class="text-danger"><?php echo form_error('alamat_guru', ' ') ?></small>
                </div>
                <div class="form-group">
                    <label for="tlp">Telpon Guru</label>
                    <?php echo form_input("tlp_guru", $eg->tlpn_guru, array('class' => 'form-control', 'id' => 'tlp', 'placeholder' => 'Isi Telpon Guru')); ?>
                    <small class="text-danger"><?php echo form_error('tlp_guru', ' '); ?></small>
                </div>
                <div class="form-group">
                    <label for="ng">Foto Guru Lama</label>
                    <?php
                    if (!$eg->foto_guru) {
                    ?>
                        <img src="<?= base_url('assets/img_guru/fotokosong.gif') ?>" alt="" width="100">
                    <?php
                    } else {
                    ?>
                        <img src="<?= base_url('assets/img_guru/' . $eg->foto_guru) ?>" alt="" width="200">
                    <?php
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="ng">Foto Guru Baru *)</label>
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