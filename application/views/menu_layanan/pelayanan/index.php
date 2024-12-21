<!-- Begin Page Content -->
<div class="container-fluid">
    <style>
        input {
            text-align: center;
        }
    </style>
    <!-- Page Heading -->
    <h1 class="h2 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DATA PELAYANAN</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php
                $current_user_role_id = $_SESSION['role_id'];
                if ($current_user_role_id == 1 || $current_user_role_id == 3) { ?>
                    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addnewpelayanan">Add New Pelayanan</a>
                <?php } ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th hidden>ID PELAYANAN</th>
                            <th>NAMA OPERATOR YANG MENGUBAH DI <?= $title; ?></th>
                            <th>NAMA WP</th>
                            <th>NIK WP</th>
                            <th>ALAMAT</th>
                            <th>NOP</th>
                            <th>JENIS PENDAFTARAN</th>
                            <th>ALASHAK</th>
                            <th>FILE</th>
                            <th>STATUS</th>
                            <th>TGL FILE MASUK</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_pelayanan as $datapel) : ?>
                            <tr>
                                <td hidden><?= $datapel['id_pelayanan'] ?></td>
                                <td>
                                    <?php
                                    foreach ($userx as $username) {
                                        if ($username['id'] == $datapel['id_user']) {
                                            print_r($username['username'] . '<br>----' . $datapel['role']);
                                        }
                                    }

                                    ?>
                                </td>
                                <td><?= $datapel['nama_wp'] ?></td>
                                <td><?= $datapel['nik_wp'] ?></td>
                                <td><?= $datapel['alamat'] ?></td>
                                <td><?= $datapel['nop'] ?></td>
                                <td><?= $datapel['jenis_pendaftaran'] ?></td>
                                <td><?= $datapel['alashak'] ?></td>
                                <td>
                                    <?= $datapel['upload_doc_pbb']; ?>
                                    <?php $file_path = base_url('file_pbb/' . $datapel['upload_doc_pbb']); ?>
                                    <a href="<?= $file_path ?>" target="_blank">Lihat File</a>
                                </td>
                                <td style="text-align: center;">
                                    <?php
                                    $id_pelayanan = $datapel['id_pelayanan'];
                                    $sqlCountStatusx = $this->pelayanan->sqlCountStatus($id_pelayanan);
                                    $sqlCountStatus = $sqlCountStatusx['total_status'];
                                    $statusLabels = [
                                        0 => ['text' => 'PROSES PELAYANAN', 'class' => 'badge-info'],
                                        1 => ['text' => 'PROSES PENDATAAN', 'class' => 'badge-success'],
                                        3 => ['text' => 'PROSES PENETAPAN', 'class' => 'badge-danger'],
                                        6 => ['text' => 'PROSES PENAGIHAN', 'class' => 'badge-warning'],
                                        10 => ['text' => 'DI ARSIPKAN', 'class' => 'badge-primary']
                                        // 15 => ['text' => 'ARSIP', 'class' => 'badge-info']
                                    ];
                                    if (array_key_exists($sqlCountStatus, $statusLabels)) {
                                        $status = $statusLabels[$sqlCountStatus];
                                        if (isset($status)) {
                                            echo '<a class="badge ' . $status['class'] . '" style="color:white">' . $status['text'] . '</a>';
                                        } else {
                                            echo '<a class="badge ' . $status['class'] . '" style="color:white">' . $status['text'] . 'TIDAK VALID</a>';
                                        }
                                    } else {
                                        // Tindakan yang akan diambil jika kunci tidak ada dalam array
                                        echo '<a style="color:black">TIDAK VALID KARENA STATUS <br><br><b> ' . $sqlCountStatus . ' </b><br><br>KARENA ANGKA TERSEBUT TIDAK ADA DALAM STATUS</a>';
                                    }
                                    ?>
                                </td>
                                <td><?= $datapel['tgl_pelayanan'] ?></td>
                                <td style="text-align: center;">
                                    <?php
                                    $id_pelayanan = $datapel['id_pelayanan'];
                                    $sqlCountStatusx = $this->pelayanan->sqlCountStatus($id_pelayanan);
                                    $sqlCountStatus = $sqlCountStatusx['total_status'];
                                    $statusLabels = [
                                        0 => ['text' => 'PROSES PELAYANAN', 'class' => 'badge-info'],
                                        1 => ['text' => 'PROSES PENDATAAN', 'class' => 'badge-success'],
                                        3 => ['text' => 'PROSES PENETAPAN', 'class' => 'badge-danger'],
                                        6 => ['text' => 'PROSES PENAGIHAN', 'class' => 'badge-warning'],
                                        10 => ['text' => 'DI ARSIPKAN', 'class' => 'badge-primary']
                                        // 15 => ['text' => 'ARSIP', 'class' => 'badge-info']
                                    ];
                                    if (array_key_exists($sqlCountStatus, $statusLabels)) {
                                        $status = $statusLabels[$sqlCountStatus];
                                        $current_user_role_id = $_SESSION['role_id'];
                                        if ($current_user_role_id == 1 || $current_user_role_id == 3) {
                                            if ($status['text'] == "DI ARSIPKAN") {
                                                echo '<a><b>TIDAK DAPAT MERUBAH APAPUN</b></a>';
                                            } else if ($status['text'] == "PROSES PENDATAAN") {
                                                echo '<a><b>TIDAK DAPAT MERUBAH APAPUN</b></a>';
                                            } else if ($status['text'] == "PROSES PENETAPAN") {
                                                echo '<a><b>TIDAK DAPAT MERUBAH APAPUN</b></a>';
                                            } else if ($status['text'] == "PROSES PENAGIHAN") {
                                                echo '<a><b>TIDAK DAPAT MERUBAH APAPUN</b></a>';
                                            } else {
                                                echo '<a href="#" class="badge badge-success" data-toggle="modal" data-target="#editpelayanan' . $datapel['id_pelayanan'] . '">Edit & Ubah Status</a> 
                                                <a href="#" class="badge badge-danger" data-toggle="modal" data-target="#deletepelayanan' . $datapel['id_pelayanan'] . '">Delete</a>';
                                            }
                                        } else {
                                            echo '<a><b>TIDAK DAPAT MERUBAH APAPUN</b></a>';
                                        }
                                    } else {
                                        // Tindakan yang akan diambil jika kunci tidak ada dalam array
                                        echo '<a style="color:black">TIDAK VALID KARENA STATUS <br><br><b> ' . $sqlCountStatus . ' </b><br><br>KARENA ANGKA TERSEBUT TIDAK ADA DALAM STATUS</a>';
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="addnewpelayanan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ADD NEW PELAYANAN </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('pelayanan/addnewpelayanan'); ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body" style="text-align:center">
                            <div class="form-group">
                                <label>USER ANDA</label>
                                <input type="text" class="form-control" id="id_user" name="id_user" value="<?= $_SESSION['user_id']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="name" name="name" value="<?= $_SESSION['username']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="nama_wp" name="nama_wp" placeholder="NAMA WP" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="nik_wp" name="nik_wp" placeholder="NIK WP" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="ALAMAT" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="nop" name="nop" placeholder="NOP" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="jenis_pendaftaran" name="jenis_pendaftaran" placeholder="JENIS PENDAFTARAN" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="alashak" name="alashak" placeholder=" ALASHAK" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="file">Pilih File:</label>
                                <input type="file" class="form-control-file" id="upload_doc_pbb" name="upload_doc_pbb" accept=".pdf,.docx" required>
                            </div>
                            <!-- <br>
                            <div class="form-group">
                                <label for="notice" style="color: red;">Jika Data Sudah Dipastikan Benar Silahkan Di Centang Agar Status Pelayanan Dapat Di Update</label>
                                <input type="checkbox" style="transform: scale(1.5); margin-right: 5px;" id="status_pelayanan" name="status_pelayanan" value="1" required>
                            </div> -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- BUAT EDIT & DELETE-->
        <?php foreach ($data_pelayanan as $datapelx) : ?>
            <!-- EDIT -->
            <div class="modal fade" id="editpelayanan<?= $datapelx['id_pelayanan']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">EDIT PELAYANAN</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('pelayanan/editpelayanan'); ?>" method="post" enctype="multipart/form-data">
                            <div class="modal-body" style="text-align:center">
                                <div class="form-group" hidden>
                                    <input type="text" class="form-control" id="id_pelayanan" name="id_pelayanan" value="<?= $datapelx['id_pelayanan']; ?>" readonly hidden>
                                </div>
                                <div class="form-group" hidden>
                                    <label>USER ANDA</label>
                                    <input type="text" class="form-control" id="id_user" name="id_user" value="<?= $_SESSION['user_id']; ?>" readonly>
                                </div>
                                <div class="form-group" hidden>
                                    <input type="text" class="form-control" id="name" name="name" value="<?= $_SESSION['username']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="nama_wp" name="nama_wp" value="<?= $datapelx['nama_wp']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="nik_wp" name="nik_wp" value="<?= $datapelx['nik_wp']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $datapelx['alamat']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="nop" name="nop" value="<?= $datapelx['nop']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="jenis_pendaftaran" name="jenis_pendaftaran" value="<?= $datapelx['jenis_pendaftaran']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="alashak" name="alashak" value="<?= $datapelx['alashak']; ?>" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="file">Pilih File:</label>
                                    <input type="file" class="form-control-file" id="upload_doc_pbb" name="upload_doc_pbb" accept=".pdf,.docx">
                                    <br>
                                    <label for="file"><b>File Yang Sekarang Terupload:</b></label>
                                    <br>
                                    <?= $datapelx['upload_doc_pbb']; ?>
                                    <?php $file_path = base_url('file_pbb/' . $datapelx['upload_doc_pbb']); ?>
                                    <a href="<?= $file_path ?>" target="_blank">Lihat File</a>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="notice" style="color: red;"><b>Jika Data Sudah Dipastikan Benar Silahkan Di Centang Agar Status Pelayanan Dapat Di Update</b></label>
                                    <?php if (isset($datapelx['status_pelayanan']) && $datapelx['status_pelayanan'] !== null && $datapelx['status_pelayanan'] !== '0') { ?>
                                        <input type="checkbox" style="transform: scale(1.5); margin-right: 5px;" id="status_pelayanan" name="status_pelayanan" value="<?= $datapelx['status_pelayanan']; ?>" checked>
                                    <?php } else { ?>
                                        <input type="checkbox" style="transform: scale(1.5); margin-right: 5px;" id="status_pelayanan" name="status_pelayanan" value="1">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- DELETE -->
            <div class="modal fade" id="deletepelayanan<?= $datapelx['id_pelayanan'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Arsip</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Apakah Kamu Yakin Menghapus User ini <?= $datapelx['id_pelayanan']; ?> - <?= $datapelx['nama_wp']; ?> - <?= $datapelx['nik_wp']; ?> - <?= $datapelx['jenis_pendaftaran']; ?> - <?= $datapelx['alashak']; ?>?</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="<?= base_url('pelayanan/deletepelayanan/') . $datapelx['id_pelayanan']; ?>">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>

    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->