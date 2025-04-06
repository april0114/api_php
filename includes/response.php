<?php
function success_response($order_id) {
    echo json_encode([
        "result" => 0,
        "order_id" => $order_id
    ]);
    exit;
}
