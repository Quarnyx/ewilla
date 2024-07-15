<?php
require_once '../../config.php';
?>
<div class="row">
    <form class="" id="form" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Nama Produk</label>
                    <select class="form-select select2" name="product_id" id="product_id">
                        <?php
                        $sql = "SELECT * FROM lp_products";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['product_id'] . '">' . $row['product_name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="created_at" name="created_at" required="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Banyaknya</label>
                    <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Banyaknya produk"
                        required="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Harga</label>
                    <input type="text" class="form-control" id="product_price" name="product_price"
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
    $("#form").submit(function (e) {
        e.preventDefault(); //prevent the form from submitting normally
        $.ajax({
            url: "process.php?act=tambah-stok",
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