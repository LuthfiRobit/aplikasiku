<div class="main-content-inner">
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Isi Data Users</h4>
                <?php echo form_open('Admin/simpan_users'); ?>
                <div class="form-group">
                    <label for="nl">Nama Lengkap</label>
                    <?php echo form_input("nama_lengkap", set_value('nama_lengkap'), array('class' => 'form-control', 'id' => 'nl', 'placeholder' => 'Isi Nama Lengkap Anda')); ?>
                    <small class="text-danger"><?php echo form_error('nama_lengkap', ' '); ?></small>
                </div>
                <div class="form-group">
                    <label for="un">Username</label>
                    <?php echo form_input("username", set_value('username'), array('class' => 'form-control', 'id' => 'nu', 'placeholder' => 'Isi Username Anda')); ?>
                    <small class="text-danger"><?php echo form_error('username', ' '); ?></small>
                </div>
                <div class="form-group">
                    <label for="pw">Password</label>
                    <?php echo form_password("password", set_value('password'), array('class' => 'form-control', 'id' => 'pw', 'placeholder' => 'Isi Password')); ?>
                    <small class="text-danger"><?php echo form_error('password', ' '); ?></small>
                </div>
                <div class="form-group">
                    <label for="pw">Confirmasi Password</label>
                    <?php echo form_password("conpassword", set_value('conpassword'), array('class' => 'form-control', 'id' => 'pw', 'placeholder' => 'Confirmasi Password Anda')); ?>
                    <small class="text-danger"><?php echo form_error('conpassword', ' '); ?></small>
                </div>
                <div class="form-group">
                    <label for="em">Alamat E-Mail</label>
                    <?php echo form_input("email", set_value('email'), array('class' => 'form-control', 'id' => 'em', 'placeholder' => 'Isi Alamat E-Mail Anda')); ?>
                    <small class="text-danger"><?php echo form_error('email', ' '); ?></small>
                </div>
                <div class="form-group">
                    <label for="lv">Level</label>
                    <?php echo form_radio('level', 'admin', set_value('level')) ?>Admin
                    <?php echo form_radio('level', 'user', set_value('level')) ?>User
                    <br />
                    <small class="text-danger"><?php echo form_error('level', ' '); ?></small>
                </div>
                <?php echo form_submit('save', 'SIMPAN', array('class' => 'btn btn-primary mt-4 pr-4 pl-4')) ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>