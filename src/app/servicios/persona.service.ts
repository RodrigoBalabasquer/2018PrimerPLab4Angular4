import { Injectable } from '@angular/core';
import { HttpService } from './http.service';
import { Persona } from '../clases/persona';

@Injectable()
export class PersonaService {

  constructor(public miserviciohttp:HttpService) { }
  
    public listarPersonaPromesa(): Promise<Array<Persona>> {
      let promesa: Promise<Array<Persona>> = new Promise((resolve, reject) =>
          {
            this.miserviciohttp.dameTodasLasPromesas('')        
                .then(datos=>{  console.log(datos);
                                let miArray: Array<Persona> = new Array<Persona>();
                                for (let unDato of datos) {
                                  //console.log(unDato.nombre);     
                                  miArray.push(new Persona(unDato.id, unDato.nombre, unDato.mail, unDato.sexo,unDato.password, unDato.foto));                        
                                }
                                resolve(miArray);
                              })
                .catch(error=>{console.log(error);});
          }
        );
       return promesa;
      }
    public guardarPersonaPromesa(unaPersona:Persona): Promise<Persona> {
      
          let promesaAlta: Promise<Persona> = new Promise((resolve,reject) =>
              {
                this.miserviciohttp.teDoyUnaPromesaAlta(unaPersona)
                        .then(datos=>{ console.log("Datos Alta:",datos);
                                       resolve(unaPersona);
                                     } 
                             )
                        .catch(error=>{console.log("Error Alta:",error);});      
              }
            )
            return promesaAlta;
          }
    public modificarPersonaPromesa(unaPersona:Persona): Promise<Persona> {
      
          let promesaAlta: Promise<Persona> = new Promise((resolve,reject) =>
              {
                this.miserviciohttp.teDoyUnaPromesaModificada(unaPersona)
                        .then(datos=>{ console.log("Datos Alta:",datos);
                                       resolve(unaPersona);
                                     } 
                             )
                        .catch(error=>{console.log("Error Alta:",error);});      
              }
            )
            return promesaAlta;
          }
    public borrarPersonaPromesa(idPersona:string): Promise<string> {
        
      let promesaBaja: Promise<string> = new Promise((resolve,reject) =>
        {
          this.miserviciohttp.teDoyUnaPromesaBaja("borrar",idPersona)
                    .then(datos=>{ console.log("Datos Baja:",datos);
                                   resolve(idPersona);
                                 } 
                          )
                     .catch(error=>{console.log("Error Baja:",error);});      
        }
      )
    return promesaBaja;
}         
}
