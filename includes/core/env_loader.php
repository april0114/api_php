<?php
function load_env($path = null) {
    if ($path === null) {
        $path = realpath(__DIR__ . "/../../.env"); // ⬅ htdocs 기준
    }

    if (!$path || !file_exists($path)) {
        echo " .env not found at: $path\n";
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0 || strpos($line, '=') === false) continue;
        list($key, $value) = explode('=', $line, 2);
        putenv(trim($key) . '=' . trim($value));
    }
}
load_env();

