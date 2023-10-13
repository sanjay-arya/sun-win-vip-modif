import { Component } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { JhiEventManager } from 'ng-jhipster';

import { ITxRank } from 'app/shared/model/tx-rank.model';
import { TxRankService } from './tx-rank.service';

@Component({
  templateUrl: './tx-rank-delete-dialog.component.html',
})
export class TxRankDeleteDialogComponent {
  txRank?: ITxRank;

  constructor(protected txRankService: TxRankService, public activeModal: NgbActiveModal, protected eventManager: JhiEventManager) {}

  cancel(): void {
    this.activeModal.dismiss();
  }

  confirmDelete(id: number): void {
    this.txRankService.delete(id).subscribe(() => {
      this.eventManager.broadcast('txRankListModification');
      this.activeModal.close();
    });
  }
}
