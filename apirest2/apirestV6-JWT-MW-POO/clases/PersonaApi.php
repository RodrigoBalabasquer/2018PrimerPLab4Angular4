<?php
require_once 'Persona.php';
require_once 'IApiUsable.php';
//require_once 'AutentificadorJWT.php';
//require_once '../composer/vendor/autoload.php';
//use Firebase\JWT\JWT;

class PersonaApi extends Persona implements IApiUsable
{   
    //private static $aud = null;
    //private static $clave = "ClaveSuperSecreta";
    public function TraerTodos($request, $response, $args) {
      	$todosLasPersonas=Persona::TraerTodoLasPersonas();
     	$newresponse = $response->withJson($todosLasPersonas, 200);  
    	return $newresponse;
    }

 	public function TraerUno($request, $response, $args) {
     	$id=$args['id'];
        $laPersona=Persona::TraerUnaPersona($id);
        if(!$laPersona)
        {
            $objDelaRespuesta= new stdclass();
            $objDelaRespuesta->error="No esta la persona";
            $NuevaRespuesta = $response->withJson($objDelaRespuesta, 500); 
        }else
        {
            $NuevaRespuesta = $response->withJson($laPersona, 200); 
        }     
        return $NuevaRespuesta;
    }
     
    public function CargarUno($request, $response, $args) {
     	
        $objDelaRespuesta= new stdclass();
        
        $ArrayDeParametros = $request->getParsedBody();
        
        $nombre= $ArrayDeParametros["nombre"];
        $mail = $ArrayDeParametros['mail'];
        $sexo = $ArrayDeParametros['sexo'];
        $foto = $ArrayDeParametros['foto'];
        $password = $ArrayDeParametros['password'];
        
        $miPersona = new Persona();
        $miPersona->nombre=$nombre;
        $miPersona->mail=$mail;
        $miPersona->sexo=$sexo;
        $miPersona->foto=$foto;

        $miPersona->password= $password;
        $miPersona->InsertarLaPersonaParametros();

        $objDelaRespuesta->respuesta="Se guardo la persona.";
        //$objDelaRespuesta->respuesta=$nombre;
        return $response->withJson($objDelaRespuesta, 200);
        
    }
      
      public function BorrarUno($request, $response, $args) {
          $objDelaRespuesta= new stdclass();
          
          $ArrayDeParametros = $request->getParsedBody();
  
          $id= $ArrayDeParametros["id"];

          $miPersona = new Persona();

          $cantidadDeBorrados=$miPersona->BorrarPersona($id);

          $objDelaRespuesta->respuesta="Se borro $cantidadDeBorrados personas.";
          return $response->withJson($objDelaRespuesta, 200);
        }
     
     public function ModificarUno($request, $response, $args) {
     	$ArrayDeParametros = $request->getParsedBody();
	    $miPersona = new Persona();
	    $miPersona->id=$ArrayDeParametros['id'];
	    $miPersona->nombre=$ArrayDeParametros['nombre'];
        $miPersona->mail=$ArrayDeParametros['mail'];
        $miPersona->sexo=$ArrayDeParametros['sexo'];
        $miPersona->foto=$ArrayDeParametros['foto'];
        $miPersona->password=$ArrayDeParametros['password'];

	   	$resultado = $miPersona->ModificarPersonaParametros();
	   	$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->resultado=$resultado;
        $objDelaRespuesta->tarea="modificar";
		return $response->withJson($objDelaRespuesta, 200);		
    }
}