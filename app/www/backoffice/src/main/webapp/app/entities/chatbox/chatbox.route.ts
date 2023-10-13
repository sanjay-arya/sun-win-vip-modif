import { Injectable } from '@angular/core';
import { HttpResponse } from '@angular/common/http';
import { Resolve, ActivatedRouteSnapshot, Routes, Router } from '@angular/router';
import { Observable, of, EMPTY } from 'rxjs';
import { flatMap } from 'rxjs/operators';

import { Authority } from 'app/shared/constants/authority.constants';
import { UserRouteAccessService } from 'app/core/auth/user-route-access-service';
import { IChatbox, Chatbox } from 'app/shared/model/chatbox.model';
import { ChatboxService } from './chatbox.service';
import { ChatboxComponent } from './chatbox.component';
import { ChatboxDetailComponent } from './chatbox-detail.component';
import { ChatboxUpdateComponent } from './chatbox-update.component';

@Injectable({ providedIn: 'root' })
export class ChatboxResolve implements Resolve<IChatbox> {
  constructor(private service: ChatboxService, private router: Router) {}

  resolve(route: ActivatedRouteSnapshot): Observable<IChatbox> | Observable<never> {
    const id = route.params['id'];
    if (id) {
      return this.service.find(id).pipe(
        flatMap((chatbox: HttpResponse<Chatbox>) => {
          if (chatbox.body) {
            return of(chatbox.body);
          } else {
            this.router.navigate(['404']);
            return EMPTY;
          }
        })
      );
    }
    return of(new Chatbox());
  }
}

export const chatboxRoute: Routes = [
  {
    path: '',
    component: ChatboxComponent,
    data: {
      authorities: [Authority.USER, Authority.MKT, Authority.CS],
      pageTitle: 'txcbApp.chatbox.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/view',
    component: ChatboxDetailComponent,
    resolve: {
      chatbox: ChatboxResolve,
    },
    data: {
      authorities: [Authority.USER, Authority.MKT, Authority.CS],
      pageTitle: 'txcbApp.chatbox.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: 'new',
    component: ChatboxUpdateComponent,
    resolve: {
      chatbox: ChatboxResolve,
    },
    data: {
      authorities: [Authority.USER, Authority.MKT, Authority.CS],
      pageTitle: 'txcbApp.chatbox.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
  {
    path: ':id/edit',
    component: ChatboxUpdateComponent,
    resolve: {
      chatbox: ChatboxResolve,
    },
    data: {
      authorities: [Authority.USER, Authority.MKT, Authority.CS],
      pageTitle: 'txcbApp.chatbox.home.title',
    },
    canActivate: [UserRouteAccessService],
  },
];
