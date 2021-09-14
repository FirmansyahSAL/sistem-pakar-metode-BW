  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/back/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/back/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


  <body class="hold-transition sidebar-mini">
      <div class="wrapper">

          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
              <!-- Content Header (Page header) -->
              <section class="content-header">
                  <div class="container-fluid">
                      <div class="row mb-2">
                          <div class="col-sm-6">
                              <h1>Profile</h1>
                          </div>
                      </div>
                  </div><!-- /.container-fluid -->
              </section>

              <!-- Main content -->
              <section class="content">
                  <div class="container-fluid">
                      <div class="row">
                          <div class="col-md-3">

                              <!-- Profile Image -->
                              <div class="card card-primary card-outline">
                                  <div class="card-body box-profile">
                                      <div class="text-center">
                                          <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/images/profile/' . $karyawan->image_user); ?>" alt="User profile picture">
                                      </div>
                                      <h3 class="profile-username text-center"><?= $this->session->username; ?></h3>
                                      <a href="#" class="btn btn-primary btn-block"><b>change</b></a>
                                  </div>
                                  <!-- /.card-body -->
                              </div>
                              <div class="card card-primary">
                                  <div class="card-header">
                                      <h3 class="card-title">About Me</h3>
                                  </div>
                                  <!-- /.card-header -->
                                  <div class="card-body">
                                      <strong><i class="fas fa-book mr-1"></i> Education</strong>

                                      <p class="text-muted">
                                          B.S. in Computer Science from the University of Tennessee at Knoxville
                                      </p>

                                      <hr>

                                      <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                                      <p class="text-muted">Malibu, California</p>

                                      <hr>

                                      <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                                      <p class="text-muted">
                                          <span class="tag tag-danger">UI Design</span>
                                          <span class="tag tag-success">Coding</span>
                                          <span class="tag tag-info">Javascript</span>
                                          <span class="tag tag-warning">PHP</span>
                                          <span class="tag tag-primary">Node.js</span>
                                      </p>

                                      <hr>

                                      <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                                      <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                                  </div>
                                  <!-- /.card-body -->
                              </div>
                              <!-- /.card -->
                          </div>
                          <!-- /.card -->
                      </div>


                      <!-- /.col -->
                      <div class="col-md-9">
                          <div class="card">
                              <div class="card-header p-2">
                                  <ul class="nav nav-pills">
                                      <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Akun</a></li>
                                      <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Change Picture</a></li>
                                      <li class="nav-item"><a class="nav-link" href="#timeline1" data-toggle="tab">Change Password</a></li>
                                  </ul>
                              </div><!-- /.card-header -->
                              <div class="card-body">
                                  <div class="tab-content">
                                      <div class="active tab-pane" id="activity">
                                          <?= $this->session->flashdata('message'); ?>
                                          <form class="form-horizontal" action="<?= base_url('karyawan/update_profile') ?>" method="post">
                                              <div class="form-group row">
                                                  <label for="inputName" class="col-sm-2 col-form-label">Username</label>
                                                  <div class="col-sm-10">
                                                      <input type="hidden" name="id_users" class="form-control" value="<?= $karyawan->id_users ?>" placeholder="NIK">
                                                      <input type="text" readonly name="username" class="form-control" value="<?= $karyawan->username ?>" placeholder="NIK">
                                                  </div>
                                              </div>
                                              <div class="form-group row">
                                                  <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                                  <div class="col-sm-10">
                                                      <input type="email" name="email" value="<?= $karyawan->email ?>" class="form-control" id="inputEmail" placeholder="Email">
                                                  </div>
                                              </div>
                                              <div class="form-group row">
                                                  <label for="inputEmail" class="col-sm-2 col-form-label">Jabatan</label>
                                                  <div class="col-sm-10">
                                                      <select name="jabatan_id" class="form-control">
                                                          <option value="">---Pilih Jabatan---</option>
                                                          <?php foreach ($jabatan as $key => $row) { ?>

                                                              <option value="<?= $row->id_jabatan ?>" <?= $row->id_jabatan == $karyawan->jabatan_id ? "selected" : null ?>>
                                                                  <?= $row->jabatan ?>
                                                              </option>
                                                          <?php } ?>
                                                      </select>
                                                  </div>
                                              </div>
                                              <div class="form-group row">
                                                  <label for="inputEmail" class="col-sm-2 col-form-label">Divisi</label>
                                                  <div class="col-sm-10">
                                                      <select name="divisi_id" class="form-control ">
                                                          <option value="">---Pilih Divisi---</option>
                                                          <?php foreach ($divisi as $key => $row) { ?>

                                                              <option value="<?= $row->id_divisi ?>" <?= $row->id_divisi == $karyawan->divisi_id ? "selected" : null ?>>
                                                                  <?= $row->divisi ?>
                                                              </option>
                                                          <?php } ?>
                                                      </select>
                                                  </div>
                                              </div>
                                              <div class="form-group row">
                                                  <div class="offset-sm-2 col-sm-10">
                                                      <button type="submit" class="btn btn-success">Submit</button>
                                                  </div>
                                              </div>
                                          </form>
                                      </div>
                                      <!-- /.tab-pane -->
                                      <div class="tab-pane" id="timeline">
                                          <?= form_open_multipart('karyawan/save_tiket'); ?>
                                          <div class="form-group row">
                                              <label for="inputEmail2" class="col-sm-2 col-form-label">Foto</label>
                                              <div class="col-sm-10">
                                                  <input type="file" id="image_user" name="image_user" class="form-control" required="">
                                              </div>
                                          </div>
                                          <div class="form-group row">
                                              <div class="offset-sm-2 col-sm-10">
                                                  <button type="submit" class="btn btn-success">Submit</button>
                                              </div>
                                          </div>
                                          <?php echo form_close(); ?>
                                      </div>

                                      <div class="tab-pane" id="timeline1">
                                          <?= $this->session->flashdata('message'); ?>
                                          <form class="form-horizontal" action="<?= base_url('karyawan/proses_new_password') ?>" method="post">

                                              <div class="form-group row">
                                                  <label for="inputEmail" class="col-sm-2 col-form-label">New Password</label>
                                                  <div class="col-sm-10">
                                                      <input type="password" name="new_password" class="form-control" placeholder="new password">
                                                  </div>
                                              </div>

                                              <div class="form-group row">
                                                  <label for="inputEmail" class="col-sm-2 col-form-label">Confrim Password</label>
                                                  <div class="col-sm-10">
                                                      <input type="password" name="confirm_new_password" class="form-control" placeholder="confirm password">
                                                  </div>
                                              </div>
                                              <div class="form-group row">
                                                  <div class="offset-sm-2 col-sm-10">
                                                      <button type="submit" class="btn btn-success">Submit</button>
                                                  </div>
                                              </div>
                                          </form>
                                      </div>

                                  </div>
                                  <!-- /.tab-content -->
                              </div><!-- /.card-body -->
                          </div>
                          <!-- /.nav-tabs-custom -->
                      </div>
                      <!-- /.col -->
                  </div>
                  <!-- /.row -->
          </div><!-- /.container-fluid -->
          </section>
          <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
          <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
      </div>
      <!-- ./wrapper -->

      <!-- jQuery -->
      <script src="<?= base_url() ?>assets/back/plugins/jquery/jquery.min.js"></script>
      <!-- Bootstrap 4 -->
      <script src="<?= base_url() ?>assets/back/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- AdminLTE App -->
      <script src="<?= base_url() ?>assets/back/dist/js/adminlte.min.js"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="<?= base_url() ?>assets/back/dist/js/demo.js"></script>