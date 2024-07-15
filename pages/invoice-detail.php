<?php
$invoice_id = $_GET['id'];
$getcart = $conn->query("SELECT * FROM `v_order_detail` WHERE `invoice_id` = '$invoice_id'");
$data = mysqli_fetch_array($getcart);
?>
<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>Detail Invoice <?php echo $data['invoice_number']; ?></h2>
        </div>
    </div>
</div>
<!-- End Page Title -->
<section class="checkout-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
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
                            $user_id = $_SESSION['user_id'];
                            $getcart = $conn->query("SELECT * FROM `v_order_detail` WHERE `invoice_id` = '$invoice_id'");
                            if ($getcart->num_rows > 0) {
                                $total = 0;
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
                                            <?php echo $row['quantity']; ?>
                                        </td>

                                        <td class="product-subtotal">
                                            <span class="subtotal-amount">Rp
                                                <?php echo number_format($row['quantity'] * $row['product_price'], 0, ',', '.'); ?></span>

                                        </td>
                                    </tr>
                                    <?php

                                    $total += $row['quantity'] * $row['product_price'];
                                }
                            } ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php
        $getcourier = $conn->query("SELECT * FROM `v_courier` WHERE `invoice_id` = '$invoice_id'");
        $row = mysqli_fetch_array($getcourier);
        ?>
        <div class="row">
            <div class="ptb-100 col-lg-4 col-md-12">
                <div class="billing-details">

                    <h3 class="title">
                        Status Pesanan : <?= $row['status'] ?>
                    </h3>

                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Kurir <span class="required">*</span></label>
                                <input type="text" class="form-control" value="<?= $row['courier'] ?>" readonly>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Layanan<span class="required">*</span></label>
                                <input type="text" class="form-control" value="<?= $row['service'] ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6">
                            <div class="form-group">
                                <label>Biaya Pengiriman <span class="required">*</span></label>
                                <input type="text" class="form-control"
                                    value="Rp <?= number_format($row['cost'], 0, ',', '.') ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6">
                            <div class="form-group">
                                <label>Nomor Resi <span class="required">*</span></label>
                                <input type="text" class="form-control" value="<?= $row['receipt_number'] ?>" readonly>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="ptb-100 col-lg-4 col-md-12">
                <div class="billing-details">

                    <h3 class="title">
                        Metode Pembayaran
                    </h3>

                    <div class="customer-service-content">
                        <h3><i class='bx bx-credit-card-front'></i> BNI : 1598286525</h3>
                        <h3><i class='bx bx-credit-card-front'></i> BRI : 590301043139538</h3>
                        <h3><i class='bx bx-credit-card-front'></i> DANA : 0895630608438</h3>
                        <p>Ewilla menerima pembayaran melalu transfer ke rekening diatas, jika sudah melakukan
                            pembayaran
                            silahkan konfirmasi melalui Whatsapp atau melalui halaman ini
                        </p>
                        <div class="col-lg-6 col-sm-6 col-md-6">
                            <a href="?page=konfirmasi-pembayaran&id=<?= $invoice_id ?>" class="default-btn">konfirmasi
                                Pembayaran</a>
                        </div>


                    </div>
                </div>
            </div>
            <div class="ptb-100 col-lg-4 col-md-12">
                <div class="cart-totals">
                    <h3>Total</h3>

                    <ul>
                        <li>Subtotal <span>Rp <?php echo number_format($total, 0, ',', '.'); ?></span></li>
                        <li>Pengiriman <span>Rp <?= number_format($row['cost'], 0, ',', '.') ?></span></li>

                        <li>Total <span>Rp <?php $total = floatval($total);
                        $cost = floatval($row['cost']);

                        $total_with_cost = $total + $cost;

                        echo number_format($total_with_cost, 0, ',', '.'); ?></span></li>
                    </ul>
                </div>
            </div>

        </div>

</section>
<!-- End Checkout Area -->