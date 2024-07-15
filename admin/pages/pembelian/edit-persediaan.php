<?php
require_once '../../config.php';
$id = $_POST['id'];
$sql = "SELECT * FROM lp_inventory_transaction WHERE inventory_transactions_id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>
<div class="row">
    <form class="" id="form" enctype="multipart/form-data">
        <input type="hidden" name="inventory_transactions_id" value="<?= $row['inventory_transactions_id'] ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Tanggal Transaksi</label>
                    <input type="date" class="form-control" name="created_at" id="created_at"
                        value="<?= $row['created_at'] ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Nama Produk</label>
                    <select class="form-select" name="product_id" id="product_id" data-select2-selector="default">
                        <?php
                        $sql = "SELECT * FROM lp_inventory WHERE category ='product'";

                        $hasil = mysqli_query($conn, $sql);
                        while ($data = mysqli_fetch_array($hasil)):
                            ?>
                            <option value="<?php echo $data['product_id']; ?>" <?php echo ($row['product_id'] == $data['product_id']) ? 'selected' : ''; ?>>
                                <?php echo $data['product_name']; ?>
                            </option>
                            <?php
                        endwhile;
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
                        required="" value="<?= $row['quantity'] ?>">

                </div>
            </div>
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