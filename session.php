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

  if ( isset ( $_SESSION [ "id"] ) ) {

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
   
   $this->id = $_SESSION [ "id" ] ;
   $this->username = $_SESSION [ "username" ] ;
   $this->password = $_SESSION [ "password" ] ;

  } else {

   return false ;

  }

 }

 /**
  * Gera uma hash única para uma sessão de usuário.
  */
 private function get_hash ( ) : string {

  return hash ( "md5" , $this->username . $this->password ) ;

 }

 /**
  * Inicializa uma nova sessão com um novo id baseado no usuário e senha especificados.
  */
 public function create_session ( ) {

  $_SESSION [ "id" ] = $this->id ;
  $_SESSION [ "username" ] = $this->username ;
  $_SESSION [ "password" ] = $this->password ;

 }

}