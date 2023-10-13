import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { IXocdiaRank } from 'app/shared/model/xocdia-rank.model';

@Component({
  selector: 'jhi-xocdia-rank-detail',
  templateUrl: './xocdia-rank-detail.component.html',
})
export class XocdiaRankDetailComponent implements OnInit {
  xocdiaRank: IXocdiaRank | null = null;

  constructor(protected activatedRoute: ActivatedRoute) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ xocdiaRank }) => (this.xocdiaRank = xocdiaRank));
  }

  previousState(): void {
    window.history.back();
  }
}
