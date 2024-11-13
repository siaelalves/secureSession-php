<?php
namespace security ;

/**
 * Esta classe organiza as informações obtidas de um token quando este é
 * obtido a partir de uma autenticação OAuth 2.0. Cada website controla 
 * os dados de um token à sua maneira, de modo que as propriedades 
 * presentes nesta classe precisam ser obtidas de maneiras diferentes 
 * conforme o serviço OAuth utilizado. Para dados de token que não 
 * correspondam às propriedades desta classe, utilize a propriedade 
 * $data.
 */
class token {

 /** @var GRANT_TYPE Tipo de autorização concedida pela aplicação. */
 public GRANT_TYPE $grant_type ;

 /** @var KEYS Chave id do cliente que está solicitando o token. */
 public KEYS $client_id ;

 /** @var KEYS Chave secreta do cliente que solicitou acesso ao token. */
 public KEYS $client_secret ;

 /** @var string URL para onde direcionar o usuário depois da verificação do token. */
 public string $redirect_url ;

 /** @var string URL a ser utilizada para se obter o token. */
 public string $token_url ;

 /** @var string Valor do token de acesso. */
 public string $access_token ;

 /** @var TOKEN_TYPE Tipo de token. */
 public TOKEN_TYPE $token_type ;

 /** @var int Tempo em segundos até o token expirar. */
 public int $expires_in ;

 /** @var array Outros dados do token. Trata-se de uma propriedade genérica 
  * para ser utilizada para armazenar dados do token que não correspondam 
  * às propriedades anteriores. Recomanda-se preencher os dados usando uma 
  * matriz associativa, já que esta pode ser convertida em JSON se necessário.
  */
 public array $data ;

}