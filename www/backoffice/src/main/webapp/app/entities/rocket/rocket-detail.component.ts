import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { DATE_TIME_FORMAT } from 'app/shared/constants/input.constants';

import { IRocket } from 'app/shared/model/rocket.model';

@Component({
  selector: 'jhi-rocket-detail',
  templateUrl: './rocket-detail.component.html',
})
export class RocketDetailComponent implements OnInit {
  rocket: IRocket | null = null;

  constructor(protected activatedRoute: ActivatedRoute) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ rocket }) => {
      rocket.opentime = rocket.opentime ? rocket.opentime.format(DATE_TIME_FORMAT) : null;
      rocket.endtime = rocket.endtime ? rocket.endtime.format(DATE_TIME_FORMAT) : null;
      this.rocket = rocket;
    });
  }

  previousState(): void {
    window.history.back();
  }
}
