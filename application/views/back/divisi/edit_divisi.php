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
                        <h3 class="card-title">Form Edit Divisi</h3>
                    </div>
                    <div class="card-body">
                        <?= $this->session->flashdata('message'); ?>
                        <?= validation_errors() ?>
                        <form action="<?= base_url('divisi/update_divisi') ?>" method="post">
                            <div class="form-group">
                                <label>Divisi</label>
                                <input type="hidden" name="id_divisi" value="<?= $div->id_divisi ?>" class="form-control">
                                <input type="text" name="divisi" value="<?= $div->divisi ?>" class="form-control" placeholder="divisi">
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
                        <h3 class="card-title">Data Divisi</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>

                                <tr>
                                    <th>No</th>
                                    <th>Nama Divisi</th>
                                    <th>Action</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($divisi as $row) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row->divisi ?></td>
                                        <td><a href="<?= base_url('divisi/edit_divisi/' . $row->id_divisi) ?>" class="btn btn-success"><i class="fas fa-eye"></i></a>
                                            <a href="<?= base_url('divisi/delete_divisi/' . $row->id_divisi) ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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