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
                        <h3 class="card-title">Form edit karyawan <?= $users->username ?></h3>
                    </div>
                    <div class="card-body">

                        <?= validation_errors() ?>
                        <form action="<?= base_url('karyawan/update_karyawan') ?>" method="post">

                            <div class="input-group mb-3">
                                <input type="hidden" name="id_users" class="form-control" value="<?= $users->id_users ?>">
                                <input type="text" name="nik" class="form-control" value="<?= $users->nik ?>">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fa fa-user"></span>
                                    </div> <!-- /controls -->
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" name="username" class="form-control" value="<?= $users->username ?>">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fa fa-user"></span>
                                    </div> <!-- /controls -->
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" name="email" class="form-control" value="<?= $users->email ?>">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fa fa-envelope"></span>
                                    </div> <!-- /controls -->
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <select name="status_user" class="form-control">

                                    <option value="1" <?= $users->status_user == '1' ? 'selected' : '' ?>>Active</option>
                                    <option value="0" <?= $users->status_user == '0' ? 'selected' : '' ?>>Non Active</option>
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <select name="level_user" class="form-control">
                                    <option value="1" <?= $users->level_user == '1' ? 'selected' : '' ?>>IT</option>
                                    <option value="2" <?= $users->level_user == '2' ? 'selected' : '' ?>>Staff</option>
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <select name="jabatan_id" class="form-control">
                                    <option value="">---Pilih Jabatan---</option>
                                    <?php foreach ($jabatan as $key => $row) { ?>

                                        <option value="<?= $row->id_jabatan ?>" <?= $row->id_jabatan == $users->jabatan_id ? 'selected' : null ?>>
                                            <?= $row->jabatan ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <select name="divisi_id" class="form-control">
                                    <option value="">---Pilih Divisi---</option>
                                    <?php foreach ($divisi as $key => $row) { ?>

                                        <option value="<?= $row->id_divisi ?>" <?= $row->id_divisi == $users->divisi_id ? 'selected' : null ?>>
                                            <?= $row->divisi ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                            <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
    </section>
</div>