<?php

declare(strict_types=1);

use Lucas\DigitalCep\Search;

require_once '../vendor/autoload.php';

try {
    $busca = new Search();
    $resultado = $busca->getAddress('36016-080');

    print_r($resultado);
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}
