<?php

try {
    require __DIR__.'/../vendor/autoload.php';

    $app = require_once __DIR__.'/../bootstrap/app.php';

    echo '<h1>Laravel carregou!</h1>';
    echo '<p>Aplicação: OK</p>';
} catch (Throwable $e) {
    echo '<h1>ERRO AO CARREGAR O LARAVEL</h1>';
    echo '<pre>';
    echo htmlspecialchars($e->getMessage());
    echo "\n\n";
    echo htmlspecialchars($e->getFile());
    echo ':';
    echo $e->getLine();
    echo "\n\n";
    echo htmlspecialchars($e->getTraceAsString());
    echo '</pre>';
}