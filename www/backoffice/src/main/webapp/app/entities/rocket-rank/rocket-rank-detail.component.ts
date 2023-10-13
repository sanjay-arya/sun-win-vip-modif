import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { IRocketRank } from 'app/shared/model/rocket-rank.model';

@Component({
  selector: 'jhi-rocket-rank-detail',
  templateUrl: './rocket-rank-detail.component.html',
})
export class RocketRankDetailComponent implements OnInit {
  rocketRank: IRocketRank | null = null;

  constructor(protected activatedRoute: ActivatedRoute) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ rocketRank }) => (this.rocketRank = rocketRank));
  }

  previousState(): void {
    window.history.back();
  }
}
