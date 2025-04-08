import { ProductsService } from './../../services/products-service.service';
import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonContent, IonHeader, IonTitle, IonToolbar, IonButton, IonButtons , IonRefresher, IonRefresherContent, IonIcon, IonSpinner, IonText  , IonItem, IonLabel, IonList,IonThumbnail } from '@ionic/angular/standalone';

@Component({
  selector: 'app-products',
  templateUrl: './products.page.html',
  styleUrls: ['./products.page.scss'],
  standalone: true,
  imports: [IonIcon, IonContent, IonHeader, IonTitle, IonToolbar, CommonModule, FormsModule,IonButton, IonButtons , IonRefresher,
    IonRefresherContent, IonSpinner , IonText , IonItem, IonLabel, IonList,IonThumbnail]
})
export class ProductsPage implements OnInit {

  articulos: any[] = [];
  isLoading = false;
  errorMessage = '';

  constructor( private productoService: ProductsService) { }

  ngOnInit() {
    this.cargarArticulos();
  }


  cargarArticulos() {
    this.isLoading = true;
    this.errorMessage = '';

    this.productoService.recuperarTodos().subscribe(
      (result: any) => {
        this.articulos =  result;
        this.isLoading = false;
        console.log("response", this.articulos);
      },
      (error) => {
        this.errorMessage = 'Error al cargar los productos';
        this.isLoading = false;
        console.error("Error al recuperar los datos", error);
      }
    );
  }

  refrescarArticulos(event: any) {
    this.cargarArticulos();
    event.target.complete();
  }

}