import { Injectable } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
import { Resolve, ActivatedRouteSnapshot, Routes, Router } from '@angular/router';
import { Observable, of, EMPTY } from 'rxjs';
import { flatMap } from 'rxjs/operators';

import { Authority } from 'app/shared/constants/authority.constants';
import { UserRouteAccessService } from 'app/core/auth/user-route-access-service';
import { IXocdia, Xocdia } from 'app/shared/model/xocdia.model';
import { XocdiaService } from './xocdia.service';
import { XocdiaComponent } from './xocdia.component';
import { XocdiaDetailComponent } from './xocdia-detail.component';
import { XocdiaUpdateComponent } from './xocdia-update.component';

@Injectable({ providedIn: 'root' })
export class XocdiaResolve implements Resolve<IXocdia> {
  constructor(private service: XocdiaService, private router: Router) {}

  resolve(route: ActivatedRouteSnapshot): Observable<IXocdia> | Observable<never> {
    const id = route.params['id'];
    if (id) {
      return this.service.find(id).pipe(
        flatMap((xocdia: HttpResponse<Xocdia>) => {
          if (xocdia.body) {
            return of(xocdia.body);
          } else {
            this.router.navigate(['404']);
            return EMPTY;
          }
        })
      );
    }
    return of(new Xocdia());
  }
}

export const xocdiaRoute: Routes = [
  {
    path: '',
    component: XocdiaComponent,
    data: {
      authorities: [Authority.USER, Authority.ADMIN],
      defaultSort: 'id,asc',
      pageTitle: 'txcbApp.xocdia.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/view',
    component: XocdiaDetailComponent,
    resolve: {
      xocdia: XocdiaResolve,
    },
    data: {
      authorities: [Authority.USER, Authority.ADMIN],
      pageTitle: 'txcbApp.xocdia.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: 'new',
    component: XocdiaUpdateComponent,
    resolve: {
      xocdia: XocdiaResolve,
    },
    data: {
      authorities: [Authority.USER, Authority.ADMIN],
      pageTitle: 'txcbApp.xocdia.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/edit',
    component: XocdiaUpdateComponent,
    resolve: {
      xocdia: XocdiaResolve,
    },
    data: {
      authorities: [Authority.USER, Authority.ADMIN],
      pageTitle: 'txcbApp.xocdia.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
];
