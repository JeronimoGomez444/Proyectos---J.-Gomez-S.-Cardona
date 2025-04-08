import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import {IonInput, IonItem,IonList,IonButton,IonCard,IonLabel,IonContent} from '@ionic/angular/standalone';
import { Router } from '@angular/router';
import { AuthService } from '../../services/auth.service'; 

@Component({
  selector: 'app-register',
  templateUrl: './register.page.html',
  styleUrls: ['./register.page.scss'],
  standalone: true,
  imports: [CommonModule, FormsModule, IonInput, IonItem, IonList, IonButton, IonCard, IonLabel, IonContent]
})
export class RegisterPage implements OnInit {
  username: string = '';
  email: string = '';
  password: string = '';

  constructor(private authService: AuthService, private router: Router) {}

  ngOnInit() {}

  register() {
    if (!this.username || !this.email || !this.password) {
      alert('Por favor, completa todos los campos.');
      return;
    }
    this.authService.register(this.username, this.email, this.password).subscribe(response => {
      if (response.status === 'success') {
        alert(response.message);
        this.router.navigate(['/login']);
      } else {
        alert(response.message);
      }
    }, error => {
      console.error(error);
      alert('Error en la conexión con el servidor');
    });
  }
  
  irALogin(event?: Event) {
    if (event) event.preventDefault();
    this.router.navigate(['/login']);
  }
}
