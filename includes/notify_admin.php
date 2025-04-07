<?php
function notify_admin($subject, $message) {
    $to = getenv('ADMIN_EMAIL') ?: 'kyungrimha@gmail.com'; // .env에 있으면 사용
    $headers = "From: noreply@koreaesim.com\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    mail($to, $subject, $message, $headers);
}
