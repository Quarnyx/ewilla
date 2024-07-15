<!-- Start Products Area -->
<section class="products-area pt-100 pb-70">
    <div class="container">
        <div class="products-filter-options">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-4">
                    <div class="d-lg-flex d-md-flex align-items-center">


                        <span class="sub-title d-none d-lg-block d-md-block">View:</span>

                        <div class="view-list-row d-none d-lg-block d-md-block">
                            <div class="view-column">
                                <a href="#" class="icon-view-two">
                                    <span></span>
                                    <span></span>
                                </a>

                                <a href="#" class="icon-view-three active">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>

                                <a href="#" class="icon-view-four">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>

                                <a href="#" class="view-grid-switch">
                                    <span></span>
                                    <span></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="products-collections-filter" class="row">
            <?php
            if (isset($_GET['cat'])) {
                $cat = $_GET['cat'];
                $newpro = "SELECT * FROM v_newpro WHERE category_name = '$cat' ORDER BY product_id DESC";
                $query = mysqli_query($conn, $newpro);
            } else {
                $newpro = "SELECT * FROM v_newpro ORDER BY product_id DESC";
                $query = mysqli_query($conn, $newpro);
            }

            while ($row = mysqli_fetch_array($query)) {
                ?>
                <div class="col-lg-4 col-md-6 col-sm-6 products-col-item">
                    <div class="single-productsBox">
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
                            <span class="category"><?php echo $row['category_name']; ?></span>
                            <h3><a href="?page=produk&id=<?php echo $row['product_id']; ?>"><?php echo $row['product_name']; ?>
                                    product</a></h3>
                            <div class="star-rating">
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                            </div>
                            <div class="price">
                                <span class="new-price">Rp
                                    <?php echo number_format($row['product_price'], 0, ',', '.'); ?></span>
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