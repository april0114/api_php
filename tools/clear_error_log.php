<?php
// error_log 초기화
$logFile = '/home/yckoreadomain/public_html/error_log';
file_put_contents($logFile, '');
echo "로그 초기화 완료: " . date('Y-m-d H:i:s');
?>
