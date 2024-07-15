<div class="table-responsive">
    <table class="table table-hover" id="table">
        <thead>
            <tr>
                <th class="wd-30">
                    No
                </th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
                <th class="text-end">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once '../../config.php';


            $sql = mysqli_query($conn, "SELECT * FROM v_return");
            $no = 0;

            while ($row = mysqli_fetch_array($sql)) {
                $no++;
                ?>
                <tr class="single-item">
                    <td>
                        <span class="fs-12 text-muted">#<?php echo $no ?></span>
                    </td>
                    <td>
                        <?php echo $row['product_code'] ?>
                    </td>
                    <td>
                        <?php echo $row['product_name'] ?>
                    </td>
                    <td>
                        <?php echo $row['desc'] ?>
                    </td>
                    <td>
                        <?php echo $row['qty'] ?>
                    </td>
                    <td class="text-end">
                        <div class="hstack gap-2 justify-content-end">
                            <a href="javascript:void(0);" class="avatar-text avatar-md edit"
                                data-id="<?php echo $row['return_id'] ?>" data-bs-toggle="tooltip" title="Edit"
                                data-bs-original-title="Edit">
                                <i class="feather-edit-3"></i>
                            </a>
                            <button href="javascript:void(0);" class="avatar-text avatar-md hapus" data-bs-toggle="tooltip"
                                title="Hapus" data-id="<?php echo $row['return_id'] ?>" data-bs-original-title="Hapus">
                                <i class="feather-trash-2"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            <?php } ?>

        </tbody>
    </table>
</div>
<script>
    $(document).ready(function () {
        $("#table").DataTable(
            { pageLength: 10, lengthMenu: [10, 20, 50, 100, 200, 500], order: [] })
    })
    $('#table').on('click', '.hapus', function () {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data yang dihapus tidak dapat kembali",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                // Perform the AJAX request
                console.log(id);
                $.ajax({
                    url: 'process.php?act=hapus-return',
                    type: 'POST',
                    data: { id: id }, // Replace with actual data
                    success: function (response) {
                        Swal.fire(
                            'Terhapus!',
                            'Data sudah dihapus',
                            'success'
                        );
                        loadContent();
                    },
                    error: function (xhr, status, error) {
                        Swal.fire(
                            'Error!',
                            'Terjada kesalahan. Coba lagi',
                            'error'
                        );
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('Tidak Tersimpan', '', 'info'),
                    location.reload();

            }
        });
    });
    $('#table').on('click', '.edit', function () {
        var id = $(this).data("id");
        $.ajax({
            url: 'pages/pesanan/edit-return.php',
            method: 'post',
            data: { id: id },
            success: function (data) {
                $('#tampil_data').html(data);
                document.getElementById("judul").innerHTML = 'Edit Data Return';
            }
        });
        $('#modal').modal('show');
    });
</script>