<?php
class Pizza
{
	public $id;
 	public $sabor;
  	public $cantidad;
    public $tipo;
    public $foto;
    
    public static function TraerTodoLasPizzas()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from pizza");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "Pizza");		
	}

	public static function TraerUnaPizza($id) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from pizza where id = $id");
			$consulta->execute();
			$cdBuscado= $consulta->fetchObject('Pizza');
			return $cdBuscado;				
    }

	public static function TraerUnaPizzaPorSabor($sabor) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select cantidad from pizza where sabor = :sabor");
			//$cant = $consulta->execute();
			//$cdBuscado= $consulta->fetchObject('Pizza');
			$consulta->bindValue(':sabor', $sabor, PDO::PARAM_STR);
			$consulta->execute();
			$cantidad= $consulta->fetch();
			return $cantidad;				
    }

	public function InsertarLaPizzaParametros()
	{			
			   $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			   $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into pizza(id,sabor,tipo,cantidad,foto)values(null,:sabor,:tipo,:cantidad,:foto)");
			   $consulta->bindParam(':sabor',$this->sabor);
			   $consulta->bindParam(':tipo', $this->tipo);
			   $consulta->bindParam(':cantidad',$this->cantidad);
			   $consulta->bindParam(':foto',$this->foto);
			   $consulta->execute();		
			   return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

	public function ModificarPizzaParametros()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update pizza 
				set sabor=:sabor,
                cantidad=:cantidad,
                tipo=:tipo,
                foto=:foto
				WHERE id=:id");
			$consulta->bindValue(':id',$this->id);
			$consulta->bindValue(':sabor',$this->sabor);
			$consulta->bindValue(':cantidad', $this->cantidad);
            $consulta->bindValue(':tipo',$this->tipo);
            $consulta->bindValue(':foto',$this->foto);
			$consulta->execute();
			return $this->id;
	 }

	public function BorrarPizza($id)
	 {
	 		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			
			$consulta =$objetoAccesoDato->RetornarConsulta("
				DELETE FROM pizza  
				WHERE id= $id");	
				//$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();
				
	 }
}
?>