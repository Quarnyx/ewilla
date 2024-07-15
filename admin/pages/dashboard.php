<div class="nxl-content">
    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Dashboard</h5>
            </div>
        </div>
    </div>
    <!-- [ page-header ] end -->
    <!-- [ Main Content ] start -->
    <div class="main-content">
        <div class="row">
            <div class="col-xxl-4">
                <div class="card stretch stretch-full overflow-hidden">

                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-6">
                                <a href="javascript:void(0);"
                                    class="d-block p-4 text-center border border-dashed border-soft-primary rounded position-relative">
                                    <div
                                        class="avatar-text avatar-md bg-soft-primary text-primary border-soft-primary position-absolute top-0 start-50 translate-middle">
                                        <i class="feather-airplay"></i>
                                    </div>
                                    <div>
                                        <div class="fs-12 text-muted mb-2">Saldo Kas</div>
                                        <?php
                                        require_once './config.php';

                                        ?>
                                        <h3 id="balance"></h3>
                                    </div>
                                </a>

                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0);"
                                    class="d-block p-4 text-center border border-dashed border-soft-warning rounded position-relative">
                                    <div
                                        class="avatar-text avatar-md bg-soft-warning text-warning border-soft-warning position-absolute top-0 start-50 translate-middle">
                                        <i class="feather-layers"></i>
                                    </div>
                                    <div>
                                        <div class="fs-12 text-muted mb-2">Saldo Persediaan</div>
                                        <h3 id="balance_inventory"></h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [Payment Records] start -->
            <div class="col-xxl-8">
                <div class="card stretch stretch-full">
                    <div class="card-header">
                        <h5 class="card-title">Penjualan Tahun ini</h5>
                        <div class="card-header-action">
                            <div class="card-header-btn">
                                <div data-bs-toggle="tooltip" title="Delete">
                                    <a href="javascript:void(0);" class="avatar-text avatar-xs bg-danger"
                                        data-bs-toggle="remove">
                                    </a>
                                </div>
                                <div data-bs-toggle="tooltip" title="Refresh">
                                    <a href="javascript:void(0);" class="avatar-text avatar-xs bg-warning"
                                        data-bs-toggle="refresh">
                                    </a>
                                </div>
                                <div data-bs-toggle="tooltip" title="Maximize/Minimize">
                                    <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success"
                                        data-bs-toggle="expand">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body custom-card-action p-0">
                        <!-- <div id="payment-records-chart"></div> -->
                        <div id="sales-chart"></div>
                    </div>

                </div>
            </div>
            <!-- [Payment Records] end -->


        </div>
    </div>
    <!-- [ Main Content ] end -->
</div>
<script>
    $(document).ready(function () {

        $.ajax({
            url: 'pages/fetch-sales.php',
            method: 'POST',
            success: function (data) {
                $('#sales-chart').html(data);
            }
        });
        $.ajax({
            url: 'process.php?act=balance',
            type: 'GET',
            success: function (response) {
                $("#balance").html(response);
            },
            error: function (xhr, status, error) {
                console.error(xhr);
            }
        });
        $.ajax({
            url: 'process.php?act=balance_inventory',
            type: 'GET',
            success: function (response) {
                $("#balance_inventory").html(response);
            },
            error: function (xhr, status, error) {
                console.error(xhr);
            }
        });

    });
</script>