<?php if (is_it()) { ?>
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
            <div class="row-mt-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Tiket</h3>
                            <a href="<?= base_url('tiket/add_tiket') ?>" data-toggle="modal" data-target="#form_tiket" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i> Tiket Baru</a>
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('message'); ?>
                            <table id="example1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No tiket</th>
                                        <th>Judul Tiket</th>
                                        <th>Status Tiket</th>
                                        <th>Konfirmasi</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($tiket as $row) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row->no_tiket ?></td>
                                            <td><?= $row->judul_tiket ?></td>
                                            <td>
                                                <?php if ($row->status_tiket == '0') {
                                                    echo '<span class="badge badge-warning"> Menunggu...</span>';
                                                } else if ($row->status_tiket == '1') {
                                                    echo '<span class="badge badge-info"> Response...</span>';
                                                } else if ($row->status_tiket == '2') {
                                                    echo '<span class="badge badge-success"> Process...</span>';
                                                } else {
                                                    echo '<span class="badge badge-danger"> Selesai...</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($row->status_tiket == '0') {
                                                    echo '<a href= "javascript:void(0);" data-toggle="modal" data-target="#modal-tiket" id="select_tiket" 
                                                    data-id_tiket="' . $row->id_tiket . '"
                                                    data-status_tiket="' . $row->status_tiket . '"
                                                    class="btn btn-success">
                                                    Confirm 
                                                </a>';
                                                } else if ($row->status_tiket == '1') {
                                                    echo '<a href="javascript:void(0);" data-toggle="modal" data-target="#modal-reply" id="reply-message"
                                                        data-tiket_id="' . $row->id_tiket . '"
                                                        data-id_tiket_id="' . $row->id_tiket . '"
                                                        data-judul_tiket="' . $row->judul_tiket . '"
                                                        data-deskripsi="' . $row->deskripsi . '"
                                                        class="btn btn-warning">
                                                       Reply Message 
                                                    </a>';
                                                } else if ($row->status_tiket == '2') {
                                                    echo '<a href="javascript:void(0);" data-toggle="modal" data-target="#modalclosetiket" id="ctiket"
                                                        data-closetiket="' . $row->id_tiket . '"
                                                        data-closestatus="' . $row->status_tiket . '"
                                                          class="btn btn-primary">
                                                       Close 
                                                    </a>';
                                                } else {
                                                    echo '<a href="javascript:void(0);" class="btn btn-danger">
                                                        Closed
                                                        </a>';
                                                }

                                                ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('tiket/detail_tiket/' . $row->no_tiket) ?>"><button type='button' class='btn btn-info'><i class="fas fa-eye"></i></button></a>
                                                <a href="<?= base_url('tiket/delete_tiket/' . $row->id_tiket) ?>"><button type='button' class='btn btn-danger' onclick="return confirm('Yakin Menghapus Data ini ?')"><i class="fas fa-trash"></i></button></a>
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

    <div class="modal fade" id="form_tiket">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    Form Tambah Tiket <aria-label="Close" button class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>

                </div>
                <div class="modal-body">
                    <form action="<?= base_url('tiket/save_tiket') ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" name="no_tiket" value="<?= $no_tiket ?>" readonly class="form-control"><label>Keluhan</label>
                            <input type="text" name="judul_tiket" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>keterangan</label>
                            <textarea name="deskripsi" class="form-control">
                        </textarea>
                        </div>
                        <div class="form-group">
                            <label>Gambar</label><br>
                            <input type="file" name="gambar_tiket">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-tiket">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    Yakin Konfirmasi Tiket ini
                    <aria-label="Close" button class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('tiket/save_tiket_waiting') ?>" method="post" enctype="multipart/form-data">

                        <input type="hidden" name="id_tiket" id="id_tiket" class="form-control">
                        <br>
                        <input type="hidden" name="status_tiket" value="1" class="form-control">

                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-reply">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    Form Tanggapan IT Support
                    <aria-label="Close" button class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('tiket/save_tanggapan') ?>" method="post" enctype="multipart/form-data">

                        <input type="hidden" name="id_tiket" id="id_tiket_id" class="form-control">
                        <br>
                        <input type="hidden" name="tiket_id" id="tiket_id" class="form-control">

                        <div class="form-group">
                            <label for="Keluhan">Keluhan / Judul Tiket</label>
                            <input type="text" id="judul_tiket" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea id="deskripsi" class="form-control" readonly></textarea>
                        </div>
                        <div class="form-group">
                            <label for="tanggapan">Tanggapan</label>
                            <textarea name="tanggapan" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="tanggapan">Gambar Tanggapan</label>
                            <input type="file" name="gambar_tanggapan" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Reply Message</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalclosetiket">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    Yakin Close Tiket ini
                    <aria-label="Close" button class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('tiket/save_close_tiket') ?>" method="post" enctype="multipart/form-data">

                        <input type="hidden" name="id_tiket" id="closetiket" class="form-control">
                        <br>
                        <input type="hidden" name="status_tiket" value="3" class="form-control">

                        <button type="submit" class="btn btn-primary">Close Tiket</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(document).on('click', '#select_tiket', function() {
                var id_tiket = $(this).data('id_tiket')
                var status_tiket = $(this).data('status_tiket')

                $('#id_tiket').val(id_tiket)
                $('#status_tiket').val(status_tiket)
            })
            $(document).on('click', '#reply-message', function() {
                var id_tiket = $(this).data('id_tiket')
                var id_tiket_id = $(this).data('id_tiket_id')
                var judul_tiket = $(this).data('judul_tiket')
                var deskripsi = $(this).data('deskripsi')

                $('#id_tiket').val(id_tiket)
                $('#id_tiket_id').val(id_tiket_id)
                $('#judul_tiket').val(judul_tiket)
                $('#deskripsi').val(deskripsi)
            })
            $(document).on('click', '#ctiket', function() {
                var closetiket = $(this).data('closetiket')
                var closestatus = $(this).data('closestatus')

                $('#closetiket').val(closetiket)
                $('#closestatus').val(closestatus)
            })
        })
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

    <script src="<?= base_url() ?>assets/back/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/back/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>assets/back/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>assets/back/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<?php } else { ?>

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
            <div class="row-mt-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Tiket</h3>
                            <a href="<?= base_url('tiket/add_tiket') ?>" data-toggle="modal" data-target="#form_tiket" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i> Tiket Baru</a>
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('message'); ?>
                            <table id="example1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No tiket</th>
                                        <th>Keluhan</th>
                                        <th>Keterangan</th>
                                        <th>Status Tiket</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($tiket_user as $row) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row->no_tiket ?></td>
                                            <td><?= $row->judul_tiket ?></td>
                                            <td><?= $row->deskripsi ?></td>

                                            <td>
                                                <?php if ($row->status_tiket == '0') {
                                                    echo '<span class="badge badge-warning"> Waiting...</span>';
                                                } else if ($row->status_tiket == '1') {
                                                    echo '<span class="badge badge-info"> Response...</span>';
                                                } else if ($row->status_tiket == '2') {
                                                    echo '<span class="badge badge-success"> Process...</span>';
                                                } else {
                                                    echo '<span class="badge badge-danger"> solved...</span>';
                                                }
                                                ?>
                                            </td>

                                            <td>
                                                <a href="<?= base_url('tiket/detail_tiket/' . $row->no_tiket) ?>"><button type='button' class='btn btn-info'><i class="fas fa-eye"></i></button></a>
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

    <div class="modal fade" id="form_tiket">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    Form Tambah Tiket <aria-label="Close" button class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>

                </div>
                <div class="modal-body">
                    <form action="<?= base_url('tiket/save_tiket') ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" name="no_tiket" value="<?= $no_tiket ?>" class="form-control"><label>Keluhan</label>
                            <input type="text" name="judul_tiket" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>keterangan</label>
                            <textarea name="deskripsi" class="form-control">
                        </textarea>
                        </div>
                        <div class="form-group">
                            <label>Gambar</label><br>
                            <input type="file" name="gambar_tiket">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </form>
                </div>
            </div>
        </div>
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


<?php } ?>