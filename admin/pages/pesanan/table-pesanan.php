<div class="table-responsive">
    <table class="table table-hover" id="table">
        <thead>
            <tr>
                <th class="wd-30">
                    No
                </th>
                <th>Kode Invoice</th>
                <th>Nama Pelanggan</th>
                <th>Kode Pelanggan</th>
                <th>Tanggal Beli</th>
                <th>Status</th>
                <th class="text-end">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once '../../config.php';


            $sql = mysqli_query($conn, "SELECT * FROM v_invoicelist");
            $no = 0;

            while ($row = mysqli_fetch_array($sql)) {
                $no++;
                ?>
                <tr class="single-item">
                    <td>
                        <span class="fs-12 text-muted">#<?php echo $no ?></span>
                    </td>
                    <td><?php echo $row['invoice_number'] ?></td>
                    <td>
                        <a href="javascript:void(0)" class="hstack gap-3">
                            <div>
                                <span class="text-truncate-1-line"><?php echo $row['name'] ?></span>

                            </div>
                        </a>
                    </td>
                    <td><?php echo $row['account_number'] ?></td>
                    <td class="fw-bold text-dark">
                        <?php echo $row['timestamp'] ?>
                    </td>
                    <td><span class="badge bg-<?php if ($row['status'] == 'Pending') {
                        echo 'warning';
                    } elseif ($row['status'] == 'Proses') {
                        echo 'primary';
                    } elseif ($row['status'] == 'Selesai') {
                        echo 'success';
                    } elseif ($row['status'] == 'Dikirim') {
                        echo 'info';
                    } ?>"><?= $row['status'] ?></span></td>
                    <td>
                        <div class="hstack gap-2 justify-content-end">

                            <a href="?page=pesanan_detail&id=<?php echo $row['invoice_id'] ?>"
                                class="btn btn-primary rounded" data-id="<?php echo $row['invoice_id'] ?>"
                                data-bs-toggle="tooltip" title="Variasi" data-bs-original-title="Variasi">
                                <i class="feather-edit-3"></i> Detail
                            </a>
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
                    url: 'process.php?act=hapus-produk',
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
            url: 'pages/produk/edit-produk.php',
            method: 'post',
            data: { id: id },
            success: function (data) {
                $('#tampil_data').html(data);
                document.getElementById("judul").innerHTML = 'Edit Produk';
            }
        });
        $('#modal').modal('show');
    });
</script>