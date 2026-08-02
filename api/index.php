<?php

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

// Set runtime environment variables for Vercel
putenv('DB_CONNECTION=sqlite');
putenv('DB_DATABASE=' . $sqliteDest);
putenv('VIEW_COMPILED_PATH=' . $tmpStorage . '/framework/views');

// Forward requests to Laravel's public/index.php
require __DIR__ . '/../public/index.php';
