<?php
require_once '../../config.php';
$id = $_POST['id'];
$sql = "SELECT * FROM lp_products WHERE product_id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>
<div class="row">
    <form class="" id="form" enctype="multipart/form-data">
        <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Kode Produk</label>
                    <input type="text" class="form-control" name="product_code" id="product_code"
                        value="<?= $row['product_code'] ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="product_name" name="product_name"
                        placeholder="Nama produk" required="" value="<?= $row['product_name'] ?>">
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="product_price" name="product_price"
                        placeholder="Harga produk" required="" value="<?= $row['product_price'] ?>">

                </div>
            </div>
        </div>
        <div>
            <button class="btn btn-primary" type="submit" id="submit">Simpan</button>
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
            url: "process.php?act=update-persediaan",
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