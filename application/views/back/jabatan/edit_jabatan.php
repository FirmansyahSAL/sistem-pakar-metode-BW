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
            <div class="col-md-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Form Edit Jabatan</h3>
                    </div>
                    <div class="card-body">
                        <?= $this->session->flashdata('message'); ?>
                        <?= validation_errors() ?>
                        <form action="<?= base_url('jabatan/update_jabatan') ?>" method="post">
                            <div class="form-group">
                                <label>Jabatan</label>
                                <input type="hidden" name="id_jabatan" value="<?= $jbt->id_jabatan ?>" class="form-control" placeholder="jabatan">
                                <input type="text" name="jabatan" value="<?= $jbt->jabatan ?>" class="form-control" placeholder="jabatan">
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Save</button>
                                <button type="reset" class="btn btn-default float-right">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Jabatan</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>

                                <tr>
                                    <th>No</th>
                                    <th>Nama Jabatan</th>
                                    <th>Action</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($jabatan as $row) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row->jabatan ?></td>
                                        <td><a href="<?= base_url('jabatan/edit_jabatan/' . $row->id_jabatan) ?>" class="btn btn-success"><i class="fas fa-eye"></i></a>
                                            <a href="<?= base_url('jabatan/delete_jabatan/' . $row->id_jabatan) ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>