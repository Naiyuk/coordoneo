<?php

return [
    'captcha.secret_key' => '6LcLL-IUAAAAAGgUXczOX-if-JEbt5uH9Uaa2zNl',
    'db.host' => 'localhost',
    'db.name' => 'coordoneo',
    'db.username' => 'root',
    'db.password' => '',
    Framework\Validator\CaptchaValidator::class => DI\autowire()->constructor(\DI\get('captcha.secret_key')),
    Framework\Database\MySqlDatabase::class => DI\autowire()->constructor(
        \DI\get('db.host'),
        \DI\get('db.name'),
        \DI\get('db.username'),
        \DI\get('db.password'),
    )
];