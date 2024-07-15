<?php
header('Content-Type: application/json');

$apiKey = 'e97cce922b30b2fe107a035ff1b5ba01';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'provinces') {
        // Fetch provinces
        $url = "https://api.rajaongkir.com/starter/province";
    } elseif ($action == 'cities' && isset($_GET['province'])) {
        // Fetch cities for a specific province
        $provinceId = $_GET['province'];
        $url = "https://api.rajaongkir.com/starter/city?province=" . $provinceId;
    } else {
        echo json_encode(['error' => 'Invalid action or missing parameters']);
        exit;
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            'key: ' . $apiKey
        )
    );

    $response = curl_exec($ch);
    curl_close($ch);

    echo $response;
} elseif (isset($_POST['action']) && $_POST['action'] == 'cost') {
    // Fetch courier cost
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];
    $weight = $_POST['weight'];
    $courier = $_POST['courier'];

    $data = [
        'origin' => $origin,
        'destination' => $destination,
        'weight' => $weight,
        'courier' => $courier
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.rajaongkir.com/starter/cost");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            'key: ' . $apiKey,
            'Content-Type: application/x-www-form-urlencoded'
        )
    );

    $response = curl_exec($ch);
    curl_close($ch);

    echo $response;
} else {
    echo json_encode(['error' => 'Action is required']);
}
?>