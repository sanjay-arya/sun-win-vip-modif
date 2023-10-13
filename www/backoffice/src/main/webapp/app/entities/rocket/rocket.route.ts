import { Injectable } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
import { Resolve, ActivatedRouteSnapshot, Routes, Router } from '@angular/router';
import { Observable, of, EMPTY } from 'rxjs';
import { flatMap } from 'rxjs/operators';

import { Authority } from 'app/shared/constants/authority.constants';
import { UserRouteAccessService } from 'app/core/auth/user-route-access-service';
import { IRocket, Rocket } from 'app/shared/model/rocket.model';
import { RocketService } from './rocket.service';
import { RocketComponent } from './rocket.component';
import { RocketDetailComponent } from './rocket-detail.component';
import { RocketUpdateComponent } from './rocket-update.component';

@Injectable({ providedIn: 'root' })
export class RocketResolve implements Resolve<IRocket> {
  constructor(private service: RocketService, private router: Router) {}

  resolve(route: ActivatedRouteSnapshot): Observable<IRocket> | Observable<never> {
    const id = route.params['id'];
    if (id) {
      return this.service.find(id).pipe(
        flatMap((rocket: HttpResponse<Rocket>) => {
          if (rocket.body) {
            return of(rocket.body);
          } else {
            this.router.navigate(['404']);
            return EMPTY;
          }
        })
      );
    }
    return of(new Rocket());
  }
}

export const rocketRoute: Routes = [
  {
    path: '',
    component: RocketComponent,
    data: {
      authorities: [Authority.USER],
      defaultSort: 'id,asc',
      pageTitle: 'txcbApp.rocket.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/view',
    component: RocketDetailComponent,
    resolve: {
      rocket: RocketResolve,
    },
    data: {
      authorities: [Authority.USER],
      pageTitle: 'txcbApp.rocket.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: 'new',
    component: RocketUpdateComponent,
    resolve: {
      rocket: RocketResolve,
    },
    data: {
      authorities: [Authority.USER],
      pageTitle: 'txcbApp.rocket.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/edit',
    component: RocketUpdateComponent,
    resolve: {
      rocket: RocketResolve,
    },
    data: {
      authorities: [Authority.USER],
      pageTitle: 'txcbApp.rocket.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
];
