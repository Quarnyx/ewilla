<?php
require_once '../../config.php';
?>


<div class="row">
    <form class="" id="form" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Kode Produk</label>
                    <input type="text" class="form-control" name="product_code" id="product_code">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="product_name" name="product_name"
                        placeholder="Nama produk" required="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Nama Customer</label>
                    <input type="text" class="form-control" id="customer_name" name="customer_name"
                        placeholder="Nama customer" required="">

                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Harga</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Harga produk"
                        required="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Banyaknya</label>
                    <input type="text" class="form-control" id="qty" name="qty" placeholder="Banyaknya" required="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Tanggal Order</label>
                    <input type="date" class="form-control" id="order_date" name="order_date">
                </div>
            </div>


        </div>

        <div>
            <button class="btn btn-primary" type="submit" id="submit">Tambah</button>
        </div>
    </form>
</div>
<script>
    $("#form").submit(function (e) {
        e.preventDefault(); //prevent the form from submitting normally
        $.ajax({
            url: "process.php?act=tambah-custom",
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