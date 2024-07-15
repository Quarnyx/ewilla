<?php
$getuser = "SELECT * FROM v_custaccount WHERE user_id = '" . $_SESSION['user_id'] . "'";
$result = mysqli_query($conn, $getuser);
$row = mysqli_fetch_assoc($result);

?>

<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>Akun Saya - <?= $row['name'] ?> </h2>
        </div>
    </div>
</div>
<!-- End Page Title -->

<!-- Start SignUP Area -->
<section class="signup-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-md-6">

                <h2>Detail Akun</h2>
                <div class="signup-content">

                    <form class="signup-form" action="process.php?act=edit-profile" method="POST">
                        <input type="hidden" name="user_id" id="id" value="<?= $row['user_id'] ?>">
                        <div class="form-group">
                            <label>Nama</label>
                            <input value="<?= $row['name'] ?>" type="text" class="form-control"
                                placeholder="Enter your name" id="name" name="name">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input value="<?= $row['email'] ?>" type="email" class="form-control"
                                placeholder="Enter your name" id="email" name="email">
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" rows="5" placeholder="Enter your address" id="address"
                                name="address"><?= $row['address'] ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Provinsi</label>
                                    <input type="hidden" value="<?= $row['province_id'] ?>" id="province_id">
                                    <select id="provinceDropdown" name="province_id">
                                        <option value="aaa">Select a Province</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Kota</label>
                                    <input type="hidden" value="<?= $row['city_id'] ?>" id="city_id">
                                    <select id="cityDropdown" name="city_id"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input value="<?= $row['phone_number'] ?>" type="number" class="form-control"
                                        id="phone_number" name="phone_number"></input>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Kode Pos</label>
                                    <input value="<?= $row['post_code'] ?>" type="number" class="form-control"
                                        id="post_code" name="post_code"></input>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="?page=ganti-password&id=<?= $row['user_id'] ?>" class="btn btn-success">Ubah
                            Password</a>

                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <h2>Daftar Pesanan</h2>
                <div class="order-table table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Nomor Invoice</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $user_id = $_SESSION['user_id'];
                            $getcart = $conn->query("SELECT * FROM `v_invoicelist` WHERE `user_id` = '$user_id'");
                            if ($getcart->num_rows > 0) {
                                while ($row = $getcart->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td class="product-name">
                                            <a href="#"><?= $row['invoice_number'] ?></a>
                                        </td>

                                        <td class="product-total">
                                            <a btn="btn btn-primary"
                                                href="?page=invoice-detail&id=<?= $row['invoice_id'] ?>">Detail</a>
                                        </td>
                                    </tr>
                                <?php }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End SignUP Area -->
<script src="ongkir-account.js"></script>