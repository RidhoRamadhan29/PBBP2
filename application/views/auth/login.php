    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-7">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">

                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <style>
                                        .logo-container {
                                            display: flex;
                                            /* Menggunakan flexbox */
                                            justify-content: center;
                                            /* Menyusun item secara horizontal di tengah */
                                            align-items: center;
                                            /* Menyusun item secara vertikal di tengah */
                                        }

                                        .logo {
                                            max-width: 100px;
                                            /* Lebar maksimum gambar */
                                            max-height: 100px;
                                            /* Tinggi maksimum gambar */
                                            width: auto;
                                            /* Lebar gambar disesuaikan agar sesuai dengan tinggi maksimum */
                                            height: auto;
                                            /* Tinggi gambar disesuaikan agar sesuai dengan lebar maksimum */
                                            margin: 0 5px;
                                            /* Memberikan ruang di antara kedua logo */
                                        }
                                    </style>

                                    <div class="logo-container">
                                        <img class="logo" src="assets/img/logo/lombok barat.png" alt="LOMBOK BARAT">
                                        <img class="logo" src="assets/img/logo/stiki.png" alt="STIKI">

                                    </div>
                                    <br>
                                    <?= $this->session->flashdata('message'); ?>
                                    <form class="user" action="<?= base_url('auth'); ?>" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="email" placeholder="Username..." name="username" value="<?= set_value('username'); ?>">
                                            <?= form_error(
                                                'username',
                                                '<small class="text-danger pl-3">',
                                                '</small>'
                                            ); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                            <?= form_error(
                                                'password',
                                                '<small class="text-danger pl-3">',
                                                '</small>'
                                            ); ?>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>

                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>