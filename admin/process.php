<?php
require_once ('config.php');
if ($_GET['act'] == 'tambah-stok') {
    $product_id = $_POST['product_id'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];
    $created_at = $_POST['created_at'];

    $credit_account_id = '1';
    $debit_account_id = '21';
    $amount = $product_price * $quantity;
    $sqltrans = "INSERT INTO `lp_transactions` (`transaction_date`, `amount`, `description`, `debit_account_id`, `credit_account_id`) 
    VALUES ('$created_at', '$amount', 'Penambahan Stok', '$debit_account_id', '$credit_account_id')";
    $result = mysqli_query($conn, $sqltrans);
    if ($result) {
        echo "Berhasil Transaksi";
    } else {
        echo "Gagal";
        echo mysqli_error($conn);
    }
    //get latest transaction
    $sql = "SELECT * FROM `lp_transactions` ORDER BY `transaction_id` DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    echo $row['transaction_id'];

    $sql = "INSERT INTO `lp_inventory_transaction` (`product_price`, `quantity`, `created_at`, `transaction_id`, `transaction_type`, `product_id`)
    VALUES ('$product_price', '$quantity', '$created_at', '$row[transaction_id]', 'In', '$product_id')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Berhasil";
    } else {
        echo "Gagal";
        echo mysqli_error($conn);
    }
}
if ($_GET['act'] == 'hapus-stok') {
    $id = $_POST['id'];
    $trans = $_POST['trans'];
    $sql = "DELETE FROM `lp_inventory_transaction` WHERE `inventory_transactions_id` = '$id'";
    $result = mysqli_query($conn, $sql);
    $deletetrans = "DELETE FROM `lp_transactions` WHERE `transaction_id` = '$trans'";
    $result = mysqli_query($conn, $deletetrans);
    if ($result) {
        echo "Berhasil";
    } else {
        echo "Gagal";
        echo mysqli_error($conn);
    }
}
if ($_GET['act'] == 'balance') {
    $sql = "SELECT
            v_journal.account,
            SUM(v_journal.debit - v_journal.credit)AS total
            FROM
            v_journal
            WHERE
            v_journal.account = 'Kas'
            ";
    $result = $conn->query($sql);
    $total = 0;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total = $row['total'];
        echo "Rp. " . number_format($total, 2);
    }

}
if ($_GET['act'] == 'balance_inventory') {
    $sql = "SELECT
            v_journal.account,
            SUM(v_journal.debit - v_journal.credit)AS total
            FROM
            v_journal
            WHERE
            v_journal.account = 'Persediaan'
            ";
    $result = $conn->query($sql);
    $total = 0;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total = $row['total'];
        echo "Rp. " . number_format($total, 2);
    }

}
if ($_GET['act'] == 'hapus-persediaan') {
    $id = $_POST['id'];

    $sql = "DELETE FROM `lp_inventory_transaction` WHERE `inventory_transactions_id` = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Berhasil";
    } else {
        echo "Gagal";
        echo mysqli_error($conn);
    }
}
if ($_GET['act'] == 'hapus-persediaan-produk') {
    $id = $_POST['id'];
    // get transaction first from transaction table
    $sqla = "SELECT * FROM `lp_inventory_transaction` WHERE `inventory_transactions_id` = '$id'";
    $gettotalprice = mysqli_query($conn, $sqla);
    $row = $gettotalprice->fetch_assoc();
    $amount = $row['product_price'] * $row['quantity'];
    $sqltrans = "INSERT INTO `lp_transactions` (`transaction_date`, `amount`, `description`, `debit_account_id`, `credit_account_id`) VALUES ('$row[created_at]', '$amount', 'Pembatalan Pembelian', '1', '21')";
    $result = mysqli_query($conn, $sqltrans);
    if ($result) {
        echo "Berhasil Transaksi";
    } else {
        echo "Gagal";
        echo mysqli_error($conn);
    }
}
if ($_GET['act'] == 'update-persediaan') {
    $product_id = $_POST['product_id'];
    $product_price = $_POST['product_price'];
    $product_name = $_POST['product_name'];
    $product_code = $_POST['product_code'];

    $sql = "UPDATE `lp_products` SET `product_price` = '$product_price', `product_name` = '$product_name', `product_code` = '$product_code' WHERE `product_id` = '$product_id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Berhasil Update";
    } else {
        echo "Gagal";
        echo mysqli_error($conn);
    }

}
if ($_GET['act'] == 'tambahproduk') {
    $product_code = $_POST['product_code'];
    $product_name = $_POST['product_name'];
    $category_id = $_POST['category_id'];
    $product_price = $_POST['product_price'];
    $category = 'product';
    $unit = $_POST['unit'];
    $created_at = date('Y-m-d H:i:s');
    $description = $_POST['description'];
    $sql = "INSERT INTO `lp_products` (`product_code`, `product_name`, `category`, `product_price`, `unit`, `updated_at`, `category_id`, `description`)
    VALUES ('$product_code', '$product_name', 'product', '$product_price', '$unit', '$created_at', '$category_id', '$description')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Berhasil";
    } else {
        echo "Gagal";
        echo mysqli_error($conn);
    }
}
if ($_GET['act'] == 'hapus-produk') {
    $id = $_POST['id'];
    $sql = "DELETE FROM `lp_products` WHERE `product_id` = '$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_errno($conn) == 0) {
        echo "Berhasil";
        http_response_code(200);
    } else if (mysqli_errno($conn) == 1451) {
        echo "Gagal, produk masih digunakan";
        http_response_code(500);
        die(json_encode([
            'status' => 'error',
            'message' => 'Gagal, produk masih digunakan'
        ]));
    }
}
if ($_GET['act'] == 'update-produk') {
    $id = $_POST['product_id'];
    $product_code = $_POST['product_code'];
    $product_name = $_POST['product_name'];
    $category_id = $_POST['category_id'];
    $product_price = $_POST['product_price'];
    $category = 'product';
    $unit = $_POST['unit'];
    $updated_at = date('Y-m-d H:i:s');
    $description = $_POST['description'];
    $sql = "UPDATE `lp_products` SET `product_code` = '$product_code', `product_name` = '$product_name', `category_id` = '$category_id', `product_price` = '$product_price', `unit` = '$unit', `updated_at` = '$updated_at', `description` = '$description' WHERE `product_id` = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "Berhasil Update";
    } else {
        echo "Gagal SQL: " . $sql . "<br>" . mysqli_error($conn);
    }

}
if ($_GET['act'] == 'tambah-variasi') {
    $product_id = $_POST['id'];
    $foto = $_FILES['foto']['name'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg', 'gif');
    $x = explode('.', $foto);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['foto']['size'];
    $file_tmp = $_FILES['foto']['tmp_name'];
    // generate random number for photo filename
    $foto = rand(1000, 1000000) . "." . $ekstensi;
    $file_loc = '../assets/img/products/' . $foto;
    move_uploaded_file($file_tmp, $file_loc);
    //get file location

    $sql = "INSERT INTO `lp_variations` (`product_id`, `image_url`, `color`, `size`) VALUES ('$product_id', '$foto', '$color', '$size')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Berhasil";
    } else {
        echo "Gagal";
        echo mysqli_error($conn);
    }

}
if ($_GET['act'] == 'hapus-variasi') {
    $id = $_POST['id'];
    $sql = "DELETE FROM `lp_variations` WHERE `variation_id` = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Berhasil";
    } else {
        echo "Gagal";
        echo mysqli_error($conn);
    }
}
if ($_GET['act'] == 'tambah-transaksi') {
    $transaction_date = $_POST['transaction_date'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $debit_account_id = $_POST['debit_account_id'];
    $credit_account_id = $_POST['credit_account_id'];

    $sql_insert = "
    INSERT INTO lp_transactions (transaction_date, amount, description, debit_account_id, credit_account_id)
    VALUES ('$transaction_date', '$amount', '$description', '$debit_account_id', '$credit_account_id')";

    if ($conn->query($sql_insert) === TRUE) {
        echo "Berhasil";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}
if ($_GET['act'] == 'hapus-transaksi') {
    $id = $_POST['id'];
    $sql = "DELETE FROM `lp_transactions` WHERE `transaction_id` = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Berhasil";
    } else {
        echo "Gagal";
        echo mysqli_error($conn);
    }
}
if ($_GET['act'] == 'tambah-akun') {

    $sql_insert = "INSERT INTO `lp_accounts` (`account_name`, `account_type`) VALUES ('$_POST[account_name]', '$_POST[account_type]')";
    if ($conn->query($sql_insert) === TRUE) {
        echo "Berhasil";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}
if ($_GET['act'] == 'hapus-akun') {
    $id = $_POST['id'];
    $sql = "DELETE FROM `lp_accounts` WHERE `account_id` = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Berhasil";
    } else {
        echo "Gagal";
        echo mysqli_error($conn);
    }
}
if ($_GET['act'] == 'edit-akun') {

    $sql = "UPDATE `lp_accounts` SET `account_name` = '$_POST[account_name]', `account_type` = '$_POST[account_type]' WHERE `account_id` = '$_POST[id]'";
    if ($conn->query($sql) === TRUE) {
        echo "Berhasil";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
if ($_GET['act'] == 'tambah-penjualan') {
    $product_id = $_POST['product_id'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];
    $created_at = $_POST['created_at'];
    $sql = "INSERT INTO `lp_inventory_transaction` (`product_id`, `product_price`, `quantity`, `created_at`, `transaction_type`) 
    VALUES ('$product_id', '$product_price', '$quantity', '$created_at', 'Out')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Berhasil";
    } else {
        echo "Gagal";
        echo mysqli_error($conn);
    }
    $amount = $product_price * $quantity;
    $sqltrans = "INSERT INTO `lp_transactions` (`transaction_date`, `amount`, `description`, `debit_account_id`, `credit_account_id`) 
    VALUES ('$created_at', '$amount', 'Penjualan', '1', '20')";
    $result = mysqli_query($conn, $sqltrans);
    if ($result) {
        echo "Berhasil Transaksi";
    } else {
        echo "Gagal";
        echo mysqli_error($conn);
    }
}
if ($_GET['act'] == 'tambah-pengguna') {

    $password = md5($_POST['password']);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $level = $_POST['level'];

    $sql_insert = "INSERT INTO `lp_users` (`name`, `email`, `password`, `level`) VALUES ('$name', '$email', '$password', '$level')";
    if ($conn->query($sql_insert) === TRUE) {
        echo "Berhasil";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }

}
if ($_GET['act'] == 'edit-pengguna') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $level = $_POST['level'];
    $sql = "UPDATE `lp_users` SET `name` = '$name', `email` = '$email', `level` = '$level' WHERE `user_id` = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Berhasil";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}
if ($_GET['act'] == 'hapus-pengguna') {
    $id = $_POST['id'];
    $sql = "DELETE FROM `lp_users` WHERE `user_id` = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Berhasil";
    } else {
        echo "Gagal";
        echo mysqli_error($conn);
    }
}
if ($_GET['act'] == 'edit-password') {

    $password = md5($_POST['password']);
    $id = $_POST['id'];
    $sql = "UPDATE `lp_users` SET `password` = '$password' WHERE `user_id` = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Berhasil";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if ($_GET['act'] == 'update-status') {
    $invoice_id = $_POST['invoice_id'];
    $status = $_POST['status'];
    $getdata = "SELECT * FROM `v_order_detail` WHERE `invoice_id` = '$invoice_id'";
    $result = $conn->query($getdata);
    $getdata = $result->fetch_all(MYSQLI_ASSOC);
    if ($status == 'Proses') {
        foreach ($getdata as $item) {
            //    insert into transaction
            $amount = $item['product_price'] * $item['quantity'];
            $created_at = date('Y-m-d H:i:s');
            $sqltrans = "INSERT INTO `lp_transactions` (`transaction_date`, `amount`, `description`, `debit_account_id`, `credit_account_id`) 
            VALUES ('$created_at', '$amount', 'Penjualan Produk $item[product_name]', '1', '20')";
            $result = mysqli_query($conn, $sqltrans);
            if ($result) {
                echo "Berhasil Transaksi";
            } else {
                echo "Gagal";
                echo mysqli_error($conn);
            }
            // insert into inventory transaction

            $sql = "INSERT INTO `lp_inventory_transaction` (`product_id`, `variation_id`, `product_price`, `quantity`, `created_at`, `transaction_type`, `transaction_id`)
            VALUES ('$item[product_id]', '$item[variation_id]', '$item[product_price]', '$item[quantity]', '$created_at', 'Out', '$conn->insert_id')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "Berhasil";
            } else {
                echo "Gagal";
                echo mysqli_error($conn);
            }
        }
    }
    $sql = "UPDATE `lp_invoices` SET `status` = '$status' WHERE `invoice_id` = '$invoice_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Berhasil";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
if ($_GET['act'] == 'input-resi') {

    $invoice_id = $_POST['invoice_id'];
    $resi = $_POST['resi'];
    $sql = "UPDATE `lp_shipping` SET `receipt_number` = '$resi' WHERE `invoice_id` = '$invoice_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Berhasil";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

if ($_GET['act'] == 'hapus-konfirmasi') {
    $id = $_POST['id'];
    $sql = "DELETE FROM `lp_payment_confirm` WHERE `confirm_id` = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Berhasil";
    } else {
        echo "Gagal";
        echo mysqli_error($conn);
    }
}

if ($_GET['act'] == 'tambah-material') {

    $product_code = $_POST['product_code'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $category = 'material';
    $unit = $_POST['unit'];
    $created_at = date('Y-m-d H:i:s');
    $sql = "INSERT INTO `lp_products` (`product_code`, `product_name`, `category`, `product_price`, `unit`, `updated_at`)
    values ('$product_code', '$product_name', '$category', '$product_price', '$unit', '$created_at')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Berhasil";
    } else {
        echo "Gagal";
        echo mysqli_error($conn);
    }

}
if ($_GET['act'] == 'tambah-pembelian') {
    $product_id = $_POST['product_id'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];
    $created_at = $_POST['created_at'];
    $sql = "INSERT INTO `lp_inventory_transaction` (`product_price`, `quantity`, `created_at`, `transaction_type`, `product_id`)
    VALUES ('$product_price', '$quantity', '$created_at', 'In', '$product_id')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Berhasil";
    } else {
        echo "Gagal";
        echo mysqli_error($conn);
    }

}

