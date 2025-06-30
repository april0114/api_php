<?php
// 설정 부분 (로그 파일 경로 수정)
$logFile = '/home/yckoreadomain/public_html/wp-content/plugins/yck-order-handler/includes/error/error.log';

// 최근 몇 줄까지 출력할지
$maxLines = 10000;

// 파일 존재 여부 확인
if (!file_exists($logFile)) {
    die("로그 파일이 존재하지 않습니다: " . htmlspecialchars($logFile));
}

// 파일 읽기
$lines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$lines = array_reverse($lines);

// 최근 $maxLines 줄만 출력
$linesToDisplay = array_slice($lines, 0, $maxLines);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>에러 로그 뷰어</title>
    <style>
        body {
            font-family: monospace;
            background-color: #f9f9f9;
            color: #333;
            padding: 20px;
        }
        .log-line {
            border-bottom: 1px solid #ddd;
            padding: 4px 0;
        }
        .refresh-button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .refresh-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>📋 에러 로그 뷰어 (최근 <?= $maxLines ?>줄, 최신순)</h2>
    <a href="?refresh=1" class="refresh-button">🔄 새로고침</a>

    <div class="log-content">
        <?php foreach ($linesToDisplay as $line): ?>
            <div class="log-line"><?= htmlspecialchars($line) ?></div>
        <?php endforeach; ?>
    </div>
</body>
</html>
