<div class="nxl-content">
    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Konfirmasi Pembayaran</h5>
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
                    <div class="card-body p-0" id="show-table">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- [ Main Content ] end -->
</div>
<!-- Modal -->

<script>
    function loadContent() {
        $.ajax({
            url: 'pages/pesanan/table-konfirmasi.php',
            type: 'GET',
            success: function (response) {
                $("#show-table").html(response);
            },
            error: function (xhr, status, error) {
                console.error(xhr);
            }
        });
    }

    $(document).ready(function () {
        loadContent();

    })
</script>