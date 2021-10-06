<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>files/assets/images/favicon.png">
    <title><?= $title ?></title>
    <!-- Custom CSS -->
    <link href="<?= base_url() ?>files/dist/css/style.min.css" rel="stylesheet">
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative" style="background:url(<?= base_url() ?>files/assets/images/big/auth-bg.jpg) no-repeat center center;">
            <div class="col-sm-5 bg-white">
                <div class="p-3">
                    <h2 class="mt-3 text-center">Selamat Datang!</h2>
                    <p class="text-center"><i>Sistem Pakar Diagnosa Kerusakan Motor Injeksi Matic</i></p>
                    <form class="mt-4" method="POST" action="<?= base_url('konsultasi/add') ?>">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="text-dark" for="uname">Nama Lengkap</label>
                                    <input class="form-control" id="nama" name="nama" type="text">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="text-dark" for="pwd">Email</label>
                                    <input class="form-control" id="email" name="email" type="text">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="text-dark" for="pwd">Merk Motor</label>
                                    <select class="form-control" name="merek">
                                        <option value="">Pilih Merk</option>
                                        <?php foreach ($merek as $m) : ?>
                                            <option value="<?= $m['nama'] ?>"><?= $m['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="text-dark" for="pwd">Seri Motor</label>
                                    <select class="form-control" name="seri">
                                        <option value="">Pilih Seri</option>
                                        <?php foreach ($seri as $s) : ?>
                                            <option value="<?= $s['nama'] ?>"><?= $s['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="btn btn-block btn-dark">Mulai Konsultasi</button>
                                <hr>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="<?= base_url() ?>files/assets/libs/jquery/dist/jquery.min.js "></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url() ?>files/assets/libs/popper.js/dist/umd/popper.min.js "></script>
    <script src="<?= base_url() ?>files/assets/libs/bootstrap/dist/js/bootstrap.min.js "></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $(".preloader ").fadeOut();
    </script>
</body>

</html>