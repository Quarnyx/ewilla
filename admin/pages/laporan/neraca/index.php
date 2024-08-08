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
                            <input type="hidden" name="page" value="neraca">
                            <div class="input-group">
                                <input type="date" name="dari-tanggal" id="dari-tanggal" class="form-control">
                                <span class="input-group-text">Sampai</span>
                                <input type="date" name="sampai-tanggal" id="sampai-tanggal" class="form-control">
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
                                    <br>LAPORAN NERACA<br>Periode:
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
                                                <th class="text-uppercase text-center">Aktiva</th>
                                                <th class="text-uppercase text-center">Kewajiban</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table class="table">
                                                        <tr>
                                                            <th>Aktiva Lancar</th>
                                                        </tr>
                                                        <?php
                                                        $sqlaktiva = "SELECT SUM(debit) - SUM(credit) AS debit,
                                                v_journal.account_type,
                                                v_journal.account
                                            FROM
                                                v_journal
                                            WHERE
                                                account_type = 'Aktiva Lancar' $kondisi
                                            GROUP BY
                                                v_journal.account
                                                HAVING SUM(debit) - SUM(credit) <> 0";
                                                        $aktivalancar = $conn->query($sqlaktiva);
                                                        while ($row = $aktivalancar->fetch_array()) {
                                                            ?>
                                                            <tr>
                                                                <td style="padding:0px 0px 0px 25px !important">
                                                                    <?php echo $row['account'] ?>
                                                                </td>
                                                                <td style="padding:0px !important" class="text-end">Rp
                                                                    <?php echo number_format($row['debit'], 0, ',', '.') ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                        <tr>
                                                            <td style="padding:0px 0px 0px 25px !important">Jumlah
                                                                Aktiva Lancar</td>
                                                            <?php
                                                            $sqllancar = "SELECT sum(debit)-sum(credit) AS debit FROM v_journal WHERE account_type = 'Aktiva Lancar' $kondisi";
                                                            $lancar = $conn->query($sqllancar);
                                                            $lancar = $lancar->fetch_array();
                                                            ?>
                                                            <td style="padding:0px !important" class="text-end">Rp
                                                                <?php echo number_format($lancar['debit'], 0, ',', '.') ?>
                                                            </td>
                                                        <tr>
                                                            <th>Aktiva Tetap</th>
                                                        </tr>
                                                        <?php
                                                        $sqlaktiva = "SELECT
                                                SUM(debit) AS debit,
                                                v_journal.account_type,
                                                v_journal.account
                                            FROM v_journal
                                            WHERE account_type = 'Aktiva Tetap' $kondisi
                                            GROUP BY
                                                v_journal.account";
                                                        $aktivalancar = $conn->query($sqlaktiva);
                                                        while ($row = $aktivalancar->fetch_array()) {
                                                            ?>
                                                            <tr>
                                                                <td style="padding:0px 0px 0px 25px !important">
                                                                    <?php echo $row['account'] ?>
                                                                </td>
                                                                <td style="padding:0px !important" class="text-end">Rp
                                                                    <?php echo number_format($row['debit'], 0, ',', '.') ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                        <tr>
                                                            <td style="padding:0px 0px 0px 25px !important">Jumlah
                                                                Aktiva Tetap</td>
                                                            <?php
                                                            $sqltetap = "SELECT sum(debit) AS debit FROM v_journal WHERE account_type = 'Aktiva Tetap' $kondisi";
                                                            $tetap = $conn->query($sqltetap);
                                                            $tetap = $tetap->fetch_array();
                                                            ?>
                                                            <td style="padding:0px !important" class="text-end">Rp
                                                                <?php echo number_format($tetap['debit'], 0, ',', '.') ?>
                                                            </td>
                                                        <tr>
                                                        <tr>
                                                            <td style="padding:0px 0px 0px 25px !important">Jumlah
                                                                Aktiva</td>
                                                            <?php
                                                            $totalwajib = $lancar['debit'] + $tetap['debit'];
                                                            ?>
                                                            <td style="padding:0px !important" class="text-end">Rp
                                                                <?php echo number_format($totalwajib, 0, ',', '.') ?>
                                                            </td>
                                                        </tr>

                                                    </table>
                                                </td>
                                                <!-- kewajiban -->
                                                <td>
                                                    <table class="table">
                                                        <tr>
                                                            <th>Utang Lancar</th>
                                                        </tr>
                                                        <?php
                                                        $sqlaktiva = "SELECT
                                                SUM(credit) AS credit,
                                                v_journal.account_type,
                                                v_journal.account
                                            FROM v_journal
                                            WHERE account_type = 'Utang Lancar' $kondisi
                                            GROUP BY
                                                v_journal.account";
                                                        $aktivalancar = $conn->query($sqlaktiva);
                                                        while ($row = $aktivalancar->fetch_array()) {
                                                            ?>
                                                            <tr>
                                                                <td style="padding:0px 0px 0px 25px !important">
                                                                    <?php echo $row['account'] ?>
                                                                </td>
                                                                <td style="padding:0px !important" class="text-end">Rp
                                                                    <?php echo number_format($row['credit'], 0, ',', '.') ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                        <tr>
                                                            <td style="padding:0px 0px 0px 25px !important">Jumlah Utang
                                                                Lancar</td>
                                                            <?php
                                                            $sqlulancar = "SELECT sum(credit) AS credit FROM v_journal WHERE account_type = 'Utang Lancar' $kondisi";
                                                            $ulancar = $conn->query($sqlulancar);
                                                            $ulancar = $ulancar->fetch_array();
                                                            ?>
                                                            <td style="padding:0px !important" class="text-end">Rp
                                                                <?php echo number_format($ulancar['credit'], 0, ',', '.') ?>
                                                            </td>
                                                        <tr>
                                                            <th>Modal</th>
                                                        </tr>
                                                        <?php
                                                        $sqlaktiva = "SELECT
                                                SUM(credit) AS credit,
                                                v_journal.account_type,
                                                v_journal.account
                                            FROM v_journal
                                            WHERE account_type = 'Modal' $kondisi
                                            GROUP BY
                                                v_journal.account";
                                                        $aktivalancar = $conn->query($sqlaktiva);
                                                        while ($row = $aktivalancar->fetch_array()) {
                                                            ?>
                                                            <tr>
                                                                <td style="padding:0px 0px 0px 25px !important">
                                                                    <?php echo $row['account'] ?>
                                                                </td>
                                                                <td style="padding:0px !important" class="text-end">Rp
                                                                    <?php echo number_format($row['credit'], 0, ',', '.') ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                        <tr>
                                                            <td style="padding:0px 0px 0px 25px !important">Jumlah Modal
                                                            </td>
                                                            <?php
                                                            $sqlmodal = "SELECT sum(credit) AS credit FROM v_journal WHERE account_type = 'modal' $kondisi";
                                                            $modal = $conn->query($sqlmodal);
                                                            $modal = $modal->fetch_array();
                                                            ?>
                                                            <td style="padding:0px !important" class="text-end">Rp
                                                                <?php echo number_format($modal['credit'], 0, ',', '.') ?>
                                                            </td>
                                                        <tr>
                                                        <tr>
                                                            <td style="padding:0px 0px 0px 25px !important">Jumlah
                                                                Kewajiban</td>
                                                            <?php
                                                            $totalwajib = $modal['credit'] + $ulancar['credit'];
                                                            ?>
                                                            <td style="padding:0px !important" class="text-end">Rp
                                                                <?php echo number_format($totalwajib, 0, ',', '.') ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                                        </table>
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
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary printBTN" type="button">Print</button>
            </div>

        </div>
    </div>
    <!-- [ Main Content ] end -->
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