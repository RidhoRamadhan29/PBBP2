<div class="container-fluid">
    <!-- Area Chart -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">GRAFIK JUMALAH DATA PER BULAN YANG MASUK</h6>
        </div>
        <div class="card-body">
            <div class="chart-area">
                <canvas id="myAreaChart"></canvas>
            </div>

        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">JUMLAH DATA PADA SETIAP BIDANG</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Pelayanan Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Pelayanan</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_pelayanan['jumlah_data']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pendataan Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Pendataan</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_pendataan['jumlah_data']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Penetapan Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Penetapan</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_penetapan['jumlah_data']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Penagihan Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Penagihan</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_penagihan['jumlah_data']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Arsip Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Arsip</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_arsip['jumlah_data']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    var monthlyData = <?php echo json_encode(array_values($monthly_data)); ?>;
</script>