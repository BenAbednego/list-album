<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

register_shutdown_function(function() {
    $error = error_get_last();
    if ($error !== null) {
        http_response_code(500);
        echo "<h1>Vercel PHP Fatal Error</h1>";
        echo "<p><strong>Type:</strong> " . $error['type'] . "</p>";
        echo "<p><strong>Message:</strong> " . htmlspecialchars($error['message']) . "</p>";
        echo "<p><strong>File:</strong> " . htmlspecialchars($error['file']) . ":" . $error['line'] . "</p>";
    }
});

// Prepare /tmp directory for Vercel Serverless Environment
$tmpStorage = '/tmp/storage';
$tmpBootstrap = '/tmp/bootstrap';
$directories = [
    $tmpStorage . '/framework/views',
    $tmpStorage . '/framework/cache',
    $tmpStorage . '/framework/sessions',
    $tmpStorage . '/logs',
    $tmpBootstrap . '/cache',
    '/tmp/database',
    '/tmp/uploads'
];

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Ensure SQLite database exists in /tmp
$sqliteSource = __DIR__ . '/../database/database.sqlite';
$sqliteDest = '/tmp/database/database.sqlite';

if (!file_exists($sqliteDest)) {
    if (file_exists($sqliteSource)) {
        @copy($sqliteSource, $sqliteDest);
    } else {
        @touch($sqliteDest);
    }
}

// Set runtime environment variables for Vercel in putenv, $_ENV, and $_SERVER
$appKey = getenv('APP_KEY') ?: 'base64:B7s81iZA6/OkI6GBG8H/8wwn1ka6Zv/COGl0WOq1V8Y=';

$envVars = [
    'APP_ENV' => 'production',
    'APP_DEBUG' => 'true',
    'APP_KEY' => $appKey,
    'LARAVEL_STORAGE_PATH' => $tmpStorage,
    'APP_BOOTSTRAP_PATH' => $tmpBootstrap,
    'LOG_CHANNEL' => 'stderr',
    'DB_CONNECTION' => 'sqlite',
    'DB_DATABASE' => $sqliteDest,
    'VIEW_COMPILED_PATH' => $tmpStorage . '/framework/views',
];

foreach ($envVars as $key => $val) {
    putenv("{$key}={$val}");
    $_ENV[$key] = $val;
    $_SERVER[$key] = $val;
}

try {
    // Forward requests to Laravel's public/index.php
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    http_response_code(500);
    echo "<h1>Vercel Deployment Exception</h1>";
    echo "<p><strong>Message:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><strong>File:</strong> " . htmlspecialchars($e->getFile()) . ":" . $e->getLine() . "</p>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}


