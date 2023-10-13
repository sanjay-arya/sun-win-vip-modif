import { Component } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { JhiEventManager } from 'ng-jhipster';

import { IJackpotSettingRecord } from 'app/shared/model/jackpot-setting-record.model';
import { JackpotSettingRecordService } from './jackpot-setting-record.service';

@Component({
  templateUrl: './jackpot-setting-record-delete-dialog.component.html',
})
export class JackpotSettingRecordDeleteDialogComponent {
  jackpotSettingRecord?: IJackpotSettingRecord;

  constructor(
    protected jackpotSettingRecordService: JackpotSettingRecordService,
    public activeModal: NgbActiveModal,
    protected eventManager: JhiEventManager
  ) {}

  cancel(): void {
    this.activeModal.dismiss();
  }

  confirmDelete(id: number): void {
    this.jackpotSettingRecordService.delete(id).subscribe(() => {
      this.eventManager.broadcast('jackpotSettingRecordListModification');
      this.activeModal.close();
    });
  }
}
