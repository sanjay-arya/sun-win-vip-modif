import { Injectable } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
import { Resolve, ActivatedRouteSnapshot, Routes, Router } from '@angular/router';
import { Observable, of, EMPTY } from 'rxjs';
import { flatMap } from 'rxjs/operators';

import { Authority } from 'app/shared/constants/authority.constants';
import { UserRouteAccessService } from 'app/core/auth/user-route-access-service';
import { ITxRank, TxRank } from 'app/shared/model/tx-rank.model';
import { TxRankService } from './tx-rank.service';
import { TxRankComponent } from './tx-rank.component';
import { TxRankDetailComponent } from './tx-rank-detail.component';
import { TxRankUpdateComponent } from './tx-rank-update.component';

@Injectable({ providedIn: 'root' })
export class TxRankResolve implements Resolve<ITxRank> {
  constructor(private service: TxRankService, private router: Router) {}

  resolve(route: ActivatedRouteSnapshot): Observable<ITxRank> | Observable<never> {
    const id = route.params['id'];
    if (id) {
      return this.service.find(id).pipe(
        flatMap((txRank: HttpResponse<TxRank>) => {
          if (txRank.body) {
            return of(txRank.body);
          } else {
            this.router.navigate(['404']);
            return EMPTY;
          }
        })
      );
    }
    return of(new TxRank());
  }
}

export const txRankRoute: Routes = [
  {
    path: '',
    component: TxRankComponent,
    data: {
      authorities: [Authority.USER, Authority.MKT, Authority.CS],
      defaultSort: 'id,asc',
      pageTitle: 'txcbApp.txRank.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/view',
    component: TxRankDetailComponent,
    resolve: {
      txRank: TxRankResolve,
    },
    data: {
      authorities: [Authority.USER, Authority.MKT, Authority.CS],
      pageTitle: 'txcbApp.txRank.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: 'new',
    component: TxRankUpdateComponent,
    resolve: {
      txRank: TxRankResolve,
    },
    data: {
      authorities: [Authority.USER, Authority.MKT, Authority.CS],
      pageTitle: 'txcbApp.txRank.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/edit',
    component: TxRankUpdateComponent,
    resolve: {
      txRank: TxRankResolve,
    },
    data: {
      authorities: [Authority.USER, Authority.MKT, Authority.CS],
      pageTitle: 'txcbApp.txRank.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
];
