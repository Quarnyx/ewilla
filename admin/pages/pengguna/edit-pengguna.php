<?php
require_once '../../config.php';

$id = $_POST['id'];
$sql = "SELECT * FROM `lp_users` WHERE `user_id` = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>
<div class="row">
    <form class="" id="form" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id" value="<?= $row['user_id'] ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Nama Pengguna</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama pengguna"
                        value="<?= $row['name'] ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                        value="<?= $row['email'] ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Level</label>
                    <select class="form-select" name="level" id="level" data-select2-selector="default">
                        <option value="Admin" <?= $row['level'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="Customer" <?= $row['level'] == 'Customer' ? 'selected' : '' ?>>Customer</option>
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
    $("#form").submit(function (e) {
        e.preventDefault(); //prevent the form from submitting normally
        $.ajax({
            url: "process.php?act=edit-pengguna",
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