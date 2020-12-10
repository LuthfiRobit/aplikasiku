<div class="main-content-inner">
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Update Data Users</h4>
                <?php echo form_open('Admin/edit_users_session'); ?>
                <?php echo form_hidden('id_users', $es->id_users) ?>
                <div class="form-group">
                    <label for="nl">Nama Lengkap</label>
                    <?php echo form_input("nama_lengkap", $es->nama_lengkap, array('class' => 'form-control', 'id' => 'nl', 'placeholder' => 'Isi Nama Lengkap Anda')); ?>
                    <small class="text-danger"><?php echo form_error('nama_lengkap', ' '); ?></small>
                </div>
                <div class="form-group">
                    <label for="un">Username</label>
                    <?php echo form_input("username", $es->username, array('class' => 'form-control', 'id' => 'nu', 'placeholder' => 'Isi Username Anda')); ?>
                    <small class="text-danger"><?php echo form_error('username', ' '); ?></small>
                </div>
                <div class="form-group">
                    <label for="pw">Password*)</label>
                    <?php echo form_password("password", set_value('password'), array('class' => 'form-control', 'id' => 'pw', 'placeholder' => 'Isi Password')); ?>
                    <small class="text-danger"><?php echo form_error('password', ' '); ?></small>
                </div>
                <div class="form-group">
                    <label for="pw">Confirmasi Password*)</label>
                    <?php echo form_password("conpassword", set_value('conpassword'), array('class' => 'form-control', 'id' => 'pw', 'placeholder' => 'Confirmasi Password Anda')); ?>
                    <small class="text-danger"><?php echo form_error('conpassword', ' '); ?></small>
                </div>
                <div class="form-group">
                    <label for="em">Alamat E-Mail</label>
                    <?php echo form_input("email", $es->email, array('class' => 'form-control', 'id' => 'em', 'placeholder' => 'Isi Alamat E-Mail Anda')); ?>
                    <small class="text-danger"><?php echo form_error('email', ' '); ?></small>
                </div>
                <div class="form-group">
                    <label for="con">*) Kosongi Jika Tidak Ada Perubahan</label>
                </div>
                <?php echo form_submit('edit', 'EDIT', array('class' => 'btn btn-primary mt-4 pr-4 pl-4')) ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>