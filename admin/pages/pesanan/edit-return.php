<?php
require_once '../../config.php';

$id = $_POST['id'];
$sql = "SELECT * FROM v_return WHERE return_id = '$id'";
$query = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($query);
?>


<div class="row">
    <form class="" id="form" enctype="multipart/form-data">
        <input type="hidden" name="return_id" id="id" value="<?= $data['return_id'] ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Produk</label>
                    <select class="form-select" name="product_id" id="product_id">
                        <?php
                        $sql = "SELECT * FROM lp_products";
                        $query = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo '<option value="' . $row['product_id'] . '"' . ($row['product_id'] == $data['product_id'] ? 'selected' : '') . ' >' . $row['product_name'] . '</option>';
                        }

                        ?>

                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Banyak</label>
                    <input value="<?= $data['qty'] ?>" type="number" class="form-control" id="qty" name="qty"
                        placeholder="QTY" required="">
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="" class="form-label">Keterangan</label>
                    <textarea rows="5" name="desc" id="note" class="form-control"><?= $data['desc'] ?></textarea>

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
            url: "process.php?act=update-return",
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