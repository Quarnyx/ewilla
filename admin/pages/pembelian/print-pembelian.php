<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print</title>
    <!-- take online bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <h1 class="text-center mb-4">DATA PEMBELIAN</h1>
    <?php
    //get month from url
    $daribulan = $_GET['dari-tanggal'];
    $sampaibulan = $_GET['sampai-tanggal'];
    $date = DateTime::createFromFormat('Y-m-d', $sampaibulan);
    $year = $date->format('Y');
    function tanggal($tanggal)
    {
        $bulan = array(
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $split = explode('-', $tanggal);
        return $bulan[(int) $split[1]];
    }
    ?>
    <p class="text-center h5 mb-4">Periode: <?php echo tanggal($daribulan) ?> -
        <?php echo tanggal($sampaibulan) ?> <?php echo $year ?>
    </p>
    <?php
    require_once "../../config.php";
    $dari_tanggal = $_GET['dari-tanggal'];
    $sampai_tanggal = $_GET['sampai-tanggal'];
    $sql = mysqli_query($conn, "SELECT
        lp_inventory_transaction.inventory_transactions_id,
        lp_inventory_transaction.product_id,
        lp_inventory_transaction.product_price,
        lp_inventory_transaction.quantity,
        lp_inventory_transaction.created_at,
        lp_inventory_transaction.transaction_id,
        lp_products.product_name,
        lp_products.product_code,
        lp_products.category,
        lp_products.unit
        FROM
        lp_inventory_transaction
        INNER JOIN lp_products ON lp_inventory_transaction.product_id = lp_products.product_id
        WHERE lp_inventory_transaction.created_at BETWEEN '$dari_tanggal' AND '$sampai_tanggal' AND category = 'material' ORDER BY lp_inventory_transaction.created_at ASC");

    ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="text-align: center;">Nama Barang</th>
                <th style="text-align: center;">Jumlah Barang</th>
                <th style="text-align: center;">Harga Jual(pcs)</th>
                <th style="text-align: center;">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 0;
            while ($row = mysqli_fetch_array($sql)) {
                $no++;
                ?>
                <tr class="single-item">
                    <td style="text-align: center;">
                        <?php echo $row['product_name'] ?>
                    </td>
                    <td style="text-align: center;">
                        <?php echo $row['quantity'] ?>     <?php echo $row['unit'] ?>
                    </td>
                    <td class="fw-bold text-dark" style="text-align: center;">
                        <?php echo 'Rp ' . number_format($row['product_price'], 0, ',', '.') ?>/<?php echo $row['unit'] ?>
                    </td>
                    <td style="text-align: center;">
                        <?php echo 'Rp ' . number_format($row['product_price'] * $row['quantity'], 0, ',', '.') ?>
                    </td>
                </tr>

            <?php } ?>
            <?php
            $sqltotal = mysqli_query($conn, "SELECT
                                        SUM(
                                            lp_inventory_transaction.product_price * lp_inventory_transaction.quantity
                                        ) AS total
                                    FROM
                                    lp_inventory_transaction
                                    INNER JOIN lp_products ON lp_inventory_transaction.product_id = lp_products.product_id
                                    WHERE
                                    lp_inventory_transaction.created_at BETWEEN '$dari_tanggal' AND '$sampai_tanggal' AND
                                    lp_products.category = 'material'
                                    ORDER BY
                                        lp_inventory_transaction.created_at ASC");

            $total = mysqli_fetch_array($sqltotal);

            ?>
            <tr>
                <td colspan="3" style="text-align: center;">TOTAL</td>
                <td class="fw-bold text-dark" style="text-align: center;">
                    <?php echo 'Rp ' . number_format($total['total']) ?>
                </td>
            </tr>
        </tbody>

    </table>
    <?php
    session_start();
    function tanggala($tanggal)
    {
        $bulan = array(
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $split = explode('-', $tanggal);
        return $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];
    }
    ?>
    <div class="mt-3" style="text-align:end;">
        <hr>
        <p class="font-weight-bold">Demak, <?= tanggala(date('Y-m-d')) ?><br></p>
        <div class="mt-5">
            <p class="font-weight-bold">(<?php echo $_SESSION['user_name'] ?>)</p>
        </div>
    </div>
</body>
<script>
    window.print();
    window.onafterprint = window.close;
</script>

</html>