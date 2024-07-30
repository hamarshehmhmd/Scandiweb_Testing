<?php

spl_autoload_register(function ($class) {
    $base_dir = __DIR__ . '/classes/';
    $file = $base_dir . $class . '.php';

    if (file_exists($file)) {
        require $file;
    } else {
        echo "File not found: $file\n"; // Debug statement
    }
});
