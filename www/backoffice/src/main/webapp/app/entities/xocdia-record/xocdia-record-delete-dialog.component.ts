import { Component } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { JhiEventManager } from 'ng-jhipster';

import { IXocdiaRecord } from 'app/shared/model/xocdia-record.model';
import { XocdiaRecordService } from './xocdia-record.service';

@Component({
  templateUrl: './xocdia-record-delete-dialog.component.html',
})
export class XocdiaRecordDeleteDialogComponent {
  xocdiaRecord?: IXocdiaRecord;

  constructor(
    protected xocdiaRecordService: XocdiaRecordService,
    public activeModal: NgbActiveModal,
    protected eventManager: JhiEventManager
  ) {}

  cancel(): void {
    this.activeModal.dismiss();
  }

  confirmDelete(id: number): void {
    this.xocdiaRecordService.delete(id).subscribe(() => {
      this.eventManager.broadcast('xocdiaRecordListModification');
      this.activeModal.close();
    });
  }
}
