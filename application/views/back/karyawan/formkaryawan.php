<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Form karyawan</h3>
                    </div>
                    <div class="card-body">

                        <?= validation_errors() ?>
                        <form action="<?= base_url('karyawan/save_karyawan') ?>" method="post" enctype="multipart/form-data">

                            <div class="input-group mb-3">
                                <input type="text" name="nik" class="form-control" placeholder="NIK">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fa fa-user"></span>
                                    </div> <!-- /controls -->
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" name="username" class="form-control" placeholder="Username">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fa fa-user"></span>
                                    </div> <!-- /controls -->
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" name="email" class="form-control" placeholder="Email">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fa fa-envelope"></span>
                                    </div> <!-- /controls -->
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fa fa-lock"></span>
                                    </div> <!-- /controls -->
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fa fa-lock"></span>
                                    </div> <!-- /controls -->
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <select name="jabatan_id" class="form-control">
                                    <option value="">---Pilih Jabatan---</option>
                                    <?php foreach ($jabatan as $key => $row) { ?>

                                        <option value="<?= $row->id_jabatan ?>">
                                            <?= $row->jabatan ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <select name="divisi_id" class="form-control">
                                    <option value="">---Pilih Divisi---</option>
                                    <?php foreach ($divisi as $key => $row) { ?>

                                        <option value="<?= $row->id_divisi ?>">
                                            <?= $row->divisi ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <input type="file" id="image_user" name="image_user" class="form-control" required="">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fa fa-lock"></span>
                                    </div> <!-- /controls -->
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                            <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
    </section>
</div>