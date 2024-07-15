<?php
require_once '../../config.php';
?>
<script src="https://cdn.tiny.cloud/1/cp09tuj1c1qcxwqilunpue1g7i1c0lgxur46my743r05ukmn/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>

<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
    tinymce.init({
        selector: 'textarea'
    });
</script>

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
                    <div class="error" id="produkError">

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Kategori Produk</label>
                    <select class="form-select select2" name="category_id" id="category_id">
                        <?php
                        $sql = "SELECT * FROM lp_category";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['category_id'] . '">' . $row['category_name'] . '</option>';
                        }
                        ?>
                    </select>
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
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="" class="form-label">Deskripsi</label>
                    <textarea name="description" id="description"></textarea>
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
            url: "process.php?act=tambahproduk",
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