import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';


@Injectable({
  providedIn: 'root'
})
export class ProductsService {

  url = 'http://localhost//Backend/crud.php';


  constructor(private http: HttpClient) { }

  recuperarTodos() {
    return this.http.post(`${this.url}`, { accion: 'listarProductos' });
  }
}