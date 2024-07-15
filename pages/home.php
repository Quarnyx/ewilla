<div class="home-slides owl-carousel owl-theme">
    <div class="main-banner banner-bg1">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="main-banner-content text-center">
                        <span class="sub-title">Ewilla</span>
                        <h1 style="color: white;">Looks Beautiful and Charming With Ewilla</h1>
                        <div class="btn-box">
                            <a href="?page=toko" class="default-btn">Order Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-banner banner-bg2">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="main-banner-content">
                        <span class="sub-title">Ewilla</span>
                        <h1>Looks Beautiful and <br>Charming With Ewilla</h1>
                        <div class="btn-box">
                            <a href="?page=toko" class="default-btn">Order Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Main Banner Area -->


<!-- Start Products Area -->
<section class="products-area pt-100 pb-70">
    <div class="container">
        <div class="section-title">
            <span class="sub-title">Koleksi Kami</span>
            <h2>Produk Terbaru</h2>
        </div>

        <div class="row">
            <?php
            $newpro = "SELECT * FROM v_newpro ORDER BY product_id DESC LIMIT 6";
            $query = mysqli_query($conn, $newpro);
            while ($row = mysqli_fetch_array($query)) {
                ?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-products-box">
                        <div class="products-image">
                            <a href="?page=produk&id=<?php echo $row['product_id']; ?>">
                                <img src="assets/img/products/<?php echo $row['image_url']; ?>" class="main-image"
                                    alt="image">
                                <img src="assets/img/products/<?php echo $row['image_url']; ?>" class="hover-image"
                                    alt="image">
                            </a>

                            <!-- <div class="products-button">
                                    <ul>
                                        <li>
                                            <div class="wishlist-btn">
                                                <a href="#">
                                                    <i class='bx bx-heart'></i>
                                                    <span class="tooltip-label">Add to Wishlist</span>
                                                </a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="compare-btn">
                                                <a href="#">
                                                    <i class='bx bx-refresh'></i>
                                                    <span class="tooltip-label">Compare</span>
                                                </a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="quick-view-btn">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#productsQuickView">
                                                    <i class='bx bx-search-alt'></i>
                                                    <span class="tooltip-label">Quick View</span>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div> -->
                        </div>

                        <div class="products-content">
                            <h3><a
                                    href="?page=produk&id=<?php echo $row['product_id']; ?>"><?php echo $row['product_name']; ?></a>
                            </h3>
                            <div class="price">
                                <span class="new-price">Rp
                                    <?php echo number_format($row['product_price'], 0, ',', '.'); ?></span>
                            </div>
                            <div class="star-rating">
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                            </div>
                            <a href="?page=produk&id=<?php echo $row['product_id']; ?>" class="add-to-cart">Lihat Produk</a>
                        </div>
                    </div>
                </div>
            <?php } ?>


        </div>
    </div>
</section>
<!-- End Products Area -->

<!-- Start Products Area -->
<section class="products-area pt-100 pb-70">
    <div class="container">
        <div class="section-title">
            <span class="sub-title">Koleksi Kami</span>
            <h2>Produk Terlaris</h2>
        </div>

        <div class="row">
            <?php
            $newpro = "SELECT * FROM v_newpro ORDER BY color DESC LIMIT 6";
            $query = mysqli_query($conn, $newpro);
            while ($row = mysqli_fetch_array($query)) {
                ?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-products-box">
                        <div class="products-image">
                            <a href="?page=produk&id=<?php echo $row['product_id']; ?>">
                                <img src="assets/img/products/<?php echo $row['image_url']; ?>" class="main-image"
                                    alt="image">
                                <img src="assets/img/products/<?php echo $row['image_url']; ?>" class="hover-image"
                                    alt="image">
                            </a>

                            <!-- <div class="products-button">
                                                    <ul>
                                                        <li>
                                                            <div class="wishlist-btn">
                                                                <a href="#">
                                                                    <i class='bx bx-heart'></i>
                                                                    <span class="tooltip-label">Add to Wishlist</span>
                                                                </a>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="compare-btn">
                                                                <a href="#">
                                                                    <i class='bx bx-refresh'></i>
                                                                    <span class="tooltip-label">Compare</span>
                                                                </a>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="quick-view-btn">
                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#productsQuickView">
                                                                    <i class='bx bx-search-alt'></i>
                                                                    <span class="tooltip-label">Quick View</span>
                                                                </a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div> -->
                        </div>

                        <div class="products-content">
                            <h3><a
                                    href="?page=produk&id=<?php echo $row['product_id']; ?>"><?php echo $row['product_name']; ?></a>
                            </h3>
                            <div class="price">
                                <span class="new-price">Rp
                                    <?php echo number_format($row['product_price'], 0, ',', '.'); ?></span>
                            </div>
                            <div class="star-rating">
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                            </div>
                            <a href="?page=produk&id=<?php echo $row['product_id']; ?>" class="add-to-cart">Lihat Produk</a>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</section>
<!-- End Products Area -->

<!-- Start Facility Area -->
<section class="facility-area pb-70">
    <div class="container">
        <div class="facility-slides owl-carousel owl-theme">
            <div class="single-facility-box">
                <div class="icon">
                    <i class='flaticon-tracking'></i>
                </div>
                <h3>Gratis Ongkir</h3>
                <p>Kami menanggung ongkir kirim jika produk rusak dan tidak sesuai</p>
            </div>

            <div class="single-facility-box">
                <div class="icon">
                    <i class='flaticon-return'></i>
                </div>
                <h3>Ganti Baru</h3>
                <p>Ganti baru jika produk yang diterima tidak sesuai</p>
            </div>

            <div class="single-facility-box">
                <div class="icon">
                    <i class='flaticon-shuffle'></i>
                </div>
                <h3>Pengemasan</h3>
                <p>Setiap produk dikemas dengan aman</p>
            </div>

        </div>
    </div>
</section>
<!-- End Facility Area -->