import { Injectable } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
import { Resolve, ActivatedRouteSnapshot, Routes, Router } from '@angular/router';
import { Observable, of, EMPTY } from 'rxjs';
import { flatMap } from 'rxjs/operators';

import { Authority } from 'app/shared/constants/authority.constants';
import { UserRouteAccessService } from 'app/core/auth/user-route-access-service';
import { ITransferHistory, TransferHistory } from 'app/shared/model/transfer-history.model';
import { TransferHistoryService } from './transfer-history.service';
import { TransferHistoryComponent } from './transfer-history.component';
import { TransferHistoryDetailComponent } from './transfer-history-detail.component';
import { TransferHistoryUpdateComponent } from './transfer-history-update.component';

@Injectable({ providedIn: 'root' })
export class TransferHistoryResolve implements Resolve<ITransferHistory> {
  constructor(private service: TransferHistoryService, private router: Router) {}

  resolve(route: ActivatedRouteSnapshot): Observable<ITransferHistory> | Observable<never> {
    const id = route.params['id'];
    if (id) {
      return this.service.find(id).pipe(
        flatMap((transferHistory: HttpResponse<TransferHistory>) => {
          if (transferHistory.body) {
            return of(transferHistory.body);
          } else {
            this.router.navigate(['404']);
            return EMPTY;
          }
        })
      );
    }
    return of(new TransferHistory());
  }
}

export const transferHistoryRoute: Routes = [
  {
    path: '',
    component: TransferHistoryComponent,
    data: {
      authorities: [Authority.ADMIN],
      defaultSort: 'id,asc',
      pageTitle: 'taixiucbApp.transferHistory.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/view',
    component: TransferHistoryDetailComponent,
    resolve: {
      transferHistory: TransferHistoryResolve,
    },
    data: {
      authorities: [Authority.ADMIN],
      pageTitle: 'taixiucbApp.transferHistory.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: 'new',
    component: TransferHistoryUpdateComponent,
    resolve: {
      transferHistory: TransferHistoryResolve,
    },
    data: {
      authorities: [Authority.ADMIN],
      pageTitle: 'taixiucbApp.transferHistory.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/edit',
    component: TransferHistoryUpdateComponent,
    resolve: {
      transferHistory: TransferHistoryResolve,
    },
    data: {
      authorities: [Authority.ADMIN],
      pageTitle: 'taixiucbApp.transferHistory.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
];
