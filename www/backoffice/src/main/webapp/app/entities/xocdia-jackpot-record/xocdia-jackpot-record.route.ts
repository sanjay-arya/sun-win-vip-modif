import { Injectable } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
import { Resolve, ActivatedRouteSnapshot, Routes, Router } from '@angular/router';
import { Observable, of, EMPTY } from 'rxjs';
import { flatMap } from 'rxjs/operators';

import { Authority } from 'app/shared/constants/authority.constants';
import { UserRouteAccessService } from 'app/core/auth/user-route-access-service';
import { IXocdiaJackpotRecord, XocdiaJackpotRecord } from 'app/shared/model/xocdia-jackpot-record.model';
import { XocdiaJackpotRecordService } from './xocdia-jackpot-record.service';
import { XocdiaJackpotRecordComponent } from './xocdia-jackpot-record.component';
import { XocdiaJackpotRecordDetailComponent } from './xocdia-jackpot-record-detail.component';
import { XocdiaJackpotRecordUpdateComponent } from './xocdia-jackpot-record-update.component';

@Injectable({ providedIn: 'root' })
export class XocdiaJackpotRecordResolve implements Resolve<IXocdiaJackpotRecord> {
  constructor(private service: XocdiaJackpotRecordService, private router: Router) {}

  resolve(route: ActivatedRouteSnapshot): Observable<IXocdiaJackpotRecord> | Observable<never> {
    const id = route.params['id'];
    if (id) {
      return this.service.find(id).pipe(
        flatMap((xocdiaJackpotRecord: HttpResponse<XocdiaJackpotRecord>) => {
          if (xocdiaJackpotRecord.body) {
            return of(xocdiaJackpotRecord.body);
          } else {
            this.router.navigate(['404']);
            return EMPTY;
          }
        })
      );
    }
    return of(new XocdiaJackpotRecord());
  }
}

export const xocdiaJackpotRecordRoute: Routes = [
  {
    path: '',
    component: XocdiaJackpotRecordComponent,
    data: {
      authorities: [Authority.USER],
      defaultSort: 'id,asc',
      pageTitle: 'txcbApp.xocdiaJackpotRecord.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/view',
    component: XocdiaJackpotRecordDetailComponent,
    resolve: {
      xocdiaJackpotRecord: XocdiaJackpotRecordResolve,
    },
    data: {
      authorities: [Authority.USER],
      pageTitle: 'txcbApp.xocdiaJackpotRecord.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: 'new',
    component: XocdiaJackpotRecordUpdateComponent,
    resolve: {
      xocdiaJackpotRecord: XocdiaJackpotRecordResolve,
    },
    data: {
      authorities: [Authority.USER],
      pageTitle: 'txcbApp.xocdiaJackpotRecord.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/edit',
    component: XocdiaJackpotRecordUpdateComponent,
    resolve: {
      xocdiaJackpotRecord: XocdiaJackpotRecordResolve,
    },
    data: {
      authorities: [Authority.USER],
      pageTitle: 'txcbApp.xocdiaJackpotRecord.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
];
