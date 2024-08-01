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
    <h1 class="text-center mb-4">DATA PERSEDIAAN</h1>
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
                                    p.product_name,
                                    p.product_code,
                                    p.category,
                                    it.product_price,
                                    SUM(CASE WHEN it.transaction_type = 'In' THEN it.quantity ELSE 0 END) - 
                                    SUM(CASE WHEN it.transaction_type = 'Out' THEN it.quantity ELSE 0 END) AS stock_level
                                FROM lp_products p
                                LEFT JOIN lp_inventory_transaction it ON p.product_id = it.product_id
                                WHERE it.created_at BETWEEN '$dari_tanggal' AND '$sampai_tanggal' AND p.category = 'product'
                                GROUP BY p.product_id
                                HAVING stock_level > 0
                                 ORDER BY it.created_at ASC
                                ");


    ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="text-align: center;">Kode</th>
                <th style="text-align: center;">Nama Barang</th>
                <th style="text-align: center;">Stok</th>
                <th style="text-align: center;">Harga Jual(pcs)</th>
                <th style="text-align: center;">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 0;
            $total_stock_level = 0;
            while ($row = mysqli_fetch_array($sql)) {
                $no++;
                ?>
                <tr class="single-item">
                    <td style="text-align: center;">
                        <?php echo $row['product_code'] ?>
                    </td>
                    <td style="text-align: center;">
                        <?php echo $row['product_name'] ?>
                    </td>
                    <td style="text-align: center;">
                        <?php echo $row['stock_level'] ?>
                    </td>
                    <td class="fw-bold text-dark" style="text-align: center;">
                        <?php echo 'Rp ' . number_format($row['product_price'], 0, ',', '.') ?>
                    </td>
                    <td style="text-align: center;">
                        <?php echo 'Rp ' . $totalstock = number_format($row['product_price'] * $row['stock_level'], 0, ',', '.') ?>
                    </td>
                </tr>

                <?php $total_stock_level += $row['product_price'] * $row['stock_level'];
            } ?>
            <tr>
                <td colspan="4" style="text-align: center;">TOTAL</td>
                <td class="fw-bold text-dark" style="text-align: center;">
                    <?php echo 'Rp ' . number_format($total_stock_level, 0, ',', '.') ?>
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