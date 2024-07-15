<div class="nxl-content">
    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Laporan Penjualan</h5>
            </div>
        </div>
        <div class="page-header-right ms-auto">
            <div class="page-header-right-items">
                <div class="d-flex d-md-none">
                    <a href="javascript:void(0)" class="page-header-right-close-toggle">
                        <i class="feather-arrow-left me-2"></i>a
                        <span>Back</span>
                    </a>
                </div>
                <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                    <a href="javascript:void(0);" class="btn btn-primary" id="btn-transaksi">
                        <i class="feather-plus me-2"></i>
                        <span>Tambah Transaksi</span>
                    </a>
                </div>
            </div>
            <div class="d-md-none d-flex align-items-center">
                <a href="javascript:void(0)" class="page-header-right-open-toggle">
                    <i class="feather-align-right fs-20"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- [ page-header ] end -->
    <!-- [ Main Content ] start -->
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Filter Laporan Penjualan</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="GET">
                            <input type="hidden" name="page" value="penjualan">
                            <div class="input-group">
                                <input type="date" name="dari-tanggal" id="dari-tanggal" class="form-control" required>
                                <span class="input-group-text">Sampai</span>
                                <input type="date" name="sampai-tanggal" id="sampai-tanggal" class="form-control"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3"> <i class="feather-calendar me-2"></i>
                                <span>Filter</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <?php
                    if (isset($_GET['dari-tanggal']) && isset($_GET['sampai-tanggal'])) {
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
                    }

                    if (!isset($_GET['dari-tanggal']) && !isset($_GET['sampai-tanggal'])) {
                        $kondisi = "";
                    } else {
                        $kondisi = "AND transaction_date BETWEEN '$daribulan' AND '$sampaibulan'";
                    }
                    ?>
                    <div class="card-body invoice-container">
                        <?php
                        $start_date = isset($_GET['dari-tanggal']) ? $_GET['dari-tanggal'] : date('Y-m-t');
                        $end_date = isset($_GET['sampai-tanggal']) ? $_GET['sampai-tanggal'] : date('Y-m-t');
                        require_once './config.php';

                        $sql_sales_report = "SELECT
                                                p.category_id,
                                                DATE_FORMAT(it.created_at, '%M %Y') AS sale_month,
                                                Sum(it.quantity) AS total_sold,
                                                Sum(it.quantity * it.product_price) AS total_revenue,
                                                lp_category.category_name
                                                FROM
                                                lp_inventory_transaction AS it
                                                JOIN lp_products AS p ON it.product_id = p.product_id
                                                JOIN lp_category ON p.category_id = lp_category.category_id
                                                WHERE
                                                    it.transaction_type = 'Out'
                                                AND it.created_at BETWEEN '$start_date'
                                                AND '$end_date'
                                                GROUP BY
                                                    p.category_id,
                                                    sale_month
                                                ORDER BY
                                                    p.category_id,
                                                    sale_month
                                                ";
                        $result_sales_report = $conn->query($sql_sales_report);
                        ?>
                        <p class="text-center" style="color: black; font-size: 15px">EWILLA SEWING
                            <br>LAPORAN PENJUALAN<br>Periode:
                            <?php if (isset($_GET['dari-tanggal']) && isset($_GET['sampai-tanggal'])) {
                                echo tanggal($daribulan) . " - " . tanggal($sampaibulan) . " " . $year;
                            } else {
                                echo "Semua Periode";
                            }
                            ?>

                        </p>
                        <table class="table table-bordered mb-0">
                            <?php
                            if ($result_sales_report->num_rows > 0) {
                                // Prepare data for display
                                $sales_data = [];
                                $total_revenue_by_month = [];
                                while ($row = $result_sales_report->fetch_assoc()) {
                                    $category = $row['category_name'];
                                    $sale_month = $row['sale_month'];
                                    $total_sold = $row['total_sold'];
                                    $total_revenue = $row['total_revenue'];
                                    $sales_data[$category][$sale_month] = ['total_sold' => $total_sold, 'total_revenue' => $total_revenue];
                                    // Prepare total revenue by month
                                    if (!isset($total_revenue_by_month[$sale_month])) {
                                        $total_revenue_by_month[$sale_month] = 0;
                                    }
                                    $total_revenue_by_month[$sale_month] += $total_revenue;
                                }
                                ?>
                                <tr>
                                    <th rowspan="2" style="vertical-align: middle; text-align: center">Barang</th>
                                    <?php $months = array_keys(array_merge(...array_values($sales_data))); ?>
                                    <th colspan="<?= count($months) ?>" style="vertical-align: middle; text-align: center">
                                        Jumlah Barang Terjual (pcs)</th>
                                </tr>
                                <tr>

                                    <?php

                                    foreach ($months as $month) {
                                        echo "<th>$month</th>";
                                    }
                                    ?>
                                </tr>
                                <?php
                                foreach ($sales_data as $category => $month_data) {
                                    echo "<tr>";
                                    echo "<td>$category</td>";
                                    foreach ($months as $month) {
                                        echo "<td>" . (isset($month_data[$month]['total_sold']) ? $month_data[$month]['total_sold'] : 0) . "</td>";
                                    }
                                    echo "</tr>";
                                }
                                ?>
                                <?php
                                echo "<tr><th>Pendapatan</th>";
                                foreach ($months as $month) {
                                    echo "<td>" . number_format($total_revenue_by_month[$month], 2) . "</td>";
                                }
                                echo "</tr>";
                                ?>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <button class="btn btn-primary printBTN" type="button"><i
                        class="feather-printer me-2"></i>Print</button>
            </div>

        </div>



        <!-- [ Main Content ] end -->
    </div>
</div>
<script>

    $(document).ready(function () {

        $(document).ready(function () {
            $(" .printBTN").on("click", function () {
                $(".invoice-container").print({ globalStyles: !0, iframe: !1 })
            })
        }); $('#btn-transaksi').on('click', function () {
            var user = $(this).attr("user"); $.ajax({
                url: 'pages/laporan/penjualan/penjualan.php', method: 'post', data: { user: user },
                success: function (data) {
                    $('#tampil_data').html(data);
                    document.getElementById("judul").innerHTML = 'Tambah Penjualan';
                }
            });
            $('#modal').modal('show');
        });
    }); </script>