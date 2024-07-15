<?php
require_once '../../../config.php';
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5>Filter Neraca</h5>
            </div>
            <div class="card-body">
                <form action="" method="GET" target="_blank">
                    <input type="hidden" name="page" value="neraca">
                    <div class="input-group">
                        <input type="date" name="dari-tanggal" id="dari-tanggal" class="form-control">
                        <span class="input-group-text">Sampai</span>
                        <input type="date" name="sampai-tanggal" id="sampai-tanggal" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3"> <i class="feather-printer me-2"></i>
                        <span>Print</span></button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
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

<div class="col-xxl-8">
    <div class="card stretch stretch-full">
        <div class="card-header">
            <p class="text-center h5 mb-4">Periode: <?php echo tanggal($daribulan) ?> -
                <?php echo tanggal($sampaibulan) ?> <?php echo $year ?>
            </p>
            <div class="card-header-action">
                <div class="card-header-btn">
                    <div data-bs-toggle="tooltip" title="" data-bs-original-title="Delete">
                        <a href="javascript:void(0);" class="avatar-text avatar-xs bg-danger" data-bs-toggle="remove">
                        </a>
                    </div>
                    <div data-bs-toggle="tooltip" title="" data-bs-original-title="Refresh">
                        <a href="javascript:void(0);" class="avatar-text avatar-xs bg-warning" data-bs-toggle="refresh">
                        </a>
                    </div>
                    <div data-bs-toggle="tooltip" title="" data-bs-original-title="Maximize/Minimize">
                        <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success" data-bs-toggle="expand">
                        </a>
                    </div>
                </div>

            </div>
        </div>
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
                                                account_type = 'Aktiva Lancar'
                                            GROUP BY
                                                v_journal.account";
                                $aktivalancar = $conn->query($sqlaktiva);
                                while ($row = $aktivalancar->fetch_array()) {
                                    ?>
                                    <tr>
                                        <td style="padding:0px 0px 0px 25px !important"><?php echo $row['account'] ?></td>
                                        <td style="padding:0px !important" class="text-end">Rp
                                            <?php echo number_format($row['debit'], 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td style="padding:0px 0px 0px 25px !important">Jumlah Aktiva Lancar</td>
                                    <?php
                                    $sqllancar = "SELECT sum(debit) AS debit FROM v_journal WHERE account_type = 'Aktiva Lancar'";
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
                                            WHERE account_type = 'Aktiva Tetap'
                                            GROUP BY
                                                v_journal.account";
                                $aktivalancar = $conn->query($sqlaktiva);
                                while ($row = $aktivalancar->fetch_array()) {
                                    ?>
                                    <tr>
                                        <td style="padding:0px 0px 0px 25px !important"><?php echo $row['account'] ?></td>
                                        <td style="padding:0px !important" class="text-end">Rp
                                            <?php echo number_format($row['debit'], 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td style="padding:0px 0px 0px 25px !important">Jumlah Aktiva Tetap</td>
                                    <?php
                                    $sqltetap = "SELECT sum(debit) AS debit FROM v_journal WHERE account_type = 'Aktiva Tetap'";
                                    $tetap = $conn->query($sqltetap);
                                    $tetap = $tetap->fetch_array();
                                    ?>
                                    <td style="padding:0px !important" class="text-end">Rp
                                        <?php echo number_format($tetap['debit'], 0, ',', '.') ?>
                                    </td>
                                <tr>
                                <tr>
                                    <td style="padding:0px 0px 0px 25px !important">Jumlah Aktiva</td>
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
                                            WHERE account_type = 'Utang Lancar'
                                            GROUP BY
                                                v_journal.account";
                                $aktivalancar = $conn->query($sqlaktiva);
                                while ($row = $aktivalancar->fetch_array()) {
                                    ?>
                                    <tr>
                                        <td style="padding:0px 0px 0px 25px !important"><?php echo $row['account'] ?></td>
                                        <td style="padding:0px !important" class="text-end">Rp
                                            <?php echo number_format($row['credit'], 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td style="padding:0px 0px 0px 25px !important">Jumlah Utang Lancar</td>
                                    <?php
                                    $sqlulancar = "SELECT sum(credit) AS credit FROM v_journal WHERE account_type = 'Utang Lancar'";
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
                                            WHERE account_type = 'Modal'
                                            GROUP BY
                                                v_journal.account";
                                $aktivalancar = $conn->query($sqlaktiva);
                                while ($row = $aktivalancar->fetch_array()) {
                                    ?>
                                    <tr>
                                        <td style="padding:0px 0px 0px 25px !important"><?php echo $row['account'] ?></td>
                                        <td style="padding:0px !important" class="text-end">Rp
                                            <?php echo number_format($row['credit'], 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td style="padding:0px 0px 0px 25px !important">Jumlah Modal</td>
                                    <?php
                                    $sqlmodal = "SELECT sum(credit) AS credit FROM v_journal WHERE account_type = 'modal'";
                                    $modal = $conn->query($sqlmodal);
                                    $modal = $modal->fetch_array();
                                    ?>
                                    <td style="padding:0px !important" class="text-end">Rp
                                        <?php echo number_format($modal['credit'], 0, ',', '.') ?>
                                    </td>
                                <tr>
                                <tr>
                                    <td style="padding:0px 0px 0px 25px !important">Jumlah Kewajiban</td>
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
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary">Print</button>
        </div>
    </div>
</div>