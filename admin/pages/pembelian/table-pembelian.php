<div class="table-responsive">
    <table class="table table-hover" id="table">
        <thead>
            <tr>
                <th class="wd-30">
                    No
                </th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah Barang</th>
                <th>Total</th>
                <th>Tanggal Transaksi</th>
                <th class="text-end">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once '../../config.php';

            $sql = mysqli_query($conn, "SELECT
                                            lp_inventory_transaction.inventory_transactions_id,
                                            lp_inventory_transaction.product_id,
                                            lp_inventory_transaction.product_price,
                                            lp_inventory_transaction.quantity,
                                            lp_inventory_transaction.created_at,
                                            lp_inventory_transaction.transaction_id,
                                            lp_products.product_name,
                                            lp_products.product_code
                                            FROM
                                            lp_inventory_transaction
                                            INNER JOIN lp_products ON lp_inventory_transaction.product_id = lp_products.product_id
                                            WHERE category = 'material'

                                            ");
            $no = 0;

            while ($row = mysqli_fetch_array($sql)) {
                $no++;
                ?>
                <tr class="single-item">
                    <td>
                        <span class="fs-12 text-muted">#<?php echo $no ?></span>
                    </td>
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
                    <td><?php echo $row['quantity'] ?></td>
                    <td><?php echo 'Rp ' . number_format($row['product_price'] * $row['quantity'], 0, ',', '.') ?>
                    </td>
                    <td>
                        <?php echo $row['created_at'] ?>
                    </td>
                    <td>
                        <div class="hstack gap-2 justify-content-end">
                            <button href="javascript:void(0);" class="avatar-text avatar-md hapus" data-bs-toggle="tooltip"
                                title="Hapus" data-id="<?php echo $row['inventory_transactions_id'] ?>"
                                data-bs-original-title="Hapus">
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
            {
                pageLength: 10,
                lengthMenu: [10, 20, 50, 100, 200, 500],
                order: []
            })
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
                    url: 'process.php?act=hapus-persediaan',
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
                            'There was a problem deleting your item.',
                            'error'
                        );
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info'),
                    location.reload();

            }
        });
    });
    $('#table').on('click', '.edit', function () {
        var id = $(this).data("id");
        $.ajax({
            url: 'pages/pembelian/edit-pembelian.php',
            method: 'post',
            data: { id: id },
            success: function (data) {
                $('#tampil_data').html(data);
                document.getElementById("judul").innerHTML = 'Edit Transaksi';
            }
        });
        $('#modal').modal('show');
    });
</script>