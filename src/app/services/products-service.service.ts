// Importamos los decoradores y servicios necesarios de Angular 

import { Injectable } from '@angular/core'; 

import { HttpClient } from '@angular/common/http'; 

 

@Injectable({ 

  // Hacemos que este servicio esté disponible a nivel global en toda la app 

  providedIn: 'root' 

}) 

export class ProductsService { 

 

  // URL del backend que maneja los productos 

  url = 'http://localhost/Plata_desarr_Tapsi_68/Backend/crud.php'; 

 

  // Variables para controlar la paginación 

  private currentPage = 0;     // Página actual que se ha cargado 

  private pageSize = 10;       // Número de artículos que se quieren cargar por página 

 

  // Inyectamos el servicio HttpClient para hacer peticiones HTTP 

  constructor(private http: HttpClient) { } 

 

  /** 

   * Recupera los productos del backend usando paginación. 

   * @param page Número de página que se quiere cargar (por defecto 0). 

   * @param limit Cantidad de productos por página (por defecto 10). 

   * 

   * Esta función hace una petición POST al backend, enviando la acción 'listarProductos' 

   * junto con la página y el límite que se desea obtener. 

   */ 

  recuperarTodos(page: number = 0, limit: number = this.pageSize) { 

    return this.http.post(`${this.url}`, { 

      accion: 'listarProductos', // Acción que debe procesar el backend 

      pagina: page,              // Página solicitada 

      limite: limit              // Número de productos por página 

    }); 

  } 

 

  /** 

   * Incrementa la página actual y llama a `recuperarTodos` para obtener más productos. 

   * 

   * Esta función es utilizada por el scroll infinito para cargar más datos cada vez 

   * que el usuario llega al final de la lista. 

   */ 

  loadMore() { 

    this.currentPage++;                   // Aumenta el número de página actual 

    return this.recuperarTodos(this.currentPage); // Llama a recuperarTodos con la nueva página 

  } 

 

} 

 