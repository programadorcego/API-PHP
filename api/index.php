<?php
/*
O formato de saída mais comum no desenvolvimento de APIs é o formato JSON (JavaScript Object Notation).

JSON é um formato de dados leve que é fácil para os seres humanos lerem e escreverem e para as máquinas analisarem e gerarem.

Os dados JSON são representados como pares chave-valor, semelhantes a um objeto em JavaScript.

Cada chave é uma string e seu valor pode ser uma string, número, booleano, array ou outro objeto JSON.

Um exemplo de um objeto JSON:

{
  "nome": "Willian",
  "idade": 32,
  "país": "Brasil"
}

A forma de se trabalhar com o JSON no PHP é através das funções json_encode() e json_decode().

A função json_decode converte um valor PHP em uma string JSON.
Ela aceita um valor como parâmetro, que pode ser um array, objeto, string, número, booleano ou nulo, 
e retorna uma string contendo uma representação JSON desse valor.

O segundo parâmetro da função `json_encode()` é opcional.
Ele permite que você defina algumas opções para controlar como a string JSON é gerada.
As opções mais usadas são:
1. JSON_PRETTY_PRINT`: faz com que a saída JSON seja formatada com indentação e espaçamento para facilitar a leitura.
2. `JSON_UNESCAPED_UNICODE`: evita que caracteres unicode sejam escapados na saída JSON, tornando-a mais legível para humanos.

Para combinar várias opções, separamos elas com a barra vertical (|).

A função json_decode faz o contrário, 
ela aceita uma string JSON como parâmetro e retorna o valor PHP correspondente.

Essa função também aceita um segundo parâmetro opcional (`$assoc`).
Esse parâmetro serve para especificar se o valor retornado deve ser um array associativo.
true = array associativo
false = objeto
O padrão é false.s
*/

$data = [
	'nome' => 'Willian',
	'idade' => 32,
	'país' => 'Brasil'
];

$json = json_encode($data, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);

/*echo "<pre>";
echo $json;
echo "</pre>";*/

$response = json_decode($json, true);
echo $response['idade'];