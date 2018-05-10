<?php
require_once 'Pizza.php';
require_once 'IApiUsable2.php';

class PizzaApi extends Pizza implements IApiUsable2
{
    public function TraerTodos($request, $response, $args) 
    {
        $todosLasPizzas=Pizza::TraerTodoLasPizzas();
        $newresponse = $response->withJson($todosLasPizzas, 200);  
        return $newresponse;
    }
    public function TraerUno($request, $response, $args) 
    {
        $id=$args['id'];
        $laPizza=Pizza::TraerUnaPizza($id);
        if(!$laPizza)
        {
            $objDelaRespuesta= new stdclass();
            $objDelaRespuesta->error="No esta la pizza";
            $NuevaRespuesta = $response->withJson($objDelaRespuesta, 500); 
        }else
        {
            if($laPizza->cantidad != "0")
                $NuevaRespuesta = $response->withJson($laPizza, 200); 
            else
                $NuevaRespuesta = $response->withJson("No hay stock", 200); 
        }     
        return $NuevaRespuesta;
    }
    
    public function TraerCantidad($request, $response, $args) 
    {
        $sabor=$args['sabor'];
        $cant=Pizza::TraerUnaPizzaPorSabor($sabor);
        if(!$cant)
        {
            $objDelaRespuesta= new stdclass();
            $objDelaRespuesta->error="No esta la pizza";
            $NuevaRespuesta = $response->withJson($objDelaRespuesta, 500); 
        }else
        {
            if($cant['cantidad'] != "0"){
                $cantidad = $cant['cantidad'];
                $NuevaRespuesta = $response->withJson("Hay $cantidad pizzas en stock", 200); 
            }
            else
                $NuevaRespuesta = $response->withJson("No hay stock", 200); 
        }    
        //$NuevaRespuesta = $response->withJson($cant, 200); 
        return $NuevaRespuesta;
    }

    public function CargarUno($request, $response, $args) {
        
       $objDelaRespuesta= new stdclass();
       
       $ArrayDeParametros = $request->getParsedBody();

       $sabor= $ArrayDeParametros["sabor"];
       $cantidad = $ArrayDeParametros['cantidad'];
       $tipo = $ArrayDeParametros['tipo'];
       $foto = $ArrayDeParametros['foto'];
       
       $miPizza= new Pizza();
       $miPizza->sabor=$sabor;
       $miPizza->tipo=$tipo;
       $miPizza->cantidad=$cantidad;
       $miPizza->foto=$foto;

       $miPizza->InsertarLaPizzaParametros();

       
       $objDelaRespuesta->respuesta="Se guardo la pizza.";
       //$objDelaRespuesta->respuesta=$sabor;
       
       return $response->withJson($objDelaRespuesta, 200);
       
   }
   public function ModificarUno($request, $response, $args) {
     	$ArrayDeParametros = $request->getParsedBody();
	    $miPizza = new Pizza();
	    $miPizza->id=$ArrayDeParametros['id'];
	    $miPizza->sabor=$ArrayDeParametros['sabor'];
        $miPizza->cantidad=$ArrayDeParametros['cantidad'];
        $miPizza->tipo=$ArrayDeParametros['tipo'];
        $miPizza->foto=$ArrayDeParametros['foto'];

	   	$resultado = $miPizza->ModificarPizzaParametros();
	   	$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->resultado=$resultado;
        $objDelaRespuesta->tarea="modificar";
		return $response->withJson($objDelaRespuesta, 200);	
    }
   public function BorrarUno($request, $response, $args) {
     	
        $objDelaRespuesta= new stdclass();
          
        $ArrayDeParametros = $request->getParsedBody();

        $id= $ArrayDeParametros["id"];

        $Pizza = new Pizza();

        $cantidadDeBorrados=$Pizza->BorrarPizza($id);
        if($cantidadDeBorrados>0)
        {
            $objDelaRespuesta->respuesta="Se borro $cantidadDeBorrados pizzas.";
        }
        else
        {
            $objDelaRespuesta->resultado="no Borro nada!!!";
        }

        return $response->withJson($objDelaRespuesta, 200);
    }
}

?>