<div class="table-responsive">
    <table class="table table-hover" id="table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Deskripsi</th>
                <th>AKun</th>
                <th>Debit</th>
                <th>Kredit</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once '../../../config.php';

            $sql = mysqli_query($conn, "SELECT * FROM v_journal ORDER BY transaction_date DESC");
            while ($row = mysqli_fetch_array($sql)) {

                ?>
                <tr class="single-item">
                    <td>
                        <a href="javascript:void(0)"><?php echo $row['transaction_date'] ?></a>
                    </td>
                    <td>
                        <?php echo $row['description'] ?>
                    </td>
                    <td class="fw-bold text-dark">
                        <a href="javascript:void(0)" class="hstack gap-3">
                            <div>
                                <span class="text-truncate-1-line"><?php echo $row['account'] ?></span>
                            </div>
                        </a>
                    </td>
                    <td><?php echo 'Rp ' . number_format($row['debit'], 0, ',', '.') ?>
                    </td>
                    <td><?php echo 'Rp ' . number_format($row['credit'], 0, ',', '.') ?>
                    </td>
                    <td>
                        <div class="hstack gap-2">
                            <button href="javascript:void(0);" class="avatar-text avatar-md hapus" data-bs-toggle="tooltip"
                                title="Hapus" data-id="<?php echo $row['transaction_id'] ?>" data-bs-original-title="Hapus">
                                <i class="feather-trash-2"></i>
                            </button>
                        </div>
                    </td>

                </tr>
            <?php } ?>

        </tbody>
    </table>
</div>
<div class="row mt-5">
    <div class="=col-xxxl-3 col-md-6">
        <div class="card stretch stretch-full">
            <div class="card-body">
                <div class="hstack justify-content-between">
                    <div>
                        <?php
                        require_once '../../../config.php';
                        $sql = mysqli_query($conn, "SELECT sum(debit) AS debit FROM v_journal");
                        $debit = mysqli_fetch_array($sql);
                        ?>
                        <h4 class="text-success">
                            <?php echo 'Rp ' . number_format($debit['debit'], 0, ',', '.') ?>
                        </h4>
                        <div class="text-muted">Total Debit</div>
                    </div>
                    <div class="text-end">
                        <i class="feather-dollar-sign fs-2"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-success py-3">
                <div class="hstack justify-content-between">
                    <p class="text-white mb-0">Debit</p>
                    <div class="text-end">
                        <i class="feather-dollar-sign text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="=col-xxxl-3 col-md-6">
        <div class="card stretch stretch-full">
            <div class="card-body">
                <div class="hstack justify-content-between">
                    <div><?php
                    require_once '../../../config.php';
                    $sql = mysqli_query($conn, "SELECT sum(credit) AS credit FROM v_journal");
                    $credit = mysqli_fetch_array($sql);
                    ?>
                        <h4 class="text-warning">
                            <?php echo 'Rp ' . number_format($credit['credit'], 0, ',', '.') ?>
                        </h4>
                        <div class="text-muted">Total Kredit</div>
                    </div>
                    <div class="text-end">
                        <i class="feather-dollar-sign fs-2"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-warning py-3">
                <div class="hstack justify-content-between">
                    <p class="text-white mb-0">Kredit</p>
                    <div class="text-end">
                        <i class="feather-dollar-sign text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                    url: 'process.php?act=hapus-transaksi',
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
            url: 'pages/pembelian/edit-persediaan.php',
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