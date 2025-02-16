<?php

// folder structure
$folders = [
    'app/Controllers',
    'app/Models',
    'app/Views',
    'public/css',
    'public/js',
    'public/images',
    'core',
    'config',
    'routes',
    'storage/logs',
    'storage/cache'
];

// Create folders
foreach ($folders as $folder) {
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }
}

// Default index.php
file_put_contents('public/index.php', "<?php\nrequire '../core/bootstrap.php';\n");

// .htaccess file for URL rewriting
file_put_contents('public/.htaccess', "<IfModule mod_rewrite.c>\n  RewriteEngine On\n  RewriteCond %{REQUEST_FILENAME} !-f\n  RewriteCond %{REQUEST_FILENAME} !-d\n  RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]\n</IfModule>");

// Bootstrap file
file_put_contents('core/bootstrap.php', "<?php\nrequire_once __DIR__.'/../vendor/autoload.php';\nrequire_once __DIR__.'/Router.php';\n");

// Basic router
file_put_contents('core/Router.php', "<?php\nclass Router {\n  public static function route() {\n    echo 'SimpleWPHP framework is running!';\n  }\n}\nRouter::route();\n");

// Default Composer file
file_put_contents('composer.json', json_encode([
    "name" => "simplewphp/framework",
    "description" => "A simple PHP MVC framework",
    "type" => "project",
    "require" => [
        "php" => ">=7.4"
    ],
    "autoload" => [
        "psr-4" => [
            "App\\" => "app/"
        ]
    ]
], JSON_PRETTY_PRINT));

// Success message
echo "SimpleWPHP framework structure generated successfully!";
