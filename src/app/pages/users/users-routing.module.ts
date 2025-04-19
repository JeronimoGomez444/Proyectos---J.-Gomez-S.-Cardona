// pages/products/products.routes.ts
import { Routes, RouterModule } from '@angular/router';

export const routes: Routes = [

  {
    path: 'users',
    loadComponent: () => import('../users/users.page').then(m => m.UsersPage)
  },
];

export const AppRoutingModule = RouterModule.forRoot(routes);