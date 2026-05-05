<?php

function config($key, $default = null)
{
    global $config;
    return $config[$key] ?? $default;
}

function base_path_url($path = '')
{
    $basePath = rtrim(config('base_path', ''), '/');
    return $basePath . '/' . ltrim($path, '/');
}

function base_url($path = '')
{
    $base = config('base_url', '');
    if (!$base) {
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $basePath = rtrim(config('base_path', ''), '/');
        $base = $scheme . '://' . $host . $basePath;
    }

    return rtrim($base, '/') . '/' . ltrim($path, '/');
}

function e($value)
{
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function csrf_token()
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_field()
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

function csrf_verify()
{
    $token = $_POST['csrf_token'] ?? '';
    return $token && hash_equals($_SESSION['csrf_token'] ?? '', $token);
}

function upload_image(array $file, $current = null)
{
    if (empty($file['tmp_name']) || $file['error'] !== UPLOAD_ERR_OK) {
        return $current;
    }

    $allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
    $mime = mime_content_type($file['tmp_name']);

    if (!isset($allowed[$mime])) {
        return $current;
    }

    $uploadDir = APP_ROOT . '/public/uploads';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $filename = 'produto_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $allowed[$mime];
    $destination = $uploadDir . '/' . $filename;

    if (move_uploaded_file($file['tmp_name'], $destination)) {
        if ($current && file_exists(APP_ROOT . '/public/' . $current)) {
            @unlink(APP_ROOT . '/public/' . $current);
        }
        return 'uploads/' . $filename;
    }

    return $current;
}
