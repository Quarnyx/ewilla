<div class="modal right fade shoppingCartModal" id="shoppingCartModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class='bx bx-x'></i></span>
            </button>

            <div class="modal-body">
                <h3>Keranjang Saya</h3>

                <div class="products-cart-content">
                    <?php
                    $user_id = $_GET['id'];
                    include "../config.php";
                    $getcart = $conn->query("SELECT * FROM `v_cart` WHERE `user_id` = '$user_id'");
                    if ($getcart->num_rows > 0) {
                        while ($row = $getcart->fetch_assoc()) {
                            ?>
                            <div class="products-cart">
                                <div class="products-image">
                                    <a href="#"><img src="assets/img/products/<?= $row['image_url'] ?>" alt="image"></a>
                                </div>

                                <div class="products-content">
                                    <h3><a href="#"><?= $row['product_name'] ?></a></h3>
                                    <span><?= $row['size'] ?> | <?= $row['color'] ?></span>
                                    <div class="products-price">
                                        <span><?= $row['qty'] ?></span>
                                        <span>x</span>
                                        <span class="price"><?= $row['product_price'] ?></span>
                                    </div>
                                    <button data-id="<?= $row['cart_id'] ?>" id="remove_cart" class="remove-btn"><i
                                            class='bx bx-trash'></i></button>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="products-cart-btn">
                    <a href="?page=checkout" class="default-btn">Bayar</a>
                    <a href="?page=cart" class="optional-btn">Lihat Keranjang</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#remove_cart').click(function () {
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