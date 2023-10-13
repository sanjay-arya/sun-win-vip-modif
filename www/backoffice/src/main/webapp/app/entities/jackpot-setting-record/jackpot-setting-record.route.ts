import { Injectable } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
import { Resolve, ActivatedRouteSnapshot, Routes, Router } from '@angular/router';
import { Observable, of, EMPTY } from 'rxjs';
import { flatMap } from 'rxjs/operators';

import { Authority } from 'app/shared/constants/authority.constants';
import { UserRouteAccessService } from 'app/core/auth/user-route-access-service';
import { IJackpotSettingRecord, JackpotSettingRecord } from 'app/shared/model/jackpot-setting-record.model';
import { JackpotSettingRecordService } from './jackpot-setting-record.service';
import { JackpotSettingRecordComponent } from './jackpot-setting-record.component';
import { JackpotSettingRecordDetailComponent } from './jackpot-setting-record-detail.component';
import { JackpotSettingRecordUpdateComponent } from './jackpot-setting-record-update.component';

@Injectable({ providedIn: 'root' })
export class JackpotSettingRecordResolve implements Resolve<IJackpotSettingRecord> {
  constructor(private service: JackpotSettingRecordService, private router: Router) {}

  resolve(route: ActivatedRouteSnapshot): Observable<IJackpotSettingRecord> | Observable<never> {
    const id = route.params['id'];
    if (id) {
      return this.service.find(id).pipe(
        flatMap((jackpotSettingRecord: HttpResponse<JackpotSettingRecord>) => {
          if (jackpotSettingRecord.body) {
            return of(jackpotSettingRecord.body);
          } else {
            this.router.navigate(['404']);
            return EMPTY;
          }
        })
      );
    }
    return of(new JackpotSettingRecord());
  }
}

export const jackpotSettingRecordRoute: Routes = [
  {
    path: '',
    component: JackpotSettingRecordComponent,
    data: {
      authorities: [Authority.USER],
      defaultSort: 'id,asc',
      pageTitle: 'txcbApp.jackpotSettingRecord.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/view',
    component: JackpotSettingRecordDetailComponent,
    resolve: {
      jackpotSettingRecord: JackpotSettingRecordResolve,
    },
    data: {
      authorities: [Authority.USER],
      pageTitle: 'txcbApp.jackpotSettingRecord.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: 'new',
    component: JackpotSettingRecordUpdateComponent,
    resolve: {
      jackpotSettingRecord: JackpotSettingRecordResolve,
    },
    data: {
      authorities: [Authority.USER],
      pageTitle: 'txcbApp.jackpotSettingRecord.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/edit',
    component: JackpotSettingRecordUpdateComponent,
    resolve: {
      jackpotSettingRecord: JackpotSettingRecordResolve,
    },
    data: {
      authorities: [Authority.USER],
      pageTitle: 'txcbApp.jackpotSettingRecord.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
];
