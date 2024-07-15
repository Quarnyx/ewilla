<?php
include 'config.php';
$sql = "SELECT * FROM v_notification WHERE status = 'Proses'";
$result = $conn->query($sql);

$purchases = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $purchases[] = $row;
    }
}

$conn->close();

echo json_encode($purchases);
?>