<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
            <p>Role : <?= $role['role'] ?? 'Role not found'; ?></p>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Access</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($menu as $m) : ?>
                        <tr>
                            <th scope="row"><?php echo $i ?></th>
                            <td><?php echo $m['menu']; ?></td>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" <?= check_access($role['id'] ?? null, $m['id'] ?? null); ?> data-role="<?= $role['id'] ?? '' ?>" data-menu="<?= $m['id'] ?? '' ?>">
                                </div>

                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->