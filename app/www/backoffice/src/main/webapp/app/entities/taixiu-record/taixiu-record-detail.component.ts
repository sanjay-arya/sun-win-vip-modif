import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { ITaixiuRecord } from 'app/shared/model/taixiu-record.model';

@Component({
  selector: 'jhi-taixiu-record-detail',
  templateUrl: './taixiu-record-detail.component.html',
})
export class TaixiuRecordDetailComponent implements OnInit {
  taixiuRecord: ITaixiuRecord | null = null;

  constructor(protected activatedRoute: ActivatedRoute) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ taixiuRecord }) => (this.taixiuRecord = taixiuRecord));
  }

  previousState(): void {
    window.history.back();
  }
}
