import { Injectable } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
import { Resolve, ActivatedRouteSnapshot, Routes, Router } from '@angular/router';
import { Observable, of, EMPTY } from 'rxjs';
import { flatMap } from 'rxjs/operators';

import { Authority } from 'app/shared/constants/authority.constants';
import { UserRouteAccessService } from 'app/core/auth/user-route-access-service';
import { ITaixiuRecord, TaixiuRecord } from 'app/shared/model/taixiu-record.model';
import { TaixiuRecordService } from './taixiu-record.service';
import { TaixiuRecordComponent } from './taixiu-record.component';
import { TaixiuRecordDetailComponent } from './taixiu-record-detail.component';
import { TaixiuRecordUpdateComponent } from './taixiu-record-update.component';

@Injectable({ providedIn: 'root' })
export class TaixiuRecordResolve implements Resolve<ITaixiuRecord> {
  constructor(private service: TaixiuRecordService, private router: Router) {}

  resolve(route: ActivatedRouteSnapshot): Observable<ITaixiuRecord> | Observable<never> {
    const id = route.params['id'];
    if (id) {
      return this.service.find(id).pipe(
        flatMap((taixiuRecord: HttpResponse<TaixiuRecord>) => {
          if (taixiuRecord.body) {
            return of(taixiuRecord.body);
          } else {
            this.router.navigate(['404']);
            return EMPTY;
          }
        })
      );
    }
    return of(new TaixiuRecord());
  }
}

export const taixiuRecordRoute: Routes = [
  {
    path: '',
    component: TaixiuRecordComponent,
    data: {
      authorities: [Authority.USER, Authority.ADMIN],
      defaultSort: 'id,asc',
      pageTitle: 'txcbApp.taixiuRecord.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/view',
    component: TaixiuRecordDetailComponent,
    resolve: {
      taixiuRecord: TaixiuRecordResolve,
    },
    data: {
      authorities: [Authority.USER, Authority.ADMIN],
      pageTitle: 'txcbApp.taixiuRecord.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: 'new',
    component: TaixiuRecordUpdateComponent,
    resolve: {
      taixiuRecord: TaixiuRecordResolve,
    },
    data: {
      authorities: [Authority.USER, Authority.ADMIN],
      pageTitle: 'txcbApp.taixiuRecord.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/edit',
    component: TaixiuRecordUpdateComponent,
    resolve: {
      taixiuRecord: TaixiuRecordResolve,
    },
    data: {
      authorities: [Authority.USER, Authority.ADMIN],
      pageTitle: 'txcbApp.taixiuRecord.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
];
