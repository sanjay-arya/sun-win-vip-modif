import { Component } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { JhiEventManager } from 'ng-jhipster';

import { IXocdiaJackpotRecord } from 'app/shared/model/xocdia-jackpot-record.model';
import { XocdiaJackpotRecordService } from './xocdia-jackpot-record.service';

@Component({
  templateUrl: './xocdia-jackpot-record-delete-dialog.component.html',
})
export class XocdiaJackpotRecordDeleteDialogComponent {
  xocdiaJackpotRecord?: IXocdiaJackpotRecord;

  constructor(
    protected xocdiaJackpotRecordService: XocdiaJackpotRecordService,
    public activeModal: NgbActiveModal,
    protected eventManager: JhiEventManager
  ) {}

  cancel(): void {
    this.activeModal.dismiss();
  }

  confirmDelete(id: number): void {
    this.xocdiaJackpotRecordService.delete(id).subscribe(() => {
      this.eventManager.broadcast('xocdiaJackpotRecordListModification');
      this.activeModal.close();
    });
  }
}
