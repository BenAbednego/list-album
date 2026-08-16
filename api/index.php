<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

try {
    // Prepare /tmp directory for Vercel Serverless Environment
    $tmpStorage = '/tmp/storage';
    $directories = [
        $tmpStorage . '/framework/views',
        $tmpStorage . '/framework/cache',
        $tmpStorage . '/framework/sessions',
        $tmpStorage . '/logs',
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
        'APP_STORAGE_PATH' => $tmpStorage,
        'DB_CONNECTION' => 'sqlite',
        'DB_DATABASE' => $sqliteDest,
        'VIEW_COMPILED_PATH' => $tmpStorage . '/framework/views',
    ];

    foreach ($envVars as $key => $val) {
        putenv("{$key}={$val}");
        $_ENV[$key] = $val;
        $_SERVER[$key] = $val;
    }

    // Forward requests to Laravel's public/index.php
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    http_response_code(500);
    echo "<h1>Vercel Deployment Exception</h1>";
    echo "<p><strong>Message:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><strong>File:</strong> " . htmlspecialchars($e->getFile()) . ":" . $e->getLine() . "</p>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}

