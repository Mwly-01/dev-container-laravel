<?php

namespace App\Swagger;

use OpenApi\Annotations as OA;


/** 
*@OA\info{
*  title:"Api en Laravel"
*  version:"1.0.0"
*  description:"Documentación de la API en Laravel"
* }
* @OA\Server{
*  url=L5_SWAGGER_CONST_HOST
*  description="Servidor local"
* }
* @OA\SecurityScheme{
*  securityScheme="bearerAuth"
*  type="http"
*  scheme="bearer"
*  bearerFormat="JWT"
* }
* @OA\Tag{name="Auth", description="Autheticación y perfil"}
*
*/

class OpenApi{}

