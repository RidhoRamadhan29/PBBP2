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
            <h6 class="m-0 font-weight-bold text-primary">DATA PENETAPAN</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th hidden>ID PENETAPAN</th>
                            <th hidden>ID PENDATAAN</th>
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
                            <th>TGL FILE MASUK DI PENETAPAN</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_penetapan as $datapene) : ?>
                            <tr>
                                <td hidden><?= $datapene['id_penetapan'] ?></td>
                                <td hidden><?= $datapene['id_pendataan'] ?></td>
                                <td>
                                    <?php
                                    foreach ($userx as $username) {
                                        if ($username['id'] == $datapene['penetapan_id_user']) {
                                            print_r($username['username'] . '<br>----' . $datapene['role']);
                                        }
                                    }
                                    ?>
                                </td>
                                <td><?= $datapene['nama_wp'] ?></td>
                                <td><?= $datapene['nik_wp'] ?></td>
                                <td><?= $datapene['alamat'] ?></td>
                                <td><?= $datapene['nop'] ?></td>
                                <td><?= $datapene['jenis_pendaftaran'] ?></td>
                                <td><?= $datapene['alashak'] ?></td>
                                <td>
                                    <?= $datapene['upload_doc_pbb']; ?>
                                    <?php $file_path = base_url('file_pbb/' . $datapene['upload_doc_pbb']); ?>
                                    <a href="<?= $file_path ?>" target="_blank">Lihat File</a>
                                </td>
                                <td style="text-align: center;">
                                    <?php
                                    $id_pelayanan = $datapene['id_pelayanan'];
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
                                <td><?= $datapene['tgl_pelayanan'] ?></td>
                                <td><?= $datapene['tgl_penetapan'] ?></td>
                                <td style="text-align: center;">
                                    <?php
                                    $id_pelayanan = $datapene['id_pelayanan'];
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
                                        if ($current_user_role_id == 1 || $current_user_role_id == 5) {
                                            if ($status['text'] == "DI ARSIPKAN") {
                                                echo '<a><b>TIDAK DAPAT MERUBAH APAPUN</b></a>';
                                            } else if ($status['text'] == "PROSES PELAYANAN") {
                                                echo '<a><b>TIDAK DAPAT MERUBAH APAPUN DATA MASIH DI <a style="color:red;">PELAYANAN</a></b></a>';
                                            } else if ($status['text'] == "PROSES PENDATAAN") {
                                                echo '<a><b>TIDAK DAPAT MERUBAH APAPUN</b></a>';
                                            } else if ($status['text'] == "PROSES PENAGIHAN") {
                                                echo '<a><b>TIDAK DAPAT MERUBAH APAPUN</b></a>';
                                            } else {
                                                echo '<a href="#" class="badge badge-success" data-toggle="modal" data-target="#editpenetapan' . $datapene['id_penetapan'] . '">Edit & Ubah Status</a>';
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
        <?php foreach ($data_penetapan as $datapenex) : ?>
            <!-- EDIT -->
            <div class="modal fade" id="editpenetapan<?= $datapenex['id_penetapan']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">EDIT PENETAPAN</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('penetapan/editpenetapan'); ?>" method="post" enctype="multipart/form-data">
                            <div class="modal-body" style="text-align:center">
                                <div class="form-group" hidden>
                                    <input type="text" class="form-control" id="id_pelayanan" name="id_pelayanan" value="<?= $datapenex['id_pelayanan']; ?>" readonly>
                                </div>
                                <div class="form-group" hidden>
                                    <input type="text" class="form-control" id="id_pendataan" name="id_pendataan" value="<?= $datapenex['id_pendataan']; ?>" readonly>
                                </div>
                                <div class="form-group" hidden>
                                    <input type="text" class="form-control" id="id_penetapan" name="id_penetapan" value="<?= $datapenex['id_penetapan']; ?>" readonly>
                                </div>
                                <div class="form-group" hidden>
                                    <label>USER ANDA</label>
                                    <input type="text" class="form-control" id="id_user" name="id_user" value="<?= $_SESSION['user_id']; ?>" readonly>
                                </div>
                                <div class="form-group" hidden>
                                    <input type="text" class="form-control" id="name" name="name" value="<?= $_SESSION['username']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="nama_wp" name="nama_wp" value="<?= $datapenex['nama_wp']; ?>" required readonly>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="nik_wp" name="nik_wp" value="<?= $datapenex['nik_wp']; ?>" required readonly>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $datapenex['alamat']; ?>" required readonly>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="nop" name="nop" value="<?= $datapenex['nop']; ?>" required readonly>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="jenis_pendaftaran" name="jenis_pendaftaran" value="<?= $datapenex['jenis_pendaftaran']; ?>" required readonly>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="alashak" name="alashak" value="<?= $datapenex['alashak']; ?>" required readonly>
                                </div>

                                <div class="form-group">
                                    <label for="notice" style="color: red;"><b>Jika Data Sudah Dipastikan Benar Silahkan Di Centang Agar Status Pendataan Dapat Di Update</b></label>
                                    <?php if (isset($datapenex['status_penetapan']) && $datapenex['status_penetapan'] !== null && $datapenex['status_penetapan'] !== '0') { ?>
                                        <input type="checkbox" style="transform: scale(1.5); margin-right: 5px;" id="status_penetapan" name="status_penetapan" value="<?= $datapenex['status_penetapan']; ?>" checked>
                                    <?php } else { ?>
                                        <input type="checkbox" style="transform: scale(1.5); margin-right: 5px;" id="status_penetapan" name="status_penetapan" value="3">
                                    <?php } ?>
                                </div>
                            </div>
                            <div>
                                <div class="form-group" style="text-align: center;">
                                    <label for="notice" style="color: red;"><b>Jika Tidak Silahkan Mengembalikan Data Dengan Tombol Di Bawah Ini</b></label>
                                    <a href="#" id="pengembalian_penetapan<?= $datapenex['id_penetapan']; ?>" class="btn btn-danger mb-3" data-value="0">KEMBALIKAN DATA KE PENDATAAN</a>
                                    <script>
                                        $(document).ready(function() {
                                            // Tangkap klik pada anchor tag
                                            $('#pengembalian_penetapan<?= $datapenex['id_penetapan']; ?>').click(function(e) {
                                                e.preventDefault(); // Mencegah perilaku default dari anchor tag

                                                // Ambil nilai dari atribut data-value
                                                var value = $(this).data('value');

                                                // Ambil nilai id_pelayanan dari PHP
                                                var id_pendataan_di_penetapan = <?= $datapenex['id_pendataan']; ?>;

                                                // Kirimkan nilai menggunakan window.location.href atau Ajax sesuai kebutuhan
                                                // Misalnya, menggunakan window.location.href:
                                                window.location.href = '<?= base_url('penetapan/pengembalianfile'); ?>?pengembalian_penetapan=' + value + '&id_pendataan_di_penetapan=' + id_pendataan_di_penetapan;
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