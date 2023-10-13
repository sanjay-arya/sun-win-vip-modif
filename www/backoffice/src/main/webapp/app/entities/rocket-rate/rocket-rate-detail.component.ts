import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { IRocketRate } from 'app/shared/model/rocket-rate.model';

@Component({
  selector: 'jhi-rocket-rate-detail',
  templateUrl: './rocket-rate-detail.component.html',
})
export class RocketRateDetailComponent implements OnInit {
  rocketRate: IRocketRate | null = null;

  constructor(protected activatedRoute: ActivatedRoute) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ rocketRate }) => (this.rocketRate = rocketRate));
  }

  previousState(): void {
    window.history.back();
  }
}
