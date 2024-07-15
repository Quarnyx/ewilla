<?php
require_once '../../config.php';

$id = $_POST['id'];

$pesanan = $conn->query("SELECT * FROM lp_custom_order WHERE custom_product_id = $id")->fetch_assoc();

?>


<div class="row">
    <form class="" id="form" enctype="multipart/form-data">
        <input type="hidden" name="custom_product_id" id="id" value="<?= $id ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Kode Produk</label>
                    <input value="<?= $pesanan['product_code'] ?>" type="text" class="form-control" name="product_code"
                        id="product_code">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Nama Produk</label>
                    <input value="<?= $pesanan['product_name'] ?>" type="text" class="form-control" id="product_name"
                        name="product_name" placeholder="Nama produk" required="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Nama Customer</label>
                    <input value="<?= $pesanan['customer_name'] ?>" type="text" class="form-control" id="customer_name"
                        name="customer_name" placeholder="Nama customer" required="">

                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Harga</label>
                    <input value="<?= $pesanan['price'] ?>" type="text" class="form-control" id="price" name="price"
                        placeholder="Harga produk" required="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="" class="form-label">Banyaknya</label>
                    <input value="<?= $pesanan['qty'] ?>" type="text" class="form-control" id="qty" name="qty"
                        placeholder="Banyaknya" required="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="" class="form-label">Tanggal Order</label>
                    <input value="<?= $pesanan['order_date'] ?>" type="date" class="form-control" id="order_date"
                        name="order_date">
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="" class="form-label">Tanggal Pengembilan</label>
                    <input value="<?= $pesanan['delivery_date'] ?>" type="date" class="form-control" id="delivery_date"
                        name="delivery_date">
                </div>
            </div>


        </div>

        <div>
            <button class="btn btn-primary" type="submit" id="submit">Simpan</button>
        </div>
    </form>
</div>
<script>
    $("#form").submit(function (e) {
        e.preventDefault(); //prevent the form from submitting normally
        $.ajax({
            url: "process.php?act=update-custom",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                //display the response from the server
                $("#form")[0].reset();
                $('#modal').modal('hide');
                //reload page
                loadContent();

            }
        });
    });
</script>