<?php
function notify_admin($subject, $message) {
    file_put_contents(__DIR__ . '/../../logs/admin_notify.txt', "[$subject] $message\n", FILE_APPEND);
}
