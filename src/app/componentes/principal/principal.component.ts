import { Component, OnInit } from '@angular/core';
import { Persona} from '../../clases/persona';
import { PersonaService} from '../../servicios/persona.service';

@Component({
  selector: 'app-principal',
  templateUrl: './principal.component.html',
  styleUrls: ['./principal.component.css']
})
export class PrincipalComponent implements OnInit {

  public listadoParaCompartir: Array<any>;
  public miServicioPersona:PersonaService;
  public editar:boolean;
  public persona:Persona;
  
  public verFormularioMostrarPersona = false;

  constructor(servicioPersona:PersonaService) {     
    this.miServicioPersona = servicioPersona;
    this.persona = new Persona();
    //this.llamaServicePromesa();
  }

  public llamaServicePromesa(){
    //console.log("llamaServicePromesa");
    this.miServicioPersona.listarPersonaPromesa().then(
      (listadoPromesa) => { this.listadoParaCompartir = listadoPromesa;}
    );
  }

  public Borrar(id:string)
  {
    this.miServicioPersona.borrarPersonaPromesa(id).then(
      (listadoPromesa) => { this.llamaServicePromesa()}
    );
  }
  public borrarPersona(id:string)
  {
    this.Borrar(id);
  }
  public Modificar(persona:any)
  {
    this.persona.id = persona.id;
    this.persona.nombre = persona.nombre;
    this.persona.email = persona.email;
    this.persona.sexo = persona.sexo;
    this.persona.password = persona.password;
  }

  public Mostrar(persona: Persona)
  {
    this.persona = persona;
    this.verFormularioMostrarPersona = true;
  }
  public DarAlta()
  {
    if(this.persona.id == null){
      if(this.persona.sexo == "M")
        this.persona.foto = "rodrigo.png";
      else
      {
        this.persona.foto = "sabrina.png";
        this.persona.sexo == "F";
      }
      this.miServicioPersona.guardarPersonaPromesa(this.persona).then(
      () => { this.llamaServicePromesa() });
    }
    else
    { 
      if(this.persona.sexo == "M")
        this.persona.foto = "rodrigo.png";
      else
      {
        this.persona.foto = "sabrina.png";
        this.persona.sexo == "F";
      }
      this.miServicioPersona.modificarPersonaPromesa(this.persona).then(
      () => { this.llamaServicePromesa() });
    }
  }
  ngOnInit() {
  }

}
