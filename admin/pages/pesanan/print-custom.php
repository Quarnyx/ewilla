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
    <h1 class="text-center mb-4">Laporan Penjualan Busana Custom Made</h1>
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
    $sql = mysqli_query($conn, "SELECT * FROM lp_custom_order
        WHERE order_date BETWEEN '$dari_tanggal' AND '$sampai_tanggal' ORDER BY order_date ASC");

    ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="wd-30 text-center align-middle">
                    No
                </th>
                <th class="text-center align-middle">
                    Kode Barang
                </th>
                <th class="text-center align-middle">
                    Nama Barang
                </th>
                <th class="text-center align-middle">
                    Nama Customer
                </th>
                <th class="text-center align-middle">
                    Tanggal Order
                </th>
                <th class="text-center align-middle">
                    Tanggal Pengambilan
                </th>
                <th class="text-center align-middle">
                    Jumlah Order
                </th>
                <th class="text-center align-middle">
                    Harga
                </th>
                <th class="text-center align-middle">
                    Total
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once '../../config.php';
            $no = 0;
            while ($row = mysqli_fetch_array($sql)) {
                $no++;
                ?>
                <tr class="single-item">
                    <td style="text-align: center;">
                        <span class="fs-12 text-muted"><?php echo $no ?></span>
                    </td>
                    <td style="text-align: center;">
                        <?php echo $row['product_code'] ?>
                    </td>
                    <td style="text-align: center;">
                        <?php echo $row['product_name'] ?>
                    </td>
                    <td style="text-align: center;">
                        <?php echo $row['customer_name'] ?>
                    </td>
                    <td style="text-align: center;">
                        <?php echo $row['order_date'] ?>
                    </td>
                    <td style="text-align: center;">
                        <?php echo $row['delivery_date'] ?>
                    </td>
                    <td style="text-align: center;">
                        <?php echo $row['qty'] ?>
                    </td>
                    <td style="text-align: center;">
                        <?php echo number_format($row['price'], 0, ',', '.') ?>
                    </td>
                    <td style="text-align: center;">
                        <?php echo number_format($row['qty'] * $row['price'], 0, ',', '.') ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>

    </table>
</body>
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
<script>
    window.print();
    window.onafterprint = window.close;
</script>

</html>