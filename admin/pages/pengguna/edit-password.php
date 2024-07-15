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
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="" class="form-label">Password Baru</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
            </div>
        </div>


        <div>
            <button class="btn btn-primary" type="submit" id="submit">Ganti Password</button>
        </div>
    </form>
</div>
<script>
    $("#form").submit(function (e) {
        e.preventDefault(); //prevent the form from submitting normally
        $.ajax({
            url: "process.php?act=edit-password",
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