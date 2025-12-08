<?php

require __DIR__ . '/../vendor/autoload.php';

use Flight;

// подключаем роуты
require __DIR__ . '/../app/routes.php';

Flight::start();
