<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>Keranjang</h2>
        </div>
    </div>
</div>
<!-- End Page Title -->
<?php
$user_id = $_SESSION['user_id'];
$getcart = $conn->query("SELECT * FROM `v_cart` WHERE `user_id` = '$user_id'");

?>
<!-- Start Cart Area -->
<section class="cart-area ptb-100">
    <div class="container">
        <form>
            <div class="cart-table table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Produk</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Banyak</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if ($getcart->num_rows > 0) {
                            while ($row = $getcart->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td class="product-thumbnail">
                                        <a href="#">
                                            <img src="assets/img/products/<?php echo $row['image_url']; ?>" alt="item">
                                        </a>
                                    </td>

                                    <td class="product-name">
                                        <a
                                            href="?page=produk&id=<?php echo $row['product_id']; ?>"><?php echo $row['product_name']; ?></a>
                                        <ul>
                                            <li>Warna: <span><?= $row['color']; ?></span></li>
                                            <li>Ukuran: <span><?= $row['size']; ?></span></li>
                                        </ul>
                                    </td>

                                    <td class="product-price">
                                        <span class="unit-amount">Rp
                                            <?php echo number_format($row['product_price'], 0, ',', '.'); ?></span>
                                    </td>

                                    <td class="product-quantity">
                                        <?php echo $row['qty']; ?>
                                    </td>

                                    <td class="product-subtotal">
                                        <span class="subtotal-amount">Rp
                                            <?php echo number_format($row['qty'] * $row['product_price'], 0, ',', '.'); ?></span>

                                        <a data-id="<?php echo $row['cart_id']; ?>" class="remove"><i
                                                class='bx bx-trash'></i></a>
                                    </td>
                                </tr>
                                <?php
                            }
                        } ?>


                    </tbody>
                </table>
            </div>

            <div class="cart-buttons">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-sm-7 col-md-7">
                        <a href="?page=toko" class="optional-btn">Continue Shopping</a>
                    </div>

                    <div class="col-lg-5 col-sm-5 col-md-5 text-end">
                        <a href="?page=checkout" class="default-btn">Bayar</a>
                    </div>
                </div>
            </div>


        </form>
    </div>
</section>
<!-- End Cart Area -->
<script>
    $(document).ready(function () {
        $('.remove').click(function () {
            $.ajax({
                url: 'process.php?act=remove_cart',
                type: 'POST',
                data: {
                    id: $(this).attr('data-id')
                },
                success: function (response) {
                    loadCart();
                    location.reload();
                },
                error: function (xhr, status, error) {
                    console.error(xhr);
                }
            });
        });


    })
</script>