import { Injectable } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
import { Resolve, ActivatedRouteSnapshot, Routes, Router } from '@angular/router';
import { Observable, of, EMPTY } from 'rxjs';
import { flatMap } from 'rxjs/operators';

import { Authority } from 'app/shared/constants/authority.constants';
import { UserRouteAccessService } from 'app/core/auth/user-route-access-service';
import { ITaixiu, Taixiu } from 'app/shared/model/taixiu.model';
import { TaixiuService } from './taixiu.service';
import { TaixiuComponent } from './taixiu.component';
import { TaixiuDetailComponent } from './taixiu-detail.component';
import { TaixiuUpdateComponent } from './taixiu-update.component';

@Injectable({ providedIn: 'root' })
export class TaixiuResolve implements Resolve<ITaixiu> {
  constructor(private service: TaixiuService, private router: Router) {}

  resolve(route: ActivatedRouteSnapshot): Observable<ITaixiu> | Observable<never> {
    const id = route.params['id'];
    if (id) {
      return this.service.find(id).pipe(
        flatMap((taixiu: HttpResponse<Taixiu>) => {
          if (taixiu.body) {
            return of(taixiu.body);
          } else {
            this.router.navigate(['404']);
            return EMPTY;
          }
        })
      );
    }
    return of(new Taixiu());
  }
}

export const taixiuRoute: Routes = [
  {
    path: '',
    component: TaixiuComponent,
    data: {
      authorities: [Authority.USER, Authority.ADMIN],
      defaultSort: 'id,asc',
      pageTitle: 'txcbApp.taixiu.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/view',
    component: TaixiuDetailComponent,
    resolve: {
      taixiu: TaixiuResolve,
    },
    data: {
      authorities: [Authority.USER, Authority.ADMIN],
      pageTitle: 'txcbApp.taixiu.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: 'new',
    component: TaixiuUpdateComponent,
    resolve: {
      taixiu: TaixiuResolve,
    },
    data: {
      authorities: [Authority.USER, Authority.ADMIN],
      pageTitle: 'txcbApp.taixiu.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/edit',
    component: TaixiuUpdateComponent,
    resolve: {
      taixiu: TaixiuResolve,
    },
    data: {
      authorities: [Authority.USER, Authority.ADMIN],
      pageTitle: 'txcbApp.taixiu.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
];
