<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row mt-2">
            <div class="col-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Filter Laporan</h3>
                    </div>

                    <div class="card-body">
                        <?= validation_errors() ?>
                        <form action="<?= base_url('laporan/print_laporan') ?>" method="POST" target="_blank">

                            <div class="form-group">
                                <label>Tanggal Awal</label>
                                <input type="date" name="tgl_awal" id="tgl_awal" value="<?= date('Y-m-d') ?>" class="form-control">
                            </div> <!-- /controls -->

                            <div class="form-group">
                                <label>Tanggal Akhir</label>
                                <input type="date" name="tgl_akhir" id="tgl_akhir" value="<?= date('Y-m-d') ?>" class="form-control">
                            </div> <!-- /controls -->

                            <div class="card-footer">
                                <button type="submit" name="submit" class="btn btn-info">Print</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>