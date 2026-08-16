<?php

define('LARAVEL_START', microtime(true));

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

// Copy pre-discovered bootstrap cache manifests to /tmp/bootstrap/cache
$bootstrapSourceDir = __DIR__ . '/../bootstrap/cache';
if (is_dir($bootstrapSourceDir)) {
    foreach (glob($bootstrapSourceDir . '/*.php') as $file) {
        @copy($file, $tmpBootstrap . '/cache/' . basename($file));
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

require __DIR__ . '/../vendor/autoload.php';

/** @var \Illuminate\Foundation\Application $app */
$app = require __DIR__ . '/../bootstrap/app.php';

$app->useBootstrapPath($tmpBootstrap);
$app->useStoragePath($tmpStorage);

$app->handleRequest(\Illuminate\Http\Request::capture());



