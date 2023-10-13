import { Injectable } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
import { Resolve, ActivatedRouteSnapshot, Routes, Router } from '@angular/router';
import { Observable, of, EMPTY } from 'rxjs';
import { flatMap } from 'rxjs/operators';

import { Authority } from 'app/shared/constants/authority.constants';
import { UserRouteAccessService } from 'app/core/auth/user-route-access-service';
import { IXocdiaChatbox, XocdiaChatbox } from 'app/shared/model/xocdia-chatbox.model';
import { XocdiaChatboxService } from './xocdia-chatbox.service';
import { XocdiaChatboxComponent } from './xocdia-chatbox.component';
import { XocdiaChatboxDetailComponent } from './xocdia-chatbox-detail.component';
import { XocdiaChatboxUpdateComponent } from './xocdia-chatbox-update.component';

@Injectable({ providedIn: 'root' })
export class XocdiaChatboxResolve implements Resolve<IXocdiaChatbox> {
  constructor(private service: XocdiaChatboxService, private router: Router) {}

  resolve(route: ActivatedRouteSnapshot): Observable<IXocdiaChatbox> | Observable<never> {
    const id = route.params['id'];
    if (id) {
      return this.service.find(id).pipe(
        flatMap((xocdiaChatbox: HttpResponse<XocdiaChatbox>) => {
          if (xocdiaChatbox.body) {
            return of(xocdiaChatbox.body);
          } else {
            this.router.navigate(['404']);
            return EMPTY;
          }
        })
      );
    }
    return of(new XocdiaChatbox());
  }
}

export const xocdiaChatboxRoute: Routes = [
  {
    path: '',
    component: XocdiaChatboxComponent,
    data: {
      authorities: [Authority.USER, Authority.MKT, Authority.CS],
      pageTitle: 'txcbApp.xocdiaChatbox.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/view',
    component: XocdiaChatboxDetailComponent,
    resolve: {
      xocdiaChatbox: XocdiaChatboxResolve,
    },
    data: {
      authorities: [Authority.USER, Authority.MKT, Authority.CS],
      pageTitle: 'txcbApp.xocdiaChatbox.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: 'new',
    component: XocdiaChatboxUpdateComponent,
    resolve: {
      xocdiaChatbox: XocdiaChatboxResolve,
    },
    data: {
      authorities: [Authority.USER, Authority.MKT, Authority.CS],
      pageTitle: 'txcbApp.xocdiaChatbox.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/edit',
    component: XocdiaChatboxUpdateComponent,
    resolve: {
      xocdiaChatbox: XocdiaChatboxResolve,
    },
    data: {
      authorities: [Authority.USER, Authority.MKT, Authority.CS],
      pageTitle: 'txcbApp.xocdiaChatbox.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
];
