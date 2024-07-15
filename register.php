<?php
include ('config.php');
include ('layouts/head.php');
?>

<body>

    <!-- Start Top Header Area -->
    <?php
    include ('layouts/top-header.php');
    ?>
    <!-- End Top Header Area -->

    <!-- Start Navbar Area -->
    <?php
    include ('layouts/navbar.php');
    ?>
    <div class="page-title-area">
        <div class="container">
            <div class="page-title-content">
                <h2>Akun Saya</h2>
            </div>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- Start SignUP Area -->
    <section class="signup-area ptb-100">
        <div class="container">
            <div class="signup-content">
                <h2>Daftar Akun</h2>

                <form class="signup-form" action="process.php?act=register" method="POST">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Enter your name" id="name" name="name">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Enter your name" id="email" name="email">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Enter your password" id="password"
                            name="password">
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" rows="5" placeholder="Enter your address" id="address"
                            name="address"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Provinsi</label>
                                <select id="provinceDropdown" name="province_id">
                                    <option value="aaa">Select a Province</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Kota</label>
                                <select id="cityDropdown" name="city_id"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nomor Telepon</label>
                                <input type="number" class="form-control" id="phone_number" name="phone_number"></input>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Kode Pos</label>
                                <input type="number" class="form-control" id="post_code" name="post_code"></input>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="default-btn">Daftar</button>
                </form>
            </div>
        </div>
    </section>
    <!-- End SignUP Area -->
    <?php
    include ('layouts/footer.php');
    ?>

    <!-- End Footer Area -->

    <div class="go-top"><i class='bx bx-up-arrow-alt'></i></div>

    <!-- Links of JS files -->
    <?php
    include ('layouts/script.php'); ?>
    <script src="ongkir.js"></script>
</body>

</html>