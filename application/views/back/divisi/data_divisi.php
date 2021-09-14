<link rel="stylesheet" href="<?= base_url() ?>assets/back/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/back/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

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
                        <h3 class="card-title">Form Divisi</h3>
                    </div>
                    <div class="card-body">

                        <?= $this->session->flashdata('message'); ?>
                        <?= validation_errors() ?>
                        <form action="<?= base_url('divisi/save_divisi') ?>" method="post">
                            <div class="form-group">
                                <label>Divisi</label>
                                <input type="text" name="divisi" class="form-control" placeholder="divisi">
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
                        <table id="example1" class="table table-bordered">
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
                                            <a href="<?= base_url('divisi/delete_divisi/' . $row->id_divisi) ?>" class="btn btn-danger" onclick="return confirm('Yakin Menghapus Data ini ?')"><i class="fas fa-trash"></i></a>
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


<script src="<?= base_url() ?>assets/back/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/back/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/back/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/back/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>



<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>