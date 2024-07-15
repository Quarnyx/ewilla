<?php
require_once '../../config.php';
$id = $_POST['id'];
$sql = "SELECT * FROM lp_products WHERE product_id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
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
        <input type="hidden" name="product_id" id="product_id" value="<?= $row['product_id'] ?>">
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
                        $sqla = "SELECT * FROM lp_category";

                        $hasil = mysqli_query($conn, $sqla);
                        while ($data = mysqli_fetch_array($hasil)):
                            ?>
                            <option value="<?php echo $data['category_id']; ?>" <?php echo ($row['category_id'] == $data['category_id']) ? 'selected' : ''; ?>>
                                <?php echo $data['category_name']; ?>
                            </option>
                            <?php
                        endwhile;
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Harga</label>
                    <input type="text" class="form-control" id="product_price" name="product_price"
                        placeholder="Harga produk" required="" value="<?= $row['product_price'] ?>">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Kategori Produk</label>
                    <select class="form-select select2" name="category" id="category">
                        <option value="material" <?php echo ($row['category'] == 'material') ? 'selected' : ''; ?>>
                            Material</option>
                        <option value="product" <?php echo ($row['category'] == 'product') ? 'selected' : ''; ?>> Produk
                            Jadi</option>

                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Satuan</label>
                    <select class="form-select select2" name="unit" id="unit">
                        <option value="m" <?php echo ($row['unit'] == 'm') ? 'selected' : ''; ?>> Meter</option>
                        <option value="lusin" <?php echo ($row['unit'] == 'lusin') ? 'selected' : ''; ?>> Lusin</option>
                        <option value="pcs" <?php echo ($row['unit'] == 'pcs') ? 'selected' : ''; ?>> PCS</option>
                        <option value="roll" <?php echo ($row['unit'] == 'roll') ? 'selected' : ''; ?>> Roll</option>
                        <option value="pax" <?php echo ($row['unit'] == 'pax') ? 'selected' : ''; ?>> Pax</option>
                    </select>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="" class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="description" id="description"
                        rows="5"><?= $row['description'] ?></textarea>
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
            url: "process.php?act=update-produk",
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