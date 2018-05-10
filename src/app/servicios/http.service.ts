import { log } from 'util';
import { Injectable } from '@angular/core';

import { Http, Response,RequestOptions,Headers } from '@angular/http';

import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/catch';
import 'rxjs/add/operator/map';
import 'rxjs/add/operator/toPromise';

@Injectable()
export class HttpService {

  URl = "http://localhost:8080/apirest2/apirestV6-JWT-MW-POO/persona/";

  constructor( public http: Http ) { }

  dameTodasLasPromesas(url:string){
    
    return this.http.get(this.URl).toPromise().then(this.extraerDatos).catch(this.manejadorError);

  }

  teDoyUnaPromesaAlta(objetoAlta:any){
        var param = {nombre:objetoAlta.nombre,password:objetoAlta.password,mail:objetoAlta.email,sexo:objetoAlta.sexo,foto:objetoAlta.foto};
        var paramString = JSON.stringify(param);
        let header = new Headers();
        header.append('Content-Type','application/json');
        return this.http.post(this.URl,paramString,{headers:header}).toPromise().then(this.extraerDatos).catch(this.manejadorError);
    
  }
  teDoyUnaPromesaModificada(objetoAlta:any){
        var param = {id:objetoAlta.id,nombre:objetoAlta.nombre,password:objetoAlta.password,mail:objetoAlta.email,sexo:objetoAlta.sexo,foto:objetoAlta.foto};
        var paramString = JSON.stringify(param);
        let header = new Headers();
        header.append('Content-Type','application/json');
        return this.http.put(this.URl,paramString,{headers:header}).toPromise().then(this.extraerDatos).catch(this.manejadorError);
    
  }
  teDoyUnaPromesaBaja(url:string,valorId:string){
    var param = {id:valorId};
    var paramString = JSON.stringify(param);
    let header = new Headers();
    header.append('Content-Type','application/json');
    return this.http.post(this.URl+url,paramString,{headers:header}).toPromise().then(this.extraerDatos).catch(this.manejadorError);
  } 

  manejadorError(error:Response|any){
    //return error;
    console.error(error.message || error);
    return Promise.reject(error.message || error);
  }

extraerDatos(respuesta:Response){
    return respuesta.json()||{};
  }  

}
