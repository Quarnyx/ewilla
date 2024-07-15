<?php
if (empty($_SESSION['user_id'])) {
    include 'login.php';
    exit;
}

switch ($_GET['page'] ?? '') {
    case '':
    case 'home':
        include 'pages/home.php';
        break;
    case 'toko':
        include 'pages/shop.php';
        break;
    case 'produk':
        include 'pages/produk.php';
        break;
    case 'profile':
        include 'pages/profile.php';
        break;
    case 'ganti-password':
        include 'pages/ganti-password.php';
        break;
    case 'cart':
        include 'pages/cart.php';
        break;
    case 'checkout':
        include 'pages/checkout.php';
        break;
    case 'invoice-detail':
        include 'pages/invoice-detail.php';
        break;
    case 'konfirmasi-pembayaran';
        include 'pages/konfirmasi-pembayaran.php';
        break;
    case 'tentang-kami':
        include 'pages/tentang-kami.php';
        break;
    case 'ketentuan-pengembalian':
        include 'pages/ketentuan-pengembalian.php';
        break;
    case 'faq':
        include 'pages/faq.php';
        break;
    case 'kontak-kami':
        include 'pages/kontak-kami.php';
        break;
    case 'blog':
        include 'pages/blog/blog.php';
        break;
    case 'yang-harus-diukur':
        include 'pages/blog/yang-harus-diukur.php';
        break;
    case 'tips-mencegah-bau':
        include 'pages/blog/tips-mencegah-bau.php';
        break;
    case 'cara-merawat-dress':
        include 'pages/blog/cara-merawat-dress.php';
        break;
    default:
        include 'pages/404.php';
        break;
}

