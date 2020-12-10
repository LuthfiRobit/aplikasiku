<div class="main-content-inner">
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Isi Data Siswa</h4>
                <?php echo form_open_multipart('Admin/simpan_siswa'); ?>
                <div class="form-group">
                    <label for="th">Tahun Pelajaran</label>
                    <?php echo form_dropdown("th", $combo, set_value('th'), array('class' => 'form-control', 'id' => 'th')); ?>
                    <small class="text-danger"><?php echo form_error('th', ' '); ?></small>
                </div>
                <div class="form-group">
                    <label for="nis">NIS</label>
                    <?php echo form_input("nis", set_value('nis'), array('class' => 'form-control', 'id' => 'nis', 'placeholder' => 'Isi NIS')); ?>
                    <small class="text-danger"><?php echo form_error('nis', ' '); ?></small>
                </div>
                <div class="form-group">
                    <label for="ns">Nama Siswa</label>
                    <?php echo form_input("nama_siswa", set_value('nama_siswa'), array('class' => 'form-control', 'id' => 'ns', 'placeholder' => 'Isi Nama Siswa')); ?>
                    <small class="text-danger"><?php echo form_error('nama_siswa', ' '); ?></small>
                </div>
                <div class="form-group">
                    <label for="jk">Jenis Kelamin</label>
                    <?php echo form_radio('jk', 'L', set_value('jk')) ?>Laki-laki
                    <?php echo form_radio('jk', 'P', set_value('jk')) ?>Perempuan
                    <br />
                    <small class="text-danger"><?php echo form_error('jk', ' '); ?></small>
                </div>
                <div class="form-group">
                    <label for="as">Alamat Siswa</label>
                    <?php echo form_textarea('alamat_siswa', set_value('alamat_siswa'), array('class' => 'form-control', 'placeholder' => 'Isi Alamat')) ?>
                    <small class="text-danger"><?php echo form_error('alamat_siswa', ' ') ?></small>
                </div>
                <div class="form-group">
                    <label for="fs">Foto Siswa</label>
                    <?php echo form_upload('foto', '', array('class' => 'form-control')) ?>
                    <small class="text-danger"><?php echo $error; ?></small>
                </div>
                <?php echo form_submit('save', 'SIMPAN', array('class' => 'btn btn-primary mt-4 pr-4 pl-4')) ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>