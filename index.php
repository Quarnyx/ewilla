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
    <!-- End Navbar Area -->
    <!-- Start Search Overlay -->
    <div class="search-overlay">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="search-overlay-layer"></div>
                <div class="search-overlay-layer"></div>
                <div class="search-overlay-layer"></div>

                <div class="search-overlay-close">
                    <span class="search-overlay-close-line"></span>
                    <span class="search-overlay-close-line"></span>
                </div>

                <div class="search-overlay-form">
                    <form action="?page=toko" method="get">
                        <input name="page" type="hidden" value="toko">
                        <input name="keyword" type="text" class="input-search" placeholder="Search here...">
                        <button type="submit"><i class='bx bx-search-alt'></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Search Overlay -->

    <!-- Start Content -->
    <?php
    include ('content.php');
    ?>
    <!-- End Content -->

    <!-- Start QuickView Modal Area -->
    <?php
    include ('layouts/quickview.php');
    ?>
    <!-- End QuickView Modal Area -->

    <!-- Start Shopping Cart Modal -->
    <div id="cart-sidebar">

    </div>
    <!-- End Shopping Cart Modal -->

    <!-- Start Wishlist Modal -->
    <?php
    include ('layouts/wishlist.php');
    ?>
    <!-- End Wishlist Modal -->

    <!-- Start Size Guide Modal Area -->
    <?php
    include ('layouts/size-guide.php');
    ?>
    <!-- End Size Guide Modal Area -->

    <!-- Start Shipping Modal Area -->
    <?php
    include ('layouts/shipping.php') ?>
    <!-- End Shipping Modal Area -->

    <!-- Start Products Filter Modal Area -->
    <?php
    include ('layouts/product-filter.php');
    ?>
    <!-- End Products Filter Modal Area -->

    <!-- Start Footer Area -->
    <?php
    include ('layouts/footer.php');
    ?>

    <!-- End Footer Area -->
    <a class="whats-app" href="https://wa.me/62895617589384" target="_blank">
        <i class='bx bxl-whatsapp my-float'></i>
    </a>
    <div class="go-top"><i class='bx bx-up-arrow-alt'></i></div>

    <!-- Links of JS files -->
    <?php
    include ('layouts/script.php'); ?>
</body>

</html>