import { Component } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { JhiEventManager } from 'ng-jhipster';

import { IRocketRank } from 'app/shared/model/rocket-rank.model';
import { RocketRankService } from './rocket-rank.service';

@Component({
  templateUrl: './rocket-rank-delete-dialog.component.html',
})
export class RocketRankDeleteDialogComponent {
  rocketRank?: IRocketRank;

  constructor(
    protected rocketRankService: RocketRankService,
    public activeModal: NgbActiveModal,
    protected eventManager: JhiEventManager
  ) {}

  cancel(): void {
    this.activeModal.dismiss();
  }

  confirmDelete(id: number): void {
    this.rocketRankService.delete(id).subscribe(() => {
      this.eventManager.broadcast('rocketRankListModification');
      this.activeModal.close();
    });
  }
}
