import { Component } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { JhiEventManager } from 'ng-jhipster';

import { ITransferHistory } from 'app/shared/model/transfer-history.model';
import { TransferHistoryService } from './transfer-history.service';

@Component({
  templateUrl: './transfer-history-delete-dialog.component.html',
})
export class TransferHistoryDeleteDialogComponent {
  transferHistory?: ITransferHistory;

  constructor(
    protected transferHistoryService: TransferHistoryService,
    public activeModal: NgbActiveModal,
    protected eventManager: JhiEventManager
  ) {}

  cancel(): void {
    this.activeModal.dismiss();
  }

  confirmDelete(id: number): void {
    this.transferHistoryService.delete(id).subscribe(() => {
      this.eventManager.broadcast('transferHistoryListModification');
      this.activeModal.close();
    });
  }
}
