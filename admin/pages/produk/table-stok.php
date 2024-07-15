<div class="table-responsive">
    <table class="table table-hover" id="table">
        <thead>
            <tr>
                <th class="wd-30">
                    No
                </th>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Tanggal</th>
                <th>Jenis</th>
                <th>Quantity</th>
                <th class="text-end">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once '../../config.php';


            $sql = mysqli_query($conn, "SELECT * FROM v_inven_trans");
            $no = 0;

            while ($row = mysqli_fetch_array($sql)) {
                $no++;
                ?>
                <tr class="single-item">
                    <td>
                        <span class="fs-12 text-muted">#<?php echo $no ?></span>
                    </td>
                    <td><?php echo $row['product_code'] ?></td>
                    <td>
                        <a href="javascript:void(0)" class="hstack gap-3">
                            <div>
                                <span class="text-truncate-1-line"><?php echo $row['product_name'] ?></span>

                            </div>
                        </a>
                    </td>
                    <td class="fw-bold text-dark">
                        <?php echo 'Rp ' . number_format($row['product_price'], 0, ',', '.') ?>
                    </td>
                    <td>
                        <?php echo $row['created_at'] ?>
                    </td>
                    <td>
                        <?php echo $row['transaction_type'] ?>
                    </td>
                    <td>
                        <?php echo $row['quantity'] ?>
                    </td>
                    <td>
                        <div class="hstack gap-2 justify-content-end">
                            <button href="javascript:void(0);" class="avatar-text avatar-md hapus" data-bs-toggle="tooltip"
                                title="Hapus" data-trans="<?php echo $row['transaction_id'] ?>"
                                data-id="<?php echo $row['inventory_transactions_id'] ?>" data-bs-original-title="Hapus">
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
        var trans = $(this).data('trans');
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
                    url: 'process.php?act=hapus-stok',
                    type: 'POST',
                    data: {
                        trans: trans, id: id
                    },
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
</script>