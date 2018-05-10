import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule, Routes } from '@angular/router';
import { PrincipalComponent } from '../componentes/principal/principal.component';

const MiRuteo = [
  {path: '' , component: PrincipalComponent},
  {path: 'Principal' , component: PrincipalComponent},
];


@NgModule({
  imports: [
    CommonModule,
    RouterModule.forRoot(MiRuteo)    
  ],
  declarations: [],
  exports: [
    RouterModule
  ]
})
export class RuteoModule { }
