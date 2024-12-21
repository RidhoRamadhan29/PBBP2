<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h2 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
        </div>
        <div class="card-body">
            <?= $this->session->flashdata('message'); ?>
            <div class="table-responsive">
                <?php
                $current_user_role_id = $_SESSION['role_id'];
                if ($current_user_role_id == 1) { ?>
                    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addnewpelayanan">Add New User</a>
                <?php } ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Date Created</th>
                            <th>RoleID</th>
                            <th>Images</th>
                            <th>Akses</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($all_user as $users) :
                            if ($users['role_id'] == '1') {
                                //kosong
                            } else {
                        ?>
                                <tr>
                                    <td><?= $users['id']; ?></td>
                                    <td><?= $users['name']; ?></td>
                                    <td><?= $users['email']; ?></td>
                                    <td><?= $users['username']; ?></td>
                                    <td><?= $users['date_created']; ?></td>
                                    <td>
                                        <?php foreach ($allrole as $allroles) : ?>
                                            <?php if (isset($users['role_id']) && $users['role_id'] == $allroles['id']) : ?>
                                                <?= $allroles['id'] ?> - <?= $allroles['role'] ?>
                                                <?php break; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>

                                    </td>
                                    <td><?= $users['image']; ?></td>
                                    <td>
                                        <a href="#" class="badge badge-success" data-id-edituser="<?php print_r($users['id']); ?>" data-toggle="modal" data-target="#editUser<?= $users['id']; ?>">Edit</a> ||
                                        <a href="#" class="badge badge-danger" data-id-delete="<?php print_r($users['id']) ?>" data-toggle="modal" data-target="#deleteUser<?= $users['id']; ?>">Delete</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="addnewpelayanan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ADD NEW USER </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('admin/addnewuser'); ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body" style="text-align:center">
                            <div class="form-group">
                                <label>USER YANG AKAN DITAMBAHKAN</label>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="name" name="name" placeholder="NAMA" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="email" name="email" placeholder="EMAIL" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="username" name="username" placeholder="USERNAME" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="PASSWORD" required>
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


        <?php foreach ($all_user as $userss) : ?>
            <div class="modal fade" id="editUser<?= $userss['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">EDIT USER</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('admin/editusers'); ?>" method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="id_user" name="id_user" value="<?php print_r($userss['id']) ?>" readonly>
                                </div>
                                <h6>Username</h6>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="username" name="username" value="<?php print_r($userss['username']) ?>" readonly>
                                </div>
                                <h6>Nama</h6>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" value="<?php print_r($userss['name']) ?>">
                                </div>
                                <h6>Role User</h6>
                                <div class="form-group">
                                    <select id="role_id" name="role_id" class="form-control">
                                        <?php foreach ($allrole as $allroles) : ?>
                                            <option value="<?= $allroles['id'] ?>" <?php echo isset($userss['role_id']) && $userss['role_id'] == $allroles['id'] ? 'selected' : ''; ?>><?= $allroles['id'] ?> - <?= $allroles['role'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
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

            <div class="modal fade" id="deleteUser<?= $userss['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Apakah Kamu Yakin Menghapus User ini <?= $userss['username']; ?> ?</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="<?= base_url('admin/deleteuser/') . $userss['id']; ?>">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>

        <?php //foreach ($all_user as $usersss) : 
        ?>

        <?php //endforeach 
        ?>

    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->