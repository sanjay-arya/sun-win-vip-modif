import { Component } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { JhiEventManager } from 'ng-jhipster';

import { IXocdiaRank } from 'app/shared/model/xocdia-rank.model';
import { XocdiaRankService } from './xocdia-rank.service';

@Component({
  templateUrl: './xocdia-rank-delete-dialog.component.html',
})
export class XocdiaRankDeleteDialogComponent {
  xocdiaRank?: IXocdiaRank;

  constructor(
    protected xocdiaRankService: XocdiaRankService,
    public activeModal: NgbActiveModal,
    protected eventManager: JhiEventManager
  ) {}

  cancel(): void {
    this.activeModal.dismiss();
  }

  confirmDelete(id: number): void {
    this.xocdiaRankService.delete(id).subscribe(() => {
      this.eventManager.broadcast('xocdiaRankListModification');
      this.activeModal.close();
    });
  }
}
