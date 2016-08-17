<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        // Configuración de mi APP
        'app_token_name'   => 'MYAPP-TOKEN',
        'connectionString' => [
            'dns'  => 'mysql:host=localhost;dbname=example_slim;charset=utf8',
            'user' => 'root',
            'pass' => ''
        ]
    ],
];
