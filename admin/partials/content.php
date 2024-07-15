<?php
if ($_GET['page'] == "dashboard") {
    include 'pages/dashboard.php';
}
if ($_GET['page'] == "laporan-penjualan") {
    include 'pages/laporan-penjualan.php';
}
if ($_GET['page'] == "stok-produk") {
    include 'pages/produk/stok-produk.php';
}
if ($_GET['page'] == "produk") {
    include 'pages/produk/index.php';
}
if ($_GET['page'] == "variasi-produk") {
    include 'pages/produk/variasi-produk.php';
}
if ($_GET['page'] == "pembelian") {
    include 'pages/pembelian/pembelian.php';
}
if ($_GET['page'] == "persedian") {
    include 'pages/pembelian/persediaan.php';
}
if ($_GET['page'] == "akunting") {
    include 'pages/akunting/transaksi/index.php';
}
if ($_GET['page'] == "akun") {
    include 'pages/akunting/akun/index.php';
}
if ($_GET['page'] == "neraca") {
    include 'pages/laporan/neraca/index.php';
}
if ($_GET['page'] == "penjualan") {
    include 'pages/laporan/penjualan/index.php';
}
if ($_GET['page'] == "laba-rugi") {
    include 'pages/laporan/laba-rugi/index.php';
}
if ($_GET['page'] == "user") {
    include 'pages/pengguna/index.php';
}
if ($_GET['page'] == "pesanan") {
    include 'pages/pesanan/index.php';
}
if ($_GET['page'] == "pesanan_detail") {
    include 'pages/pesanan/pesanan-detail.php';
}
if ($_GET['page'] == "konfirmasi-pembayaran") {
    include 'pages/pesanan/konfirmasi-pembayaran.php';
}
if ($_GET['page'] == "pesan-custom") {
    include 'pages/pesanan/pesan-custom.php';
}
if ($_GET['page'] == "return-penjualan") {
    include 'pages/pesanan/return-penjualan.php';
}