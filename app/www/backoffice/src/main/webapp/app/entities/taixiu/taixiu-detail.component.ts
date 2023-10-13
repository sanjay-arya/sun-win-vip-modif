import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { ITaixiu } from 'app/shared/model/taixiu.model';

@Component({
  selector: 'jhi-taixiu-detail',
  templateUrl: './taixiu-detail.component.html',
})
export class TaixiuDetailComponent implements OnInit {
  taixiu: ITaixiu | null = null;

  constructor(protected activatedRoute: ActivatedRoute) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ taixiu }) => (this.taixiu = taixiu));
  }

  previousState(): void {
    window.history.back();
  }
}
