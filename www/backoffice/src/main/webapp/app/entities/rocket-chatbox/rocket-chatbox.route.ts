import { Injectable } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
import { Resolve, ActivatedRouteSnapshot, Routes, Router } from '@angular/router';
import { Observable, of, EMPTY } from 'rxjs';
import { flatMap } from 'rxjs/operators';

import { Authority } from 'app/shared/constants/authority.constants';
import { UserRouteAccessService } from 'app/core/auth/user-route-access-service';
import { IRocketChatbox, RocketChatbox } from 'app/shared/model/rocket-chatbox.model';
import { RocketChatboxService } from './rocket-chatbox.service';
import { RocketChatboxComponent } from './rocket-chatbox.component';
import { RocketChatboxDetailComponent } from './rocket-chatbox-detail.component';
import { RocketChatboxUpdateComponent } from './rocket-chatbox-update.component';

@Injectable({ providedIn: 'root' })
export class RocketChatboxResolve implements Resolve<IRocketChatbox> {
  constructor(private service: RocketChatboxService, private router: Router) {}

  resolve(route: ActivatedRouteSnapshot): Observable<IRocketChatbox> | Observable<never> {
    const id = route.params['id'];
    if (id) {
      return this.service.find(id).pipe(
        flatMap((rocketChatbox: HttpResponse<RocketChatbox>) => {
          if (rocketChatbox.body) {
            return of(rocketChatbox.body);
          } else {
            this.router.navigate(['404']);
            return EMPTY;
          }
        })
      );
    }
    return of(new RocketChatbox());
  }
}

export const rocketChatboxRoute: Routes = [
  {
    path: '',
    component: RocketChatboxComponent,
    data: {
      authorities: [Authority.USER],
      pageTitle: 'txcbApp.rocketChatbox.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/view',
    component: RocketChatboxDetailComponent,
    resolve: {
      rocketChatbox: RocketChatboxResolve,
    },
    data: {
      authorities: [Authority.USER],
      pageTitle: 'txcbApp.rocketChatbox.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: 'new',
    component: RocketChatboxUpdateComponent,
    resolve: {
      rocketChatbox: RocketChatboxResolve,
    },
    data: {
      authorities: [Authority.USER],
      pageTitle: 'txcbApp.rocketChatbox.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/edit',
    component: RocketChatboxUpdateComponent,
    resolve: {
      rocketChatbox: RocketChatboxResolve,
    },
    data: {
      authorities: [Authority.USER],
      pageTitle: 'txcbApp.rocketChatbox.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
];
