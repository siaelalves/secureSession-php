<?php
namespace security ;

/**
 * Controla e organiza as sessões de usuário do website.
 */
class session {

 /**
  * ID único da sessão do usuário.
  */
 public string $id ;

 /**
  * Nome de usuário da sessão.
  */
 public string $username ;

 /**
  * Senha do usuário da sessão.
  */
 public string $password ;



 public function __construct ( string $username = "" , string $password = "" ) {
  
  $this->username = $username ;
  $this->password = $password ;
  $this->id = $this->get_hash ( ) ;

 }

 /**
  * Verifica se uma sessão do usuário está aberta.
  * @return bool Retorna True se a sessão estiver aberta e False não houver sessão.
  */
 public function exists ( ) : bool {
  
  if ( session_status ( ) == PHP_SESSION_ACTIVE ) {
   
   if ( $_SESSION [ "id" ] == $this->get_hash ( ) ) {

    return true ;

   }

  }

  return false ;

 }

 /**
  * Restaura uma sessão de usuário.
  */
 public function restore_session ( ) {

  if ( $this->exists ( ) ) {
   
   session_start ( ) ;
   $this->id = $_SESSION [ "id" ] ;
   $this->username = $_SESSION [ "username" ] ;
   $this->password = $_SESSION [ "password" ] ;
   session_id ( $this->id ) ;

  } else {

   return false ;

  }

 }
 
 /**
  * Inicializa uma nova sessão com um novo id baseado no usuário e senha especificados.
  */
  public function create_session ( ) {

   session_id ( $this->id ) ;
   session_start ( );
   $_SESSION [ "id" ] = $this->id ;
   $_SESSION [ "username" ] = $this->username ;
   $_SESSION [ "password" ] = $this->password ;   
 
  }

  public function destroy_session ( ) {

   $this->id = "" ;
   $this->username = "" ;
   $this->password = "" ;
   session_destroy ( ) ;

  }

  /**
   * Verifica se o login dessa sessão é válido ou não.
   * @return bool Retorna True se o login existir no banco de dados. 
   * Retorna False se não existir.
   */
  public function is_valid ( ) : bool {

   if ( $this->username == "siaelalves" ) {

    if ( $this->password == "siaelcode" ) {

      return true ;

    }

   }

   return false ;

  }

 /**
  * Gera uma hash única para uma sessão de usuário.
  */
 private function get_hash ( ) : string {

  return hash ( "md5" , $this->username . $this->password ) ;

 }

}