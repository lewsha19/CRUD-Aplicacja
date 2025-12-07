<?php
@@ -2,10 +2,10 @@

use flight\Engine;
use flight\database\PdoWrapper;
use Tracy\Debugger;

$ds = DIRECTORY_SEPARATOR;

/*********************************************
 *         FlightPHP Service Setup           *
 *********************************************
@@ -18,24 +18,6 @@

/*********************************************
 *           Tracy Debugger Setup            *
 *********************************************
@@ -61,34 +43,22 @@
 *
 * For more options, see https://tracy.nette.org/en/configuration
 **********************************************/

Debugger::enable(Debugger::Production); // Explicitly set environment
Debugger::$showBar = false; // Disable debug bar to avoid loading incompatible PdoQueryCapture
Debugger::$logDirectory = __DIR__ . $ds . '..' . $ds . 'log'; // Log directory
Debugger::$strictMode = true; // Show all errors (set to E_ALL & ~E_DEPRECATED for less noise)
// Debugger::$maxLen = 1000; // Max length of dumped variables (default: 150)
// Debugger::$maxDepth = 5; // Max depth of dumped structures (default: 3)
// Debugger::$editor = 'vscode'; // Enable clickable file links in debug bar
// Debugger::$email = 'your@email.com'; // Send error notifications

/**********************************************
 *           Database Service Setup           *
 **********************************************/
$sqlitePath = $config['database']['file_path'] ?? (__DIR__ . $ds . '..' . $ds . 'database.sqlite');
$dsn = 'sqlite:' . $sqlitePath;
$options = [ \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC ];
$app->register('db', PdoWrapper::class, [ $dsn, null, null, $options ]);

/**********************************************
 *         Third-Party Integrations           *