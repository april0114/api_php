<?php
function insert_esim_order($conn, $data, $order_id, $payment_date, $apply_end_date) {
    // ✅ 1. 중복 체크
    $check = $conn->prepare("SELECT id FROM esim_orders WHERE order_id = ?");
    $check->bind_param("s", $order_id);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        http_response_code(409); // Conflict
        echo json_encode([
            "result" => -4,
            "reason" => "duplicated order_id"
        ]);
        exit;
    }
    $check->close();

    // ✅ 2. 정상일 경우 INSERT
    $stmt = $conn->prepare("INSERT INTO esim_orders (
        order_id, buy_user_name, buy_user_email,
        product_type, product_days, payment_date,
        apply_start_date, apply_end_date
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssssss",
        $order_id,
        $data['buy_user_name'],
        $data['buy_user_email'],
        $data['product_type'],
        $data['product_days'],
        $payment_date,
        $data['apply_start_date'],
        $apply_end_date
    );

    $stmt->execute();

    if ($stmt->error) {
        http_response_code(500); // Server Error
        echo json_encode([
            "result" => -9,
            "reason" => $stmt->error
        ]);
        exit;
    }

    $stmt->close();
}
