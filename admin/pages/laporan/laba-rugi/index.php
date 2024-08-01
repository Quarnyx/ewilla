<div class="nxl-content">
    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Laporan Neraca</h5>
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
                        <h5>Filter Neraca</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="GET">
                            <input type="hidden" name="page" value="laba-rugi">
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
                <div class="card stretch stretch-full invoice-container">
                    <div class="card-body">
                        <?php
                        require_once './config.php';
                        ?>

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

                        <div class="col-xxl-8">
                            <div class="card stretch stretch-full">

                                <p class="text-center" style="color: black; font-size: 15px">EWILLA SEWING
                                    <br>LAPORAN LABA RUGI<br>Periode:
                                    <?php if (isset($_GET['dari-tanggal']) && isset($_GET['sampai-tanggal'])) {
                                        echo tanggal($daribulan) . " - " . tanggal($sampaibulan) . $year;
                                    } else {
                                        echo "Semua Periode";
                                    }
                                    ?>

                                </p>
                                <div class="card-body custom-card-action p-0">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <tr>
                                                <td>
                                                    <table class="table">
                                                        <tr>
                                                            <th>Pendapatan</th>
                                                        </tr>
                                                        <?php
                                                        $sqlaktiva = "SELECT SUM(credit) - SUM(debit) AS credit,
                                                                        v_journal.account_type,
                                                                        v_journal.account
                                                                    FROM
                                                                        v_journal
                                                                    WHERE
                                                                        account_type = 'Pendapatan' $kondisi
                                                                    GROUP BY
                                                                        v_journal.account";
                                                        $totalcredit = 0;
                                                        $aktivalancar = $conn->query($sqlaktiva);
                                                        while ($row = $aktivalancar->fetch_array()) {
                                                            ?>
                                                            <tr>
                                                                <td style="padding:0px 0px 0px 15px !important">
                                                                    <?php echo $row['account'] ?>
                                                                </td>
                                                                <td style="padding:0px !important" class="text-end">Rp
                                                                    <?php echo number_format($row['credit'], 0, ',', '.');
                                                                    $totalcredit += $row['credit'];
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                        <tr>
                                                            <td style="padding:0px 0px 0px 15px !important">Jumlah
                                                                Pendapatan</td>
                                                            <td style="padding:0px !important" class="text-end">Rp
                                                                <?php echo number_format($totalcredit, 0, ',', '.') ?>
                                                            </td>
                                                        <tr>
                                                            <th>Beban</th>
                                                        </tr>
                                                        <?php
                                                        $sqlaktiva = "SELECT
                                                                        SUM(debit) - SUM(credit) AS debit,
                                                                        v_journal.account_type,
                                                                        v_journal.account
                                                                    FROM v_journal
                                                                    WHERE account_type = 'Beban' $kondisi
                                                                    GROUP BY
                                                                        v_journal.account";
                                                        $totalbeban = 0;
                                                        $aktivalancar = $conn->query($sqlaktiva);
                                                        while ($row = $aktivalancar->fetch_array()) {
                                                            ?>
                                                            <tr>
                                                                <td style="padding:0px 0px 0px 15px !important">
                                                                    <?php echo $row['account'] ?>
                                                                </td>
                                                                <td style="padding:0px !important" class="text-end">Rp
                                                                    <?php echo number_format($row['debit'], 0, ',', '.');
                                                                    $totalbeban += $row['debit']; ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                        <tr>
                                                            <td style="padding:0px 0px 0px 15px !important">Jumlah
                                                                Aktiva Tetap</td>
                                                            <td style="padding:0px !important" class="text-end">Rp
                                                                <?php echo number_format($totalbeban, 0, ',', '.') ?>
                                                            </td>
                                                        <tr>
                                                        <tr>
                                                            <td style="padding:0px 0px 0px 15px !important">Jumlah
                                                                Aktiva</td>
                                                            <?php
                                                            $totalwajib = $totalcredit - $totalbeban;
                                                            ?>
                                                            <td style="padding:0px !important" class="text-end">Rp
                                                                <?php echo number_format($totalwajib, 0, ',', '.') ?>
                                                            </td>
                                                        </tr>

                                                    </table>
                                                </td>
                                                <!-- kewajiban -->

                                            </tr>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
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
                    </div>
                </div>

                <button class="btn btn-primary printBTN" type="button">Print</button>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<script>

    $(document).ready(function () {

        $(document).ready(function () {
            $(".printBTN").on("click", function () {
                $(".invoice-container").print({ globalStyles: !0, iframe: !1 })
            })
        });

    });

</script>