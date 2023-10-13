import { Injectable } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
import { Resolve, ActivatedRouteSnapshot, Routes, Router } from '@angular/router';
import { Observable, of, EMPTY } from 'rxjs';
import { flatMap } from 'rxjs/operators';

import { Authority } from 'app/shared/constants/authority.constants';
import { UserRouteAccessService } from 'app/core/auth/user-route-access-service';
import { IReportGame, ReportGame } from 'app/shared/model/report-game.model';
import { ReportGameService } from './report-game.service';
import { ReportGameComponent } from './report-game.component';
import { ReportGameDetailComponent } from './report-game-detail.component';
import { ReportGameUpdateComponent } from './report-game-update.component';

@Injectable({ providedIn: 'root' })
export class ReportGameResolve implements Resolve<IReportGame> {
  constructor(private service: ReportGameService, private router: Router) {}

  resolve(route: ActivatedRouteSnapshot): Observable<IReportGame> | Observable<never> {
    const id = route.params['id'];
    if (id) {
      return this.service.find(id).pipe(
        flatMap((reportGame: HttpResponse<ReportGame>) => {
          if (reportGame.body) {
            return of(reportGame.body);
          } else {
            this.router.navigate(['404']);
            return EMPTY;
          }
        })
      );
    }
    return of(new ReportGame());
  }
}

export const reportGameRoute: Routes = [
  {
    path: '',
    component: ReportGameComponent,
    data: {
      authorities: [Authority.ADMIN],
      defaultSort: 'id,asc',
      pageTitle: 'taixiucbApp.reportGame.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/view',
    component: ReportGameDetailComponent,
    resolve: {
      reportGame: ReportGameResolve,
    },
    data: {
      authorities: [Authority.ADMIN],
      pageTitle: 'taixiucbApp.reportGame.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: 'new',
    component: ReportGameUpdateComponent,
    resolve: {
      reportGame: ReportGameResolve,
    },
    data: {
      authorities: [Authority.ADMIN],
      pageTitle: 'taixiucbApp.reportGame.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/edit',
    component: ReportGameUpdateComponent,
    resolve: {
      reportGame: ReportGameResolve,
    },
    data: {
      authorities: [Authority.ADMIN],
      pageTitle: 'taixiucbApp.reportGame.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
];
