<?php
require_once '../inc/admin/snippets/header.php';

require_once '../config/db.php';


$query = "SELECT * FROM user";
$results = mysqli_query($conn, $query);

?>

<div id="app">

    <!-- Sidebar -->
    <?php require_once '../inc/admin/snippets/sidebar.php' ?>

    <!-- Topbar -->
    <?php require_once '../inc/admin/snippets/topbar.php' ?>

    <div class="main-content container-fluid">
        <!-- Hoverable rows start -->
        <div class="row" id="table-hover-row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All role</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p>Menampilkan semua data <code class="highlighter-rouge"><b>All role</b></code>

                            </p>
                        </div>
                        <!-- table hover -->
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>EMAIL</th>
                                        <th>USERNAME</th>
                                        <th>FULLNAME</th>
                                        <th>ROLE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if (empty($results)) : ?>
                                    <tr>
                                        <td colspan="5" style="text-align:center;">
                                            <i>Data empty</i>
                                        </td>
                                    </tr>

                                <?php else: ?>

                                    <?php $rows_id = 1; ?>
                                    <?php foreach ($results as $result) { ?>
                                        <?php if ($result['role_id'] == 2 ) : ?>
                                        <tr>
                                            <td class="text-bold-500"><?= $rows_id ?></td>
                                            <td><?= $result['user_email'] ?></td>
                                            <td class="text-bold-500"><?= $result['user_username'] ?></td>
                                            <td><?= $result['user_full_name'] ?></td>
                                            <td><?= $result['role_id'] ?></td>
                                            <td><a href="#"><i class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="mail"></i></a></td>
                                        </tr>
                                        <?php $rows_id++ ?>
                                        <?php endif; ?>
                                    <?php } ?>

                                <?php endif; ?>

                                
                                    

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hoverable rows end -->
    </div>


    <?php
    require_once '../inc/admin/snippets/footer.php';
    ?>