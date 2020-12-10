<div class="main-content-inner">
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Isi Data Guru</h4>
                <?php echo form_open_multipart('Admin/simpan_guru'); ?>
                <div class="form-group">
                    <label for="nip">NIP</label>
                    <?php echo form_input("nip", set_value('nip'), array('class' => 'form-control', 'id' => 'nip', 'placeholder' => 'Isi NIP')); ?>
                    <small class="text-danger"><?php echo form_error('nip', ' '); ?></small>
                </div>
                <div class="form-group">
                    <label for="ng">Nama Guru</label>
                    <?php echo form_input("nama_guru", set_value('nama_guru'), array('class' => 'form-control', 'id' => 'ng', 'placeholder' => 'Isi Nama Guru')); ?>
                    <small class="text-danger"><?php echo form_error('nama_guru', ' '); ?></small>
                </div>
                <div class="form-group">
                    <label for="ng">Jenis Kelamin</label>
                    <?php echo form_radio('jk', 'L', set_value('jk')) ?>Laki-laki
                    <?php echo form_radio('jk', 'P', set_value('jk')) ?>Perempuan
                    <br />
                    <small class="text-danger"><?php echo form_error('jk', ' '); ?></small>
                </div>
                <div class="form-group">
                    <label for="ng">Alamat Guru</label>
                    <?php echo form_textarea('alamat_guru', set_value('alamat_guru'), array('class' => 'form-control', 'placeholder' => 'Isi Alamat')) ?>
                    <small class="text-danger"><?php echo form_error('alamat_guru', ' ') ?></small>
                </div>
                <div class="form-group">
                    <label for="tlp">Telpon Guru</label>
                    <?php echo form_input("tlp_guru", set_value('tlp_guru'), array('class' => 'form-control', 'id' => 'tlp', 'placeholder' => 'Isi Telpon Guru')); ?>
                    <small class="text-danger"><?php echo form_error('tlp_guru', ' '); ?></small>
                </div>
                <div class="form-group">
                    <label for="ng">Foto Guru</label>
                    <?php echo form_upload('foto', '', array('class' => 'form-control')) ?>
                    <small class="text-danger"><?php echo $error; ?></small>
                </div>
                <?php echo form_submit('save', 'SIMPAN', array('class' => 'btn btn-primary mt-4 pr-4 pl-4')) ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>