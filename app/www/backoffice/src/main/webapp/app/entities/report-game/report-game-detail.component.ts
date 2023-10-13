import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { IReportGame } from 'app/shared/model/report-game.model';

@Component({
  selector: 'jhi-report-game-detail',
  templateUrl: './report-game-detail.component.html',
})
export class ReportGameDetailComponent implements OnInit {
  reportGame: IReportGame | null = null;

  constructor(protected activatedRoute: ActivatedRoute) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ reportGame }) => (this.reportGame = reportGame));
  }

  previousState(): void {
    window.history.back();
  }
}
