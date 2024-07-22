<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>Konfirmasi Pembayaran</h2>
        </div>
    </div>
</div>
<!-- End Page Title -->

<!-- Start SignUP Area -->
<section class="signup-area ptb-100">
    <div class="container">
        <div class="signup-content">
            <h2>Konfirmasi Pembayaran</h2>

            <form class="signup-form" action="process.php?act=konfirmasi-pembayaran" method="POST"
                enctype="multipart/form-data">
                <input type="hidden" name="invoice_id" value="<?= $_GET['id'] ?>">
                <div class="form-group">
                    <label>Waktu Pembayaran</label>
                    <input type="date" class="form-control" placeholder="" id="created_at" name="created_at">
                </div>

                <div class="form-group">
                    <label>Di Transfer Ke</label>
                    <input type="text" class="form-control" id="payment_method" name="payment_method">
                </div>

                <div class="form-group">
                    <label>Bank Asal</label>
                    <input type="text" class="form-control" id="cust_bank" name="cust_bank">
                </div>
                <div class="form-group">
                    <label>Nama Pemilik Rekening</label>
                    <input type="text" class="form-control" id="cust_bank_name" name="cust_bank_name">
                </div>

                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" class="form-control" id="amount" name="amount">
                </div>

                <div class="form-group">
                    <label>Bukti Transfer</label>
                    <input type="file" class="form-control" id="proof" name="proof">
                </div>

                <button type="submit" class="default-btn">Konfirmasi</button>
                <a href="https://wa.me/62895617589384" target="_blank" style="margin-top: 10px;" type="button"
                    class="default-btn">Konfirmasi Pembayaran Via
                    Wa</a>

            </form>
        </div>
    </div>
</section>
<!-- End SignUP Area -->