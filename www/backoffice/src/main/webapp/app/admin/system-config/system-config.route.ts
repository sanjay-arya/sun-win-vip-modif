import { SystemConfigComponent } from './system-config.component';
import { Routes } from '@angular/router';
import { Authority } from 'app/shared/constants/authority.constants';
import { UserRouteAccessService } from 'app/core/auth/user-route-access-service';

export const systemConfigRoute: Routes = [
  {
    path: '',
    component: SystemConfigComponent,
    data: {
      authorities: [Authority.ADMIN, Authority.MKT, Authority.CS],
      pageTitle: 'system-config.title',
    },
    canActivate: [UserRouteAccessService],
  },
];
