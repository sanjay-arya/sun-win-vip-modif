import { Injectable } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
import { Resolve, ActivatedRouteSnapshot, Routes, Router } from '@angular/router';
import { Observable, of, EMPTY } from 'rxjs';
import { flatMap } from 'rxjs/operators';

import { Authority } from 'app/shared/constants/authority.constants';
import { UserRouteAccessService } from 'app/core/auth/user-route-access-service';
import { IXocdiaRank, XocdiaRank } from 'app/shared/model/xocdia-rank.model';
import { XocdiaRankService } from './xocdia-rank.service';
import { XocdiaRankComponent } from './xocdia-rank.component';
import { XocdiaRankDetailComponent } from './xocdia-rank-detail.component';
import { XocdiaRankUpdateComponent } from './xocdia-rank-update.component';

@Injectable({ providedIn: 'root' })
export class XocdiaRankResolve implements Resolve<IXocdiaRank> {
  constructor(private service: XocdiaRankService, private router: Router) {}

  resolve(route: ActivatedRouteSnapshot): Observable<IXocdiaRank> | Observable<never> {
    const id = route.params['id'];
    if (id) {
      return this.service.find(id).pipe(
        flatMap((xocdiaRank: HttpResponse<XocdiaRank>) => {
          if (xocdiaRank.body) {
            return of(xocdiaRank.body);
          } else {
            this.router.navigate(['404']);
            return EMPTY;
          }
        })
      );
    }
    return of(new XocdiaRank());
  }
}

export const xocdiaRankRoute: Routes = [
  {
    path: '',
    component: XocdiaRankComponent,
    data: {
      authorities: [Authority.USER, Authority.MKT, Authority.CS],
      defaultSort: 'id,asc',
      pageTitle: 'txcbApp.xocdiaRank.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/view',
    component: XocdiaRankDetailComponent,
    resolve: {
      xocdiaRank: XocdiaRankResolve,
    },
    data: {
      authorities: [Authority.USER, Authority.MKT, Authority.CS],
      pageTitle: 'txcbApp.xocdiaRank.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: 'new',
    component: XocdiaRankUpdateComponent,
    resolve: {
      xocdiaRank: XocdiaRankResolve,
    },
    data: {
      authorities: [Authority.USER, Authority.MKT, Authority.CS],
      pageTitle: 'txcbApp.xocdiaRank.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/edit',
    component: XocdiaRankUpdateComponent,
    resolve: {
      xocdiaRank: XocdiaRankResolve,
    },
    data: {
      authorities: [Authority.USER, Authority.MKT, Authority.CS],
      pageTitle: 'txcbApp.xocdiaRank.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
];
