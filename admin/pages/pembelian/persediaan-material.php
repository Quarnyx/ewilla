<div class="nxl-content">
    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Data Persediaan</h5>
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

                    <a href="javascript:void(0);" class="btn btn-primary" id="btn-tambah">
                        <i class="feather-plus me-2"></i>
                        <span>Transaksi Persediaan Material</span>
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
                <div class="card stretch stretch-full">
                    <div class="card-header">
                        <h5>Riwayat Data Persediaan</h5>
                    </div>
                    <div class="card-body p-0" id="show-table">

                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Print Data Persediaan</h5>
                    </div>
                    <div class="card-body">
                        <form action="pages/pembelian/print-persediaan-material.php" method="GET" target="_blank">
                            <div class="input-group">
                                <input type="date" name="dari-tanggal" id="dari-tanggal" class="form-control" required>
                                <span class="input-group-text">Sampai</span>
                                <input type="date" name="sampai-tanggal" id="sampai-tanggal" class="form-control"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3"> <i class="feather-printer me-2"></i>
                                <span>Print</span></button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <!-- [ Main Content ] end -->
    </div>


    <script>
        function loadContent() {
            $.ajax({
                url: 'pages/pembelian/table-persediaan-material.php',
                type: 'GET',
                success: function (response) {
                    $("#show-table").html(response);
                },
                error: function (xhr, status, error) {
                    console.error(xhr);
                }
            });

            $.ajax({
                url: 'pages/pembelian/table-persediaan-material.php',
                type: 'GET',
                success: function (response) {
                    $("#table-real-stock").html(response);
                },
                error: function (xhr, status, error) {
                    console.error(xhr);
                }
            });
        }
        $(document).ready(function () {

            loadContent();
            $('#btn-tambah').on('click', function () {
                var user = $(this).attr("user");
                $.ajax({
                    url: 'pages/pembelian/transaksi-persediaan.php',
                    method: 'post',
                    data: { user: user },
                    success: function (data) {
                        $('#tampil_data').html(data);
                        document.getElementById("judul").innerHTML = 'Transaksi Persediaan';
                    }
                });
                $('#modal').modal('show');
            });


        });

    </script>