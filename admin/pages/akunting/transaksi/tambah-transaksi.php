<?php
require_once '../../../config.php';
$sql_accounts = "SELECT account_id, account_name FROM lp_accounts";
$result_accounts = $conn->query($sql_accounts);
$accounts = [];
while ($row = $result_accounts->fetch_assoc()) {
    $accounts[] = $row;
}


?>
<div class="row">
    <form class="" id="form" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Tanggal Transaksi</label>
                    <input type="date" class="form-control" name="transaction_date" id="transaction_date">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Deskripsi</label>
                    <input type="text" class="form-control" name="description" id="description">
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Akun Debit</label>
                    <select id="debit_account_id" name="debit_account_id" required class="form-select"
                        data-select2-selector="default">
                        <?php foreach ($accounts as $account): ?>
                            <option value="<?php echo $account['account_id']; ?>"><?php echo $account['account_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Akun Kredit</label>
                    <select id="credit_account_id" name="credit_account_id" required class="form-select"
                        data-select2-selector="default">
                        <?php foreach ($accounts as $account): ?>
                            <option value="<?php echo $account['account_id']; ?>"><?php echo $account['account_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Total</label>
                    <input type="number" class="form-control" name="amount" id="amount">

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
            url: "process.php?act=tambah-transaksi",
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