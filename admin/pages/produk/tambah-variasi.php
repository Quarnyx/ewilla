<?php
require_once '../../config.php';
?>
<div class="row">
    <form class="" id="form" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id" value="<?php echo $_POST['id']; ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Warna</label>
                    <input type="text" class="form-control" name="color" id="color">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Ukuran</label>
                    <input type="text" class="form-control" id="size" name="size" placeholder="Ukuran" required="">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="card border border-primary">
                <div class="card-header bg-transparent border-primary">
                    <h5 class="my-0 text-primary text-center"><i class="mdi mdi-bullseye-arrow me-3"></i>Foto
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-5">

                        <img id="preview" src="" alt="Foto Produk" class="card-img-top img-fluid" width="100">

                    </div>
                    <h5 class="card-title">Pilih Foto</h5>
                    <div class="input-group">
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>
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
            url: "process.php?act=tambah-variasi",
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
    $("#foto").change(function (e) {
        var fileName = e.target.files[0].name;
        $("#foto").val();

        var reader = new FileReader();
        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            document.getElementById("preview").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });
</script>