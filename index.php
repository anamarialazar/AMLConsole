<?php
// index.php
require_once __DIR__.'/src/autoload.php';

use Symfony\Component\Console as Console;

$application = new Console\Application('Extract', '1.0.0');
$application->run();
