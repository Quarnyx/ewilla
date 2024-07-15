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
                        <i class="feather-arrow-left me-2"></i>
                        <span>Back</span>
                    </a>
                </div>
                <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">


                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Dari <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="startDate" placeholder="Pick start date ">
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Sampai <span class="text-danger">*</span></label>
                            <input type="date" #class="form-control" id="dueDate" placeholder="Pick due date">
                        </div>
                    </div>
                    <a href="javascript:void(0);" class="btn btn-primary">
                        <i class="feather-plus me-2"></i>
                        <span>Filter</span>
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
            <div class="col-xxl-3 col-md-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="hstack justify-content-between">
                            <div>
                                <div class="hstack gap-2 mb-4">
                                    <i class="feather-dollar-sign"></i>
                                    <span>Total Penjualan</span>
                                </div>
                                <?php
                                require_once './config.php';
                                $thisMonth = date('m');
                                $sql = "SELECT
                                        wp_wc_order_stats.order_id,
                                        SUM(wp_wc_order_stats.net_total) AS total,
                                        wp_wc_order_stats.date_completed,
                                        wp_wc_order_stats.`status`
                                        FROM
                                        wp_wc_order_stats
                                        WHERE `status` = 'wc-completed' AND MONTH(date_completed) = '$thisMonth'
                                        ";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        $total = number_format((float) $row['total'], 2, ',', '.');
                                    }
                                } else {
                                    $total = 0;
                                }
                                ?>
                                <h4 class="fw-bolder mb-3">Rp<span class="counter"></span><?php echo $total; ?></h4>
                                <p class="fs-12 text-muted mb-0">total <span class="fw-semibold text-dark">Bulan
                                        ini</span></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- [Active Deals] end -->
            <!-- [Revenue Deals] start -->
            <div class="col-xxl-3 col-md-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="hstack justify-content-between">
                            <div>
                                <div class="hstack gap-2 mb-4">
                                    <i class="feather-pie-chart"></i>
                                    <span>Total Penjualan Produk</span>
                                </div>
                                <?php
                                require_once './config.php';
                                $thisMonth = date('m');
                                $sql = "SELECT
                                        COUNT(v_complete_sale.product_id) AS total
                                        FROM
                                        v_complete_sale";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        $total = $row['total'];
                                    }
                                } else {
                                    $total = 0;
                                }
                                ?>
                                <h4 class="fw-bolder mb-3"><span class="counter"></span><?php echo $total; ?> Produk
                                </h4>
                                <p class="fs-12 text-muted mb-0">total <span class="fw-semibold text-dark">Bulan
                                        ini</span></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- [Revenue Deals] end -->


        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card stretch stretch-full">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover" id="proposalList">
                                <thead>
                                    <tr>
                                        <th class="wd-30">
                                            No
                                        </th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = mysqli_query($conn, "SELECT * FROM v_complete_sale");
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
                                                        <span
                                                            class="text-truncate-1-line"><?php echo $row['post_title'] ?></span>

                                                    </div>
                                                </a>
                                            </td>
                                            <td class="fw-bold text-dark">
                                                <?php echo 'Rp ' . number_format($row['product_net_revenue'], 0, ',', '.') ?>
                                            </td>
                                            <td><?php echo $row['date_updated_gmt'] ?></td>
                                            <td>
                                                <div class="badge bg-soft-success text-success"><?php echo $row['status'] ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
</div>
<script>
    $(document).ready(function () {
        $("#proposalList").DataTable(
            { pageLength: 10, lengthMenu: [10, 20, 50, 100, 200, 500] })
    })
</script>