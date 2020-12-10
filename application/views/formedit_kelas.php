<div class="main-content-inner">
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Edit Kelas</h4>
                <?php echo form_open('Admin/edit_kelas'); ?>
                <?php echo form_hidden('id', $ek->id_kelas)?>
                <div class="form-group">
                    <label for="kk">Kode Kelas</label>
                    <?php echo form_input("kode_kelas", $ek->kode_kelas, array('class' => 'form-control', 'id' => 'kk', 'placeholder' => 'Isi Kode Kelas')); ?>
                    <!-- <small class="text-danger"><?php echo form_error('kode_kelas', ' '); ?></small> -->
                </div>
                <div class="form-group">
                    <label for="nk">Nama Kelas</label>
                    <?php echo form_input("nama_kelas", $ek->nama_kelas, array('class' => 'form-control', 'id' => 'nk', 'placeholder' => 'Isi Nama Kelas')); ?>
                    <!-- <small class="text-danger"><?php echo form_error('nama_kelas', ' '); ?></small> -->
                </div>
                <?php echo form_submit('edit', 'EDIT', array('class' => 'btn btn-primary mt-4 pr-4 pl-4')) ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>