<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="callout callout-info">
                            <h5><i class="fas fa-ticket"></i>No Tiket: <?= $tiket->no_tiket ?></h5>
                        </div>

                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="fas fa-globe"></i>IT Helpdesk
                                        <small class="float-right">Date : <?= $tiket->tgl_daftar ?></small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    From <br>
                                    <strong><?= $tiket->username; ?></strong>
                                    <br>
                                    Divisi : <?= $tiket->divisi ?><br>
                                    Jabatan :<?= $tiket->jabatan ?><br>
                                    Email :<?= $tiket->email ?><br>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    To <br>
                                    <b>Status Tiket</b> : <?php if ($tiket->status_tiket == 0) {
                                                                echo '<span class="badge badge-warning"> Menunggu...</span>';
                                                            } else if ($tiket->status_tiket == '1') {
                                                                echo '<span class="badge badge-info"> Response...</span>';
                                                            } else if ($tiket->status_tiket == '2') {
                                                                echo '<span class="badge badge-success"> Process...</span>';
                                                            } else {
                                                                echo '<span class="badge badge-danger"> Selesai...</span>';
                                                            } ?>
                                    <br>
                                    <br>
                                    <b> No Tiket :</b>
                                    <?= $tiket->no_tiket ?>
                                    <br>
                                    <b> Selesai :</b>
                                    <?php
                                    if ($tiket->status_tiket == '3') {
                                        echo $tiket->waktu_tanggapan;
                                    } else {
                                        echo "- -";
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <label for=""> Keluhan User / Karyawan</label>
                                    <input type="text" value="<?= $tiket->judul_tiket ?>" readonly class="form-control">
                                    <label for="">Keterangan Lengkap</label>
                                    <textarea rows="6" readonly class="form-control"> <?= $tiket->deskripsi ?> </textarea>
                                </div>
                                <div class="col-6">
                                    <label for="">Tanggapan Dept IT</label>
                                    <textarea rows="6" readonly class="form-control"> <?= $tiket->tanggapan ?> </textarea>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="">Foto Keluhan</label>
                                        <img src="<?= base_url('assets/images/tiket/' . $tiket->gambar_tiket); ?>" width="250px">

                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="">Foto tanggapan </label>
                                        <img src="<?= base_url('assets/images/tanggapan/' . $tiket->gambar_tanggapan); ?>" width="250px">
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
</div>
</div>