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
            <h6 class="m-0 font-weight-bold text-primary">DATA ARSIP</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th hidden>ID ARSIP</th>
                            <th hidden>ID PENAGIHAN</th>
                            <th>NAMA OPERATOR YANG TERAKHIR MERUBAH</th>
                            <th>NAMA WP</th>
                            <th>NIK WP</th>
                            <th>ALAMAT</th>
                            <th>NOP</th>
                            <th>JENIS PENDAFTARAN</th>
                            <th>ALASHAK</th>
                            <th>FILE</th>
                            <th>STATUS</th>
                            <th>TGL FILE MASUK</th>
                            <th>TGL FILE DI ARSIP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_arsip as $dataarsip) : ?>
                            <tr>
                                <td hidden><?= $dataarsip['id_penagihan'] ?></td>
                                <td hidden><?= $dataarsip['id_penetapan'] ?></td>
                                <td>
                                    <?php
                                    foreach ($userx as $username) {
                                        if ($username['id'] == $dataarsip['penagihan_id_user']) {
                                            print_r($username['username'] . '<br>----' . $dataarsip['role']);
                                        }
                                    }
                                    ?>
                                </td>
                                <td><?= $dataarsip['nama_wp'] ?></td>
                                <td><?= $dataarsip['nik_wp'] ?></td>
                                <td><?= $dataarsip['alamat'] ?></td>
                                <td><?= $dataarsip['nop'] ?></td>
                                <td><?= $dataarsip['jenis_pendaftaran'] ?></td>
                                <td><?= $dataarsip['alashak'] ?></td>
                                <td>
                                    <?= $dataarsip['upload_doc_pbb']; ?>
                                    <?php $file_path = base_url('file_pbb/' . $dataarsip['upload_doc_pbb']); ?>
                                    <a href="<?= $file_path ?>" target="_blank">Lihat File</a>
                                </td>
                                <td style="text-align: center;">
                                    <?php
                                    $id_pelayanan = $dataarsip['id_pelayanan'];
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
                                <td><?= $dataarsip['tgl_pelayanan'] ?></td>
                                <td><?= $dataarsip['tgl_arsip'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <?php
    if ($_SESSION['role_id'] == '1' || $_SESSION['role_id'] == '10') { ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DATA PELAYANAN</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th hidden>ID ARSIP</th>
                                <th hidden>ID PENAGIHAN</th>
                                <th>NAMA OPERATOR YANG TERAKHIR MERUBAH</th>
                                <th>NAMA WP</th>
                                <th>NIK WP</th>
                                <th>ALAMAT</th>
                                <th>NOP</th>
                                <th>JENIS PENDAFTARAN</th>
                                <th>ALASHAK</th>
                                <th>FILE</th>
                                <th>STATUS</th>
                                <th>TGL FILE MASUK</th>
                                <th>TGL FILE DI ARSIP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_pelayanan as $dataarsip) : ?>
                                <tr>
                                    <td hidden><?= $dataarsip['id_penagihan'] ?></td>
                                    <td hidden><?= $dataarsip['id_penetapan'] ?></td>
                                    <td>
                                        <?php
                                        foreach ($userx as $username) {
                                            if ($username['id'] == $dataarsip['penagihan_id_user']) {
                                                print_r($username['username'] . '<br>----' . $dataarsip['role']);
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td><?= $dataarsip['nama_wp'] ?></td>
                                    <td><?= $dataarsip['nik_wp'] ?></td>
                                    <td><?= $dataarsip['alamat'] ?></td>
                                    <td><?= $dataarsip['nop'] ?></td>
                                    <td><?= $dataarsip['jenis_pendaftaran'] ?></td>
                                    <td><?= $dataarsip['alashak'] ?></td>
                                    <td>
                                        <?= $dataarsip['upload_doc_pbb']; ?>
                                        <?php $file_path = base_url('file_pbb/' . $dataarsip['upload_doc_pbb']); ?>
                                        <a href="<?= $file_path ?>" target="_blank">Lihat File</a>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php
                                        $id_pelayanan = $dataarsip['id_pelayanan'];
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
                                    <td><?= $dataarsip['tgl_pelayanan'] ?></td>
                                    <td><?= $dataarsip['tgl_arsip'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    <?php }
    if ($_SESSION['role_id'] == '1' || $_SESSION['role_id'] == '11') { ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DATA PENDATAAN</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th hidden>ID ARSIP</th>
                                <th hidden>ID PENAGIHAN</th>
                                <th>NAMA OPERATOR YANG TERAKHIR MERUBAH</th>
                                <th>NAMA WP</th>
                                <th>NIK WP</th>
                                <th>ALAMAT</th>
                                <th>NOP</th>
                                <th>JENIS PENDAFTARAN</th>
                                <th>ALASHAK</th>
                                <th>FILE</th>
                                <th>STATUS</th>
                                <th>TGL FILE MASUK</th>
                                <th>TGL FILE DI ARSIP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_pendataan as $dataarsip) : ?>
                                <tr>
                                    <td hidden><?= $dataarsip['id_penagihan'] ?></td>
                                    <td hidden><?= $dataarsip['id_penetapan'] ?></td>
                                    <td>
                                        <?php
                                        foreach ($userx as $username) {
                                            if ($username['id'] == $dataarsip['penagihan_id_user']) {
                                                print_r($username['username'] . '<br>----' . $dataarsip['role']);
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td><?= $dataarsip['nama_wp'] ?></td>
                                    <td><?= $dataarsip['nik_wp'] ?></td>
                                    <td><?= $dataarsip['alamat'] ?></td>
                                    <td><?= $dataarsip['nop'] ?></td>
                                    <td><?= $dataarsip['jenis_pendaftaran'] ?></td>
                                    <td><?= $dataarsip['alashak'] ?></td>
                                    <td>
                                        <?= $dataarsip['upload_doc_pbb']; ?>
                                        <?php $file_path = base_url('file_pbb/' . $dataarsip['upload_doc_pbb']); ?>
                                        <a href="<?= $file_path ?>" target="_blank">Lihat File</a>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php
                                        $id_pelayanan = $dataarsip['id_pelayanan'];
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
                                    <td><?= $dataarsip['tgl_pelayanan'] ?></td>
                                    <td><?= $dataarsip['tgl_arsip'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    <?php }
    if ($_SESSION['role_id'] == '1' || $_SESSION['role_id'] == '12') { ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DATA PENETAPAN</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th hidden>ID ARSIP</th>
                                <th hidden>ID PENAGIHAN</th>
                                <th>NAMA OPERATOR YANG TERAKHIR MERUBAH</th>
                                <th>NAMA WP</th>
                                <th>NIK WP</th>
                                <th>ALAMAT</th>
                                <th>NOP</th>
                                <th>JENIS PENDAFTARAN</th>
                                <th>ALASHAK</th>
                                <th>FILE</th>
                                <th>STATUS</th>
                                <th>TGL FILE MASUK</th>
                                <th>TGL FILE DI ARSIP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_penetapan as $dataarsip) : ?>
                                <tr>
                                    <td hidden><?= $dataarsip['id_penagihan'] ?></td>
                                    <td hidden><?= $dataarsip['id_penetapan'] ?></td>
                                    <td>
                                        <?php
                                        foreach ($userx as $username) {
                                            if ($username['id'] == $dataarsip['penagihan_id_user']) {
                                                print_r($username['username'] . '<br>----' . $dataarsip['role']);
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td><?= $dataarsip['nama_wp'] ?></td>
                                    <td><?= $dataarsip['nik_wp'] ?></td>
                                    <td><?= $dataarsip['alamat'] ?></td>
                                    <td><?= $dataarsip['nop'] ?></td>
                                    <td><?= $dataarsip['jenis_pendaftaran'] ?></td>
                                    <td><?= $dataarsip['alashak'] ?></td>
                                    <td>
                                        <?= $dataarsip['upload_doc_pbb']; ?>
                                        <?php $file_path = base_url('file_pbb/' . $dataarsip['upload_doc_pbb']); ?>
                                        <a href="<?= $file_path ?>" target="_blank">Lihat File</a>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php
                                        $id_pelayanan = $dataarsip['id_pelayanan'];
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
                                    <td><?= $dataarsip['tgl_pelayanan'] ?></td>
                                    <td><?= $dataarsip['tgl_arsip'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    <?php }
    if ($_SESSION['role_id'] == '1' || $_SESSION['role_id'] == '13') { ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DATA PENAGIHAN</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th hidden>ID ARSIP</th>
                                <th hidden>ID PENAGIHAN</th>
                                <th>NAMA OPERATOR YANG TERAKHIR MERUBAH</th>
                                <th>NAMA WP</th>
                                <th>NIK WP</th>
                                <th>ALAMAT</th>
                                <th>NOP</th>
                                <th>JENIS PENDAFTARAN</th>
                                <th>ALASHAK</th>
                                <th>FILE</th>
                                <th>STATUS</th>
                                <th>TGL FILE MASUK</th>
                                <th>TGL FILE DI ARSIP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_penagihan as $dataarsip) : ?>
                                <tr>
                                    <td hidden><?= $dataarsip['id_penagihan'] ?></td>
                                    <td hidden><?= $dataarsip['id_penetapan'] ?></td>
                                    <td>
                                        <?php
                                        foreach ($userx as $username) {
                                            if ($username['id'] == $dataarsip['penagihan_id_user']) {
                                                print_r($username['username'] . '<br>----' . $dataarsip['role']);
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td><?= $dataarsip['nama_wp'] ?></td>
                                    <td><?= $dataarsip['nik_wp'] ?></td>
                                    <td><?= $dataarsip['alamat'] ?></td>
                                    <td><?= $dataarsip['nop'] ?></td>
                                    <td><?= $dataarsip['jenis_pendaftaran'] ?></td>
                                    <td><?= $dataarsip['alashak'] ?></td>
                                    <td>
                                        <?= $dataarsip['upload_doc_pbb']; ?>
                                        <?php $file_path = base_url('file_pbb/' . $dataarsip['upload_doc_pbb']); ?>
                                        <a href="<?= $file_path ?>" target="_blank">Lihat File</a>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php
                                        $id_pelayanan = $dataarsip['id_pelayanan'];
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
                                    <td><?= $dataarsip['tgl_pelayanan'] ?></td>
                                    <td><?= $dataarsip['tgl_arsip'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    <?php } ?>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->