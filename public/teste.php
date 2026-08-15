<?php

$log = __DIR__ . '/../storage/logs/laravel.log';

echo '<h1>Log do Laravel</h1>';

if (!file_exists($log)) {
    echo '<p>Arquivo laravel.log não existe.</p>';
    exit;
}

$content = file_get_contents($log);

echo '<pre style="white-space: pre-wrap;">';
echo htmlspecialchars($content);
echo '</pre>';