import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { IUserinfo } from 'app/shared/model/userinfo.model';

@Component({
  selector: 'jhi-userinfo-detail',
  templateUrl: './userinfo-detail.component.html',
})
export class UserinfoDetailComponent implements OnInit {
  userinfo: IUserinfo | null = null;

  constructor(protected activatedRoute: ActivatedRoute) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ userinfo }) => (this.userinfo = userinfo));
  }

  previousState(): void {
    window.history.back();
  }
}
