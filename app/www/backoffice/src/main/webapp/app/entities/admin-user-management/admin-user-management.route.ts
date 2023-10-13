import { IUser, User } from './../../core/user/user.model';
import { Injectable } from '@angular/core';
import { Resolve, ActivatedRouteSnapshot, Routes } from '@angular/router';
import { Observable, of } from 'rxjs';

import { AdminUserManagementComponent } from './admin-user-management.component';
import { AdminUserManagementDetailComponent } from './admin-user-management-detail.component';
import { AdminUserManagementUpdateComponent } from './admin-user-management-update.component';
import { UserService } from '../../core/user/user.service';
import { Authority } from 'app/shared/constants/authority.constants';
import { UserRouteAccessService } from 'app/core/auth/user-route-access-service';

@Injectable({ providedIn: 'root' })
export class AdminUserManagementResolve implements Resolve<IUser> {
  constructor(private service: UserService) {}

  resolve(route: ActivatedRouteSnapshot): Observable<IUser> {
    const id = route.params['login'];
    if (id) {
      return this.service.find(id);
    }
    return of(new User());
  }
}

export const adminUserManagementRoute: Routes = [
  {
    path: '',
    component: AdminUserManagementComponent,
    data: {
      defaultSort: 'id,asc',
      authorities: [Authority.ADMIN, Authority.MKT, Authority.CS],
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':login/view',
    component: AdminUserManagementDetailComponent,
    resolve: {
      user: AdminUserManagementResolve,
    },
    data: {
      authorities: [Authority.ADMIN, Authority.MKT, Authority.CS],
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: 'new',
    component: AdminUserManagementUpdateComponent,
    resolve: {
      user: AdminUserManagementResolve,
    },
    data: {
      authorities: [Authority.ADMIN, Authority.MKT, Authority.CS],
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':login/edit',
    component: AdminUserManagementUpdateComponent,
    resolve: {
      user: AdminUserManagementResolve,
    },
    data: {
      authorities: [Authority.ADMIN, Authority.MKT, Authority.CS],
    },
    canActivate: [UserRouteAccessService],
  },
];
