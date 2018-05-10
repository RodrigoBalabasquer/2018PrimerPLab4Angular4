import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule} from '@angular/forms';
import { HttpModule } from "@angular/http";
import { RouterModule, Routes } from '@angular/router';

import {RuteoModule} from './ruteo/ruteo.module';

import { AppComponent } from './app.component';
import { PrincipalComponent } from './componentes/principal/principal.component';

import { HttpService} from './servicios/http.service';
import { PersonaService } from './servicios/persona.service';
import { PersonaComponent } from './componentes/persona/persona.component';

@NgModule({
  declarations: [
    AppComponent,
    PrincipalComponent,
    PersonaComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    RuteoModule,
    HttpModule
  ],
  providers: [HttpService,PersonaService],
  bootstrap: [AppComponent]
})
export class AppModule { }
