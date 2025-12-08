<?php

$ds = DIRECTORY_SEPARATOR;

// Подключаем автозагрузку Composer
require __DIR__ . $ds . '..' . $ds . 'vendor' . $ds . 'autoload.php';

// Подключение bootstrap с правильным путём
require __DIR__ . $ds . '..' . $ds . 'app' . $ds . 'config' . $ds . 'bootstrap.php';

// Запускаем приложение
Flight::start();
