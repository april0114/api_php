<?php
//db에 값 넣어주고 중복 테스트 해주는 php
function insert_esim_order($conn, $data, $order_id, $payment_date) {
    $esim_day_json = json_encode(array_map('strval', $data['esim_day']));

    $check = $conn->prepare("SELECT id FROM esim_orders WHERE order_id = ?");
    $check->bind_param("s", $order_id);
    $check->execute();
    $check->store_result();
    if ($check->num_rows > 0) {
        http_response_code(409);
        echo json_encode(["result" => -4, "reason" => "duplicated order_item_code "]);
        exit;
    }
    $check->close();
//문제 없을 시 db에 저장하기
    $stmt = $conn->prepare("INSERT INTO esim_orders (order_id, buy_user_name, buy_user_email, esim_day, payment_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $order_id, $data['buy_user_name'], $data['buy_user_email'], $esim_day_json, $payment_date);
    $stmt->execute();
    if ($stmt->error) {
        http_response_code(500);
        echo json_encode(["result" => -9, "reason" => $stmt->error, "temporary system error"]);
        exit;
    }
    $stmt->close();
}
