<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>Pembayaran</h2>
            <ul>
        </div>
    </div>
</div>
<!-- End Page Title -->
<?php
$getuser = "SELECT * FROM v_custaccount WHERE user_id = '" . $_SESSION['user_id'] . "'";
$result = mysqli_query($conn, $getuser);
$row = mysqli_fetch_assoc($result);

?>
<!-- Start Checkout Area -->
<section class="checkout-area ptb-100">
    <div class="container">
        <form action="process.php?act=checkout" method="POST">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="billing-details">
                        <h3 class="title">Detail Alamat</h3>

                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Nama <span class="required">*</span></label>
                                    <input type="text" class="form-control" value="<?= $row['name'] ?>" disabled>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Email<span class="required">*</span></label>
                                    <input type="text" class="form-control" value="<?= $row['email'] ?>" disabled>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6">
                                <div class="form-group">
                                    <label>Address <span class="required">*</span></label>
                                    <textarea class="form-control" name="address" id="address" cols="30" rows="5"
                                        disabled><?= $row['address'] ?></textarea>
                                </div>
                            </div>
                            <input type="hidden" value="<?= $row['user_id'] ?>" name="user_id">
                            <input type="hidden" value="<?= $row['customer_id'] ?>" name="customer_id">
                            <input type="hidden" value="<?= $row['province_id'] ?>" name="province_id">
                            <input type="hidden" value="<?= $row['city_id'] ?>" id="destination" name="city_id">
                            <input type="hidden" value="113" id="origin">

                            <div class="col-lg-12 col-md-6">
                                <div class="form-group">
                                    <label>Pilih Kurir <span class="required">*</span></label>
                                    <select id="courierDropdown" name="courierService">
                                        <option value="">Pilih Kurir</option>
                                    </select>
                                    <input type="hidden" name="cost" id="cost">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="order-details">
                        <h3 class="title">Pesanan Anda</h3>

                        <div class="order-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $user_id = $_SESSION['user_id'];
                                    $getcart = $conn->query("SELECT * FROM `v_cart` WHERE `user_id` = '$user_id'");
                                    if ($getcart->num_rows > 0) {
                                        while ($row = $getcart->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td class="product-name">
                                                    <a href="#"><?= $row['product_name'] ?></a>
                                                </td>

                                                <td class="product-total">
                                                    <span
                                                        class="subtotal-amount"><?php echo "Rp " . number_format($row['product_price'] * $row['qty'], 0, ',', '.'); ?></span>
                                                </td>
                                            </tr>
                                        <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="payment-box">
                            <div class="payment-method">
                                <p>
                                    <input type="radio" id="direct-bank-transfer" name="payment" value="bri">
                                    <label for="direct-bank-transfer">BRI</label>
                                    Nomor Rekening 590301043139538
                                </p>
                                <p>
                                    <input type="radio" id="payment" name="payment" value="bni">
                                    <label for="payment">BNI</label>
                                    Nomor Rekening 1598286525
                                </p>
                                <p>
                                    <input type="radio" id="cash-on-delivery" name="payment" value="dana">
                                    <label for="cash-on-delivery">Dana</label>
                                    Nomor Rekening 0895630608438
                                </p>
                            </div>

                            <button type="submit" class="default-btn">Buat Pesanan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- End Checkout Area -->
<script>
    $(document).ready(function () {
        $('select').niceSelect();

        var destination = $('#destination').val();
        var origin = $('#origin').val();
        var courier = 'jne';
        var weight = 1000;
        // Load provinces on page load
        if (origin && destination && weight && courier) {
            $.ajax({
                url: 'proxy.php', // URL to your PHP proxy script
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'cost',
                    origin: origin,
                    destination: destination,
                    weight: weight,
                    courier: courier
                },
                success: function (data) {
                    console.log("Courier cost data:", data); // Log the response data
                    if (data && data.rajaongkir && data.rajaongkir.results) {
                        var costs = data.rajaongkir.results[0].costs;
                        var courierDropdown = $('#courierDropdown');
                        courierDropdown.empty();
                        courierDropdown.append('<option value="">Pilih Kurir</option>');
                        $.each(costs, function (index, cost) {
                            console.log("Adding courier service:", cost.service); // Log each service
                            courierDropdown.append(
                                $('<option></option>')
                                    .val(cost.service)
                                    .text(cost.service + ' - Rp.' + cost.cost[0].value + ' | ' + cost.cost[0].etd + ' Hari')
                                    .attr('data-cost', cost.cost[0].value)
                            );
                        });
                        courierDropdown.niceSelect('update'); // Refresh NiceSelect
                    } else {
                        console.error('Failed to load courier data.');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error fetching courier data:', textStatus, errorThrown);
                }
            });
        } else {
            alert('Please fill in all the fields.');
        }

    });
    $('#courierDropdown').change(function () {
        var selectedCost = $(this).find(':selected').data('cost');
        $('#cost').val(selectedCost);
    });

</script>