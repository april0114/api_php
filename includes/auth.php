<?php
function check_api_auth($conn) {
    $headers = getallheaders();
    $client_id = $headers['client_id'] ?? '';
    $client_secret = $headers['client_secret'] ?? '';

    if (!$client_id || !$client_secret) {
        echo json_encode(["result" => -1, "reason" => "missing_credentials"]);
        exit;
    }

    $stmt = $conn->prepare("SELECT id FROM api_clients WHERE client_id = ? AND client_secret = ?");
    $stmt->bind_param("ss", $client_id, $client_secret);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        echo json_encode(["result" => -1, "reason" => "invalid_credentials"]);
        exit;
    }

    $stmt->close();
}
