<?php
require_once '../../config.php';
?>
<div class="row">
    <form class="" id="form" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Nama Pengguna</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama pengguna">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Level</label>
                    <select class="form-select" name="level" id="level" data-select2-selector="default">
                        <option value="Admin">Admin</option>
                        <option value="Customer">Customer</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">

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
            url: "process.php?act=tambah-pengguna",
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