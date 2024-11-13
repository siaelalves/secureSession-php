<?php
namespace security ;

enum GRANT_TYPE : string {

 case AUTHORIZATION = "authorization_code" ;

 case EXCHANGE = "exchange_token" ;

 case REFRESH = "refresh_token" ;

}