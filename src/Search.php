<?php 

declare(strict_types= 1);
namespace Lucas\DigitalCep;

class Search{
    private string $url = "https://viacep.com.br/ws/";

    public function getAddress(string $cep): array{
        //função opcional que utilizo regex para limpar o cep deixando apenas números de 0 a 9
        //omiti porque não quero deixar isso permitido, se o usuário não passar 8 números (com ou sem -) a api via cep retorna 404
        //$cep = preg_replace('/[^0-9]/im', '', $cep);

        //montagem da url completa: url da api + o cep passado + o tipo de retorno
        $url = $this->url . $cep . '/json';

        //esta função é a responsável por mandar a requisição HTTP para a API passando a url completa, ela tem como retorno a reposta do servidor(API), é um json, pois, esse é o tipo especificado na url passada
        
        //estou omitindo o warning do php para esta função, ela retornará 404 quando passar um formato de cep inválido (mal formatado) e daria um warning, mas estou omitindo ele com o @, quando dá 404 get fica false e eu lanço uma exceção, interrompendo o fluxo de execução
        $get = @file_get_contents($url);
        //var_dump($get);
       
        if($get === false){
            throw new \Exception('O cep passado não está formatado corretamente no padrão de 8 dígitos');
        }

        //decodifica o json e passa ele para um array associativo
        $endereco = json_decode($get, true);
        //var_dump($endereco);

        //quando é passado um cep formatado corretamente, mas, inexistente a API retornará um json, com chave error e valor true. Anteriormente, ela foi convertida para um array associativo onde ['error']=> 1(true)
        if(isset($endereco['erro'])){
            throw new \Exception('Este CEP não existe');
        }

         // Verifica se a conversão foi bem sucedida
         if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("Erro ao decodificar o JSON: " . json_last_error_msg());
        }

        return $endereco;
    }
}
