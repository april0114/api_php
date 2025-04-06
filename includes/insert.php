<?php
function insert_esim_order($conn, $data) {
    $order_id = "ORD_" . date("YmdHis");
    $payment_date = date("YmdHis");
    $esim_day_json = json_encode($data['esim_day']);

    $check = $conn->prepare("SELECT id FROM esim_orders WHERE order_id = ?");
    $check->bind_param("s", $order_id);
    $check->execute();
    $check->store_result();
    if ($check->num_rows > 0) {
        echo json_encode(["result" => -4]);
        exit;
    }
    $check->close();

    $stmt = $conn->prepare("INSERT INTO esim_orders (order_id, buy_user_name, buy_user_email, esim_day, payment_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $order_id, $data['buy_user_name'], $data['buy_user_email'], $esim_day_json, $payment_date);
    $stmt->execute();

    if ($stmt->error) {
        echo json_encode(["result" => -9, "reason" => $stmt->error]);
        exit;
    }

    $stmt->close();
    return $order_id;
}
