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
                    <select class="form-select" name="product_id" id="product_id" data-select2-selector="default">
                        <?php
                        $sql = "SELECT * FROM lp_products WHERE category ='material';
                                ";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['product_id'] . '">' . $row['product_name'] . '</option>';
                        }
                        ?>

                    </select>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Banyak Produk</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Jumlah produk"
                        required="">

                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="product_price" name="product_price"
                        placeholder="Harga produk" required="">
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
            url: "process.php?act=tambah-pembelian",
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