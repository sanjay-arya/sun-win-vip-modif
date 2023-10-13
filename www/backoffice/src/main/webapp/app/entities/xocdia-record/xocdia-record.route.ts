import { Injectable } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
import { Resolve, ActivatedRouteSnapshot, Routes, Router } from '@angular/router';
import { Observable, of, EMPTY } from 'rxjs';
import { flatMap } from 'rxjs/operators';

import { Authority } from 'app/shared/constants/authority.constants';
import { UserRouteAccessService } from 'app/core/auth/user-route-access-service';
import { IXocdiaRecord, XocdiaRecord } from 'app/shared/model/xocdia-record.model';
import { XocdiaRecordService } from './xocdia-record.service';
import { XocdiaRecordComponent } from './xocdia-record.component';
import { XocdiaRecordDetailComponent } from './xocdia-record-detail.component';
import { XocdiaRecordUpdateComponent } from './xocdia-record-update.component';

@Injectable({ providedIn: 'root' })
export class XocdiaRecordResolve implements Resolve<IXocdiaRecord> {
  constructor(private service: XocdiaRecordService, private router: Router) {}

  resolve(route: ActivatedRouteSnapshot): Observable<IXocdiaRecord> | Observable<never> {
    const id = route.params['id'];
    if (id) {
      return this.service.find(id).pipe(
        flatMap((xocdiaRecord: HttpResponse<XocdiaRecord>) => {
          if (xocdiaRecord.body) {
            return of(xocdiaRecord.body);
          } else {
            this.router.navigate(['404']);
            return EMPTY;
          }
        })
      );
    }
    return of(new XocdiaRecord());
  }
}

export const xocdiaRecordRoute: Routes = [
  {
    path: '',
    component: XocdiaRecordComponent,
    data: {
      authorities: [Authority.USER, Authority.ADMIN],
      defaultSort: 'id,asc',
      pageTitle: 'txcbApp.xocdiaRecord.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/view',
    component: XocdiaRecordDetailComponent,
    resolve: {
      xocdiaRecord: XocdiaRecordResolve,
    },
    data: {
      authorities: [Authority.USER, Authority.ADMIN],
      pageTitle: 'txcbApp.xocdiaRecord.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: 'new',
    component: XocdiaRecordUpdateComponent,
    resolve: {
      xocdiaRecord: XocdiaRecordResolve,
    },
    data: {
      authorities: [Authority.USER, Authority.ADMIN],
      pageTitle: 'txcbApp.xocdiaRecord.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/edit',
    component: XocdiaRecordUpdateComponent,
    resolve: {
      xocdiaRecord: XocdiaRecordResolve,
    },
    data: {
      authorities: [Authority.USER, Authority.ADMIN],
      pageTitle: 'txcbApp.xocdiaRecord.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
];
