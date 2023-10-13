import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

import { IJackpotSettingRecord } from 'app/shared/model/jackpot-setting-record.model';

@Component({
  selector: 'jhi-jackpot-setting-record-detail',
  templateUrl: './jackpot-setting-record-detail.component.html',
})
export class JackpotSettingRecordDetailComponent implements OnInit {
  jackpotSettingRecord: IJackpotSettingRecord | null = null;

  constructor(protected activatedRoute: ActivatedRoute) {}

  ngOnInit(): void {
    this.activatedRoute.data.subscribe(({ jackpotSettingRecord }) => (this.jackpotSettingRecord = jackpotSettingRecord));
  }

  previousState(): void {
    window.history.back();
  }
}
