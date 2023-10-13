import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { IXocdiaJackpotRecord } from 'app/shared/model/xocdia-jackpot-record.model';

@Component({
  selector: 'jhi-xocdia-jackpot-record-detail',
  templateUrl: './xocdia-jackpot-record-detail.component.html',
})
export class XocdiaJackpotRecordDetailComponent implements OnInit {
  xocdiaJackpotRecord: IXocdiaJackpotRecord | null = null;

  constructor(protected activatedRoute: ActivatedRoute) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ xocdiaJackpotRecord }) => (this.xocdiaJackpotRecord = xocdiaJackpotRecord));
  }

  previousState(): void {
    window.history.back();
  }
}
