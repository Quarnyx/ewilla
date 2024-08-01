<!-- Start Page Title -->
<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>My Account</h2>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li>Login</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title -->

<!-- Start Login Area -->
<section class="login-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="login-content">
                    <h2>Login</h2>

                    <form class="login-form" method="post" action="auth.php">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email Pengguna">
                        </div>

                        <div class="form-group">
                            <div class="input-group" id="password-field">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <div class="input-group-append">
                                    <button class="btn btn-primary"
                                        style="background-color: #f53f85 !important; margin-top: 5px;" type="button"
                                        onclick="togglePasswordVisibility()">
                                        <i class="bx bx-low-vision"></i>
                                    </button>
                                </div>
                            </div>

                            <script>
                                function togglePasswordVisibility() {
                                    var passwordField = document.querySelector('#password-field input[type="password"]');
                                    if (passwordField.type === "password") {
                                        passwordField.type = "text";
                                    } else {
                                        passwordField.type = "password";
                                    }
                                }
                            </script>
                        </div>
                        <?php if (isset($_GET['pass'])): ?>
                            <div class="alert alert-danger" role="alert">
                                Password salah!
                            </div>
                        <?php endif; ?>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="remember_me" id="remember_me">
                            <label class="form-check-label" for="remember_me">Ingat Saya</label>
                        </div>
                        <button type="submit" class="default-btn">Login</button>
                        <a href="#" class="forgot-password">Lupa Password?</a>

                    </form>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="new-customer-content">
                    <h2>Pelanggan Baru</h2>

                    <span>Buat Akun</span>
                    <p>Daftar untuk akun gratis di toko kami. Pendaftaran cepat dan mudah membuat Anda dapat memesan
                        dari toko kami. Untuk memulai belanja, klik daftar.</p>
                    <a href="register.php" class="optional-btn">Buat Akun</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Login Area -->