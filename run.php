<?php
// index.php
require __DIR__.'/vendor/autoload.php';
require __DIR__.'/src/Commands/ExtractCommand.class.php';
use Commands\ExtractCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new ExtractCommand());
$application->run();