if ($_GET['act'] == 'tambah-custom') {
    $product_code = $_POST['product_code'];
    $product_name = $_POST['product_name'];
    $customer_name = $_POST['customer_name'];
    $order_date = $_POST['order_date'];
    $delivery_date = "";
    $qty = $_POST['qty'];
    $price = $_POST['price'];

    $sql = "INSERT INTO `lp_custom_order` (`product_code`, `product_name`, `customer_name`, `order_date`, `delivery_date`, `qty`, `price`) 
    VALUES ('$product_code', '$product_name', '$customer_name', '$order_date', '$delivery_date', '$qty', '$price')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Berhasil";
    } else {
        echo "Gagal";
        echo mysqli_error($conn);
    }
}
if ($_GET['act'] == 'hapus-custom') {
    $id = $_POST['id'];
    $sql = "DELETE FROM `lp_custom_order` WHERE `custom_product_id` = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Berhasil";
    } else {
        echo "Gagal";
        echo mysqli_error($conn);
    }
}
if ($_GET['act'] == 'update-custom') {
    $id = $_POST['custom_product_id'];
    $order_date = $_POST['order_date'];
    $customer_name = $_POST['customer_name'];
    echo $customer_name;
    $product_name = $_POST['product_name'];
    $product_code = $_POST['product_code'];
    $delivery_date = $_POST['delivery_date'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $sql = "UPDATE `lp_custom_order` SET 
    `product_code` = '$product_code', 
    `product_name` = '$product_name', 
    `customer_name` = '$customer_name', 
    `order_date` = '$order_date', 
    `delivery_date` = '$delivery_date', 
    `qty` = '$qty', 
    `price` = '$price' 
    WHERE `custom_product_id` = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Berhasil";
    } else {
        echo "Gagal";
        echo mysqli_error($conn);
    }
}

if ($_GET['act'] == 'tambah-return') {
    $product_id = $_POST['product_id'];
    $desc = $_POST['desc'];
    $qty = $_POST['qty'];
    $sql = "INSERT INTO `lp_return` (`product_id`, `desc`, `qty`) VALUES ('$product_id', '$desc', '$qty')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Berhasil";
    } else {
        echo "Gagal";
        echo mysqli_error($conn);
    }
}
if ($_GET['act'] == 'update-return') {
    $id = $_POST['return_id'];
    $product_id = $_POST['product_id'];
    $desc = $_POST['desc'];
    $qty = $_POST['qty'];
    $sql = "UPDATE `lp_return` SET `product_id` = '$product_id', `desc` = '$desc', `qty` = '$qty' WHERE `return_id` = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Berhasil";
    } else {
        echo "Gagal";
        echo mysqli_error($conn);
    }
}
if ($_GET['act'] == 'hapus-return') {
    $id = $_POST['id'];
    $sql = "DELETE FROM `lp_return` WHERE `return_id` = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Berhasil";
    } else {
        echo "Gagal";
        echo mysqli_error($conn);
    }
}