import { Component } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { JhiEventManager } from 'ng-jhipster';

import { ITaixiuRecord } from 'app/shared/model/taixiu-record.model';
import { TaixiuRecordService } from './taixiu-record.service';

@Component({
  templateUrl: './taixiu-record-delete-dialog.component.html',
})
export class TaixiuRecordDeleteDialogComponent {
  taixiuRecord?: ITaixiuRecord;

  constructor(
    protected taixiuRecordService: TaixiuRecordService,
    public activeModal: NgbActiveModal,
    protected eventManager: JhiEventManager
  ) {}

  cancel(): void {
    this.activeModal.dismiss();
  }

  confirmDelete(id: number): void {
    this.taixiuRecordService.delete(id).subscribe(() => {
      this.eventManager.broadcast('taixiuRecordListModification');
      this.activeModal.close();
    });
  }
}
