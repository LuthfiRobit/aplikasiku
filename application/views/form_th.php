<div class="main-content-inner">
    <div class="col-12 mt-5">
        <div class="card">
            <?php if (validation_errors()) {
                ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Sorry !<?php echo validation_errors(); ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span>
                    </button>
                </div>
            <?php
            } ?>
            <div class="card-body">
                <h4 class="header-title">Isi Tahun Ajaran</h4>
                <?php echo form_open('Admin/simpan_th'); ?>
                <div class="form-group">
                    <label for="th">Tahun Pelajaran</label>
                    <?php echo form_input("th", "", array('class' => 'form-control', 'id' => 'th', 'placeholder' => 'Isi Tahun Pelajaran')); ?>
                </div>
                <?php echo form_submit('save', 'SIMPAN', array('class' => 'btn btn-primary mt-4 pr-4 pl-4')) ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>