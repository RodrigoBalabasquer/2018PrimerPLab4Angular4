import { Component, OnInit, Input,Output,EventEmitter} from '@angular/core';
import { Persona} from '../../clases/persona';
@Component({
  selector: 'app-persona',
  templateUrl: './persona.component.html',
  styleUrls: ['./persona.component.css']
})
export class PersonaComponent implements OnInit {
@Output() seBorroPersona: EventEmitter<any>= new EventEmitter<any>();  
@Input()
  
  public unaPersona: Persona;
  constructor() { }
  Borrar(id:string)
  {
    this.seBorroPersona.emit(id);
  }
  ngOnInit() {
  }

}
