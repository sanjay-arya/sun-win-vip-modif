import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { IXocdiaRecord } from 'app/shared/model/xocdia-record.model';

@Component({
  selector: 'jhi-xocdia-record-detail',
  templateUrl: './xocdia-record-detail.component.html',
})
export class XocdiaRecordDetailComponent implements OnInit {
  xocdiaRecord: IXocdiaRecord | null = null;

  constructor(protected activatedRoute: ActivatedRoute) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ xocdiaRecord }) => (this.xocdiaRecord = xocdiaRecord));
  }

  previousState(): void {
    window.history.back();
  }
}
