<?php
require_once 'config.php';
$invoice_id = $_GET['id'];
$getcart = $conn->query("SELECT * FROM `v_order_detail` WHERE `invoice_id` = '$invoice_id'");
$data = mysqli_fetch_array($getcart);
?>
<div class="nxl-content">
    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Detail Pesanan <?php echo $data['invoice_number']; ?></h5>
            </div>
        </div>
        <div class="page-header-right ms-auto">
            <div class="page-header-right-items">
                <div class="d-flex d-md-none">
                    <a href="javascript:void(0)" class="page-header-right-close-toggle">
                        <i class="feather-arrow-left me-2"></i>
                        <span>Back</span>
                    </a>
                </div>
            </div>
            <div class="d-md-none d-flex align-items-center">
                <a href="javascript:void(0)" class="page-header-right-open-toggle">
                    <i class="feather-align-right fs-20"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- [ page-header ] end -->
    <!-- [ Main Content ] start -->
    <div class="main-content">

        <div class="row">
            <div class="col-lg-12">
                <div class="card stretch stretch-full">
                    <div class="table-responsive">
                        <table class="table table-hover" id="table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Banyak</th>
                                    <th>Total</th>
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
                                            <td>
                                                <a href="#">
                                                    <img class="img-fluid" width="50"
                                                        src="../assets/img/products/<?php echo $row['image_url'] ?>">
                                                </a>
                                            </td>

                                            <td>
                                                <a
                                                    href="?page=produk&id=<?php echo $row['product_id']; ?>"><?php echo $row['product_name']; ?></a>
                                                <ul>
                                                    <li>Warna: <span><?= $row['color']; ?></span></li>
                                                    <li>Ukuran: <span><?= $row['size']; ?></span></li>
                                                </ul>
                                            </td>

                                            <td>
                                                <span class="unit-amount">Rp
                                                    <?php echo number_format($row['product_price'], 0, ',', '.'); ?></span>
                                            </td>

                                            <td>
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
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ubah Status</h5>
                        <div class="col-lg-12 col-md-6">
                            <div class="form-group">
                                <label>Status <span class="required">*</span></label>
                                <select class="form-control" name="status" id="status">
                                    <option value="Pending">Pending</option>
                                    <option value="Proses">Proses</option>
                                    <option value="Dikirim">Dikirim</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3" onclick="update_status()">Simpan</button>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Input Resi</h5>
                        <div class="col-lg-12 col-md-6">
                            <div class="form-group">
                                <label>Input Resi <span class="required">*</span></label>
                                <input type="text" class="form-control" name="resi" id="resi">
                            </div>
                            <button type="submit" class="btn btn-primary mt-3" onclick="input_resi()">Simpan</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php
        $getcourier = $conn->query("SELECT * FROM `v_courier` WHERE `invoice_id` = '$invoice_id'");
        $row = mysqli_fetch_array($getcourier);
        ?>
        <div class="row">
            <div class="col-lg-6">
                <div class="card stretch stretch-full">

                    <div class="card-body">
                        <h5 class="card-title">Detail Pengiriman</h5>
                        <h5>
                            Status Pesanan : <?= $row['status'] ?>
                        </h5>

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
                                    <input type="text" class="form-control" value="<?= $row['receipt_number'] ?>"
                                        readonly>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card stretch stretch-full">

                    <div class="card-body">
                        <h5 class="card-title">Detail Tagihan</h5>
                        <div class="col-lg-12 col-md-6">
                            <div class="form-group">
                                <label>Subtotal<span class="required">*</span></label>
                                <input type="text" class="form-control"
                                    value="Rp <?php echo number_format($total, 0, ',', '.'); ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6">
                            <div class="form-group">
                                <label>Pengiriman<span class="required">*</span></label>
                                <input type="text" class="form-control"
                                    value="Rp <?= number_format($row['cost'], 0, ',', '.') ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6">
                            <div class="form-group">
                                <label>Total<span class="required">*</span></label>
                                <input type="text" class="form-control" value="Rp <?php $total = floatval($total);
                                $cost = floatval($row['cost']);

                                $total_with_cost = $total + $cost;

                                echo number_format($total_with_cost, 0, ',', '.'); ?>" readonly>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- [ Main Content ] end -->
</div>
<!-- Modal -->
<script>

    function update_status() {
        var status = $('#status').val();
        var invoice_id = '<?= $invoice_id ?>';
        $.ajax({
            type: "POST",
            url: "process.php?act=update-status",
            data: {
                status: status,
                invoice_id: invoice_id
            },
            success: function (data) {
                location.reload();
            }
        });
    }

    function input_resi() {
        var resi = $('#resi').val();
        var invoice_id = '<?= $invoice_id ?>';
        $.ajax({
            type: "POST",
            url: "process.php?act=input-resi",
            data: {
                resi: resi,
                invoice_id: invoice_id
            },
            success: function (data) {
                location.reload();
            }
        });
    }
</script>