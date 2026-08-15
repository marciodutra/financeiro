<?php

use Illuminate\Http\Request;

try {
    require __DIR__.'/../vendor/autoload.php';

    $app = require_once __DIR__.'/../bootstrap/app.php';

    $request = Request::capture();

    $app->handleRequest($request);

} catch (Throwable $e) {

    echo '<h1>ERRO AO PROCESSAR REQUEST DO LARAVEL</h1>';

    echo '<pre>';
    echo 'Classe: ' . htmlspecialchars(get_class($e)) . "\n\n";
    echo 'Mensagem: ' . htmlspecialchars($e->getMessage()) . "\n\n";
    echo 'Arquivo: ' . htmlspecialchars($e->getFile()) . "\n";
    echo 'Linha: ' . $e->getLine() . "\n\n";
    echo "TRACE:\n";
    echo htmlspecialchars($e->getTraceAsString());
    echo '</pre>';
}