<?php
$getuser = "SELECT * FROM v_custaccount WHERE user_id = '" . $_GET['id'] . "'";
$result = mysqli_query($conn, $getuser);
$row = mysqli_fetch_assoc($result);

?>

<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>Ganti Password Akun - <?= $row['name'] ?> </h2>
        </div>
    </div>
</div>
<!-- End Page Title -->

<!-- Start SignUP Area -->
<section class="signup-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="signup-content">

                    <form class="signup-form" action="process.php?act=edit-password" method="POST">
                        <input type="hidden" name="user_id" id="id" value="<?= $row['user_id'] ?>">
                        <div class="form-group">
                            <label>Password Baru</label>
                            <input type="password" class="form-control" placeholder="password" id="password"
                                name="password">
                        </div>


                        <button type="submit" class="btn btn-success">Simpan Password</b>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End SignUP Area -->
<script src="ongkir-account.js"></script>