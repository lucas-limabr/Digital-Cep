<?php

declare(strict_types= 1);
use PHPUnit\Framework\TestCase;
use Lucas\DigitalCep\Search;
use PHPUnit\Framework\Attributes\DataProvider;

class SearchTest extends TestCase
{
    //estou utilizando um provedor de dados, ele sempre retornará um array. Um provedor serve dados ao método que está imediatamente depois dele
    #[DataProvider('dadosTeste')]
    
    //método que recebe dois argumentos do método provider
    public function testGetAddress(string $input, array $expected)
    {

        $busca = new Search();
        $resultado = $busca->getAddress($input);

        //função de teste para ver se dois valores são idênticos
        $this->assertEquals($expected, $resultado);
    }

    //return um array associativo. Onde a chave é um comentário do teste, e o valor é um array que contém uma string que é o  input, que será passado para testgetAddress e um array associativo que é o resultado esperado para aquele input que é o segundo argumento passado para o testgetAddress
    public static function dadosTeste() : array
    {
        return [
            "Endereço da Praça da Sé" => [
                "01001-000",
                [
                    "cep" => "01001-000",
                    "logradouro" => "Praça da Sé",
                    "complemento" => "lado ímpar",
                    "bairro" => "Sé",
                    "localidade" => "São Paulo",
                    "uf" => "SP",
                    "ibge" => "3550308",
                    "gia" => "1004",
                    "ddd" => "11",
                    "siafi" => "7107"
                ]
            ],
            "Endereço do CT do Flu em Lranjeiras" => [
                "22231-220",
                [
                    "cep" => "22231-420",
                    "logradouro" => "Rua Álvaro Chaves",
                    "complemento" => "",
                    "bairro" => "Laranjeiras",
                    "localidade" => "Rio de Janeiro",
                    "uf" => "RJ",
                    "ibge" => "3304557",
                    "gia" => "",
                    "ddd" => "21",
                    "siafi" => "6001"
                ]
            ]
        ];
    }
}
