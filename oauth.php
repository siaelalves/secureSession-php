<?php
namespace security ;

class oauth {

 /** @var string Chave pública do cliente. */
 public string $client_id ;
 
 /** @var string Chave secreta e única do cliente. */
 public string $client_secret ;


 /** @var string URL de autorização. */
 public string $authorize_url ;

 /** @var string URL base de onde retornarão todas as solicitações. */
 public string $api_url_base ;

 /** @var string URL para onde o usuário será redirecionado após obtenção to token. */
 public string $redirect_url ;

 /** @var token Token a ser obtido. */
 public token $token ;


 /** @var string Resposta retorna pela aplicação. Isso varia de serviço para serviço. */
 public string $response_type ;

 /** @var string Área de permissão concedida pela aplicação. */
 public string $scope ;

 /** @var string Sinaliza o status da solicitação. */
 public string $state ; 

 /** @var string Código de autorização do login oauth que será usado 
  * para trocar por um token de acesso. */
 public string $code ;

 function __construct ( ){

  

 }

 /**
 * Obtém o valor do token de acesso. Utiliza o método GET ou POST na URL 
 * especificada.
 * @param string $token_url URL onde se pode obter o token de acesso.
 * @return 
 */
 public function get_token ( string $token_url , array $parameters , REQUEST_METHOD $method ) : token|bool {

  $token_params = http_build_query ( $parameters ) ;
  $token_data = "" ;

  if ( $method == REQUEST_METHOD::GET ) {

   $token_data = json_decode ( file_get_contents( $token_url . "?" . $token_params ) , true ) ;

  } else if ( $method == REQUEST_METHOD::POST ) {

   $curl = curl_init ( ) ;
   curl_setopt ( $curl , CURLOPT_URL , $token_url ) ;
   curl_setopt ( $curl , CURLOPT_POST , 1 ) ;
   curl_setopt ( $curl , CURLOPT_POSTFIELDS , $token_params ) ;
   curl_setopt ( $curl , CURLOPT_RETURNTRANSFER, true);
   
   $response = curl_exec ( $curl ) ;
   $token_data = json_decode ( $response , true ) ;

  } else {

   echo "O método para obter o token é inválido. Utilize GET ou POST." ;
   return false ;

  }

  if ( $token_data == "" ) {

   echo "Ocorreu algum erro na obtenção do token. Método utilizado: " . $method->value . ". Token vazio." ;
   return false ;

  }

  $token = new token ( ) ;
  $token->access_token = $token_data [ "access_token" ] ;
  return $token ;

 }

}