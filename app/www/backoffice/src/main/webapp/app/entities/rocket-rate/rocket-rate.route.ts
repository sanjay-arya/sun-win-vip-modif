import { Injectable } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
import { Resolve, ActivatedRouteSnapshot, Routes, Router } from '@angular/router';
import { Observable, of, EMPTY } from 'rxjs';
import { flatMap } from 'rxjs/operators';

import { Authority } from 'app/shared/constants/authority.constants';
import { UserRouteAccessService } from 'app/core/auth/user-route-access-service';
import { IRocketRate, RocketRate } from 'app/shared/model/rocket-rate.model';
import { RocketRateService } from './rocket-rate.service';
import { RocketRateComponent } from './rocket-rate.component';
import { RocketRateDetailComponent } from './rocket-rate-detail.component';
import { RocketRateUpdateComponent } from './rocket-rate-update.component';

@Injectable({ providedIn: 'root' })
export class RocketRateResolve implements Resolve<IRocketRate> {
  constructor(private service: RocketRateService, private router: Router) {}

  resolve(route: ActivatedRouteSnapshot): Observable<IRocketRate> | Observable<never> {
    const id = route.params['id'];
    if (id) {
      return this.service.find(id).pipe(
        flatMap((rocketRate: HttpResponse<RocketRate>) => {
          if (rocketRate.body) {
            return of(rocketRate.body);
          } else {
            this.router.navigate(['404']);
            return EMPTY;
          }
        })
      );
    }
    return of(new RocketRate());
  }
}

export const rocketRateRoute: Routes = [
  {
    path: '',
    component: RocketRateComponent,
    data: {
      authorities: [Authority.USER],
      pageTitle: 'txcbApp.rocketRate.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/view',
    component: RocketRateDetailComponent,
    resolve: {
      rocketRate: RocketRateResolve,
    },
    data: {
      authorities: [Authority.USER],
      pageTitle: 'txcbApp.rocketRate.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: 'new',
    component: RocketRateUpdateComponent,
    resolve: {
      rocketRate: RocketRateResolve,
    },
    data: {
      authorities: [Authority.USER],
      pageTitle: 'txcbApp.rocketRate.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/edit',
    component: RocketRateUpdateComponent,
    resolve: {
      rocketRate: RocketRateResolve,
    },
    data: {
      authorities: [Authority.USER],
      pageTitle: 'txcbApp.rocketRate.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
];
