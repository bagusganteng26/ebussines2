<?php

// Prevent duplicate constant definition
if (!defined('LARAVEL_START')) {
    define('LARAVEL_START', microtime(true));
}

// Load autoloader
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Set storage path untuk Vercel
$app->useStoragePath('/tmp/storage');

// Create necessary directories
if (!file_exists('/tmp/storage/framework/cache')) {
    mkdir('/tmp/storage/framework/cache', 0755, true);
}
if (!file_exists('/tmp/storage/framework/sessions')) {
    mkdir('/tmp/storage/framework/sessions', 0755, true);
}
if (!file_exists('/tmp/storage/framework/views')) {
    mkdir('/tmp/storage/framework/views', 0755, true);
}
if (!file_exists('/tmp/storage/logs')) {
    mkdir('/tmp/storage/logs', 0755, true);
}

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);