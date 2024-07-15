<?php
require_once '../../../config.php';
$sql_accounts = "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_NAME = 'lp_accounts' AND COLUMN_NAME = 'account_type'";
$result = $conn->query($sql_accounts);
$row = $result->fetch_array();
$enumList = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE']) - 6))));

$sqlget = "SELECT * FROM lp_accounts WHERE account_id = " . $_POST['id'];
$resulta = $conn->query($sqlget);
$rowa = $resulta->fetch_array();



?>
<div class="row">
    <form class="" id="form" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id" value="<?php echo $rowa['account_id']; ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Nama Akun</label>
                    <input type="text" class="form-control" name="account_name" id="account_name"
                        value="<?php echo $rowa['account_name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Tipe Akun</label>
                    <select id="account_type" name="account_type" required class="form-select"
                        data-select2-selector="default">
                        <?php foreach ($enumList as $enum): ?>
                            <option value="<?php echo $enum; ?>" <?php echo ($rowa['account_type'] == $enum) ? 'selected' : ''; ?>><?php echo $enum; ?></option>
                        <?php endforeach; ?>
                    </select>
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
            url: "process.php?act=edit-akun",
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