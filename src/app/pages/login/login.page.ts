import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import {IonInput, IonItem,IonList, IonButton, IonCard, IonLabel, IonContent, IonImg} from '@ionic/angular/standalone';
import { Router } from '@angular/router';
import { AuthService } from '../../services/auth.service'; 

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
  standalone: true,
  imports: [CommonModule, FormsModule, IonInput, IonItem, IonList, IonButton, IonCard, IonLabel, IonContent, IonImg,]
})
export class LoginPage implements OnInit {
  email: string = '';
  password: string = '';

//variable para controlar la visibilidad del loader
  isLoading : boolean = true;
  imagePath: string = 'https://www.icegif.com/wp-content/uploads/luffy-icegif-26.gif';

  constructor(private authService: AuthService, private router: Router) {}

  async ngOnInit() {


    // Espera 5 segundos para simular la carga de datos
    await new Promise (resolve => setTimeout(resolve,5000));

    // Cuando termina la carga , oculta la barra de progreso
    this.isLoading = false;

  }

  login() {
    if (!this.email || !this.password) {
      alert('Por favor, ingresa todos los datos.');
      return;
    }
    this.authService.login(this.email, this.password).subscribe(response => {
      if (response.status === 'success') {
        this.router.navigate(['/products']);
      } else {
        alert(response.message);
      }
    }, error => {
      console.error(error);
      alert('Error en la conexión con el servidor');
    });
  }

  irARegister(event?: Event) {
    if (event) event.preventDefault();
    this.router.navigate(['/register']);
  
  
  }
}