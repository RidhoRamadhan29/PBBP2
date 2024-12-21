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
            <h6 class="m-0 font-weight-bold text-primary">DATA PENDATAAN</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th hidden>ID PENDATAAN</th>
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
                            <th>TGL FILE MASUK DI PENDATAAN</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_pendataan as $datapen) : ?>
                            <tr>
                                <td hidden><?= $datapen['id_pendataan'] ?></td>
                                <td hidden><?= $datapen['id_pelayanan'] ?></td>
                                <td>
                                    <?php
                                    foreach ($userx as $username) {
                                        if ($username['id'] == $datapen['pendataan_id_user']) {
                                            print_r($username['username'] . '<br>----' . $datapen['role']);
                                        }
                                    }
                                    ?>
                                </td>
                                <td><?= $datapen['nama_wp'] ?></td>
                                <td><?= $datapen['nik_wp'] ?></td>
                                <td><?= $datapen['alamat'] ?></td>
                                <td><?= $datapen['nop'] ?></td>
                                <td><?= $datapen['jenis_pendaftaran'] ?></td>
                                <td><?= $datapen['alashak'] ?></td>
                                <td>
                                    <?= $datapen['upload_doc_pbb']; ?>
                                    <?php $file_path = base_url('file_pbb/' . $datapen['upload_doc_pbb']); ?>
                                    <a href="<?= $file_path ?>" target="_blank">Lihat File</a>
                                </td>
                                <td style="text-align: center;">
                                    <?php
                                    $id_pelayanan = $datapen['id_pelayanan'];
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
                                <td><?= $datapen['tgl_pelayanan'] ?></td>
                                <td><?= $datapen['tgl_pendataan'] ?></td>
                                <td style="text-align: center;">
                                    <?php
                                    $id_pelayanan = $datapen['id_pelayanan'];
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
                                        if ($current_user_role_id == 1 || $current_user_role_id == 4) {
                                            if ($status['text'] == "DI ARSIPKAN") {
                                                echo '<a><b>TIDAK DAPAT MERUBAH APAPUN</b></a>';
                                            } else if ($status['text'] == "PROSES PELAYANAN") {
                                                echo '<a><b>TIDAK DAPAT MERUBAH APAPUN DATA MASIH DI <a style="color:red;">PELAYANAN</a></b></a>';
                                            } else if ($status['text'] == "PROSES PENETAPAN") {
                                                echo '<a><b>TIDAK DAPAT MERUBAH APAPUN</b></a>';
                                            } else if ($status['text'] == "PROSES PENAGIHAN") {
                                                echo '<a><b>TIDAK DAPAT MERUBAH APAPUN</b></a>';
                                            } else {
                                                echo '<a href="#" class="badge badge-success" data-toggle="modal" data-target="#editpelayanan' . $datapen['id_pendataan'] . '">Edit & Ubah Status</a>';
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

        <!-- BUAT EDIT -->
        <?php foreach ($data_pendataan as $datapenx) : ?>
            <!-- EDIT -->
            <div class="modal fade" id="editpelayanan<?= $datapenx['id_pendataan']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">EDIT PENDATAAN</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('pendataan/editpendataan'); ?>" method="post" enctype="multipart/form-data">
                            <div class="modal-body" style="text-align:center">
                                <div class="form-group" hidden>
                                    <input type="text" class="form-control" id="id_pelayanan" name="id_pelayanan" value="<?= $datapenx['id_pelayanan']; ?>" readonly hidden>
                                </div>
                                <div class="form-group" hidden>
                                    <input type="text" class="form-control" id="id_pendataan" name="id_pendataan" value="<?= $datapenx['id_pendataan']; ?>" readonly hidden>
                                </div>
                                <div class="form-group" hidden>
                                    <input type="text" class="form-control" id="id_user" name="id_user" value="<?= $_SESSION['user_id']; ?>" readonly>
                                </div>
                                <div class="form-group" hidden>
                                    <input type="text" class="form-control" id="name" name="name" value="<?= $_SESSION['username']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="nama_wp" name="nama_wp" value="<?= $datapenx['nama_wp']; ?>" required readonly>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="nik_wp" name="nik_wp" value="<?= $datapenx['nik_wp']; ?>" required readonly>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $datapenx['alamat']; ?>" required readonly>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="nop" name="nop" value="<?= $datapenx['nop']; ?>" required readonly>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="jenis_pendaftaran" name="jenis_pendaftaran" value="<?= $datapenx['jenis_pendaftaran']; ?>" required readonly>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="alashak" name="alashak" value="<?= $datapenx['alashak']; ?>" required readonly>
                                </div>

                                <div class="form-group">
                                    <label for="notice" style="color: red;"><b>Jika Data Sudah Dipastikan Benar Silahkan Di Centang Agar Status Pendataan Dapat Di Update</b></label>
                                    <?php if (isset($datapenx['status_pendataan']) && $datapenx['status_pendataan'] !== null && $datapenx['status_pendataan'] !== '0') { ?>
                                        <input type="checkbox" style="transform: scale(1.5); margin-right: 5px;" id="status_pendataan" name="status_pendataan" value="<?= $datapenx['status_pendataan']; ?>" checked>
                                    <?php } else { ?>
                                        <input type="checkbox" style="transform: scale(1.5); margin-right: 5px;" id="status_pendataan" name="status_pendataan" value="2">
                                    <?php } ?>
                                </div>
                            </div>
                            <div>
                                <div class="form-group" style="text-align: center;">
                                    <label for="notice" style="color: red;"><b>Jika Tidak Silahkan Mengembelikan Data Dengan Tombol Di Bawah Ini</b></label>
                                    <a href="#" id="pengembalian_pelayanan<?= $datapenx['id_pendataan']; ?>" class="btn btn-danger mb-3" data-value="0">KEMBALIKAN DATA KE PELAYANAN</a>
                                    <script>
                                        $(document).ready(function() {
                                            // Tangkap klik pada anchor tag
                                            $('#pengembalian_pelayanan<?= $datapenx['id_pendataan']; ?>').click(function(e) {
                                                e.preventDefault(); // Mencegah perilaku default dari anchor tag

                                                // Ambil nilai dari atribut data-value
                                                var value = $(this).data('value');

                                                // Ambil nilai id_pelayanan dari PHP
                                                var id_pelayanan_di_pendataan = <?= $datapenx['id_pelayanan']; ?>;

                                                // Kirimkan nilai menggunakan window.location.href atau Ajax sesuai kebutuhan
                                                // Misalnya, menggunakan window.location.href:
                                                window.location.href = '<?= base_url('pendataan/pengembalianfile'); ?>?pengembalian_pelayanan=' + value + '&id_pelayanan_di_pendataan=' + id_pelayanan_di_pendataan;
                                            });
                                        });
                                    </script>
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
        <?php endforeach ?>

    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->