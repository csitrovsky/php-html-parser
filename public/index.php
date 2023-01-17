<?php


$registry = @include 'init.php';
$starts = [
    'router' => 'initialize',
    'response' => 'output',
];

try {
    foreach ($starts as $class => $method) {
        $registry->get($class)->$method();
    }
} catch (JsonException|Exception $exception) {
    die($exception->getMessage());
}