<?php
require_once '../../config.php';



?>
<div class="row">
    <form class="" id="form" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Tanggal Transaksi</label>
                    <input type="date" class="form-control" name="created_at" id="created_at">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" name="product_name" id="product_name">
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Kode Produk</label>
                    <input type="text" class="form-control" name="product_code" id="product_code">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Harga</label>
                    <input type="text" class="form-control" name="product_price" id="product_price">
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Satuan</label>
                    <select class="form-select select2" name="unit" id="unit">
                        <option value="m"> Meter</option>
                        <option value="lusin"> Lusin</option>
                        <option value="pcs"> PCS</option>
                        <option value="roll"> Roll</option>
                        <option value="pax"> Pax</option>
                    </select>
                </div>
            </div>

        </div>
        <div>
            <button class="btn btn-primary" type="submit" id="submit">Tambah</button>
        </div>
    </form>
</div>
<script>
    $("[data-select2-selector='default']").select2({
        theme: "bootstrap-5",
        dropdownParent: $('#modal .modal-content')
    })

    $("#form").submit(function (e) {
        e.preventDefault(); //prevent the form from submitting normally
        $.ajax({
            url: "process.php?act=tambah-material",
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
    $("#product_id").change(function () {
        var price = $(this).find(':selected').data('price');
        $('#product_price').val(price);
    });
</script>