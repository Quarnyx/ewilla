<?php
require_once ('config.php');

if ($_GET['act'] == 'register') {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $name = $_POST['name'];
    $address = $_POST['address'];
    $province_id = $_POST['province_id'];
    $city_id = $_POST['city_id'];
    $phone_number = $_POST['phone_number'];
    $post_code = $_POST['post_code'];
    $level = 'Customer';

    $sql_insert = "INSERT INTO `lp_users` (`name`, `email`, `password`, `level`) VALUES ('$name', '$email', '$password', '$level')";
    if ($conn->query($sql_insert) === TRUE) {
        echo "Berhasil";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }

    $getuserid = "SELECT user_id FROM `lp_users` WHERE email = '$email'";
    $result = $conn->query($getuserid);
    $row = $result->fetch_assoc();
    $userid = $row['user_id'];

    // generate random 5 digit number
    $account_number = rand(10000, 99999);
    // insert into customer info
    $customer = "INSERT INTO `lp_customers` (`user_id`, `customer_name`, `address`, `phone_number`, `province_id`, `city_id`, `post_code`, `account_number`) 
    VALUES ('$userid', '$name', '$address', '$phone_number', '$province_id', '$city_id', '$post_code', '$account_number')";
    if ($conn->query($customer) === TRUE) {
        echo "Berhasil";
    } else {
        echo "Error: " . $customer . "<br>" . $conn->error;
    }

    $conn->close();
    //redirect to index
    header('Location: index.php');
}
if ($_GET['act'] == 'edit-password') {
    $password = md5($_POST['password']);
    $sql = "UPDATE `lp_users` SET `password` = '$password' WHERE `user_id` = '{$_POST['user_id']}'";
    if ($conn->query($sql) === TRUE) {
        echo "Berhasil";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    //redirect to index
    header('Location: index.php');

}
if ($_GET['act'] == 'edit-profile') {
    $updateuser = "UPDATE `lp_users` SET `name` = '{$_POST['name']}', `email` = '{$_POST['email']}' WHERE `user_id` = '{$_POST['user_id']}'";
    if ($conn->query($updateuser) === TRUE) {
        echo "Berhasil";
    } else {
        echo "Error: " . $updateuser . "<br>" . $conn->error;
    }
    $updateinfouser = "UPDATE `lp_customers` SET `customer_name` = '{$_POST['name']}', `address` = '{$_POST['address']}', `phone_number` = '{$_POST['phone_number']}', `province_id` = '{$_POST['province_id']}', `city_id` = '{$_POST['city_id']}', `post_code` = '{$_POST['post_code']}' WHERE `user_id` = '{$_POST['user_id']}'";
    if ($conn->query($updateinfouser) === TRUE) {
        echo "Berhasil";
    } else {
        echo "Error: " . $updateinfouser . "<br>" . $conn->error;
    }

    $conn->close();
    //redirect to index
    header('Location: index.php');
}
if ($_GET['act'] == 'addtocart') {
    $userid = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    // find variation id
    $variation_sql = "SELECT * FROM lp_variations WHERE product_id = $product_id AND color = '$color' AND size = '$size'";
    $variation_result = $conn->query($variation_sql);
    $variation = $variation_result->fetch_assoc();

    $sql = "INSERT INTO `lp_cart` (`user_id`, `qty`, `variation_id`) 
    VALUES ('$userid', '$quantity', '{$variation['variation_id']}')";
    if ($conn->query($sql) === TRUE) {
        echo "Berhasil";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

// remove from cart
function removeFromCart($id)
{
    global $conn;
    $sql = "DELETE FROM `lp_cart` WHERE `cart_id` = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return "Berhasil";
    } else {
        return "Gagal" . mysqli_error($conn);
    }
}

if ($_GET['act'] == 'remove_cart') {
    echo removeFromCart($_POST['id']);
}


if ($_GET['act'] == 'checkout') {
    $cost = $_POST['cost'];
    $customer_id = $_POST['customer_id'];
    $status = 'Pending';
    // get all from cart
    $cart = "SELECT * FROM `v_cart` WHERE `user_id` = '{$_POST['user_id']}'";
    $result = $conn->query($cart);
    $cart = $result->fetch_all(MYSQLI_ASSOC);
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['product_price'] * $item['qty'];
    }
    echo "Total: " . number_format($total, 0, ',', '.');
    $timestamp = date('Y-m-d H:i:s');
    $total = $total + $cost;
    //insert into order table
    $order = "INSERT INTO `lp_orders` (`customer_id`, `order_total`, `status`, `timestamp`) VALUES ('$customer_id', '$total', '$status', '$timestamp')";
    if ($conn->query($order) === TRUE) {
        echo "Berhasil";
    } else {
        echo "Error: " . $order . "<br>" . $conn->error;
    }
    // GET last id in lp_order
    $order_id = $conn->insert_id;

    //insert into order detail table
    foreach ($cart as $item) {
        $total = $item['product_price'] * $item['qty'];
        $order_detail = "INSERT INTO `lp_order_details` (`order_id`, `variation_id`, `quantity`, `total`)
        VALUES ('$order_id', '{$item['variation_id']}', '{$item['qty']}', '$total')";
        if ($conn->query($order_detail) === TRUE) {
            echo "Berhasil";
        } else {
            echo "Error: " . $order_detail . "<br>" . $conn->error;
        }
    }
    // insert into invoice table
    $invoicenumber = "INV-" . $order_id . "-" . rand(1000, 9999);
    $invoice = "INSERT INTO `lp_invoices` (`invoice_number`, `order_id`, `status`, `payment`)
    VALUES ('$invoicenumber', '$order_id', '$status', '{$_POST['payment']}')";
    if ($conn->query($invoice) === TRUE) {
        echo "Berhasil";
    } else {
        echo "Error: " . $invoice . "<br>" . $conn->error;
    }
    $invoice_id = $conn->insert_id;

    // insert into shipping table
    $sql = "INSERT INTO `lp_shipping` (`courier`, `service`, `invoice_id`, `cost`) VALUES
    ('JNE', '{$_POST['courierService']}', '$invoice_id', '$cost')";
    if ($conn->query($sql) === TRUE) {
        echo "Berhasil inv";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    // delete from cart
    foreach ($cart as $item) {
        $sql = "DELETE FROM `lp_cart` WHERE `cart_id` = '{$item['cart_id']}'";
        if ($conn->query($sql) === TRUE) {
            echo "Berhasil";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();

    header('Location: index.php?page=profile');

}
if ($_GET['act'] == 'konfirmasi-pembayaran') {
    $invoice_id = $_POST['invoice_id'];
    $created_at = $_POST['created_at'];
    $payment_method = $_POST['payment_method'];
    $cust_bank = $_POST['cust_bank'];
    $cust_bank_name = $_POST['cust_bank_name'];
    $amount = $_POST['amount'];
    $pembayaran = $_FILES['proof']['name'];
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg', 'gif');
    $x = explode('.', $pembayaran);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['proof']['size'];
    $file_tmp = $_FILES['proof']['tmp_name'];
    // generate random number for photo filename
    $pembayaran = rand(1000, 1000000) . "." . $ekstensi;
    $file_loc = 'assets/img/pembayaran/' . $pembayaran;
    move_uploaded_file($file_tmp, $file_loc);
    //get file location

    $sql = "INSERT INTO `lp_payment_confirm` (`created_at`, `invoice_id`, `payment_method`, `cust_bank`, `cust_bank_name`, `amount`, `proof`) 
    VALUES ('$created_at', '$invoice_id', '$payment_method', '$cust_bank', '$cust_bank_name', '$amount', '$pembayaran')";
    if ($conn->query($sql) === TRUE) {
        echo "Berhasil";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();

    header('Location: index.php?page=invoice-detail&id=' . $invoice_id);
}
