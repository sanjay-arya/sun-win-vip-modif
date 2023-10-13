import { Injectable } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
import { Resolve, ActivatedRouteSnapshot, Routes, Router } from '@angular/router';
import { Observable, of, EMPTY } from 'rxjs';
import { flatMap } from 'rxjs/operators';

import { Authority } from 'app/shared/constants/authority.constants';
import { UserRouteAccessService } from 'app/core/auth/user-route-access-service';
import { IRocketRank, RocketRank } from 'app/shared/model/rocket-rank.model';
import { RocketRankService } from './rocket-rank.service';
import { RocketRankComponent } from './rocket-rank.component';
import { RocketRankDetailComponent } from './rocket-rank-detail.component';
import { RocketRankUpdateComponent } from './rocket-rank-update.component';

@Injectable({ providedIn: 'root' })
export class RocketRankResolve implements Resolve<IRocketRank> {
  constructor(private service: RocketRankService, private router: Router) {}

  resolve(route: ActivatedRouteSnapshot): Observable<IRocketRank> | Observable<never> {
    const id = route.params['id'];
    if (id) {
      return this.service.find(id).pipe(
        flatMap((rocketRank: HttpResponse<RocketRank>) => {
          if (rocketRank.body) {
            return of(rocketRank.body);
          } else {
            this.router.navigate(['404']);
            return EMPTY;
          }
        })
      );
    }
    return of(new RocketRank());
  }
}

export const rocketRankRoute: Routes = [
  {
    path: '',
    component: RocketRankComponent,
    data: {
      authorities: [Authority.USER, Authority.MKT, Authority.CS],
      defaultSort: 'id,asc',
      pageTitle: 'txcbApp.rocketRank.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/view',
    component: RocketRankDetailComponent,
    resolve: {
      rocketRank: RocketRankResolve,
    },
    data: {
      authorities: [Authority.USER, Authority.MKT, Authority.CS],
      pageTitle: 'txcbApp.rocketRank.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: 'new',
    component: RocketRankUpdateComponent,
    resolve: {
      rocketRank: RocketRankResolve,
    },
    data: {
      authorities: [Authority.USER, Authority.MKT, Authority.CS],
      pageTitle: 'txcbApp.rocketRank.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/edit',
    component: RocketRankUpdateComponent,
    resolve: {
      rocketRank: RocketRankResolve,
    },
    data: {
      authorities: [Authority.USER, Authority.MKT, Authority.CS],
      pageTitle: 'txcbApp.rocketRank.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
];
