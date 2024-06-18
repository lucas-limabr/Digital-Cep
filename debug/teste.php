<?php

declare(strict_types=1);
//caminho absoluto usado para encontrar o autoload, só assim foi possível localizar o autoload
require_once dirname(__DIR__) . '/vendor/autoload.php';

use Lucas\DigitalCep\Search;

try {
    $busca = new Search();
    $resultado = $busca->getAddress('36016080');

    print_r($resultado);
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}
